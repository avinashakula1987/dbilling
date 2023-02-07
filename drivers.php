<?php include("database.php"); ?>
<?php include("session.php"); ?>
<?php include("headpart.php"); ?>

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
			<h3 class="panel-title">Vehicles</h3>
		  </div>
		  <div class="panel-body">
			
			
				<div>				
					<div class='col-md-2'></div>
					<div class='col-md-8'>
						<div class='col-md-3 text-right'>
							<input type='text' id='drivername' class='form-control' autocomplete='off' placeholder='Driver Name' />
						</div>
						<div class='col-md-3 text-right'>
							<input type='text' id='driverno' class='form-control' autocomplete='off' autofocus placeholder='Driver Number' />
						</div>						
						<div class='col-md-3 text-right'>
							<input type='text' id='address' class='form-control' autocomplete='off' placeholder='Address' />
						</div>						
						<div class='col-md-3 text-left'>
							<button id='createdriver' class='btn btn-md btn-warning' >Create Driver</button>
						</div>
					</div>	
					<div class='col-md-2'></div>
				</div>
							
			
			<hr>
			<div class='clearfix'></div>
			<div class='well'>
			<div class='table-responsive'>
			<table class='display nowrap table table-condensed table-striped' id='datatables'>
				<thead>
					<th>S No.</th>
					<th>Driver Number</th>
					<th>Driver Name</th>					
					<th>Description</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM drivers";
						$get = $db->query($sql);
						
						
							$sno = 1;
							while( $res = $get->fetchArray(SQLITE3_ASSOC) ){
								$id = $res['id'];
								$drivername = $res['drivername'];
								$driverno = $res['driverno'];
								$description = $res['description'];
								
								echo "<tr id='row_$id'>";
								echo "<td>$sno</td>";
								echo "<td id='name_$id'>$driverno</td>";
								echo "<td id='mobile_$id'>$drivername</td>";
								echo "<td id='address_$id'>$description</td>";
								echo "<td>
										<a href='$id' class='btn btn-xs btn-danger del_driver' onclick='return false;'><span class='glyphicon glyphicon-remove'></span> Delete</a></td>";
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


<script type='text/javascript'>
	/*$(document).ready(function() {
		$('#datatables').DataTable();
	} );*/
</script>


<?php include("footer.php"); ?>




