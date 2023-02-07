<?php include("database.php"); ?>
<?php include("session.php"); ?>

<?php include("headpart.php"); ?>

<link rel='stylesheet' href='datatables/css/jquery.dataTables.min.css'></link>
<link rel='stylesheet' href='datatables/css/buttons.dataTables.min.css'></link>
<script type='text/javascript' src='datatables/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='datatables/js/dataTables.buttons.min.js'></script>



<?php include("navbar.php"); ?>
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Stock</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="stock.php">Stock</a></li>
			  <li role="presentation"><a href="unavailable_stock.php">Unavailable Stock</a></li>
			  <li role="presentation"><a href="inactive_stock.php">Inactive Stock</a></li>
			  <li role="presentation" class='pull-right'><a href="add_stock.php" class='text-danger'>Add Stock</a></li>
			</ul>
			
			<div class='well'>
				<table class='table table-condensed' id='datatables'>
					<thead>
						<th>S No.</th>
						<th>Invoice</th>
						<th>Product</th>
						<th>Qty</th>
						<th>Date</th>
					</thead>
					<tbody>
						<?php 
							$sql = "SELECT * FROM trackers WHERE product='".$_GET['id']."' ORDER BY id DESC";
							$get = $db->query($sql);
								$sno = 1;
								while( $res = $get->fetchArray(SQLITE3_ASSOC) ){
									$id = $res['id'];
									$productname = show_product_name($res['product'], $db);
									$invoice = $res['invoice'];
									$product = $res['product'];
									$qty = $res['qty'];
									$date = $res['date'];
									echo "<tr id='row_$id'>";
									echo "<td>$sno</td>";
									echo "<td><a href='invoice.php?invoice=$invoice'>Invoice(#$invoice)</a></td>";
									echo "<td>$productname(#$product)</td>";
									echo "<td>$qty</td>";
									echo "<td>$date</td>";
									echo "</tr>";
									$sno++;
								}
						?>					
					</tbody>
				</table>
			</div>  
			
			
		  </div>
		</div>
	</div>	
</div>


<script type='text/javascript'>
	$(document).ready(function() {
		$('#datatables').DataTable();
	} );
</script>


<?php include("footer.php"); ?>




