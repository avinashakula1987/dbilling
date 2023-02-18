<?php 
	session_start();
	include("database.php"); 
?>
<?php
	if( isset($_SESSION['loginid']) ){
		header("Location: welcome.php");
	}
	$msg = "";
	if( isset($_POST['submit']) ){
		$username = $_POST['username'];
		$password = $_POST['password'];		
		$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
		$check = mysqli_query($db, $sql); 
		$count = mysqli_num_rows($check);
		if( $count == 1 ){
			// storing primary key id in variables ie; in session variable;
			$res = mysqli_fetch_array($check);
			$_SESSION['loginname'] = $res['name'];			
			$_SESSION['loginid'] = $res['id'];					
			$_SESSION['login'] = $username;			
			header("Location: welcome.php");
		}else{
			$msg = "<div class='alert alert-warning alert-xs alert-dismissable fade in'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Invalid Username (or) Password</div><div class='clearfix'></div>";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo Title; ?></title>	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
	<script type='text/javascript' src='js/jquery-ui.min.js'></script>
	<link rel='stylesheet' href='css/jquery-ui.min.css'></link>
	<link rel='stylesheet' href='css/jquery-ui.structure.min.css'></link>
	<link rel='stylesheet' href='css/jquery-ui.theme.min.css'></link>	
	<link rel="stylesheet" href="css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="css/bootstrap-theme.min.css"></link>
	<script src="js/bootstrap.min.js"></script>
	
	
	<link rel='stylesheet' href='css/desireit.css'></link>
	
</head>
<body style='background:url(images/bg.jpg);background-size: cover;background-repeat: no-repeat'>

	<div class='container-fluid mt-1'>
		<div class='col-md-12 logo text-center'>
			<h1 id='business-title'>JVK Enterprises</h2>				
		</div>
		<div class='row'>
			

			<div class='col-md-4 col-md-offset-4'>
				
				<div class='jumbotron login' >
					<form action='index.php' method='post'>
						<label>Username</label><br>
						<input type='text' required name='username' autofocus class='form-control' placeholder='Username' /><br>
					
						<label>Password</label><br>
						<input type='password' required name='password' class='form-control' placeholder='Password' /><br>
						
						<input type='submit' name='submit' class='btn btn-md btn-default' value='Login' />
					</form>
				</div>	
				<?php echo $msg; ?>
				<div class='clearfix'></div>
				<div class='text-center text-primary'>For any issues contact at<br><b>6300034252</b></div>
			</div>


<?php include("footer.php"); ?>

