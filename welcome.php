<?php include("session.php"); ?>
<?php include("database.php"); ?>


<?php include("headpart.php"); ?>



<?php include("navbar.php"); ?>
<div class='col-md-10'>
	<div class='row'>
		<div class="panel panel-primary mainbody">
		  <div class="panel-heading">
			<h3 class="panel-title"><?php echo $_SESSION['loginname']; ?> Area</h3>
		  </div>
		  <div class="panel-body">
			<div class='row text-center'>
				<h3>Welcome <?php echo $_SESSION['loginname']; ?></h3>
				<a href='billing.php' class='btn btn-lg btn-primary'>Start Billing</a>
			</div>	
		  </div>
		</div>
	</div>	
</div>



<?php //include("footer.php"); ?>




