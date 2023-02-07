<?php	
	
	$query = "SELECT id, name, actualprice, qty FROM stock WHERE status='1' ORDER BY name";
	$result = mysqli_query($db, $query);
	while ($row = mysqli_fetch_array($result)){
		$name = htmlentities(stripslashes($row['name']));			
		$id = htmlentities(stripslashes($row['id']));					
		$individualnetprice = htmlentities(stripslashes($row['actualprice']));	
		$qty = htmlentities(stripslashes($row['qty']));	

		 $output_array1[] = array( 
				'id' => $id
				, 'label' => $name
				, 'price' => $individualnetprice				
				, 'qty' => $qty				
			);
	}
	echo json_encode($output_array1);

?>