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


<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Product Categories</h3>
		  </div>
		  <div class="panel-body">
			
			
				<div>				
					<div class='col-md-2'></div>
					<div class='col-md-8'>
						<div class='col-md-8 text-right'>
							<input type='text' id='category' class='form-control' placeholder='Provide New Category' />
						</div>
						<div class='col-md-4 text-left'>
							<button id='create' class='btn btn-md btn-warning' >Create Category</button>
						</div>
					</div>	
					<div class='col-md-2'></div>
				</div>
							
			
			<hr>
			<div class='clearfix'></div>
			<div class='well'>
			<div class="table-responsive">
				<table class='display nowrap table table-condensed table-striped' id='datatables'>
					<thead>
						<th>S No.</th>
						<th>Category</th>
						<th>Status</th>
						<th>Actions</th>
					</thead>
					<tbody>
						<?php 
							$sql = "SELECT * FROM categories";
							$get = mysqli_query($db, $sql);
							$count = mysqli_num_rows($get);
							if( $count>0 ){
								$sno = 1;
								while( $res = mysqli_fetch_array($get) ){
									$id = $res['id'];
									$name = $res['name'];
									$status = $res['status'];
									if( $status == "0" ){
										$status = "<a title='This is hidden. We cannot seen this in Billing page' class='btn btn-xs btn-warning changestatus' data-id='$id' href='1' onclick='return false;'>Inactive</a>";
									}else if( $status == "1" ){
										$status = "<a title='Available in Billing' class='btn btn-xs btn-success changestatus' data-id='$id' href='0' onclick='return false;'>Active</a>";
									}
									echo "<tr id='row_$id'>";
									echo "<td>$sno</td>";
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
															<label>Category Title</label><br>
															<input type='text' id='editcategory_$id' class='form-control' value='$name' placeholder='Category' />
														</div>
														<button data-id='$id' class='btn btn-md btn-warning update' >Update Category</button>
														<div class='loading_$id'></div>
												  </div>
												  <div class='modal-footer'>
													<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
												  </div>
												</div>
											  </div>
											</div>

											<a href='$id' class='btn btn-xs btn-danger del_category' onclick='return false;'><span class='glyphicon glyphicon-remove'></span> Delete</a></td>";
									echo "</tr>";
									$sno++;
								}
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
	$(document).ready(function() {
		$('#datatables').DataTable({
			oLanguage: {
				sLoadingRecords: '<img src="images/loading.gif">'
			}
		});
	} );
</script>


<?php //include("footer.php"); ?>




