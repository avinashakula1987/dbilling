<?php include("database.php"); ?>
<?php include("session.php"); ?>

<?php include("headpart.php"); ?>
<?php
	
	$monthsarray = array(
		"01"=> "January",
		"02"=> "February",
		"03"=> "March",
		"04"=> "April",
		"05"=> "May",
		"06"=> "June",
		"07"=> "July",
		"08"=> "August",
		"09"=> "September",
		"10"=> "October",
		"11"=> "November",
		"12"=> "December"	
	);

?>
<?php
	
	function getTotalByInvoice($id, $db){
	$sql = "SELECT mrpprice AS total FROM purchases WHERE id='$id'";
		$existance_check = mysqli_query($db, $sql);
		$r = mysqli_fetch_array($existance_check);
		$total = $r['total'];
		if( $total > 0 ){
			return $total;			
		}else{
			return 0;
		}
	}

?>

<link rel='stylesheet' href='datatables/css/jquery.dataTables.min.css'></link>
<link rel='stylesheet' href='datatables/css/buttons.dataTables.min.css'></link>
<script type='text/javascript' src='datatables/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='datatables/js/dataTables.buttons.min.js'></script>
<script type='text/javascript' src='datatables/js/buttons.flash.min.js'></script>
<script type='text/javascript' src='datatables/js/jszip.min.js'></script>
<script type='text/javascript' src='datatables/js/pdfmake.min.js'></script>
<script type='text/javascript' src='datatables/js/vfs_fonts.js'></script>
<script type='text/javascript' src='datatables/js/buttons.html5.min.js'></script>
<script type='text/javascript' src='datatables/js/buttons.print.min.js'></script>


