

<?php foreach (($invoices ?? []) as $invoice): ?>
<div class="invoice">
    <div><?php echo $invoice["number"] ?></div>
    <div><?php echo $invoice["client"] ?></div>
    <div><?php echo $invoice["amount"] ?></div>
    <div><?php echo $invoice["status"] ?></div>
</div>
<?php endforeach; ?>