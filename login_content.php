<div id='loginblock'>
	
	<form action='index.php' method='post'>
		<label>Username</label><br>
		<input type='text' name='username' placeholder='Username' /><br>
	
		<label>Password</label><br>
		<input type='text' name='password' placeholder='Password' /><br>
		<br>
		<input type='submit' name='submit' value='Login' />
	</form>
	<?php echo $msg; ?>

</div>
