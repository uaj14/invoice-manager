<?php
foreach (($filteredInvoices ?? []) as $invoice): ?>
    <div class="invoice">
        <div class="invoice_item invoice_number"><?php echo $invoice["number"] ?></div>
        <div class="invoice_item invoice_client"><a href="<?php echo $invoice["email"] ?>"><?php echo $invoice["client"] ?></a></div>
        <div class="invoice_item invoice_amount">$ <?php echo $invoice["amount"] ?></div>
        <div class="invoice_item invoice_status <?php 
            switch ($invoice["status"]){
                case "draft":
                    echo "invoice_status_draft";
                    break;
                case "pending":
                    echo "invoice_status_pending";
                    break;
                case "paid":
                    echo "invoice_status_paid";
                    break;
            }

        ?>"><?php echo $invoice["status"] ?></div>

        <!-- <div class=""><button class="">Edit</button></div>
        <div class=""><button class="">Delete</button></div> -->

        <a href="update.php?number=<?php echo $invoice["number"] ?>" id="edit_button" class="invoice_button">Edit</a>
        <form method="post">
            <input type="hidden" name="post_type" value="delete">
            <input 
                type="hidden" 
                name="number" 
                value="<?php echo $invoice["number"] ?>">
            <button id="delete_button" class="invoice_button">Delete</button>
        </form>
        

    </div>
<?php endforeach; ?>