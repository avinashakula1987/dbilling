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
			<h3 class="panel-title">Add Purchased Stock</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			  <li role="presentation"><a href="purchases.php">Purchased Stock</a></li>
			  <li role="presentation" class='pull-right active'><a href="add_stock.php" class='text-danger'>Add Purchased Stock</a></li>
			</ul>
			
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
					
					<div class='form-group col-md-3'>
						<label>Qty</label><br>
						<select id='quantity' class='form-control' >
							<option value="">Select</option>
							<option value="Box">Box</option>
							<option value="10 pack">10 pack</option>
							<option value="30 pack">30 pack</option>
							<option value="50 pack">50 pack</option>
							<option value="100 pack">100 pack</option>
							<option value="200 pack">200 pack</option>
							<option value="500 pack">500 pack</option>
							<option value="1000 pack">1000 pack</option>
							<option value="10000 pack">10000 pack</option>
							<option value="1 kg">1 kg</option>
						</select>
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




