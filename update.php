<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Invoice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once 'db.php';
        require_once 'validate.php';
        require_once 'nav.php';
        renderNav('none');

        $selectedInvoice = null;
        $invoiceNumber = null;
        $error = null;
        $errors = [];
        $old = ['client' => '', 'email' => '', 'amount' => '', 'status' => 'draft'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['post_type'] ?? '') === 'update') {
            $invoiceNumber = trim($_POST['number'] ?? '');
            if ($invoiceNumber === '') {
                $error = "Invalid invoice number.";
            } else {
                $result = validateInvoiceData($_POST, 'update');
                if ($result['valid']) {
                    updateInvoice($invoiceNumber, $result['data']);
                    $status = rawurlencode($result['data']['status'] ?? 'all');
                    header("Location: index.php?status={$status}");
                    exit;
                }

                $errors = $result['errors'];
                $old['client'] = htmlspecialchars($_POST['client'] ?? '', ENT_QUOTES, 'UTF-8');
                $old['email'] = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
                $old['amount'] = htmlspecialchars($_POST['amount'] ?? '', ENT_QUOTES, 'UTF-8');
                $old['status'] = $_POST['status'] ?? 'draft';
            }
        }

        if ($invoiceNumber === null && isset($_GET['number']) && !empty(trim($_GET['number']))) {
            $invoiceNumber = trim($_GET['number']);
        }

        if ($invoiceNumber !== null && $error === null) {
            $selectedInvoice = getInvoiceByNumber($invoiceNumber);
            if (!$selectedInvoice) {
                $error = "Invoice not found.";
            }
        }

        if ($selectedInvoice && empty($errors)) {
            $old['client'] = htmlspecialchars($selectedInvoice["client"], ENT_QUOTES, 'UTF-8');
            $old['email'] = htmlspecialchars($selectedInvoice["email"], ENT_QUOTES, 'UTF-8');
            $old['amount'] = htmlspecialchars($selectedInvoice["amount"], ENT_QUOTES, 'UTF-8');
            $old['status'] = $selectedInvoice["status"];
        }
    ?>
    
    <?php if ($error): ?>
        <div class="error-message" style="color: red; padding: 1rem; margin: 1rem 10%; background-color: #ffcccc; border-radius: 4px;">
            <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <p style="text-align: center; margin-top: 2rem;">
            <a href="index.php" class="nav-link" style="display: inline-block; padding: 0.5rem 1rem; background-color: #34495e; color: white; text-decoration: none; border-radius: 4px;">Back to Invoices</a>
        </p>
    <?php else: ?>
    <?php if (!empty($errors)): ?>
        <div class="error-message" style="color: #b00020; background:#ffdede; padding:8px; margin:1rem 10%; border-radius:6px;">
            <ul style="margin:0 0 0.5rem 1.25rem;">
                <?php foreach ($errors as $err): ?>
                    <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form class="add invoice-form" action="" method="post">
        <h1>Update Invoice</h1>
        <input type="hidden" name="post_type" value="update">
        <input type="hidden" name="number" value="<?php echo htmlspecialchars($invoiceNumber, ENT_QUOTES, 'UTF-8'); ?>">

        <label for="client">Client Name</label>
        <input id="client" name="client" type="text" value="<?php echo $old['client']; ?>" required>

        <label for="email">Client Email</label>
        <input id="email" name="email" type="email" value="<?php echo $old['email']; ?>" required>

        <label for="amount">Amount</label>
        <input id="amount" name="amount" type="number" step="1" min="1" value="<?php echo $old['amount']; ?>" required>

        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="draft" <?php echo $old['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
            <option value="pending" <?php echo $old['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="paid" <?php echo $old['status'] === 'paid' ? 'selected' : ''; ?>>Paid</option>
        </select>

        <button type="submit" class="nav-link">Update Invoice</button>
    </form>
    <?php endif; ?>

</body>
</html>
