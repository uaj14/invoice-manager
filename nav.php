<?php
function renderNav($currentStatus = 'all', $count = null) {
    if ($count === null && $currentStatus !== 'none') {
        $all = $_SESSION["all_invoices"] ?? [];
        if ($currentStatus === 'all') {
            $count = sizeof($all);
        } else {
            $count = sizeof(array_filter($all, fn($inv) => ($inv['status'] ?? '') === $currentStatus));
        }
    }
?>
    <nav class="navbar">
        <h1>Invoice Manager</h1>
        <?php if ($currentStatus !== 'none'){?>
            <p>There are <?php echo $count ?> invoices.</p>
        <?php } else {?>
            <br>
        <?php } ?>
        <ul class="nav-list">
            <li><a href="index.php?status=all" class="nav-link<?php echo $currentStatus === 'all' ? ' active' : ''; ?>">All</a></li>
            <li><a href="index.php?status=draft" class="nav-link<?php echo $currentStatus === 'draft' ? ' active' : ''; ?>">Draft</a></li>
            <li><a href="index.php?status=pending" class="nav-link<?php echo $currentStatus === 'pending' ? ' active' : ''; ?>">Pending</a></li>
            <li><a href="index.php?status=paid" class="nav-link<?php echo $currentStatus === 'paid' ? ' active' : ''; ?>">Paid</a></li>
            <li><a href="add.php" class="nav-link<?php echo strpos($_SERVER['PHP_SELF'], 'add.php') !== false ? ' active' : ''; ?>">Add</a></li>
        </ul>
    </nav>
<?php }
?>