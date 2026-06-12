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

        $TEST = "";

        // POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_type'], $_POST['number'])) {
            switch ($_POST['post_type']) {
                case 'add':
                    $newInvoice = [
                        'number' => $_POST['number'] ?? '',
                        'amount' => isset($_POST['amount']) ? (float) $_POST['amount'] : 0,
                        'status' => $_POST['status'] ?? 'draft',
                        'client' => $_POST['client'] ?? '',
                        'email' => $_POST['email'] ?? '',
                    ];

                    if ($newInvoice['number'] && $newInvoice['client'] && $newInvoice['email']) {
                        array_push($_SESSION['all_invoices'], $newInvoice);
                    }
                    break;
                case 'update':
                case 'delete':
                    foreach ($_SESSION['all_invoices'] as $key => $invoice) {
                        if ($invoice['number'] === $_POST['number']) {
                            if ($_POST['post_type'] === 'update') {
                                $_SESSION['all_invoices'][$key]['amount'] = isset($_POST['amount']) ? (float) $_POST['amount'] : 0;
                                $_SESSION['all_invoices'][$key]['status'] = $_POST['status'] ?? $invoice['status'];
                                $_SESSION['all_invoices'][$key]['client'] = $_POST['client'] ?? $invoice['client'];
                                $_SESSION['all_invoices'][$key]['email'] = $_POST['email'] ?? $invoice['email'];
                            } else {
                                unset($_SESSION['all_invoices'][$key]);
                                $_SESSION['all_invoices'] = array_values($_SESSION['all_invoices']);
                            }
                            break;
                        }
                    }
                    break;
            }
        }
        ?><!--<h1>TEST: <?php //echo $TEST ?></h1>--><?php

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