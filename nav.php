<?php
function renderNav($invoices, $currentStatus = 'all') { ?>
    <nav class="navbar">
        <h1>Invoice Manager</h1>
        <p>There are <?php echo sizeof($invoices) ?> invoices.</p>
        <ul class="nav-list">
            <li><a href="index.php?status=all" class="nav-link<?php echo $currentStatus === 'all' ? ' active' : ''; ?>">All</a></li>
            <li><a href="index.php?status=draft" class="nav-link<?php echo $currentStatus === 'draft' ? ' active' : ''; ?>">Draft</a></li>
            <li><a href="index.php?status=pending" class="nav-link<?php echo $currentStatus === 'pending' ? ' active' : ''; ?>">Pending</a></li>
            <li><a href="index.php?status=paid" class="nav-link<?php echo $currentStatus === 'paid' ? ' active' : ''; ?>">Paid</a></li>
        </ul>
    </nav>
<?php }
?>