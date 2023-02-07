<?php	
	
	$sql = "SELECT id, name FROM categories WHERE status='1' ORDER BY name";
	$result = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_array($result)){
		$name = htmlentities(stripslashes($row['name']));			
		$id = htmlentities(stripslashes($row['id']));					
		 $output_array[] = array( 
				'id' => $id
				, 'label' => $name
			);
	}
	echo json_encode($output_array);

?>