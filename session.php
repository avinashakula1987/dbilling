<?php
	session_start();
	
	if( !isset($_SESSION['loginid']) ){
		header("Location: index.php");
	}
?>