<?php 
	include("database.php");
	include("session.php");
	include("headpart.php");
	include("navbar.php");
?>

<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Add Purchased Stock</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			  <li role="presentation"><a href="purchases.php">Purchased Stock</a></li>
			  <li role="presentation" class='pull-right active'><a href="add_stock.php" class='text-danger'>Add Purchased Stock</a></li>
			</ul>
			
			<style>
				.updateStock{
					display:none;
				}
			</style>
			<div class='well stockform'>
				
				
				<div class='row'>					
					<div class='form-group   col-md-3 text-left'>
						<label>Amount</label><br>
						<input type='text' id='quantity' class='form-control dontstay' placeholder='Quantity' />					
					</div>
				</div>	
				
				<button id='createQuantity' class='btn btn-md btn-info' >Create Quantity</button>			
			</div>	

			<div class='well'>
				<div class='table-responsive'>
				<table class='table table-condensed' id='datatables'>
					<thead>
						<th>S No.</th>
						<th>Quantity</th>
						<th>Actions</th>
					</thead>
					<tbody>
						<?php 
							$sql = "SELECT * FROM quantity ORDER BY id DESC";
							$get = mysqli_query($db, $sql);
								$sno = 1;
								while( $res = mysqli_fetch_array($get) ){
									$id = $res['id'];
									$quantity = $res['quantity'];
									
									
									if( $res['status'] == "1" ){
										$stat = "<a class='btn btn-xs btn-primary inactivateitem' data-id='$id' ><span class='glyphicon glyphicon-eye-close'></span> Inactivate</a>";
									}
									echo "<tr id='row_$id'>";
									echo "<td>$sno</td>";
									echo "<td id='qty_$id'>$quantity</td>";

									echo "<td>
											$stat
											<a class='btn btn-xs btn-info' data-toggle='modal' data-target='#edit_$id'><span class='glyphicon glyphicon-pencil'></span> Edit</a> 
											
											<a class='btn btn-xs btn-warning' href='trackers.php?id=$id'><span class='glyphicon glyphicon-pencil'></span> Trackers</a> 

											<div id='edit_$id' class='modal fade' role='dialog'>
											  <div class='modal-dialog'>
												<div class='modal-content'>
												  <div class='modal-header'>
													<button type='button' class='close' data-dismiss='modal'>&times;</button>
													<h4 class='modal-title'>Update</h4>
												  </div>
												  <div class='modal-body'>
																										
														
														<div class='form-group'>
															<label>Quantity</label><br>
															<input type='text' id='editstock_quantity_$id' class='form-control' value='$quantity' />
														</div>
														
														
												
														
														<button data-id='$id' class='btn btn-md btn-warning update_quantity' >Update Quantity</button>
														<div class='loadingustock_$id'></div>
												  </div>
												  <div class='modal-footer'>
													<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
												  </div>
												</div>
											  </div>
											</div>

											<a href='$id' class='btn btn-xs btn-danger del_stock' onclick='return false;'><span class='glyphicon glyphicon-remove'></span> Delete</a></td>";
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



<?php include("footer.php"); ?>




