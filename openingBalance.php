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
			<h3 class="panel-title">Opening Balance</h3>
		  </div>
		  <div class="panel-body">
			
		  	<?php 
				$sql = "SELECT balance FROM openingBalance WHERE id='1'";
				$get = mysqli_query($db, $sql);
				$res = mysqli_fetch_array($get);							
			?>	
				<div>				
					<div class='col-md-2'></div>
					<div class='col-md-8'>
						<div class='col-md-8 text-right'>
							<input type='text' id='balance' value="<?php echo $res["balance"] ?>" class='form-control' placeholder='Provide New Category' />
						</div>
						<div class='col-md-4 text-left'>
							<button id='create' class='btn btn-md btn-warning' >Update Opening Balance</button>
						</div>
					</div>	
					<div class='col-md-2'></div>
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




