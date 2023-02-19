<?php 
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<ul class="nav nav-tabs">
	<?php echo $current_page == "add_stock.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="add_stock.php">Add Stock</a></li>
	<?php echo $current_page == "stock.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="stock.php">Stock</a></li>	
	<?php echo $current_page == "inactive_stock.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="inactive_stock.php">Inactive Stock</a></li>
	<?php echo $current_page == "measurements.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="measurements.php">Create Measure</a></li>			  
	<?php echo $current_page == "inactive_measurements.php" ? "<li role='presentation' class='active'>" : "<li role='presentation'>" ?><a href="inactive_measurements.php">Inactive Measurements</a></li>			  
</ul>