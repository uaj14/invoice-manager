<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Invoice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once 'data.php';
        session_start();
        if (!isset($_SESSION["all_invoices"])) {
            $_SESSION["all_invoices"] = $invoices;
        }
        require_once 'nav.php';
        renderNav('none');

        // Get data associated with the invoice number
        if (isset($_GET['number'])) {
            
            $invoiceNumber = $_GET['number'];
            $allInvoices = $_SESSION["all_invoices"];
            $selectedInvoice = array_filter($allInvoices, function ($invoice) use ($invoiceNumber) {
                return $invoice["number"] === $invoiceNumber;
            });
            $selectedInvoice = reset($selectedInvoice);
        }
    ?>
    <h1> <?php echo $invoiceNumber ?></h1>
    <form class="add" action="index.php" method="post" class="invoice-form">
        <h1>Update Invoice</h1>
        <input type="hidden" name="post_type" value="update">
        <input type="hidden" name="number" value="<?php echo $invoiceNumber; ?>">

        <label for="client">Client Name</label>
        <input id="client" name="client" type="text" value="<?php echo $selectedInvoice["client"]; ?>" required>

        <label for="email">Client Email</label>
        <input id="email" name="email" type="email" value="<?php echo $selectedInvoice["email"]; ?>" required>

        <label for="amount">Amount</label>
        <input id="amount" name="amount" type="number" step="0.01" min="0" value="<?php echo $selectedInvoice["amount"]; ?>" required>

        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="draft" <?php if ($selectedInvoice["status"] === "draft") echo "selected"; ?>>Draft</option>
            <option value="pending" <?php if ($selectedInvoice["status"] === "pending") echo "selected"; ?>>Pending</option>
            <option value="paid" <?php if ($selectedInvoice["status"] === "paid") echo "selected"; ?>>Paid</option>
        </select>

        <button type="submit" class="nav-link">Update Invoice</button>
    </form>

</body>
</html>
