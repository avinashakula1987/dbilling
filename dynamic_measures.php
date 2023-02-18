<?php	
	
	$sql = "SELECT id, quantity FROM quantity WHERE status='1' ORDER BY quantity";
	$result = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_array($result)){
		$name = htmlentities(stripslashes($row['quantity']));			
		$id = htmlentities(stripslashes($row['id']));				
		 $output_array2[] = array( 
				'id' => $id
				, 'label' => $name
			);
	}
	echo json_encode($output_array2);

?>