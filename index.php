<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Invoice Manager - All Invoices</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        session_start();
        require_once 'data.php';
        require_once 'nav.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newInvoice = [
                'number' => $_POST['number'] ?? '',
                'amount' => isset($_POST['amount']) ? (float) $_POST['amount'] : 0,
                'status' => $_POST['status'] ?? 'draft',
                'client' => $_POST['client'] ?? '',
                'email' => $_POST['email'] ?? '',
            ];

            if ($newInvoice['number'] && $newInvoice['client'] && $newInvoice['email']) {
                $invoices[] = $newInvoice;
            }
        }

        $selectedStatus = $_GET['status'] ?? 'all';
        if (!in_array($selectedStatus, $statuses, true)) {
            $selectedStatus = 'all';
        }

        $invoices = $selectedStatus === 'all'
            ? $invoices
            : array_filter($invoices ?? [], fn($invoice) => $invoice['status'] === $selectedStatus);

        renderNav($invoices, $selectedStatus);
        require_once 'invoice-list.php';
    ?>
</body>
</html>