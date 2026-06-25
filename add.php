<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Invoice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once 'db.php';
        require_once 'validate.php';
        require_once 'nav.php';
        renderNav('none');

        // Generate invoice number helper.
        function getInvoiceNumber ($length = 5) {
            $letters = range('A', 'Z');
            $number = [];

            for ($i = 0; $i < $length; $i++) {
                array_push($number, $letters[rand(0, count($letters) - 1)]);
            }

            return implode($number);
        }

        // Prepare defaults and handle POST submit on this page.
        $errors = [];
        $old = ['client' => '', 'email' => '', 'amount' => '', 'status' => 'draft'];
        $invoiceNumber = getInvoiceNumber();
        $formType = 'add';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['post_type'] ?? '') === 'add') {
            $result = validateInvoiceData($_POST, 'add');
            if ($result['valid']) {
                $file = $_FILES['document'] ?? ['error' => UPLOAD_ERR_NO_FILE];
                if (saveInvoiceDocument($result['data']['number'], $file, $errors) && addInvoice($result['data'])) {
                    $status = rawurlencode($result['data']['status'] ?? 'all');
                    header("Location: index.php?status={$status}");
                    exit;
                }

                if (!empty($result['data']['number'])) {
                    deleteInvoiceDocument($result['data']['number']);
                }
            }

            $errors = array_merge($errors, $result['errors']);
            $old['client'] = htmlspecialchars($_POST['client'] ?? '', ENT_QUOTES, 'UTF-8');
            $old['email'] = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
            $old['amount'] = htmlspecialchars($_POST['amount'] ?? '', ENT_QUOTES, 'UTF-8');
            $old['status'] = $_POST['status'] ?? 'draft';
            if (!empty($_POST['number'])) {
                $invoiceNumber = htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
            }
        }
    ?>

    <?php require_once 'invoice-form.php'; ?>

</body>
</html>
