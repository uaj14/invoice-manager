<?php
/**
 * Reusable invoice form component
 * 
 * Parameters:
 * - $formType: 'add' or 'update' to determine form behavior and labels
 * - $invoiceNumber: The invoice number (hidden field value)
 * - $old: Array with keys 'client', 'email', 'amount', 'status' for form values
 * - $errors: Array of validation error messages
 */

if (!isset($formType) || !in_array($formType, ['add', 'update'], true)) {
    $formType = 'add';
}

if (!isset($invoiceNumber)) {
    $invoiceNumber = '';
}

if (!isset($old)) {
    $old = ['client' => '', 'email' => '', 'amount' => '', 'status' => 'draft'];
}

if (!isset($errors)) {
    $errors = [];
}

$isUpdate = $formType === 'update';
$headingText = $isUpdate ? 'Update Invoice' : 'Add Invoice';
$buttonText = $isUpdate ? 'Update Invoice' : 'Submit Invoice';
$postType = $isUpdate ? 'update' : 'add';
?>

<?php if (!empty($errors)): ?>
    <div class="error-message" style="color: #b00020; background:#ffdede; padding:8px; margin:1rem 10%; border-radius:6px;">
        <ul style="margin:0 0 0.5rem 1.25rem;">
            <?php foreach ($errors as $err): ?>
                <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form class="add invoice-form" action="" method="post" enctype="multipart/form-data">
    <h1><?php echo $headingText; ?></h1>
    <input type="hidden" name="post_type" value="<?php echo $postType; ?>">
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

    <label for="document">Upload PDF</label>
    <input id="document" name="document" type="file" accept="application/pdf">

    <button type="submit" class="nav-link"><?php echo $buttonText; ?></button>
</form>