<?php include("navbar.php"); ?>
<div id="body">
	<div class='col-md-10'>
		<div class='row'>
			<div class="panel panel-primary mainbody">
			<div class="panel-heading">
				<h3 class="panel-title">Balancesheet</h3>
			</div>
			<div class="panel-body">
				

	
	
				<div class='col-md-4'>
					<form action='balancesheet.php' method='post'>
						<div class='form-group col-md-4'>
							<input type='text' name='date1' class='form-control datepicker' autocomplete="off" placeholder='From Date' />
						</div>
						<div class='form-group col-md-4'>
							<input type='text' name='date2' class='form-control datepicker' autocomplete="off" placeholder='To Date' />
						</div>
						<div class="input-group-btn col-md-2">
							<input type='submit' name='submit' class='btn btn-info' value='Search by Month'>
						</div>	
					</form>	
				</div>			
				<div class='col-md-4'>		
					<form action='balancesheet.php' method='post'>
						<div class="input-group">
							<select name='month' class='form-control'>
								<option value='01'>January</option>
								<option value='02'>February</option>
								<option value='03'>March</option>
								<option value='04'>April</option>
								<option value='05'>May</option>
								<option value='06'>June</option>
								<option value='07'>July</option>
								<option value='08'>August</option>
								<option value='09'>September</option>
								<option value='10'>October</option>
								<option value='11'>November</option>
								<option value='12'>December</option>
							</select>
							<div class="input-group-btn">
								<input type='submit' name='submit' class='btn btn-info' value='Search by Month'>
							</div>	
						</div>	
					</form>
				</div>			
				<div class='col-md-4'>	
					<form action='balancesheet.php' method='post'>
						<div class="input-group">
							<input type='number' name='year' class='form-control' placeholder='2019'>
							<div class="input-group-btn">
								<input type='submit' name='submit' class='btn btn-info' value='Search by Year'>
							</div>	
						</div>
					</form>
				</div>
				<div class='clearfix'></div>
				<hr>
				
				<div class='well'>
					<div class='table-responsive'>
						<button class='btn btn-primary' id="print">Print</button>
						<div id="printable">
					<table class='table table-condensed table-bordered' id='datatables'>
						
						<tbody>
							<tr>
								<td colspan='7' class='text-left'><b id="byselection"></b></td>
							</tr>
							<tr>
								<td>Date</td>
								<td>Particulars</td>
								<td>Vch Type</td>							
								<td>Vch No</td>							
								<td>Amount</td>
								<td>Credited</td>
								<td>Debited</td>
							</tr>
							<?php 
								$date1 = date('Y-m-01');
								$date2 = date('Y-m-31');
								if( isset($_POST['month']) ){
									$month = $_POST['month'];
									$date1 = date("Y-$month-01");
									$date2 = date("Y-$month-31");
									$m = "By ".$monthsarray[$month];
								}else{
									$m = "By ".date('M');
								}
								
								if( isset($_POST['year']) ){
									$year = $_POST['year'];
									$date1 = date("$year-01-01");
									$date2 = date("$year-12-31");
									$m = "By $year";
								}

								if( isset($_POST['date1']) && isset($_POST['date2']) ){
									$date1 = $_POST['date1'];
									$date2 = $_POST['date2'];								
									$m = "By $date1 - $date2";
								}
								
								$login = $_SESSION['login'];
								
								$sql = "SELECT finaltotal AS totalpurchases, customer, city, state, date, transaction, openingBalance, id, returnStatus FROM invoices WHERE login='$login' AND date BETWEEN '$date1' AND '$date2'";
								$sno = 0;
								$get = mysqli_query($db, $sql);
								$openBalance = true;
								$count = mysqli_num_rows($get);
								$tot = 0;
								while( $res = mysqli_fetch_array($get) ){

									$sno++;
									$id = $res['id'];
									$totalpurchases = $res['totalpurchases'];
									$city = $res['city'];
									$state = $res['state'];
									$customer = $res['customer'];
									$dat = $res['date'];
									$transaction = $res['transaction'];
									$returnStatus = $res['returnStatus'];
									
									
									
									$transaction1 = "";
									$transaction2 = "";
									$saletype = "";
									if( $transaction == "In" ){
										$transaction1 = $totalpurchases;
										$saletype = "Sales";
										if( $returnStatus==1 ){
											$transaction1 = "";
											$transaction2 = $totalpurchases;
										}
									}else{
										$transaction2 = $totalpurchases;
										$saletype = "Receipt<br>Sales";
									}
									if( $returnStatus==1 ){
										$tot = $tot - $totalpurchases;
									}else{
										$tot = $tot + $totalpurchases;
									}
									

									
									$date = date("d-M-y", strtotime($dat));
									if( $openBalance == true ){
										$openingBalance = $res['openingBalance'];
										$openText = "<tr>
											<td colspan='7'>Opening Balance: <b>$openingBalance</b></td>
										</tr>";									
									}
									$openBalance = false; 
									
									// $date = date($res['date'], "y-M-d");
									echo $openText;	
									echo "
									<tr>
										<td>$date</td>
										<td>$customer<br>$city, $state</td>									
										<td>$saletype</td>
										<td>$id</td>
										<td>$totalpurchases</td>
										<td>$transaction1</td>
										<td>$transaction2</td>

									</tr>";
									
									$openText = "";
								}
								$tott = $tot + $openingBalance;
								echo  "<tr>
										<td colspan='6'>Closed Balance: <b>$tott</b></td>
									</tr>";
							?>					
						</tbody>
					</table>
							</div>
					</div>
				</div>  
				
				
			</div>
			</div>
		</div>	
	</div>
	<div id='viewfullBill' class='modal fade' role='dialog'>
	<div class='modal-dialog'>
		<div class='modal-content'>
		<div class='modal-header'>
			<button type='button' class='close' data-dismiss='modal'>&times;</button>
			<h4 class='modal-title'>Complete Bill</h4>
		</div>
		<div class='modal-body'>
				<table class='table table-condensed'>
				</table>
				
		</div>
		<div class='modal-footer'>
			<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
		</div>
		</div>
	</div>
	</div>
</div>

<script type='text/javascript'>
	$(document).ready(function() {

		$("#print").click(function(){
			body = $("#body").html();
			printable = $("#printable").html();
			$("#body").html(printable);
			window.print();
			$("#body").html(body);
		});


		$("#byselection").html("<?php echo $m; ?>");
		$('#datatables').DataTable({
			"pageLength": 10,
            dom: 'Bfrtip',
            buttons: ['copy','csv','excel','pdf','print']
		});

		
		

	} );

	


</script>


<?php //include("footer.php"); ?>




