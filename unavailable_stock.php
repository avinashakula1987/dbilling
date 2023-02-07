<?php include("database.php"); ?>
<?php include("session.php"); ?>

<?php include("headpart.php"); ?>


<link rel='stylesheet' href='datatables/css/jquery.dataTables.min.css'></link>
<link rel='stylesheet' href='datatables/css/buttons.dataTables.min.css'></link>
<script type='text/javascript' src='datatables/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='datatables/js/dataTables.buttons.min.js'></script>



<?php include("navbar.php"); ?>
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Unavailable Stock</h3>
		  </div>
		  <div class="panel-body">
			
			<ul class="nav nav-tabs">
			  <li role="presentation"><a href="stock.php">Stock</a></li>
			  <li role="presentation" class="active"><a href="unavailable_stock.php">Unavailable Stock</a></li>
			  <li role="presentation"><a href="inactive_stock.php">Inactive Stock</a></li>
			  <li role="presentation" class='pull-right'><a href="add_stock.php" class='text-danger'>Add Stock</a></li>
			</ul>
			
			<div class='well'>
				<div class='table-responsive'>
				<table class='table table-condensed' id='datatables'>
					<thead>
						<th>S No.</th>
						<th>Category</th>
						<th>Title</th>
						<th>Quantity</th>
						<!--<th>MRP</th>-->
						<th>Actions</th>
					</thead>
					<tbody>
						<?php 
							$sql = "SELECT * FROM stock WHERE status='1' AND qty<=0 ORDER BY id DESC";
							$get = mysqli_query($db, $sql);

								$sno = 1;
								while( $res = mysqli_fetch_array($get) ){
									$id = $res['id'];
									$category = show_category_name($res['category'], $db);
									$name = $res['name'];
									$qty = $res['qty'];
									$mrp = $res['mrpprice'];
									$gsttype = $res['gsttype'];
									$gst = $res['gst'];
									$gstprice = $res['gstprice'];
									
									if( $gsttype == 2 ){
										$gsttypeactive1 = "";
										$gsttypeactive2 = "selected";
									}else if( $gsttype == 1 ){
										$gsttypeactive1 = "selected";
										$gsttypeactive2 = "";
									}
									
									
									echo "<tr id='row_$id'>";
									echo "<td>$sno</td>";
									echo "<td id='category_$id'>$category</td>";
									echo "<td id='name_$id'>$name</td>";
									echo "<td id='qty_$id'>$qty</td>";
									//echo "<td id='mrp_$id'>$mrp</td>";
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
															<label>Barcode</label><br>
															<input type='text' id='editstock_barcode_$id' class='form-control' value='".$res['barcode']."' />
														</div>
														<div class='form-group'>
															<label>Category Title</label><br>
															<select id='editstock_category_$id' class='form-control' ><option value='".$res['category']."'>$category</option>".show_categories_dropdown($db)."</select>
														</div>
														<div class='form-group'>
															<label>Product/Item Title</label><br>
															<input type='text' id='editstock_title_$id' class='form-control' placeholder='Product Title' value='$name' />
														</div>
														<div class='form-group'>
															<label>Quantity</label><br>
															<input type='text' id='editstock_quantity_$id' class='form-control' placeholder='Quantity' value='$qty' />
														</div>
														<div class='form-group'>
															<label>Price</label><br>
															<input type='text' id='editstock_mrp_$id' class='form-control' placeholder='Price' value='$mrp' />
														</div>
														
														<div class='form-group'>
															<div class='col-md-4'>
																<label>GST</label><br>
																<select id='editgsttype_$id' data-id='$id' class='editchangegsttype form-control' >
																	<option value='1' $gsttypeactive1>Included</option>
																	<option value='2' $gsttypeactive2>Not Included</option>
																</select>	
															</div>
															<div class='col-md-4'>
																<label>GST(%)</label><br>
																<input type='text' id='editstock_gst_$id' class='form-control editchangegst' data-id='$id'  placeholder='GST(%)' value='$gst' />
															</div>
															<div class='col-md-4'>
																<label>GST Price</label><br>
																<input type='text' id='editstock_gstprice_$id' class='form-control' placeholder='GST Price' value='$gstprice' />
															</div>
															<div class='clearfix'></div>
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
		$('#datatables').DataTable();
	} );
</script>


<?php //include("footer.php"); ?>




