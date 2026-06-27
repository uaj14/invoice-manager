<?php if (!isset($selectedStatus)) { $selectedStatus = $_GET['status'] ?? 'all'; }
?>

<?php
$currentSort = $_GET['sort'] ?? '';
$currentDir = (isset($_GET['dir']) && strtolower($_GET['dir']) === 'desc') ? 'desc' : 'asc';

function headerLink(string $col, string $label, string $selectedStatus, string $currentSort, string $currentDir) {
    $nextDir = ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc';
    $arrow = '';
    if ($currentSort === $col) {
        $arrow = $currentDir === 'asc' ? ' ▲' : ' ▼';
    }
    return sprintf('<a href="index.php?status=%s&sort=%s&dir=%s">%s%s</a>', rawurlencode($selectedStatus), rawurlencode($col), rawurlencode($nextDir), htmlspecialchars($label, ENT_QUOTES, 'UTF-8'), $arrow);
}
?>

<div class="invoice_header">
    <div class="invoice_header_item"><?php echo headerLink('number', 'Number', $selectedStatus, $currentSort, $currentDir); ?></div>
    <div class="invoice_header_item"><?php echo headerLink('client', 'Client', $selectedStatus, $currentSort, $currentDir); ?></div>
    <div class="invoice_header_item"><?php echo headerLink('amount', 'Amount', $selectedStatus, $currentSort, $currentDir); ?></div>
</div>

<?php
foreach (($filteredInvoices ?? []) as $invoice): ?>
    <div class="invoice">
        <div class="invoice_item invoice_number"><?php echo htmlspecialchars($invoice["number"], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="invoice_item invoice_client"><a href="mailto:<?php echo htmlspecialchars($invoice["email"], ENT_QUOTES, 'UTF-8') ?>"><?php echo htmlspecialchars($invoice["client"], ENT_QUOTES, 'UTF-8') ?></a></div>
        <div class="invoice_item invoice_amount">$ <?php echo htmlspecialchars($invoice["amount"], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="invoice_item invoice_status <?php 
            switch ($invoice["status"]){
                case "draft":
                    echo "invoice_status_draft";
                    break;
                case "pending":
                    echo "invoice_status_pending";
                    break;
                case "paid":
                    echo "invoice_status_paid";
                    break;
            }

        ?>"><?php echo htmlspecialchars($invoice["status"], ENT_QUOTES, 'UTF-8') ?></div>

        <div class="invoice_actions">
            <?php if (invoiceDocumentExists($invoice["number"])): ?>
                <a href="documents/<?php echo rawurlencode($invoice["number"]); ?>.pdf" target="_blank" rel="noopener" class="invoice_button">View</a>
            <?php else: ?>
                <span class="invoice_button invoice_button_placeholder"></span>
            <?php endif; ?>
            <a href="update.php?number=<?php echo $invoice["number"] ?>" id="edit_button" class="invoice_button">Edit</a>
            <form method="post">
                <input type="hidden" name="post_type" value="delete">
                <input 
                    type="hidden" 
                    name="number" 
                    value="<?php echo $invoice["number"] ?>">
                <button id="delete_button" class="invoice_button">Delete</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>