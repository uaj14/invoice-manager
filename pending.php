<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Invoices</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once 'init.php';
        $invoices = array_filter($invoices ?? [], function($n) {
            return $n["status"] == "pending"; 
        });
        require_once 'invoice-list.php';
    ?>
</body>
</html>
