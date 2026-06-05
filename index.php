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
        require_once 'nav.php';

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