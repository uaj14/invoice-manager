<?php foreach (($invoices ?? []) as $invoice): ?>
<div class="invoice">
    <div class="invoice_item invoice_number"><?php echo $invoice["number"] ?></div>
    <div class="invoice_item invoice_client"><?php echo $invoice["client"] ?></div>
    <div class="invoice_item invoice_amount">$ <?php echo $invoice["amount"] ?></div>
    <div class="invoice_item invoice_status <?php 
        // if ($invoice["status"] == "draft"){

        // } else if ($invoice["status"] == "draft"){
        // } else if ($invoice["status"] == "draft"){}

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
</div>
<?php endforeach; ?>