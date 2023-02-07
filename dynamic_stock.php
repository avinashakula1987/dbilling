<?php	
	include("database.php");
	if( isset($_POST['getstock']) ){
		$subquery = "AND category='".mysqli_real_escape_string($db, $_POST['getstock'])."'";
		$query = "SELECT id, name, qty, mrpprice, gst, gstprice FROM stock WHERE status='1' $subquery ORDER BY name";
		$result = mysqli_query($db, $query);
		while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
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
		$getqty = mysqli_real_escape_string($db, $_POST['getqty']);
		$result = mysqli_query($db, "SELECT qty FROM stock WHERE status='1' AND id='$getqty'") or die(mysqli_error($db));
		$count = mysqli_num_rows($result);
		if( $count == 1 ){
			while ($row = mysqli_fetch_array($result)){
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