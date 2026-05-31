<?php
function renderNav($invoices) { ?>
    <nav class="navbar">
        <h1>Invoice Manager</h1>
        <p>There are <?php echo sizeof($invoices) ?> invoices.</p>
        <ul class="nav-list">
            <li><a href="index.php" class="nav-link">All</a></li>
            <li><a href="draft.php" class="nav-link">Draft</a></li>
            <li><a href="pending.php" class="nav-link">Pending</a></li>
            <li><a href="paid.php" class="nav-link">Paid</a></li>
        </ul>
    </nav>
<?php }
?>