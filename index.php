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
        require_once 'data.php';

        // Initialize session all invoices
        session_start();
        if (!isset($_SESSION["all_invoices"])) {
            $_SESSION["all_invoices"] = $invoices;
        }
        require_once 'nav.php';

        // POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newInvoice = [
                'number' => $_POST['number'] ?? '',
                'amount' => isset($_POST['amount']) ? (float) $_POST['amount'] : 0,
                'status' => $_POST['status'] ?? 'draft',
                'client' => $_POST['client'] ?? '',
                'email' => $_POST['email'] ?? '',
            ];

            if ($newInvoice['number'] && $newInvoice['client'] && $newInvoice['email']) {
                array_push($_SESSION["all_invoices"], $newInvoice);
            }
        }

        // Query String
        $selectedStatus = $_GET['status'] ?? 'all';
        if (!in_array($selectedStatus, $statuses, true)) {
            $selectedStatus = 'all';
        }

        // Set a list of invoices that is filtered from the master list of invoices from $_SESSION
        $filteredInvoices = $selectedStatus === 'all'
            ? $_SESSION["all_invoices"]
            : array_filter($_SESSION["all_invoices"] ?? [], fn($invoice) => $invoice['status'] === $selectedStatus);

        renderNav($selectedStatus);
        require_once 'invoice-list.php';
    ?>
</body>
</html>