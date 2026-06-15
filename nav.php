<?php
require_once 'db.php';

function renderNav($currentStatus = 'all', $count = null) {
    if ($count === null && $currentStatus !== 'none') {
        $count = getInvoiceCount($currentStatus);
    }
    $statuses = getAllStatusesWithAll();
?>
    <nav class="navbar">
        <h1>Invoice Manager</h1>
        <?php if ($currentStatus !== 'none'){?>
            <p>There are <?php echo $count ?> invoices.</p>
        <?php } else {?>
            <br>
        <?php } ?>
        <ul class="nav-list">
            <?php foreach ($statuses as $status): ?>
                <li><a href="index.php?status=<?php echo rawurlencode($status); ?>" class="nav-link<?php echo $currentStatus === $status ? ' active' : ''; ?>"><?php echo ucfirst($status); ?></a></li>
            <?php endforeach; ?>
            <li><a href="add.php" class="nav-link<?php echo strpos($_SERVER['PHP_SELF'], 'add.php') !== false ? ' active' : ''; ?>">Add</a></li>
        </ul>
    </nav>
<?php }
?>