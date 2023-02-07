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
		
		<div class='row'>
			<form action='reports.php' method='get'>
				<div class='form-group col-md-2'>
					<input type='text' name='date1' class='form-control datepicker' autocomplete="off" placeholder='From Date' />
				</div>
				<div class='form-group col-md-2'>
					<input type='text' name='date2' class='form-control datepicker' autocomplete="off" placeholder='To Date' />
				</div>
				<div class='form-group col-md-2'>
					<select name='invoicetype' class='form-control'>						
						<option value='1'>Success</option>
						<option value='0'>Pending</option>
						<option value=''>All</option>
					</select>
				</div>					
				<div class='form-group col-md-2'>
					<input type='submit' class='form-control btn btn-info' name='submit' value='Search' />
				</div>
			</form>	
		</div>	

		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Reports</h3>
		  </div>
		  <div class="panel-body">
			
			
			
			<div class='well'>
				<div class='table-responsive'>
				<table class='display nowrap' id='datatables' cellspacing="0" width="100%">
					<thead>
						<th>S No.</th>
						<th>Customer</th>
						<th>Date</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Payable</th>
						
					</thead>
					
					<tbody>
						<?php 
							if( isset($_GET['submit']) ){
								$date1 = $_GET['date1'];
								$date2 = $_GET['date2'];
								$invoicetype = $_GET['invoicetype'];
								if( !empty($date1) && !empty($date2) ){
									if( $invoicetype == "" ){
										$state = "";
									}else{
										$state = "AND status='$invoicetype'";
									}
									$qry = "WHERE (`date` BETWEEN '$date1' AND '$date2') $state";
								}else{
									$qry = "";
								}
							
								
								$sql = "SELECT * FROM invoices $qry ORDER BY id DESC";
								$get = mysqli_query($db, $sql);
								
								
									$sno = 1;
									while( $res = mysqli_fetch_array($get) ){
										$id = $res['id'];
										$customer = $res['customer'];
										$mobile = $res['mobile'];
										$info = $res['info'];
										$date = date('d, M Y', strtotime($res['date']));
										$status = $res['status'];
										$total = $res['total'];
										$qty = $res['qty'];
										$payable = $res['finaltotal'];
										echo "<tr id='row_$id'>";
										echo "<td>#$id</td>";
										echo "<td>$customer, <br>$mobile</td>";
										echo "<td>$date</td>";
										echo "<td>$qty</td>";
										echo "<td>$total</td>";
										echo "<td>$payable</td></tr>";
										
										$sno++;
									}
									
									
								
							}else{
								echo "<tr><td colspan='5'>Search Reports</td></tr>";	
							}	
						?>					
					</tbody>
					<tfoot>
						<th>S No.</th>
						<th>Customer</th>
						<th>Date</th>
						<th>Qty</th>
						<th>Total</th>
						<th>Payable</th>
						
					</tfoot>
				</table>
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




