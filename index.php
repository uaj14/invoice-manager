<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Manager - All Invoices</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once 'db.php';
        require_once 'nav.php';

        // POST: Deleting an invoice
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_type'], $_POST['number']) && $_POST['post_type'] === 'delete') {
            $searchNumber = trim($_POST['number'] ?? '');
            if ($searchNumber !== '') {
                deleteInvoice($searchNumber);
            }
        }

        $selectedStatus = $_GET['status'] ?? 'all';
        $statuses = getAllStatusesWithAll();
        if (!in_array($selectedStatus, $statuses, true)) {
            $selectedStatus = 'all';
        }

        $filteredInvoices = getInvoices($selectedStatus);

        renderNav($selectedStatus);
        require_once 'invoice-list.php';
    ?>
</body>
</html>