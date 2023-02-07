<?php	
	
	$query = "SELECT id, name FROM categories WHERE status='1' ORDER BY name";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC)){
		$name = htmlentities(stripslashes($row['name']));			
		$id = htmlentities(stripslashes($row['id']));					
		 $output_array[] = array( 
				'id1' => $id
				, 'label1' => $name
			);
	}
	echo json_encode($output_array);

?>