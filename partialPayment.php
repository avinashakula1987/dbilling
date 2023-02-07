<?php include("database.php"); ?>
<?php include("session.php"); ?>

<?php include("headpart.php"); ?>



<?php include("navbar.php"); ?>
<link rel='stylesheet' href='datatables/css/jquery.dataTables.min.css'></link>
<link rel='stylesheet' href='datatables/css/buttons.dataTables.min.css'></link>
<script type='text/javascript' src='datatables/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='datatables/js/dataTables.buttons.min.js'></script>
<script type='text/javascript' src='datatables/js/buttons.flash.min.js'></script>
<script type='text/javascript' src='datatables/js/pdfmake.min.js'></script>
<script type='text/javascript' src='datatables/js/jszip.min.js'></script>
<script type='text/javascript' src='datatables/js/vfs_fonts.js'></script>
<script type='text/javascript' src='datatables/js/buttons.html5.min.js'></script>
<script type='text/javascript' src='datatables/js/buttons.print.min.js'></script>
<script type='text/javascript' src='datatables/js/sum().js'></script>

<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Completed Invoices</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			   <li role="presentation"><a href="billing.php">Billing</a></li>
			   <li role="presentation"><a href="invoices.php">All Transactions</a></li>
			  <li role="presentation" class="active"><a href="bills.php">Bills</a></li>
			  <li role="presentation"><a href="purchases.php">Purchases</a></li>
			  <li role="presentation"><a href="pending_invoices.php">Pending</a></li>
			  <li role="presentation"><a href="failed_invoices.php">Failed</a></li>
			</ul>
			
			
			<div class='well'>
				<div class='row'>
			<form action='invoices.php' method='get'>
				<div class='form-group col-md-2'>
					<input type='text' name='date1' class='form-control datepicker' placeholder='From Date' />
				</div>
				<div class='form-group col-md-2'>
					<input type='text' name='date2' class='form-control datepicker' placeholder='To Date' />
				</div>
								
				<div class='form-group col-md-2'>
					<input type='submit' class='form-control btn btn-info' name='submit' value='Search' />
				</div>
			</form>	
		</div>	
		
		
					
						<?php 
							if( isset($_GET['invoice']) ){
								$invoiceId = mysqli_real_escape_string($db, $_GET['invoice']);	
								$sql = "SELECT * FROM invoices WHERE id='$invoiceId'";
							}
							$get = mysqli_query($db, $sql);
							$res = mysqli_fetch_array($get);
							$id = $res['id'];
							$info = $res['info'];
							$status = $res['status'];
							$total = $res['total'];
							$qty = $res['qty'];
							$transaction = $res['transaction'];
							$payable = $res['finaltotal'];
							$fullPayment = $res['fullPayment'];
							$partialPayment = $res['partialPayment'];									
							$paid_pending_array = paid_pending($fullPayment, $payable, $partialPayment);
							$pendingAmount = $paid_pending_array[1];									
							$pendingAmount = $paid_pending_array[1];									
						?>					


						<div style="width:200px">	
							Actual Amount - <input type="text" id="actualAmount" placeholder="Actual Amount" value="<?= $payable; ?>" disabled class="form-control">
							Paid So far - <input type="text" id="pendingAmount" placeholder="Pending" value="<?= $pendingAmount; ?>" disabled class="form-control">
							Paying now - <input type="text" id="payingAmount" placeholder="Payment" value="<?= $pendingAmount; ?>" class="form-control">
							<select id="pendingStatus" class="form-control">
								<option value='1'>Completed</option>
								<option value='0'>Partial</option>
							</select><br/>
							<button class="btn btn-primary" id="partialPaymentUpdate" data-id="<?= $invoiceId; ?>" data-transaction="<?= $transaction; ?>">Payment Update</button>
						</div>	
		  
			</div>
			
		  </div>
		</div>
	</div>	
</div>


<script type='text/javascript'>
	$(document).ready(function() {
		$('#datatables').DataTable( {
			 dom: 'Bfrtip',
			 buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			],
			
			
			"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var monTotal = api
                .column( 1 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
	    var tueTotal = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
            var wedTotal = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
				
	     var thuTotal = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
		 var friTotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );		
						
	    
			
				
            // Update footer by showing the total with the reference of the column index 
	    $( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html(monTotal);
            $( api.column( 2 ).footer() ).html(tueTotal);
            $( api.column( 3 ).footer() ).html(wedTotal);
            $( api.column( 4 ).footer() ).html(thuTotal);
			$( api.column( 5 ).footer() ).html(friTotal);
        }
			
			
		} );
	} );
</script>


<?php //include("footer.php"); ?>




