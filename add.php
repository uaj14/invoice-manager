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
        require_once 'validate.php';
        session_start();
        if (!isset($_SESSION["all_invoices"])) {
            $_SESSION["all_invoices"] = $invoices;
        }
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['post_type'] ?? '') === 'add') {
            $result = validateInvoiceData($_POST, 'add');
            if ($result['valid']) {
                    // Insert validated data into session and redirect to filtered list
                    array_push($_SESSION['all_invoices'], $result['data']);
                    $status = rawurlencode($result['data']['status'] ?? 'all');
                    header("Location: index.php?status={$status}");
                    exit;
            }
            // preserve entered values and show errors
            $errors = $result['errors'];
            $old['client'] = htmlspecialchars($_POST['client'] ?? '', ENT_QUOTES, 'UTF-8');
            $old['email'] = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
            $old['amount'] = htmlspecialchars($_POST['amount'] ?? '', ENT_QUOTES, 'UTF-8');
            $old['status'] = $_POST['status'] ?? 'draft';
            // keep the invoice number the user submitted if provided
            if (!empty($_POST['number'])) {
                    $invoiceNumber = htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
            }
        }
    ?>

    <?php if (!empty($errors)): ?>
        <div class="error-message" style="color: #b00020; background:#ffdede; padding:8px; margin:1rem 10%; border-radius:6px;">
            <ul style="margin:0 0 0.5rem 1.25rem;">
                <?php foreach ($errors as $err): ?>
                    <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="add invoice-form" action="" method="post">
        <h1>Add Invoice</h1>
        <input type="hidden" name="post_type" value="add">
        <input type="hidden" name="number" value="<?php echo $invoiceNumber; ?>">

        <label for="client">Client Name</label>
        <input id="client" name="client" type="text" value="<?php echo $old['client']; ?>" required>

        <label for="email">Client Email</label>
        <input id="email" name="email" type="email" value="<?php echo $old['email']; ?>" required>

        <label for="amount">Amount</label>
        <input id="amount" name="amount" type="number" step="1" min="1" value="<?php echo $old['amount']; ?>" required>

        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="draft" <?php echo $old['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
            <option value="pending" <?php echo $old['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
            <option value="paid" <?php echo $old['status'] === 'paid' ? 'selected' : ''; ?>>Paid</option>
        </select>

        <button type="submit" class="nav-link">Submit Invoice</button>
    </form>

</body>
</html>
