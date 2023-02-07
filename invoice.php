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
	if( isset($_GET['invoice']) ){
		$invoiceId = $_GET['invoice'];
		$sql2 = "SELECT * FROM invoices WHERE id='$invoiceId'";
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
			<td style="width:33%; border:none">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>
			<td style="text-align:center; width:33%; border:none"><strong><span style="font-size:20px">TAX INVOICE</span></strong></td>
			<td style="text-align:right; width:33%; border:none; font-size:0.8em">(DUPLICATE FOR TRANSPORTER)</td>
		</tr>
	</tbody>
</table>
<br />
<br />
<table align="left" cellpadding="5" cellspacing="1" style="text-align:left; width:100%">
	<tbody>
		<tr>
			<td style="vertical-align:top; padding:5px"><strong>SAI RAM ENTERPRISES</strong><br />
			S.No: 495/4A &amp; 495/5A<br />
			PLOT NO 1B, GOLLAPUDI<br />
			VIJAYAWADA-AP<br />
			GSTIN/UIN: 37ACIFS6230L1ZQ<br />
			State Name: Andhra Pradesh, Code: <strong>37</strong></td>
			<td colspan="1" rowspan="3" style="vertical-align:top">
			<table cellpadding="5" cellspacing="0" style="width:100%; border-left:0; border-top:none; border-right:none">
				<tr>
					<td style="border:none">
						<tbody>
							<tr>
								<td style="vertical-align:top; padding:5px; border:none; border-right:1px solid black">
									<table border="0" cellpadding="1" style="width:100%; border:0;">
										<tbody>
											<tr style="">
												<td style="vertical-align:top;border:none">Invoice No.
												<div class="invoiceNumber">3251</div>
												</td>
												<td style="text-align:right; vertical-align:top; border:none">e-Way Bill No.
												<div class="invoiceewaybillNumber"></div>
												</td>
											</tr>
										</tbody>
									</table>

									<p>&nbsp;</p>
									</td>
									<td style="vertical-align:top;padding:5px; border:none">Dated
									<div class="billDateIs"></div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align:top;padding:5px; border-left:none">Delivery Note</td>
								<td style="vertical-align:top;padding:5px; border-right:none">Mode/Terms of Payment</td>
							</tr>
							<tr>
								<td style="vertical-align:top;padding:5px; border-left:none">Reference No. &amp; Date.</td>
								<td style="vertical-align:top;padding:5px; border-right:none">Other References</td>
							</tr>
							<tr>
								<td style="vertical-align:top;padding:5px; border-left:none">Buyer&#39;s Order No.</td>
								<td style="vertical-align:top;padding:5px; border-right:none">Dated</td>
							</tr>
							<tr>
								<td style="vertical-align:top;padding:5px; border-left:none">Dispatch Doc No.<br />
								<strong class="dispatchDocNo">3251</strong></td>
								<td style="vertical-align:top;padding:5px; border-right:none">Delivery Note Date</td>
							</tr>
							<tr>
								<td style="vertical-align:top;padding:5px; border-left:none">Dispatched through<br />
								<span class="dispatchThrough">BY ROAD</span></td>
								<td style="vertical-align:top;padding:5px; border-right:none">Destination<br />
								<span class="consigneeCity">RAJAHMUNDRY</span></td>
							</tr>
							<tr>
								<td style="vertical-align:top;padding:5px; border-left:none">Bill of Lading/LR-RR No.</td>
								<td style="vertical-align:top;padding:5px; border-right:none">Motor Vehicle No.<br />
								<span class="consigneeVehicle">RAJAHMUNDRY</span></td>
							</tr>
							<tr>
								<td colspan="2" style="vertical-align:top;padding:5px; border-left:none; border-right:none">Terms of Delivery</td>
							</tr>
						</tbody>
					</td>
				</tr>
				
			</table>

			<p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top; padding:5px">Consignee (Ship to)<br />
				<strong class="consigneeTo">JVK ENTERPRISES</strong>
				<div class="consigneeAddress">SVG Market D No 14-302/5<br />
				RS NO 310 Morampudi Road</div>
				<span class="consigneeCity">Rajahmundry</span><br>
				<span>GSTIN/UIN : <span class="consigneeGST">37BDGPJ5829J1Z6</span></span><br>
				<span>State Name: <span class="consigneeState">Andhra Pradesh</span>, Code: <strong class="consigneePin">37</strong></span>
			</td>
		
		</tr>
		<tr>
			<td style="vertical-align:top; padding:5px">Buyer (Bill to)<br />
				<strong class="consigneeTo">JVK ENTERPRISES</strong>
				<div class="consigneeAddress">SVG Market D No 14-302/5<br />
				RS NO 310 Morampudi Road</div>
				<span class="consigneeCity">Rajahmundry</span><br>
				<span>GSTIN/UIN : <span class="consigneeGST">37BDGPJ5829J1Z6</span></span><br>
				<span>State Name: <span class="consigneeState">Andhra Pradesh</span>, Code: <strong class="consigneePin">37</strong></span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<div class='stockform billingblock'>				
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
							<div class='a4 top' valign='top'>		
								<div class='text-center container top' valign='top'>  
								<?php echo invoiceHeader($db); ?>
								<div class='clearfix'></div>
								<table width='100%' border='1'>
									<tr>
										<td style='border:0; text-align:left; width:25%'>Serial No: <?php echo $_GET['invoice']; ?> | page: <?php echo $page; ?><br>
										Date of Issue: <?php echo date("d, M Y", strtotime(date('Y-m-d'))); ?>
										</td>
										<td style='border:0; text-align:center; width:50%; font-size:22px !important; vertical-align:top'><u>BILL OF SUPPLY</u></td>
										<td style='border:0; text-align:left; width:25%;'>
											
											Date of supply: <?php echo date('d, M Y'); ?><br>
											Place of supply: Rajahmundry
										</td>
									</tr>
								</table>
								<table width='100%' border='1'>
									<tr>
										<td style='text-align:center'>
											Details of Receiver / Billed to:
										</td>
										<td style='text-align:center'>
											Details of Consignee / Shipped to:
										</td>
									</tr>
									<tr>
										<td style='text-align:left;'>
											Name: <?php echo $customername; ?><br>
											Mobile: <?php echo $customermobile; ?>
										</td>
										<td style='text-align:left;'>
											Name: <?php echo $customername; ?><br>
											Mobile: <?php echo $customermobile; ?>
										</td>
									</tr>
								</table>			
							</div><hr>
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
									<tbody>
	
								
								
								
								
								
								
								
								
								
								
								
								
								
								
				
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
			<div id='foot'>
						<table border="0" style="border:none; margin:10px; vertical-align:top" valign="top">
							<tr>
								<td colspan="2" style="border:none">
									<p>Company's PAN : ACIFS6230L</p>
								</td>
							</tr>
							<tr>
								<td width="50%" style="border:none; vertical-align:top">									
									<u>Declaration</u>
									<p>
										1)Goods once sold will not be taken back or exchanged 2)our responsibility ceases as soon as goods leave our premises 3)we declare that this invoice shows the actual price of the goods described and that all particulars are true and correct</p>
								</td>
								<td style="border:none; vertical-align:top">
									Company's Bank Details
									<p>
										A/C Holder's Name : SAI RAM ENTERPRISES<br>
										Bank Name : TAMILNAD MERCANTILE BANK LTD<br>
										A/C No. : 266700050900044<br>
										Branch & IFS Code : GOLLAPUDI & TMBL0000266
									</p>
								</td>
							</tr>
						</table>
			</div>
			
			
		  </div>
		</div>
			</td>

		</tr>
	</tbody>
</table>

<div align="center">
	SUBJECT TO VIJAYAWADA JURISDICTION<br>
	This is a Computer Generated Invoice
</div>




		
	


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


