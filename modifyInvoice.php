<?php include("database.php"); ?>
<?php include("session.php"); ?>

<?php include("headpart.php"); ?>



<?php include("navbar.php"); ?>
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Edit Invoice</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			  <li role="presentation" class='active'><a href="billing.php">Billing</a></li>
			  <li role="presentation"><a href="invoices.php">Invoices</a></li>
			  <li role="presentation"><a href="pending_invoices.php">Pending Invoices</a></li>
			  <li role="presentation"><a href="failed_invoices.php">Failed Invoices</a></li>
			</ul>
			
			<style>
				.updateStock{
					display:none;
				}
			</style>
			<?php
				if( isset($_COOKIE['modifyInvoice']) ){
					$invoiceId = $_COOKIE['modifyInvoice'];
					$sql = "SELECT * FROM invoices WHERE id='$invoiceId'";
					$selectInvoice = mysqli_query($db, $sql);
					$res = mysqli_fetch_array($selectInvoice);
					$customername = $res['customer'];
					$mobile = $res['mobile'];
					$state = $res['state'];
					$pincode = $res['pin'];
					$gst = $res['gst'];
					$city = $res['city'];
					$address = $res['address'];
					$dispatchThrough = $res['dispatchThrough'];
					$vehicle = $res['vehicle'];
					$transaction = $res['transaction'];
					$fullPayment = $res['fullPayment'];
					$partialPayment = $res['partialPayment'];
					$returnStatus = $res['returnStatus'];
					$array = unserialize($res['info']);						
				}else if( isset($_GET['modifyInvoice']) ){
					$invoiceId = $_GET['modifyInvoice'];
					$sql = "SELECT * FROM invoices WHERE id='$invoiceId'";
					$selectInvoice = mysqli_query($db, $sql);
					$res =  mysqli_fetch_array($selectInvoice);
					$customername = $res['customer'];
					$mobile = $res['mobile'];
					$state = $res['state'];
					$pincode = $res['pin'];
					$gst = $res['gst'];
					$city = $res['city'];
					$address = $res['address'];
					$dispatchThrough = $res['dispatchThrough'];
					$vehicle = $res['vehicle'];
					$transaction = $res['transaction'];
					$fullPayment = $res['fullPayment'];
					$partialPayment = $res['partialPayment'];
					$returnStatus = $res['returnStatus'];
					$array = unserialize($res['info']);						
				}else{
					echo "
					<div class='row text-center'>
						<br>Invoice not found<br>
						<a href='billing.php' class='btn btn-lg btn-warning'>Billing</a>
					</div>";
					exit();
				}
			?>
			<div class='well stockform billingblock table-responsive'>
				<a class='btn btn-xs btn-primary addbillingrow pull-right' data-id='<?php echo count($array)-1; ?>'><span class='glyphicon glyphicon-plus'></span> Add Item</a>
			
				<div class='clearfix'></div><br>
				<div class='row'>
					<div class='form-group col-md-3'>
						<input type='text' id='customername' class='form-control' value='<?php echo $customername; ?>' placeholder='Customer' />
					</div>
					<div class='form-group col-md-3'>
						<input type='text' id='mobile' class='form-control' value='<?php echo $mobile; ?>' placeholder='Mobile' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<select id='dispatchThrough' class='form-control' placeholder='DispatchThrough' >
							<option value='<?php echo $dispatchThrough;?>'><?php echo $dispatchThrough;?></option>
							<option value='By Road'>By Road</option>
						</select>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='vehicle' class='form-control' value='<?php echo $vehicle;?>' placeholder='Vehicle No' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='state' class='form-control' value='<?php echo $state; ?>' placeholder='State' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='pincode' class='form-control' value='<?php echo $pincode; ?>' placeholder='Pin Code' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='gstno' class='form-control' value='<?php echo $gst; ?>' placeholder='GST' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='city' class='form-control' value='<?php echo $city; ?>' placeholder='City' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<textarea id='address' rows="2" class='form-control' placeholder='Address' contenteditable ><?php echo $address; ?></textarea>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<select id='transaction' class='form-control'>
							<option value='<?php echo $transaction; ?>'><?php echo $transaction; ?></option>
							<option value='In'>In</option>
							<option value='Out'>Out</option>
						</select>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						Return <?php echo $returnStatus==1 ? "<input type='checkbox' id='returnStatus' checked='true' />" : "<input type='checkbox' id='returnStatus' />";  ?> 
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<select id='fullPayment' class='form-control'>
							<option value='<?php echo $fullPayment; ?>'><?php echo $fullPayment; ?></option>
							<option value='Full'>Full</option>
							<option value='Partial'>Partial</option>
						</select>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='partialPayment' class='form-control' disabled placeholder='Payment' value='<?php echo $partialPayment; ?>' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='openingBalance' readonly disabled class='form-control' placeholder='Opening Balance' />
					</div>
				</div>	
				
				<div clas='row'>
					<div class='form-group col-md-3 col-sm-3 col-xs-3 row'>
							Product
						</div>
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							Measure
						</div>	
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							Qty.
						</div>					
						<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
							Rate
						</div>
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							%
						</div>
						<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
							Amount
						</div>						
						<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
							Total
						</div>
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'></div>
				</div>	
				
				<?php
					// print_r($array);
					for($i=1; $i<count($array); $i++){
						if( $array[$i] ){
							// print_r($array[$i]);
							$category = $array[$i][0];
							$categoryid = $array[$i][1];
							$product = $array[$i][2];
							$productid = $array[$i][3];
							$qty = $array[$i][4];
							$total = $array[$i][5];						
							$price = $array[$i][8];						
							$totalprice = $array[$i][7];						
							$aprice = $array[$i][5];						
							$disc = $array[$i][10];						
							$qtyType = $array[$i][11];						
							$existedqty = productExistedQty($productid, $db);						
							echo "
							<div clas='ro billrow_1'>
								
								<div class='form-group col-md-3 col-sm-3 col-xs-3 row'>
									<input type='text' id='billingproduct_$i' data-id='$i' class='form-control stock_dropdown_billing' hiddenid='$productid' value='$product' placeholder='Product' />
								</div>						
								<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
									<input type='text' id='billingchoosenqty_$i' data-id='$i' value='$qtyType' readonly disabled class='form-control qtyinputfield$i' placeholder='Measure' />
								</div>	
								<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
									<input type='text' id='billingqty_$i' data-id='$i' value='$qty' class='form-control billingqty qtyinputfield' placeholder='Qty' />
								</div>					
								<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
									<input type='text' id='billingactualprice_$i' data-id='$i' value='$aprice' class='form-control billingactualprice' actual-price='$aprice' placeholder='Actual Price' />
								</div>
								<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
									<input type='text' id='billingdiscount_$i' data-id='$i' value='$disc' class='form-control billingdiscount' placeholder='Discount' />
								</div>
								<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
									<input type='text' id='billingprice_$i' data-id='$i' value='$price' class='form-control billingprice' actual-price='$price' placeholder='Price' />
								</div>
								
								<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
									<input type='text' id='billingwithgstprice_$i' data-id='$i' value='$price' class='form-control billingwithgstprice' actual-price='$price' placeholder='Total' />
								</div>
								<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
									<a class='removeIndividualRow btn btn-md btn-danger' data-id='1' id='removeIndividualRow_1'>X</a>
								</div>
							</div>	
							";
						}
						
					}
				
				?>
				
				
							
			</div>	
			<a class='btn btn-xs btn-danger removebillingrow pull-right' ><span class='glyphicon glyphicon-remove'></span> Remove Item</a>
			<button id='updateBill' data-id='<?php echo $invoiceId; ?>' class='btn btn-md btn-info' >Proceed</button>
			<button id='cancelBill' data-id='<?php echo $invoiceId; ?>' class='btn btn-md btn-warning' >Cancel Invoice</button>
			
			
			
		  </div>
		</div>
	</div>	
</div>

<script>
	$(document).ready(function(){
		function openingBalance(){			
			$.post('processing.php', {getBalance:true}, function(res){	
				$('#openingBalance').val(res);
			});
		
		}
		openingBalance();

	});
		
			
</script>

<?php include("footer.php"); ?>






