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
        renderNav($invoices);
        require_once 'invoice-list.php';
    ?>
</body>
</html>