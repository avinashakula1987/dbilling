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
					<!--<div class='form-group col-md-3'>
						<label>Barcode(If Existed)</label><br>
						<input type='text' id='barcode' class='form-control' placeholder='Barcode' />
					</div>-->
					
					<div class='form-group col-md-3'>
						<label>Vendor</label><br>
						<input type='text' id='vendor' class='form-control stay' placeholder='Vendor Name' />
					</div>
					<div class='form-group col-md-3'>
						<label>Location</label><br>
						<input type='text' id='location' class='form-control stay' placeholder='Location' />
					</div>
					<div class='form-group col-md-3'>
						<label>Invoice Number</label><br>
						<input type='text' id='invoiceno' class='form-control stay' placeholder='Invoice No.' />
					</div>
					<div class='form-group col-md-3'>
						<label>Date of Purchase</label><br>
						<input type='text' id='dateofpurchase' class='form-control stay' placeholder='Date Of Purchase' />
					</div>
					
					
					<div class='clearfix'></div>
					<div class='form-group col-md-3'>
						<label>Category</label><br>
						<input type='text' id='category' class='form-control categories_dropdown stay' placeholder='Category' />
					</div>
					<div class='form-group col-md-3'>
						<label>Product/Item Title</label><br>
						<input type='text' id='product' class='form-control stock_dropdown productinstockcreation dontstay' placeholder='Product Title' />
					</div>
					<div class='form-group col-md-3'>
						<label>HSN Code</label><br>
						<input type='text' id='stock_hsn' class='form-control dontstay' placeholder='HSN Code' />
					</div>
					<!--<div class='form-group col-md-3'>
						<label>MRP</label><br>
						<input type='text' id='mrp_price' class='form-control stockcreation_mrp' placeholder='MRP Price' />
					</div>
					<div class='form-group col-md-3'>
						<label>Discount(%)</label><br>
						<input type='text' id='discount' class='form-control stockcreation_discount' placeholder='Discounnt(%)' />
					</div>-->
					<div class='form-group col-md-3'>
						<label>Quantity</label><br>
						<input type='text' id='stock_qty' class='form-control dontstay' placeholder='Quantity' />
					</div>
					
					
				</div>
				<div class='clearfix'></div>
				
				<div class='row'>
					
					<div class='form-group col-md-3'>
						<label>Purchased Bill Amount</label><br>
						<input type='number' id='stock_price' class='form-control dontstay' placeholder='Price' />
					</div>
					
					<div class='form-group newqty_formblock  col-md-4'>
						<label>Fresh Quantity</label><br>
						<input type='text' id='stock_qty2' class='form-control dontstay' placeholder='Quantity' />
					</div>
					<div class='form-group newqty_formblock  col-md-4 text-center'>
						<label>Total Quantity</label><br>
						<b id='totalfreshqty'></b>						
					</div>
					
					<div class='clearfix'></div>
					<hr>
					
					<div class='form-group   col-md-2 text-left'>
						<label>GST</label><br>
						<select id='gsttype' class='form-control' >
							<option value='1'>Include</option>
							<option value='2'>Exclude</option>
						</select>		
					</div>
					<div class='form-group col-md-2 text-left'>
						<label>GST(%)</label><br>
						<input type='text' id='gst' class='form-control dontstay' placeholder='GST(%)' />					
					</div>
					<div class='form-group   col-md-2 text-left'>
						<label>GST Amount</label><br>
						<input type='text' id='gstprice' class='form-control dontstay' placeholder='GST Amount' />					
					</div>
					<div class='form-group   col-md-3 text-left'>
						<label>Net Amount</label><br>
						<input type='text' id='actualprice' class='form-control dontstay' placeholder='Net Amount' />					
					</div>
					<div class='clearfix'></div>
					<hr>
					<div class='form-group   col-md-3 text-left'>
						<label>Invididual Net Amount</label><br>
						<input type='text' id='individualnetprice' class='form-control dontstay' placeholder='Individual Net Amount' />					
					</div>
				</div>	
				
				<button id='createStock' class='btn btn-md btn-info' >Create Stock</button>			
			</div>	
			
			
			
			
		  </div>
		</div>
	</div>	
</div>



<?php include("footer.php"); ?>




