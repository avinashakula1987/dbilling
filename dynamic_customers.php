<?php	
	
	$sql = "SELECT id, name, mobile, address FROM customers ORDER BY name";
	$result = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_array($result)){
		$name = htmlentities(stripslashes($row['name']));			
		$id = htmlentities(stripslashes($row['id']));					
		$mobile = htmlentities(stripslashes($row['mobile']));					
		$address = htmlentities(stripslashes($row['address']));					
		 $output_array2[] = array( 
				'id' => $id
				, 'label' => $name
				, 'mobile' => $mobile
				, 'address' => $address
			);
	}
	echo json_encode($output_array2);

?>