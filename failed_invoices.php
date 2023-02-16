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
			<h3 class="panel-title">Failed Invoices</h3>
		  </div>
		  <div class="panel-body">
		  <?php include("billing_nav.php"); ?>
			<!-- <ul class="nav nav-tabs">
			<li role="presentation"><a href="billing.php">Billing</a></li>
			   <li role="presentation"><a href="invoices.php">All Transactions</a></li>
			  <li role="presentation"><a href="bills.php">Bills</a></li>
			  <li role="presentation"><a href="purchases.php">Purchases</a></li>
			  <li role="presentation"><a href="credits.php">Pending Credits</a></li>
			  <li role="presentation"><a href="completedCredits.php">Completed Credits</a></li>
			  <li role="presentation"><a href="pending_invoices.php">Pending</a></li>
			  <li role="presentation" class="active"><a href="failed_invoices.php">Failed</a></li>
			</ul> -->
			<div class='well'>
				<div class='row'>
					<form action='failed_invoices.php' method='get'>
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
				
				<table class='display nowrap' id='datatables' cellspacing="0" width="100%">
					<thead>
						<th>Id</th>
						<th>Customer</th>
						<th>Date</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Payable</th>						
						<th>Actions</th>
					</thead>
					<tbody>
						<?php 
							if( isset($_GET['submit']) ){
								$date1 = mysql_real_escape_string($_GET['date1']);
								$date2 = mysql_real_escape_string($_GET['date2']);
								if( !empty($date1) && !empty($date2) ){
									
									$qry = "WHERE (`date` BETWEEN '$date1' AND '$date2') AND `status`='2'";
								}else{
									$qry = "WHERE `status`='2'";
								}
							}else{
								$qry = "WHERE `date`='".date('Y-m-d')."' AND `status`='2'";
							}	
							$sql = "SELECT * FROM invoices $qry ORDER BY id DESC";
							$get = $db->query($sql);
							
								$sno = 1;
								while( $res = $get->fetchArray(SQLITE3_ASSOC) ){
									$id = $res['id'];
									$info = $res['info'];
									$date = date('d, M Y', strtotime($res['date']));
									$status = $res['status'];
									$total = $res['total'];
									$payable = $res['finaltotal'];
									$qty = $res['qty'];
									echo "<tr id='row_$id'>";
									echo "<td>$sno</td>";
									echo "<td>$date</td>";
									echo "<td>$total</td>";
									echo "<td>$payable</td>";
									echo "<td>$qty</td>";
									echo "<td><a class='btn btn-xs btn-info' href='invoice.php?invoice=$id'><span class='glyphicon glyphicon-zoom-in'></span></a> ";
									if( $_SESSION['loginid'] == 1 ){	
									echo "<a href='$id' class='btn btn-xs btn-danger del_invoice' onclick='return false;'><span class='glyphicon glyphicon-remove'></span></a></td>";
									}
									echo "</tr>";
									$sno++;
								}
							
						?>					
					</tbody>
					<tfoot>
						<th>Id</th>
						<th>Customer</th>
						<th>Date</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Payable</th>						
						<th>Actions</th>						
					</tfoot>
				</table>
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




