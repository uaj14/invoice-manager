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
        $formType = 'update';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['post_type'] ?? '') === 'update') {
            $invoiceNumber = trim($_POST['number'] ?? '');
            if ($invoiceNumber === '') {
                $error = "Invalid invoice number.";
            } else {
                $result = validateInvoiceData($_POST, 'update');
                if ($result['valid']) {
                    $file = $_FILES['document'] ?? ['error' => UPLOAD_ERR_NO_FILE];
                    if (saveInvoiceDocument($invoiceNumber, $file, $errors) && updateInvoice($invoiceNumber, $result['data'])) {
                        $status = rawurlencode($result['data']['status'] ?? 'all');
                        header("Location: index.php?status={$status}");
                        exit;
                    }
                }

                $errors = array_merge($errors, $result['errors']);
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
        <?php require_once 'invoice-form.php'; ?>
    <?php endif; ?>

</body>
</html>
