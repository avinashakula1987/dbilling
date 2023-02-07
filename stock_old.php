<?php include("database.php"); ?>
<?php include("session.php"); ?>

<?php include("headpart.php"); ?>



<?php include("navbar.php"); ?>
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Add Stock</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="stock.php">Stock</a></li>
			  <li role="presentation"><a href="unavailable_stock.php">Unavailable Stock</a></li>
			  <li role="presentation"><a href="inactive_stock.php">Inactive Stock</a></li>
			  <li role="presentation" class='pull-right'><a href="add_stock.php" class='text-danger'>Add Stock</a></li>
			</ul>
			
			<style>
				.updateStock{
					display:none;
				}
			</style>
			<div class='well stockform'>
				<div class='form-group'>
					<label>Category</label><br>
					<input type='text' id='category' class='form-control categories_dropdown' placeholder='Category' />
				</div>
				<div class='form-group'>
					<label>Product/Item Title</label><br>
					<input type='text' id='product' class='form-control stock_dropdown productinstockcreation' placeholder='Product Title' />
				</div>
				<div class='row'>
					<div class='form-group col-md-4'>
						<label>Quantity</label><br>
						<input type='text' id='stock_qty' class='form-control' placeholder='Quantity' />
					</div>
					<div class='form-group newqty_formblock  col-md-4'>
						<label>Fresh Quantity</label><br>
						<input type='text' id='stock_qty2' class='form-control' placeholder='Quantity' />
					</div>
					<div class='form-group newqty_formblock  col-md-4 text-center'>
						<label>Total Quantity</label><br>
						<b id='totalfreshqty'></b>
						
					</div>
				</div>	
				<div class='clearfix'></div>
				<div class='form-group'>
					<label>Price</label><br>
					<input type='text' id='stock_price' class='form-control' placeholder='Price' />
				</div>
				<button id='createStock' class='btn btn-md btn-info' >Create Stock</button>			
			</div>	
			
			
			
			
		  </div>
		</div>
	</div>	
</div>



<?php include("footer.php"); ?>




