<?php include("database.php"); ?>
<?php include("session.php"); ?>
<?php include("headpart.php"); ?>
<?php
	function pendingCredit($mobile, $db){
		$sql = "SELECT COUNT(*) as count FROM credits WHERE mobile='$mobile'";
		$qry = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($qry);
		$count = $rows['count'];
		if( $count == 0 ){
			return 0;
		}else{
			$sql = "SELECT * FROM credits WHERE mobile='$mobile'";
			$qry = mysqli_query($db, $sql);
			$rows = mysqli_fetch_array($qry);
			$credit = $rows['credit'];
			return $credit;
		}
	}
	 
	if( isset($_POST['billmobile']) && isset($_POST['actualpending']) ){
		$billmobile = $_POST['billmobile'];
		$actualpending = $_POST['actualpending'];
		$paying = $_POST['paying'];
		$newpending = (float)$actualpending - (float)$paying;
		$sql = "SELECT COUNT(*) as count FROM credits WHERE mobile='$billmobile'";
		$qry = mysqli_query($db, $sql);
		$rows = mysqli_fetch_array($qry);
		$count = $rows['count'];
		if( $count == 0 ){
			
		}else if( $count == 1 ){			
			$sql = "UPDATE credits SET credit='$newpending' WHERE mobile='$billmobile'";
			$update = mysqli_query($db, $sql);
			echo true;				
		}
		exit();
	}
?>

<?php include("navbar.php"); ?>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#category').focus();
	});
</script>

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
			<h3 class="panel-title">Customers</h3>
		  </div>
		  <div class="panel-body">
			
			
				<div>				
					
					<div class='col-md-10'>
						<div class='col-md-2 text-right'>
							<input type='text' id='mobile' class='form-control' autocomplete='off' autofocus placeholder='Mobile' />
						</div>
						<div class='col-md-2 text-right'>
							<input type='text' id='name' class='form-control' autocomplete='off' placeholder='Name' />
						</div>
						<div class='col-md-2 text-right'>
							<input type='text' id='address' class='form-control' autocomplete='off' placeholder='Address' />
						</div>	
						<div class='col-md-2 text-right'>
							<input type='text' id='gstin' class='form-control' autocomplete='off' placeholder='GSTIN' />
						</div>		
						<div class='col-md-2 text-left'>
							<button id='createcustomer' class='btn btn-md btn-warning' >Create Customer</button>
						</div>
					</div>	
					
				</div>
							
			
			<hr>
			<div class='clearfix'></div>
			<div class='well'>
			<div class='table-responsive'>
			<table class='display nowrap table table-condensed table-striped' id='datatables'>
				<thead>
					<th>S No.</th>
					<th>Name</th>
					<th>Mobile</th>
					<th>Address</th>
					<th>Pending</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM customers";
						$get = mysqli_query($db, $sql);
						
						
							$sno = 1;
							while( $res = mysqli_fetch_array($get) ){
								$id = $res['id'];
								$name = $res['name'];
								$mobile = $res['mobile'];
								$address = $res['address'];
								$pending = pendingCredit($mobile, $db);
								echo "<tr id='row_$id'>";
								echo "<td>$sno</td>";
								echo "<td id='name_$id'>$name</td>";
								echo "<td id='mobile_$id'>$mobile</td>";
								echo "<td id='address_$id'>$address</td>";
								echo "<td id='pending_$id'>
										<form class='form-inline' role='form'>
											<div class='input-group'>
												<input type='text' value='$pending' class='form-control' id='record_$mobile' />
												 <div class='input-group-btn'>
													<button actual-pending='$pending' data-mobile='$mobile' class='changecredit btn btn-default' >Update</button>
												</div>
											</div>
										</form>	
									</td>";
								echo "<td>
										<a href='$id' class='btn btn-xs btn-danger del_customer' onclick='return false;'><span class='glyphicon glyphicon-remove'></span> Delete</a></td>";
								echo "</tr>";
								$sno++;
							}
						
					?>					
				</tbody>
			</table>
		    </div>
			</div>
		  </div>
		</div>
	</div>	
</div>



  

<script>
	$(document).ready(function(){
		$(document).on('click', '.changecredit',  function(){
			billmobile = $(this).attr('data-mobile');
			actualpending = $(this).attr('actual-pending');
			paying = $('#record_'+billmobile).val();			
			$.post("customers.php", {billmobile:billmobile, actualpending:actualpending, paying:paying}, function(res){
				location.href = "customers.php";
			});			
		});
	});
</script>


<?php include("footer.php"); ?>




