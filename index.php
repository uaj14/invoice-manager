<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        // POST: Deleting an invoice
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_type'], $_POST['number'])) {
            if ($_POST['post_type'] === 'delete') {
                $searchNumber = trim($_POST['number'] ?? '');
                foreach ($_SESSION['all_invoices'] as $key => $invoice) {
                    if ($invoice['number'] === $searchNumber) {
                        unset($_SESSION['all_invoices'][$key]);
                        $_SESSION['all_invoices'] = array_values($_SESSION['all_invoices']);
                        break;
                    }
                }
            }
        }

        // Query String to filter invoice by status.
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