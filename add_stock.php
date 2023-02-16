<?php 
	include("database.php");
	include("session.php");
	include("headpart.php");
	include("navbar.php");
?>

<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">New Stock</h3>
		  </div>
		  <div class="panel-body">
		  	<?php include("stock_nav.php"); ?>
			<!-- <ul class="nav nav-tabs">
			  <li role="presentation"><a href="purchases.php">Purchased Stock</a></li>
			  <li role="presentation" class='pull-right active'><a href="add_stock.php" class='text-danger'>Add Purchased Stock</a></li>
			</ul> -->
			
			<style>
				.updateStock{
					display:none;
				}
			</style>
			<div class='well stockform'>
				<div class='row'>					
					
					<div class='form-group col-md-3'>
						<label>Product/Item Title</label><br>
						<input type='text' id='product' class='form-control stock_dropdown productinstockcreation dontstay' placeholder='Product Title' />
					</div>
					
				</div>
				<div class='clearfix'></div>				
				<div class='row'>					
					<div class='form-group   col-md-3 text-left'>
						<label>Amount</label><br>
						<input type='text' id='individualnetprice' class='form-control dontstay' placeholder='Amount' />					
					</div>
				</div>	
				
				<button id='createStock' class='btn btn-md btn-info' >Create Stock</button>			
			</div>	
			
			
			
			
		  </div>
		</div>
	</div>	
</div>



<?php include("footer.php"); ?>




