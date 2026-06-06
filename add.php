<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Invoice</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once 'data.php';
        require_once 'nav.php';
        renderNav($invoices, 'all');

        function getInvoiceNumber ($length = 5) {
          $letters = range('A', 'Z');
          $number = [];

          for ($i = 0; $i < $length; $i++) {
            array_push($number, $letters[rand(0, count($letters) - 1)]);
          }

          return implode($number);
        }

        $invoiceNumber = getInvoiceNumber();
    ?>

    <div class="add">
        <h1>Add Invoice</h1>

        <form class="add" action="index.php" method="post" class="invoice-form">
            <label>Invoice Number</label>
            <div class="invoice-number"><?php echo $invoiceNumber; ?></div>
            <input type="hidden" name="number" value="<?php echo $invoiceNumber; ?>">

            <label for="client">Client Name</label>
            <input id="client" name="client" type="text" required>

            <label for="email">Client Email</label>
            <input id="email" name="email" type="email" required>

            <label for="amount">Amount</label>
            <input id="amount" name="amount" type="number" step="0.01" min="0" required>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="draft">Draft</option>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
            </select>

            <button type="submit">Submit Invoice</button>
        </form>
    </main>
</body>
</html>
