<?php include("database.php"); ?>
<?php include("session.php"); ?>
<?php include("headpart.php"); ?>

<?php include("navbar.php"); ?>
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Billing<small class='pull-right' style='font-size:0.8em'>'Enter' for new row</small></h3>
		  </div>
		  <div class="panel-body">
			<?php include("billing_nav.php"); ?>
			<!-- <ul class="nav nav-tabs">
			  <li role="presentation" class='active'><a href="billing.php">Billing</a></li>
			  <li role="presentation"><a href="invoices.php">All Transactions</a></li>
			  <li role="presentation"><a href="bills.php">Bills</a></li>
			  <li role="presentation"><a href="purchases.php">Purchases</a></li>
			  <li role="presentation"><a href="returns.php">Returns</a></li>
			  <li role="presentation"><a href="credits.php">Pending Credits</a></li>
			  <li role="presentation"><a href="completedCredits.php">Completed Credits</a></li>
			  <li role="presentation"><a href="pending_invoices.php">Pending</a></li>
			  <li role="presentation"><a href="failed_invoices.php">Failed</a></li>
			</ul> -->
			
			<style>
				.updateStock{
					display:none;
				}
			</style>
			<div class='well stockform billingblock table-responsive'>
				<a class='btn btn-xs btn-default addbillingrow pull-right' data-id='1'><span class='glyphicon glyphicon-plus'></span> Add Item</a>
			
				<div class='clearfix'></div><br>
				<div class='row'>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='customername' class='form-control customers_dropdown' autofocus placeholder='Customer'/>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='mobile' class='form-control' placeholder='Mobile' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<select id='dispatchThrough' class='form-control' placeholder='DispatchThrough' >
							<option value='By Road'>By Road</option>
						</select>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='vehicle' class='form-control' placeholder='Vehicle No' />
					</div>
								
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<select id='transaction' class='form-control'>
							<option value='In'>In</option>
							<option value='Out'>Out</option>
						</select>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						Return <input type='checkbox' id='returnStatus' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<select id='fullPayment' class='form-control'>
							<option value='Full'>Cash & Carry</option>
							<option value='Partial'>Credit</option>
						</select>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='partialPayment' class='form-control' disabled placeholder='Payment' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='openingBalance' readonly disabled class='form-control' placeholder='Opening Balance' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='state' class='form-control' placeholder='State' />
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='pincode' class='form-control' placeholder='Pin Code' />
					</div>
					
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='city' class='form-control' placeholder='City' />
					</div>		
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<input type='text' id='gstno' class='form-control' placeholder='GST' />
						<a onclick="verifyGST()" class='btn btn-link'>Verify</a>
					</div>
					<div class='form-group col-md-3 col-sm-6 col-xs-12'>
						<textarea id='address' rows="2" class='form-control' placeholder='Address' contenteditable ></textarea>
					</div>
					
				</div>
				<hr />
				<div class=''>
					<div clas='row'>
						<div class='form-group col-md-3 col-sm-3 col-xs-3 row'>
							Product
						</div>						
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							Measure
						</div>					
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							Qty
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
					<div class='ro billrow_1'>						
						<div class='form-group col-md-3 col-sm-3 col-xs-3 row'>
							<input type='text' id='billingproduct_1' data-id='1' class='form-control stock_dropdown_billing' placeholder='Product' />
						</div>	
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>										
							<input type='text' id='billingchoosenqty_1' data-id='1' class='form-control billingchoosenqty qtyinputfield' placeholder='Measure' />
						</div>													
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							<input type='text' id='billingqty_1' data-id='1' class='form-control billingqty qtyinputfield' placeholder='Qty' />
						</div>				
						<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
							<input type='text' id='billingactualprice_1' data-id='1' class='form-control billingactualprice' readonl placeholder='Actual Price' />
						</div>
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							<input type='text' id='billingdiscount_1' data-id='1' class='form-control billingdiscount' value='0' placeholder='Discount' />
						</div>
						<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
							<input type='text' id='billingprice_1' data-id='1' class='form-control billingprice' readonly placeholder='Price' />
						</div>								
						<div class='form-group col-md-2 col-sm-2 col-xs-2 row'>
							<input type='text' id='billingwithgstprice_1' data-id='1' class='form-control billingwithgstprice' placeholder='Total' />
						</div>
						<div class='form-group col-md-1 col-sm-1 col-xs-1 row'>
							<a class='removeIndividualRow btn btn-md btn-danger' data-id='1' id='removeIndividualRow_1'>X</a>
						</div>
					</div>	
				</div>							
			</div>	
			<div class='well'>Total - <b id='finalBillAmount'></b></div>
			<!-- <a class='btn btn-xs btn-warning removebillingrow pull-right' ><span class='glyphicon glyphicon-remove'></span> Remove Item</a> -->
			<button id='createBill' class='btn btn-md btn-danger' >Submit</button>
			
			
			
		  </div>
		</div>
	</div>	
</div>


			<div class='clearfix'></div>
			<!-- <div class='text-center closebuttonblock'><button class='btn btn-danger btn-sm' onclick='windowclose();'>Close</button></div> -->
			
		</div>
	</div>
	
<script>
	function windowclose(){
		if( confirm("Are you sure ?") ){
			window.close();
		}
	}
	function openNav() {
		document.getElementById("mySidenav").style.width = "250px";
		document.getElementById("main").style.marginLeft = "250px";
		document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	}

	function closeNav() {
		document.getElementById("mySidenav").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
		document.body.style.backgroundColor = "white";
	}
</script>


<div id='desire_message' class='modal fade' role='dialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>Message</h4>
      </div>
      <div class='modal-body'>
        <p></p>
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


	function verifyGST(){
            let gst = document.getElementById('gstno').value;
            if( gst!='' && gst.length ==15){
                let gstLink = `https://cleartax.in/gst-number-search/${gst}/`
                window.open(gstLink, '_blank');
            }else{
                alert("GST you entered are not valid! try again");
            }
            
        }
		
			
</script>

</body>
</html>




