<?php
	include("database.php");
	session_start();
	// check if the product already existed so far while inserting new product
	function alreadyexisted($product, $db){
		$product = $product;		
		$sql = "SELECT COUNT(*) AS count FROM stock WHERE name='$product'";
		$existance_check = mysqli_query($db, $sql);
		$r = mysqli_fetch_array($existance_check);
		$count = $r['count'];
		if( $count == 0 ){
			return true;			
		}else{
			return false;
		}
	}


	
	function updateexisted($category, $product, $quantity, $db){				
		$sql = "UPDATE stock SET qty=qty+'$quantity' WHERE category='$category' AND name='$product'";
		$update = mysqli_query($db, $sql);
		if( $update ){
			return true;			
		}else{
			return false;
		}
	}
	function increaseOpenBalance($total, $db){				
		$sql = "UPDATE openingbalance SET balance=balance+'$total' WHERE id='1'";
		$update = mysqli_query($db, $sql);
		if( $update ){
			return true;			
		}else{
			return false;
		}
	}
	
	
	if( isset($_POST['update_qty']) && isset($_POST['update_product']) && isset($_POST['update_categoryid']) ){
		$category = $_POST['update_categoryid'];
		$product = $_POST['update_product'];
		$qty = $_POST['update_qty'];
		if( updateexisted($category, $product, $qty, $db) ){
			echo "Stock also updated!";
		}else{
			echo "Stock also not updated!";
		}
		exit();
	}
	
	if( isset($_POST['createcategory']) ){
		$category = $_POST['createcategory'];
		
		$sql = "SELECT COUNT(*) AS count FROM categories WHERE name='$category'";
		$existance_check = mysqli_query($db, $sql);
		$r = mysqli_fetch_array($existance_check);
		$count = $r['count'];
		if( $count == 0 ){
			$sql2 = "INSERT INTO categories (name, status) VALUES('$category', '1')";
			$insert = mysqli_query($db, $sql2);
			if( $insert ){
				echo true;
			}else{
				echo "Try again!";
			}
		}else{
			echo "Category already existed!";
		}
		exit();
	}
	if( isset($_POST['musername']) ){
		$musername = $_POST['musername'];
		$mpassword = $_POST['mpassword'];
		$mname = $_POST['mname'];
		
		$sql = "SELECT COUNT(*) AS count FROM admin WHERE username='$musername'";
		$existance_check = mysqli_query($db, $sql);
		$r = mysqli_fetch_array($existance_check);
		$count = $r['count'];
		if( $count == 0 ){
			$sql2 = "INSERT INTO admin (username, password, name, type, status, created, attempts) VALUES('$musername', '$mpassword', '$mname', 'moderator', '0', '".date('Y-m-d')."', '0')";
			$insert = mysqli_query($db, $sql2);
			if( $insert ){
				echo true;
			}else{
				echo "Try again!";
			}
		}else{
			echo "Category already existed!";
		}
		exit();
	}
	
	if( isset($_POST['customer_mobile']) ){
		$customer_mobile = $_POST['customer_mobile'];
		$customer_name = $_POST['customer_name'];
		$customer_address = $_POST['customer_address'];
		$customer_gstin = $_POST['customer_gstin'];
		
		$sql = "SELECT COUNT(*) AS count FROM customers WHERE mobile='$customer_mobile'";
		$existance_check = mysqli_query($db, $sql);
		$r = mysqli_fetch_array($existance_check);
		$count = $r['count'];
		if( $count == 0 ){
			$sql2 = "INSERT INTO customers (name, mobile, address, gst) VALUES('$customer_name', '$customer_mobile', '$customer_address', '$customer_gstin')";
			$insert = mysqli_query($db, $sql2);
			if( $insert ){
				echo true;
			}else{
				echo "Try again!";
			}
		}else{
			echo "Customer already existed!";
		}
		exit();
	}
	

	if( isset($_POST['vehicleno']) ){
		$vehicleno = $_POST['vehicleno'];
		$vehiclename = $_POST['vehiclename'];
		$description = $_POST['description'];
		
		$sql = "SELECT COUNT(*) AS count FROM vehicles WHERE vehicleno='$vehicleno'";
		$existance_check = mysqli_query($db, $sql);
		$r = mysqli_fetch_array($existance_check);
		$count = $r['count'];
		if( $count == 0 ){
			$sql2 = "INSERT INTO vehicles (vehiclename, vehicleno, description) VALUES('$vehiclename', '$vehicleno', '$description')";
			$insert = mysqli_query($db, $sql2);
			if( $insert ){
				echo true;
			}else{
				echo "Try again!";
			}
		}else{
			echo "Vehicle Number already existed!";
		}
		exit();
	}
	if( isset($_POST['driverno']) ){
		$driverno = $_POST['driverno'];
		$drivername = $_POST['drivername'];
		$description = $_POST['description'];
		
		$sql = "SELECT COUNT(*) AS count FROM drivers WHERE driverno='$driverno'";
		$existance_check = mysqli_query($db, $sql);
		$r = mysqli_fetch_array($existance_check);
		$count = $r['count'];
		if( $count == 0 ){
			$sql2 = "INSERT INTO drivers (drivername, driverno, description) VALUES('$drivername', '$driverno', '$description')";
			$insert = mysqli_query($db, $sql2);
			if( $insert ){
				echo true;
			}else{
				echo "Try again!";
			}
		}else{
			echo "Driver Number already existed!";
		}
		exit();
	}
	
	
	if( isset($_POST['updatecreatecategory']) && isset($_POST['update_categoryid']) ){
		$updatecreatecategory = $_POST['updatecreatecategory'];
		$update_categoryid = $_POST['update_categoryid'];		
		$sql = "UPDATE categories SET name='$updatecreatecategory' WHERE id='$update_categoryid'";
		$update = mysqli_query($db, $sql);
		if( $update ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	
	if( isset($_POST['newusername_value']) && isset($_POST['newname_value']) ){
		$newusername_value = $_POST['newusername_value'];
		$newname_value = $_POST['newname_value'];
		$newpassword_value = $_POST['newpassword_value'];		
		$sql = "UPDATE admin SET name='$newname_value', password='$newpassword_value' WHERE username='$newusername_value'";
		$update = mysqli_query($db, $sql);
		if( $update ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	
	
	if( isset($_POST['category_statusstate']) && isset($_POST['category_statusid']) ){
		$category_statusstate = $_POST['category_statusstate'];
		$category_statusid = $_POST['category_statusid'];
		$sql = "UPDATE categories SET status='$category_statusstate' WHERE id='$category_statusid'";
		$update = mysqli_query($db, $sql);
		if( $update ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	if( isset($_POST['mcategory_statusstate']) && isset($_POST['mcategory_statusid']) ){
		$category_statusstate = $_POST['mcategory_statusstate'];
		$category_statusid = $_POST['mcategory_statusid'];
		$sql = "UPDATE admin SET status='$category_statusstate' WHERE id='$category_statusid'";
		$update = mysqli_query($db, $sql);
		if( $update ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	
	
	if( isset($_POST['deletecategory'])){
		$deletecategory = $_POST['deletecategory'];
		$sql = "DELETE FROM categories WHERE id='$deletecategory'";
		$delete = mysqli_query($db, $sql);
		if( $delete ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	if( isset($_POST['deletemoderator'])){
		$deletemoderator = $_POST['deletemoderator'];
		$sql = "DELETE FROM admin WHERE id='$deletemoderator'";
		$delete = mysqli_query($db, $sql);
		if( $delete ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	if( isset($_POST['delcustomer'])){
		$delcustomer = $_POST['delcustomer'];
		$sql = "DELETE FROM customers WHERE id='$delcustomer'";
		$delete = mysqli_query($db, $sql);
		if( $delete ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	if( isset($_POST['delvehicle'])){
		$delvehicle = $_POST['delvehicle'];
		$sql = "DELETE FROM vehicles WHERE id='$delvehicle'";
		$delete = mysqli_query($db, $sql);
		if( $delete ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	if( isset($_POST['deldriver'])){
		$deldriver = $_POST['deldriver'];
		$sql = "DELETE FROM drivers WHERE id='$deldriver'";
		$delete = mysqli_query($db, $sql);
		if( $delete ){
			echo true;
		}else{
			echo false;
		}		
		exit();
	}
	
	if( isset($_POST['listcategory_did'])){
		$listcategory_did = $_POST['listcategory_did'];
		$sql = "DELETE FROM stock WHERE id='$listcategory_did'";
		mysqli_query($db, $sql);
		echo true;			
		exit();
	}
	if( isset($_POST['delinvoiceid'])){
		$listcategory_did = $_POST['delinvoiceid'];
		$sql = "DELETE FROM invoices WHERE id='$listcategory_did'";
		mysqli_query($db, $sql);
		echo true;				
		exit();
	}
	
	// creating new stock starts
	if( isset($_POST['billingInfos']) ){
		$billingInfos = json_decode($_POST['billingInfos']);
		$billTotal = $_POST['billTotal'];
		$billTotalQty = $_POST['billTotalQty'];
		$billFinalTotal = $_POST['billFinalTotal'];
		$customername = $_POST['customername'];
		$mobile = $_POST['mobile'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$pincode = $_POST['pincode'];
		$gst = $_POST['gst'];
		$dispatchThrough = $_POST['dispatchThrough'];
		$vehicle = $_POST['vehicle'];
		$transaction = $_POST['transaction'];
		$openingBalance = $_POST['openingBalance'];
		$fullPayment = $_POST['fullPayment'];
		$partialPayment = $_POST['partialPayment'];
		
		$billingInfos2 = serialize($billingInfos);
		$login = $_SESSION['login'];
		$sql = "INSERT INTO invoices (customer, mobile, info, total, qty, finaltotal, date, status, state, city, address, pin, gst, dispatchThrough, vehicle, transaction, openingBalance, login, fullPayment, partialPayment) VALUES('$customername', '$mobile', '$billingInfos2', '$billTotal', '$billTotalQty', '$billFinalTotal', '".date('Y-m-d')."', '0', '$state', '$city', '$address', '$pincode', '$gst', '$dispatchThrough', '$vehicle', '$transaction', '0', '$login', '$fullPayment', '$partialPayment')";
		$data = mysqli_query($db, $sql);
		setcookie("modifyInvoice", $db->insert_id);
		echo true;
		exit();
	}
	// creating new stock ends
	// update invoice starts
	if( isset($_POST['updateBillingInfos']) ){
		$billingInfos = json_decode($_POST['updateBillingInfos']);
		$oldInvoiceId = $_POST['oldInvoiceId'];
		$billTotal = $_POST['billTotal'];
		$billTotalQty = $_POST['billTotalQty'];
		$billFinalTotal = $_POST['billFinalTotal'];
		$billingInfos2 = serialize($billingInfos);
		$customername = $_POST['customername'];
		$mobile = $_POST['mobile'];
		$openingBalance = $_POST['openingBalance'];
		// $openBal = $billFinalTotal + $openingBalance;
		// Check if qty existed
		//$qtyvalidation = qtyUpdation($billingInfos);
		$sql = "UPDATE invoices SET customer='$customername', mobile='$mobile', info='$billingInfos2', finaltotal='$billFinalTotal', total='$billTotal', qty='$billTotalQty', status='1', openingBalance='$openingBalance' WHERE id='$oldInvoiceId'";
		mysqli_query($db, $sql);
		setcookie("modifyInvoice", "",  time() - 3600);
		// reduceQuantity
		echo increaseOpenBalance($billFinalTotal, $db);
			
		exit();
	}
	// udpatge invoice ends
	// cancel invoice starts
	if( isset($_POST['cancelInvoiceId']) ){
		$cancelInvoiceId = $_POST['cancelInvoiceId'];
		
		$sql = "UPDATE invoices SET status='2' WHERE id='$cancelInvoiceId'";
		$insert = mysqli_query($db, $sql);
		
		setcookie("modifyInvoice", "",  time() - 3600);
		echo true;			
				
		exit();
	}
	// cancel invoice ends


	// partial payment clearance
	if( isset($_POST['clearance_refId']) ){
		$clearance_refId = $_POST['clearance_refId'];
		$clearance_transaction = $_POST['clearance_transaction'];
		$clearance_actualAmount = $_POST['clearance_actualAmount'];
		$clearance_pendingAmount = $_POST['clearance_pendingAmount'];
		$clearance_payingAmount = $_POST['clearance_payingAmount'];		
		$clearance_pendingStatus = $_POST['clearance_pendingStatus'];		
		$login = $_SESSION['login'];
		$sql = "INSERT INTO invoices (refId, finaltotal, partialPayment, transaction, status, login, date) VALUES('$clearance_refId', '$clearance_pendingAmount', '$clearance_payingAmount', '$clearance_transaction', '1', '$login', '".date('Y-m-d')."')";
		$insert = mysqli_query($db, $sql);	
		if( $clearance_pendingStatus == 1 ){
			mysqli_query($db, "UPDATE invoices SET clearanceStatus='1' WHERE id='$clearance_refId'");
		}	
		echo true;							
		exit();
	}
	// creating new stock starts
	
	if( isset($_POST['newstock_productname']) ){
		
		$newstock_productname = $_POST['newstock_productname'];
		$newstock_quantity = $_POST['newstock_quantity'];
		$newstock_price = $_POST['newstock_price'];

		
		

			$purchase_status = true;
			$check = alreadyexisted($newstock_productname, $db);
						
			if( $check ){
				// insert into stock other wise go to else and update the stock qty only
				$sql2 = "INSERT INTO stock (name, qty, actualprice, date, status) VALUES('$newstock_productname', '$newstock_quantity', '$newstock_price', ".date('Y-m-d').", '1')";
				$insert2 = mysqli_query($db, $sql2);
				if( $insert2 ){
					$stock_status = true;
				}else{
					$stock_status = true;
				}
			}else{
				$stock_status = false;
			}
		
		$array = array("stock"=>$stock_status);
		echo json_encode($array);
		exit();
	}
	// creating new stock ends
	
	// update old stock starts
	if( isset($_POST['updatestock_productid']) ){
		$updatestock_productid = $_POST['updatestock_productid'];
		$updatestock_productname = $_POST['updatestock_stock'];
		$updatestock_quantity = $_POST['updatestock_qty'];
		$updatestock_price = $_POST['updatestock_price'];		
		$sql = "UPDATE stock SET name='$updatestock_productname', qty='$updatestock_quantity', actualprice='$updatestock_price' WHERE id='$updatestock_productid'";
		$qry = mysqli_query($db, $sql);
		if( $qry ){
			$array = array("stock"=>true);
		}else{
			$array = array("stock"=>false);
		}
		
		echo json_encode($array);
		
		exit();
	}
	// update old stock ends
	
	// Inactivate stock starts
	if( isset($_POST['listitem_inactivateid']) ){
		$listitem_inactivateid = $_POST['listitem_inactivateid'];
		$listitemstate_inactivateid = $_POST['listitemstate_inactivateid'];
		$sql = "UPDATE stock SET status='$listitemstate_inactivateid' WHERE id='$listitem_inactivateid'";
		$update =mysqli_query($db, $sql);		
		echo true;		
		exit();
	}
	// Inactivate stock ends
	// Activate stock starts
	if( isset($_POST['listitem_activateid']) ){
		$listitem_activateid = $_POST['listitem_activateid'];
		$listitemstate_activateid = $_POST['listitemstate_activateid'];
		$sql = "UPDATE stock SET status='$listitemstate_activateid' WHERE id='$listitem_activateid'";
		$update = mysqli_query($db, $sql);
		echo true;		
		exit();
	}
	// Activate stock ends

	// Update Opening Balance starts
	if( isset($_POST['updateBalance']) ){
		$updateBalance = $_POST['updateBalance'];
		$sql = "UPDATE openingbalance SET balance='$updateBalance' WHERE id='1'";
		$update = mysqli_query($db, $sql);
		echo true;		
		exit();
	}
	if( isset($_POST['getBalance']) ){
		$sql = "SELECT balance FROM openingbalance WHERE id='1'";
		$update = mysqli_query($db, $sql);
		$res = mysqli_fetch_array($update);
		echo $res['balance'];		
		exit();
	}
	// Activate stock ends
	
	// update old stock 2 starts
	if( isset($_POST['updateexistedstock_id']) ){
		$updatestock_category = $_POST['updatestock_category'];
		$updatestock_stock = $_POST['updatestock_stock'];
		$updatestock_qty = $_POST['updatestock_qty'];
		$updatestock_price = $_POST['updatestock_price'];
		$updateexistedstock_id = $_POST['updateexistedstock_id'];
		$updatestock_gsttype = $_POST['updatestock_gsttype'];
		$updatestock_gst = $_POST['updatestock_gst'];
		$updatestock_gsstprice = $_POST['updatestock_gsstprice'];
		$updatestock_barcode = $_POST['updatestock_barcode'];
		
		
		
		$sql = "UPDATE stock SET barcode='$updatestock_barcode', gsttype='$updatestock_gsttype', gst='$updatestock_gst', gstprice='$updatestock_gsstprice', category='$updatestock_category', name='$updatestock_stock', qty='$updatestock_qty', mrpprice='$updatestock_price', actualprice='$updatestock_price' WHERE id='$updateexistedstock_id'";
		mysqli_query($db, $sql); 
		echo true;
	
		exit();
	}
	// update old stock 2 ends
?>



<?php
	
	if( isset($_POST['invoicebillid']) ){
		$invoicebillid = $_POST['invoicebillid'];
		$sql = "SELECT * FROM purchases WHERE id='$invoicebillid'";
		$existance_check = mysqli_query($db, $sql);
		$data = "";
		$sno  = 1;
		while( $res = mysqli_fetch_array($existance_check) ){
			$category = show_category_name($res['category'], $db);
			$name = $res['name'];
			$qty = $res['qty'];
			$mrp = $res['mrpprice'];
			$actualprice = $res['actualprice'];
			$id = $res['id'];
			$individualnetprice = $res['individualnetprice'];
			
			
			
		
			$data = $data."<table class='table table-condensed table-striped'>
					<tr><td>Category</td><td>$category</td></tr>
					<tr><td>Name</td><td>$name</td></tr>
					<tr><td>Qty</td><td>$qty</td></tr>			
					<tr><td>Individual Net</td><td>$individualnetprice</td></tr>
					<tr><td>Total Net</td><td>$actualprice</td></tr>
					<tr><td>Bill</td><td>$mrp</td></tr>
				</tr></table>";
			//$sno++;
		}							
		echo $data;
		exit();							
									
	}

?>
