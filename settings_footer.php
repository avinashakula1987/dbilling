<?php include("database.php"); ?>
<?php include("session.php"); ?>
<?php
	$query = "SELECT invoicefoot FROM invoicehead";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result);
	$invoicehead = unserialize($row['invoicefoot']);	

	if( isset($_POST['updateinvoice']) ){
		$in = serialize($_POST['updateinvoice']);
		$sql = "UPDATE invoicehead SET invoicefoot='$in'";
		mysqli_query($db, $sql);
		echo "Updated!";
		exit();
	}	
?>
<?php include("headpart.php"); ?>

<?php include("navbar.php"); ?>
<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel='stylesheet' href="ckeditor/samples/css/samples.css"></link>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#editor').focus();
		
		



		$(document).on('click', '#updateinvoicehead', function(){
			
			invoice = CKEDITOR.instances['editor'].getData();
			
			$.post("settings_footer.php", {updateinvoice:invoice}, function(res){
				alert(res);
			});
		});
	});
</script>
<div class='col-md-10'>
	<div class='row'>
		<div class='table-responsive'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Invoice Footer</h3>
		  </div>
		  <div class="panel-body">
			
			<div>
				<div class='form-group'>
					<label>Update Invoice Footer</label><br>
					<div id='editor'><?php echo $invoicehead; ?></div>
				</div>
				<button id='updateinvoicehead' class='btn btn-md btn-warning' >Update</button>			
			</div>				
			<hr>
			</div>
		  </div>
		  <?php echo $invoicehead; ?>
		  </div>
		</div>
	</div>	
</div>

<script>
	initSample();
</script>

<?php include("footer.php"); ?>




