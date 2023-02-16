<?php 
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<ul class="nav nav-tabs">
    <?php echo $current_page == "billing.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="billing.php">Billing</a></li>
	<?php echo $current_page == "invoices.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="invoices.php">All Transactions</a></li>
	<?php echo $current_page == "bills.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="bills.php">Bills</a></li>
	<?php echo $current_page == "purchases.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="purchases.php">Purchases</a></li>
	<?php echo $current_page == "returns.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="returns.php">Returns</a></li>
	<?php echo $current_page == "credits.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="credits.php">Pending Credits</a></li>
	<?php echo $current_page == "completedCredits.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="completedCredits.php">Completed Credits</a></li>
	<?php echo $current_page == "pending_invoices.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="pending_invoices.php">Pending</a></li>
	<?php echo $current_page == "failed_invoices.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="failed_invoices.php">Failed</a></li>
</ul>