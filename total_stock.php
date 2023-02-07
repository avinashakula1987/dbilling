<?php	
	include("database.php");
	if( isset($_POST['getstock']) ){
		$query = "SELECT id, name, qty, mrpprice, gst, gstprice FROM stock WHERE status='1' ORDER BY name";
		$result = mysql_query($query);
		while ($row = mysql_fetch_array($result,MYSQL_ASSOC)){
			$name = htmlentities(stripslashes($row['name']));			
			$id = htmlentities(stripslashes($row['id']));					
			$qty = htmlentities(stripslashes($row['qty']));					
			$price = htmlentities(stripslashes($row['mrpprice']));					
			$gst = htmlentities(stripslashes($row['gst']));					
			$gstprice = htmlentities(stripslashes($row['gstprice']));					
			 $output_array[] = array( 
					'id' => $id
					, 'label' => $name
					, 'qty' => $qty
					, 'price' => $price
					, 'gst' => $gst
					, 'gstprice' => $gstprice
				);
		}
		echo json_encode($output_array);
	}
	
	if( isset($_POST['getqty']) ){
		$getqty = mysql_real_escape_string($_POST['getqty']);
		$result = mysql_query("SELECT qty FROM stock WHERE status='1' AND id='$getqty'") or die(mysql_error());
		$count = mysql_num_rows($result);
		if( $count == 1 ){
			while ($row = mysql_fetch_array($result)){
				$qty = (int)$row['qty'];			
				if( $qty >= 1 ){
					echo $qty;
				}else{
					echo 0;
				}
			}
		}else{
			echo 0;
		}
			
	}
	

?>