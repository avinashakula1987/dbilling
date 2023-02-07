<?php include("database.php"); ?>
<?php include("session.php"); ?>
<?php
	$query = "SELECT invoicehead FROM invoicehead";
	$result = $db->query($query);
	$row = $result->fetchArray(SQLITE3_ASSOC);
	$invoicehead = unserialize($row['invoicehead']);	

	if( isset($_POST['updateinvoice']) ){
		$in = serialize($_POST['updateinvoice']);
		$sql = "UPDATE invoicehead SET invoicehead='$in'";
		$db->exec($sql);
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
			
			$.post("settings.php", {updateinvoice:invoice}, function(res){
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
			<h3 class="panel-title">Transport Settings</h3>
		  </div>
		  <div class="panel-body">
			<h3 class='page-header'>Transport facility include in Billing</h3>
			<div class='col-md-3'>
				
				<div class="input-group">
					<select class='form-control' id='transport'>
						<option value=''>Select</option>
						<option value='Yes'>Yes</option>
						<option value='No'>No</option>
					</select>
					<div class="input-group-btn">
					  <button class="btn btn-default" type="submit">
						<i class="glyphicon glyphicon-pencil"></i>
					  </button>
					</div>
				  </div>
				
				
			

							
			</div>				
			<hr>
			</div>
		  </div>
		  </div>
		</div>
	</div>	
</div>

<script>
	initSample();
</script>

<?php include("footer.php"); ?>




