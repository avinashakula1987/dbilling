<?php include("database.php"); ?>
<?php include("session.php"); ?>
<?php

	if( isset($_POST['billmobile']) && isset($_POST['currentlypayingnow']) ){
		$billmobile = $_POST['billmobile'];
		$currentlypayingnow = $_POST['currentlypayingnow'];
		$currentlypayingnowa = $_POST['currentlypayingnowa'];
		$sql = "SELECT COUNT(*) as count FROM credits WHERE mobile='$billmobile'";
		$qry = $db->query($sql);
		$rows = $qry->fetchArray();
		$count = $rows['count'];
		if( $count == 0 ){
			$qry = "INSERT INTO credits (mobile, credit) VALUES('$billmobile', '$currentlypayingnowa')";
			$insert = $db->exec($qry);
			echo true;
		}else{
			$sql = "SELECT * FROM credits WHERE mobile='$billmobile'";
			$qry = $db->query($sql);
			$rows = $qry->fetchArray();
			$credit = $rows['credit'];
			$pending = (float)$currentlypayingnowa + (float)$credit;
			$sql = "UPDATE credits SET credit='$pending' WHERE mobile='$billmobile'";
			$update = $db->exec($sql);
			echo true;				
		}
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>	
	<script type='text/javascript' src='js/jquery-3.2.1.min.js'></script>
	
	<link rel='stylesheet' href='css/jquery-ui.min.css'></link>
	<link rel='stylesheet' href='css/jquery-ui.structure.min.css'></link>
	<link rel='stylesheet' href='css/jquery-ui.theme.min.css'></link>	
	<link rel="stylesheet" href="css/bootstrap.min.css"></link>
	<link rel="stylesheet" href="css/bootstrap-theme.min.css"></link>
	
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/create.js"></script>
	<script src="js/update.js"></script>
	<script src="js/delete.js"></script>
	<script src="js/billing.js"></script>
	<link rel='stylesheet' href='css/desireit.css'></link>
	
	<script type='text/javascript' src='js/jquery-ui.min.js'></script>


	<style>
		table td{
			font-size:11px
		}
	</style>

	
</head>
<body>

	<div style="padding:5px">

	
<?php
	function productcategory($productid, $db){
		$sql = "SELECT actualprice FROM stock WHERE id='".$productid."'";
		$get = mysqli_query($db, $sql);
		$res = mysqli_fetch_array($get);
		$actualprice = $res['actualprice'];
			
		$arrays = array("actualprice"=>$actualprice);		
		return $arrays;
	}
?>

<style>
	*{
		padding:0;
		margin:0
	}
	.updateStock{
		display:none;
	}
	.table .table tr, .table .table tr td{
		border:1px solid black;
	}
	table, th, td {
	border: 1px solid;
	}
	
</style>
<?php
	if( isset($_GET['estimateId']) ){
		$estimateId = $_GET['estimateId'];
		$sql2 = "SELECT * FROM invoices WHERE id='$estimateId'";
		$selectInvoice = mysqli_query($db, $sql2);
		$res = mysqli_fetch_array($selectInvoice);
		$array = unserialize($res['info']);	
		$customername = $res["customer"];
		$customermobile = $res["mobile"];
		$state = $res["state"];
		$city = $res["city"];
		$address = $res["address"];
		$gst = $res["gst"];
		$pin = $res["pin"];
		$dat = $res["date"];
		$dispatchThrough = $res["dispatchThrough"];
		$consigneeVehicle = $res["vehicle"];
		
		$date = date("d-M-y", strtotime($dat));
		//print_r($array);
	}else{
		echo "
		<div class='row text-center'>
			<br>Invoice not found<br>
			<a href='billing.php' class='btn btn-lg btn-warning'>Billing</a>
		</div>";
		exit();
	}
	$page = 1;
?>

<script>
	$(document).ready(function(){
		$(".invoiceNumber").html("<b><?php echo $invoiceId; ?></b>");
		$(".invoiceewaybillNumber").html("<b><?php echo $invoiceId; ?></b>");
		$(".consigneeTo").html("<b><?php echo $customername; ?></b>");
		$(".consigneeAddress").html("<b><?php echo $address; ?></b>");
		$(".consigneeCity").html("<b><?php echo $city; ?></b>");
		$(".consigneeState").html("<b><?php echo $state; ?></b>");
		$(".consigneeGST").html("<b><?php echo $gst; ?></b>");
		$(".consigneePin").html("<b><?php echo $pin; ?></b>");
		$(".billDateIs").html("<b><?php echo $date; ?></b>");
		$(".dispatchDocNo").html("<b><?php echo $invoiceId; ?></b>");
		$(".dispatchThrough").html("<b><?php echo $dispatchThrough; ?></b>");
		$(".consigneeVehicle").html("<b><?php echo $consigneeVehicle; ?></b>");
		
		
	});
</script>
			
			
			
			
		<div>
		<div class='text-center '>  
			<?php //$dd = invoiceHeader($db); echo $dd[0]; ?>
<br>
<table align="left" border="0" cellpadding="1" cellspacing="1" style="width:100%; border:none">
	<tbody>
		<tr>
			<td style="width:33%; border:none; font-size:2em">ESTIMATE</td>
			<td style="text-align:center; width:33%; border:none"><strong><span style="font-size:20px">Slip No.: <?= $estimateId; ?></span></strong></td>
			<td style="text-align:right; width:33%; border:none; font-size:1.2em">Date: <?= $date; ?></td>
		</tr>
	</tbody>
</table>
<br />
<br />
<table align="left" cellpadding="5" cellspacing="1" style="text-align:left; width:100%">
	<tbody>
		
		<tr>
			<td style="vertical-align:top; padding:5px">Consignee (Ship to)<br />
				<strong class="consigneeTo">JVK POLYMERS</strong>				
				<span class="consigneeCity">Rajahmundry</span>
			</td>		
		</tr>
		
		<tr>
			<td colspan="2">
			<div class='stockform billingblock' style="height:500px">				
			<table class='table table-condensed table-bordered'>
				<thead>
					<tr>
						<th>SNo.</th>
						<th>Items</th>
						<th class='text-center'>Qty</th>
						<th class='text-center'>Rate</th>
						<th class='text-center'>Per</th>
						<th class='text-center'>Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$payable = 0;
					$sno = 1;
					$records = 1;
					$gsttotal = 0;
					$total1 = 0;
					$gst_tot = 0;
					$tally1 = 0;
					$tally2 = 0;
					$total_qty = 0;
					for($i=1; $i<count($array); $i++){
						if( $records>15 ){	
							$page++;
							$records = 2;
							?>
								</tbody>
								
								<tr>
										<td class='text-center'></td>
										<td class='text-center'></td>
										<td class='text-center'></td>
										<td class='text-center'></td>
										<td class='text-center'></td>
										<td class='text-center'>TOTAL</td>
										<td class='text-center finalpayable'><?php echo $payable; ?> /-</td>
										<td class='text-center finalpayable'><?php echo $payable; ?> /-</td>
									</tr>
									</tbody>
								</table>
								<div id='foot'>
								<?php echo invoiceHeader($db); ?>
								</div>
								
								
							  </div>
							</div>
						
							<div class='well stockform billingblock'>				
								<table class='table table-condensed table-bordered'>
									<thead>
										<tr>
											<th>SNo.</th>
											<th>Description of goods</th>
											<th class='text-center'>Qty</th>
											<th class='text-center'>Rate</th>
											<th class='text-center'>Per</th>
											<th class='text-center'>Total</th>
										</tr>
									</thead>
									<tbody style="min-height:500px">
	
								
								
								
								
								
								
								
								
								
								
								
								
								
								
				
				<!-- finished new top -->
				
							
							<?php
								if( $array[$i] ){
									$category = $array[$i][0];
									$categoryid = $array[$i][1];
									$product = $array[$i][2];
									$productid = $array[$i][3];
									$productcategory = productcategory($productid, $db);
									$qty = $array[$i][4];
									$total = $qty * $array[$i][5];						
									$price = $array[$i][6];						
									$gst = $array[$i][7];						
									$pricewithgst = $array[$i][8];	
									$qtyType = $array[$i][11];	
									$totalgst = $qty * $gst;
									$payable = $payable + $pricewithgst;	
									$total_qty = $total_qty+$qty;	
									$tally1 = $tally1 + $actual_individual_price_total;
									$tally2 = $tally2 + $gst_tot;
									$grandtotal = $tally1 + $gsttotal;				
									echo "
										<tr>
											<td>$sno</td>
											<td>$product</td>
											<td class='text-center'>$qty $qtyType</td>					
											<td class='text-center'>$actual_individual_price</td>					
											<td class='text-center'>$qtyType</td>					
											<td class='text-center'>$actual_individual_price_total</td>	
										</tr>							
									";
									$sno++;
								}	
							}else{
								if( $array[$i] ){
									$category = $array[$i][0];
									$categoryid = $array[$i][1];
									$product = $array[$i][2];
									$productid = $array[$i][3];
									$productcategory = productcategory($productid, $db);
									$qty = $array[$i][4];
									$total = $qty * $array[$i][5];						
									$price = $array[$i][6];						
									$gst = $array[$i][7];						
									$pricewithgst = $array[$i][8];	
									$actual_individual_price = $array[$i][9];	
									$qtyType = $array[$i][11];	
									$actual_individual_price_total = $actual_individual_price * $qty;
									$totalgst = $qty * $gst;
									$total1 = $total1 + $total;
									$actual_individual_price_total_value = $actual_individual_price_total + $totalgst;
									$wgst = $price + $gst;	
									$wgst2 = $qty * $wgst;	
									$gsttotal = $gsttotal + ($gst);
									$gst_tot = $gst_tot+$gst;
									$payable = $total1 + $gst_tot;

									$total_qty = $total_qty+$qty;
									
									$tally1 = $tally1 + $actual_individual_price_total;
									$tally2 = $tally2 + $gst_tot;
									$grandtotal = $tally1 + $gsttotal;
									echo "
										<tr>
											<td>$sno</td>
											<td>$product</td>
											<td class='text-center'>$qty $qtyType</td>					
											<td class='text-center'>$actual_individual_price</td>					
											<td class='text-center'>$qtyType</td>					
											<td class='text-center'>$actual_individual_price_total</td>										
										</tr>							
									";
									$sno++;
									$records++;
								}	
							}	
						}
					
					?>			
				<tr>
					<td class='text-center'></td>
					<td class='text-right'>Total</td>					
					<td class='text-center'><?php echo $total_qty; ?></td>
					<td class='text-center'></td>
					<td class='text-center'></td>
					<td class='text-center finalpayabl'><?php echo $grandtotal; ?> /-</td>
				</tr>
				</tbody>
			</table>
			
			</td>

		</tr>
	</tbody>
</table>




		
	


<style>
	.a4{
		vertical-align:top !important;
		height:260mm;
		idth:210mm;
		eight:100%;
		osition:relative;
	}
	*{
		font-size:12px;
	}
	#foot{
		
	}
	#foot table td span{
		font-size:10px !important; 
	}
</style>
<div class='text-center'>
	<button class='btn btn-default btn-sm printme' >Print</button>
	<!--<div class='form-group partialblock'>
		<input type='text' class='form-control' value='<?php echo $payable; ?>' data-actual='<?php echo $payable; ?>' id='partialpayingnow'><button class='btn btn-warning btn-sm mypendingbill' data-mobile='<?php echo $customerInfo[1]; ?>' >Pending</button>
	</div>-->	
</div>
<script>
	$(document).ready(function(){
		$('.printme').click(function(){
			$(this).hide();
			window.print();			
		});
		$('.mypendingbill').click(function(){
			billmobile = $(this).attr('data-mobile');
			currentlypayingnow = $('#partialpayingnow').val();
			currentlypayingnowa = $('#partialpayingnow').attr('data-actual');
			$.post("invoice.php", {billmobile:billmobile, currentlypayingnow:currentlypayingnow, currentlypayingnowa:currentlypayingnowa}, function(res){
				$('.partialblock').hide();
			});			
		});
		$('.finalpayable').html("<b><?php echo $payable; ?> /-</b>");
	});
</script>


