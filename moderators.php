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
			<h3 class="panel-title">Moderators</h3>
		  </div>
		  <div class="panel-body">
			
			
				<div>				
					<div class='col-md-2'></div>
					<div class='col-md-8'>
						<div class='col-md-3 text-right'>
							<input type='text' id='username' class='form-control' autocomplete='off' autofocus placeholder='Username' />
						</div>
						<div class='col-md-3 text-right'>
							<input type='text' id='password' class='form-control' autocomplete='off' placeholder='Password' />
						</div>
						<div class='col-md-3 text-right'>
							<input type='text' id='name' class='form-control' autocomplete='off' placeholder='Name' />
						</div>
						<div class='col-md-3 text-left'>
							<button id='createmoderator' class='btn btn-md btn-warning' >Create Moderator</button>
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
					<th>Username</th>
					<th>Password</th>
					<th>Name</th>
					<th>Status</th>
					<th>Actions</th>
				</thead>
				<tbody>
					<?php 
						$sql = "SELECT * FROM admin WHERE type='moderator'";
						$get = mysqli_query($db, $sql);
						
						
							$sno = 1;
							while( $res = mysqli_fetch_array($get) ){
								$id = $res['id'];
								$name = $res['name'];
								$username = $res['username'];
								$password = $res['password'];
								$status = $res['status'];
								if( $status == "0" ){
									$status = "<a title='Account is unable to LOGIN.' class='btn btn-xs btn-warning mchangestatus' data-id='$id' href='1' onclick='return false;'>Inactive</a>";
								}else if( $status == "1" ){
									$status = "<a title='Active Login' class='btn btn-xs btn-success mchangestatus' data-id='$id' href='0' onclick='return false;'>Active</a>";
								}
								echo "<tr id='row_$id'>";
								echo "<td>$sno</td>";
								echo "<td id='username_$id'>$username</td>";
								echo "<td id='password_$id'>$password</td>";
								echo "<td id='name_$id'>$name</td>";
								echo "<td id='status_$id'>$status</td>";
								echo "<td>
										<a class='btn btn-xs btn-info' data-toggle='modal' data-target='#edit_$id'><span class='glyphicon glyphicon-pencil'></span> Edit</a> 

										<div id='edit_$id' class='modal fade' role='dialog'>
										  <div class='modal-dialog'>
											<div class='modal-content'>
											  <div class='modal-header'>
												<button type='button' class='close' data-dismiss='modal'>&times;</button>
												<h4 class='modal-title'>Update</h4>
											  </div>
											  <div class='modal-body'>
													<div class='form-group'>
														<label>Username</label><br>
														<input type='text' id='editusername_$id' readonly class='form-control' value='$username' placeholder='Username' />
													</div>
													<div class='form-group'>
														<label>Password</label><br>
														<input type='text' id='editpassword_$id' class='form-control' value='$password' placeholder='Password' />
													</div>
													<div class='form-group'>
														<label>Name</label><br>
														<input type='text' id='editname_$id' class='form-control' value='$name' placeholder='Name' />
													</div>
													<button data-id='$id' class='btn btn-md btn-warning updatemoderator' >Update Moderator</button>
													<div class='loading_$id'></div>
											  </div>
											  <div class='modal-footer'>
												<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
											  </div>
											</div>
										  </div>
										</div>

										<a href='$id' class='btn btn-xs btn-danger del_moderator' onclick='return false;'><span class='glyphicon glyphicon-remove'></span> Delete</a></td>";
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




