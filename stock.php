<?php include("database.php"); ?>
<?php include("session.php"); ?>

<?php include("headpart.php"); ?>

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
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Stock List</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="stock.php">Stock</a></li>
			  <li role="presentation"><a href="inactive_stock.php">Inactive Stock</a></li>
			  <li role="presentation"><a href="quantity.php">Quantity</a></li>
			  <li role="presentation" class='pull-right'><a href="add_stock.php" class='text-danger'>Add Stock</a></li>
			</ul>
			
			<div class='well'>
				<div class='table-responsive'>
				<table class='table table-condensed' id='datatables'>
					<thead>
						<th>S No.</th>
						<th>Title</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Actions</th>
					</thead>
					<tbody>
						<?php 
							$sql = "SELECT * FROM stock WHERE status='1' ORDER BY id DESC";
							$get = mysqli_query($db, $sql);
								$sno = 1;
								while( $res = mysqli_fetch_array($get) ){
									$id = $res['id'];
									$name = $res['name'];
									$qty = $res['qty'];
									$actualprice = $res['actualprice'];
									
									if( $res['status'] == "1" ){
										$stat = "<a class='btn btn-xs btn-primary inactivateitem' data-id='$id' ><span class='glyphicon glyphicon-eye-close'></span> Inactivate</a>";
									}
									echo "<tr id='row_$id'>";
									echo "<td>$sno</td>";
									echo "<td id='name_$id'>$name</td>";
									echo "<td id='qty_$id'>$qty</td>";
									echo "<td id='actualprice_$id'>$actualprice</td>";

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
															<label>Product/Item Title</label><br>
															<input type='text' id='editstock_title_$id' class='form-control' placeholder='Product Title' value='$name' />
														</div>
														<div class='form-group'>
															<label>Quantity</label><br>
															<select id='editstock_quantity_$id' class='form-control' >
																<option value='$qty'>$qty</option>
																<option value='10 pack'>10 pack</option>
																<option value='30 pack'>30 pack</option>
																<option value='1 kg'>1 kg</option>
															</select>
														</div>
														<div class='form-group'>
															<label>Price</label><br>
															<input type='text' id='editstock_actualprice_$id' class='form-control' placeholder='Price' value='$actualprice' />
														</div>
														
												
														
														<button data-id='$id' class='btn btn-md btn-warning update_stock' >Update Stock</button>
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


<script type='text/javascript'>
	$(document).ready(function() {
		$('#datatables').DataTable({
			"pageLength": 10,
            dom: 'Bfrtip',
            buttons: ['copy','csv','excel','print']
		});
	} );
</script>


<?php //include("footer.php"); ?>




