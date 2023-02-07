<?php include("database.php"); ?>
<?php include("session.php"); ?>
<?php
	if( isset($_POST['oldpassword']) ){
		$query = "SELECT password FROM admin WHERE id='".$_SESSION['loginid']."'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_array($result);
		$password = $row['password'];	
		$oldpassword = $_POST['oldpassword'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		if( $oldpassword == $password ){
			if( $password1 == $password2 ){
				$sql = "UPDATE admin SET password='$password1'";
				mysqli_query($db, $sql);
				echo "Updated!";
			}else{
				echo 'Password mis-matched!';
			}
		}else{
			echo 'Wrong password!';
		}
		exit();
	}	
?>
<?php include("headpart.php"); ?>
<?php include("navbar.php"); ?>

<script type='text/javascript'>
	$(document).ready(function(){
		$(document).on('click', '#updateinvoicehead', function(){			
			oldpassword = $('#oldpassword').val();
			password1 = $('#password1').val();
			password2 = $('#password2').val();			
			$.post("password.php", {oldpassword:oldpassword, password1:password1, password2:password2}, function(res){
				alert(res);
			});
		});
	});
</script>
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title">Password Change</h3>
		  </div>
		  <div class="panel-body">
			
			<div>
				<div class='form-group'>
					<div class='input-group'>
						<label>Existed Password</label>
						<input type='password' id='oldpassword' class='form-control' autofocus placeholder='Existed Password' />
					</div>	
					<div class='input-group'>
						<label>New Password</label>
						<input type='password' id='password1' class='form-control' placeholder='New Password1' />
					</div>
					<div class='input-group'>
						<label>Type Again</label>	
						<input type='password' id='password2' class='form-control' placeholder='New Password2' />
					</div>	
				</div>
				<button id='updateinvoicehead' class='btn btn-md btn-warning' >Update</button>			
			</div>				
			<hr>
			</div>
		  </div>
		</div>
	</div>	
</div>


<?php include("footer.php"); ?>




