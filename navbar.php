<?php
	function activemenu($page){
		$basepage = basename($_SERVER['PHP_SELF']);
		if(	$page == $basepage ){
			echo "active";
		}else{
			echo "";
		}
	}
?>
<div class='col-md-2 col-sm-2'>
	<nav class="navbar navbar-default">
  <div class="container-fluid" style='padding:0'>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
     <!-- <a class="navbar-brand" href="#">MENU</a>-->
    </div>
    <div class="collapse navbar-collapse justnavhead" id="myNavbar">
      <ul class="nav navbar-nav justnav">
		  <li class='<?php echo activemenu("welcome.php"); ?>'><a href="welcome.php"><span class='glyphicon glyphicon-play-circle'></span> Home</a></li>
		  <li class='<?php echo activemenu("billing.php"); ?> <?php echo activemenu("invoices.php"); ?> <?php echo activemenu("pending_invoices.php"); ?> <?php echo activemenu("failed_invoices.php"); ?>'><a href="billing.php"><span class='glyphicon glyphicon-play-circle'></span> Billing</a></li>
		 
		  <!-- <li class='<?php echo activemenu("categories.php"); ?>'><a href="categories.php"><span class='glyphicon glyphicon-play-circle'></span> Categories</a></li> -->
		  <!-- <li class='<?php echo activemenu("add_stock.php"); ?> <?php echo activemenu("add_stock.php"); ?> <?php echo activemenu("purchases.php"); ?>'><a href="add_stock.php"><span class='glyphicon glyphicon-play-circle'></span> Purchases</a></li> -->
		  <li class='<?php echo activemenu("stock.php"); ?> <?php echo activemenu("unavailable_stock.php"); ?> <?php echo activemenu("inactive_stock.php"); ?>'><a href="stock.php"><span class='glyphicon glyphicon-play-circle'></span> Stock</a></li>
		  <li class='<?php echo activemenu("reports.php"); ?>'><a href="reports.php"><span class='glyphicon glyphicon-play-circle'></span> Reports</a></li>
		  <li class='<?php echo activemenu("balancesheet.php"); ?>'><a href="balancesheet.php"><span class='glyphicon glyphicon-play-circle'></span> Balancesheet</a></li>
		  <li class='<?php echo activemenu("customers.php"); ?>'><a href="customers.php"><span class='glyphicon glyphicon-play-circle'></span> Customers</a></li>
		  <!-- <li class='<?php echo activemenu("vehicles.php"); ?>'><a href="vehicles.php"><span class='glyphicon glyphicon-play-circle'></span> Vehicles</a></li> -->
		  <!-- <li class='<?php echo activemenu("drivers.php"); ?>'><a href="drivers.php"><span class='glyphicon glyphicon-play-circle'></span> Drivers</a></li> -->
		  <li class='<?php echo activemenu("moderators.php"); ?>'><a href="moderators.php"><span class='glyphicon glyphicon-play-circle'></span> Moderators</a></li>
		  <!-- <li class='<?php echo activemenu("settings.php"); ?>'><a href="settings.php"><span class='glyphicon glyphicon-play-circle'></span> Bill Header</a></li> -->
		  <!-- <li class='<?php echo activemenu("settings_footer.php"); ?>'><a href="settings_footer.php"><span class='glyphicon glyphicon-play-circle'></span> Bill Footer</a></li> -->
		  
		  <li class='<?php echo activemenu("password.php"); ?>'><a href="password.php"><span class='glyphicon glyphicon-play-circle'></span> Password</a></li>
		  <!-- <li class='<?php echo activemenu("settings_footer.php"); ?>'><a href="software_settings.php"><span class='glyphicon glyphicon-play-circle'></span> Transport</a></li> -->
		 
		  <li><a href="logout.php"><span class='glyphicon glyphicon-play-circle'></span> Logout</a></li>
		</ul>
      </ul>
    
    </div>
  </div>
</nav>


	
	
	
	
	
	
	
	<!--
	
	
	<div class="sidenav">
		<ul class="list-group">
		  <li class="list-group-item" onclick="location.href='welcome.php'">Home</li>
		  <li class="list-group-item" onclick="location.href='billing.php'">Billing</li>
		  <li class="list-group-item" onclick="location.href='categories.php'">Categories</li>
		  <li class="list-group-item" onclick="location.href='stock.php'">Stock</li>
		  <li class="list-group-item" onclick="location.href='reports.php'">Reports</li>
		  <li class="list-group-item" onclick="location.href='moderators.php'">Moderators</li>
		  <li class="list-group-item" onclick="location.href='settings.php'">Settings</li>
		  <li class="list-group-item" onclick="location.href='password.php'">Password</li>
		  <li class="list-group-item" onclick="location.href='logout.php'">Logout</li>
		</ul>
	</div>	
	
	-->
	
</div>	
