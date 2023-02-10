<?php	
	define('Title', 'Dealer Software');
	// class myDb extends SQLite3{
	// 	function __construct(){
	// 		$this->open('database.db');
	// 	}
	// }
	// $db = new myDb();

	// $db = mysqli_connect("localhost", "root", "", "dbilling");
	$db = mysqli_connect("localhost", "dbilling2", "3~M=mr8Hm-KF", "dbilling2");
	
	function show_category_name($id, $db){
		$sql = "SELECT * FROM categories WHERE id='".$id."'";
		$get = mysqli_query($db, $sql);
		$res = mysqli_fetch_array($get);
		return $res['name'];
		
	}
	
	function show_product_name($id, $db){
		$sql = "SELECT * FROM stock WHERE id='".$id."'";
		$get = mysqli_query($db, $sql);
		$res = mysqli_fetch_array($get);
		return $res['name'];		
	}
	
	function show_categories_dropdown($db){
		$sql = "SELECT * FROM categories";
		$get = mysqli_query($db, $sql);
		
		$list = "";
		while( $res = mysqli_fetch_array($get) ){
			$list = $list."<option value='".$res['id']."'>".$res['name']."</option>";
		}
		
		return $list;
		
	}
	
	
	
	function invoiceHeader($db){
		$sql = "SELECT * FROM invoicehead";
		$get = mysqli_query($db, $sql);
		$res = mysqli_fetch_array($get);
		$one = unserialize($res['invoicehead']);
		$two = unserialize($res['invoicefoot']);
		$array = array(0=>$one, 1=>$two);
		return $array;
	}
	
	function productExistedQty($pid, $db){
		$sql = "SELECT qty FROM stock WHERE id='$pid'";
		$get = mysqli_query($db, $sql);
		$res = mysqli_fetch_array($get);
		$qty = $res['qty'];		
		$array = array(0=>$qty);
		return $array;
	}
	
	// function reduceQuantity($array, $db, $oldInvoiceId){
	// 	foreach($array as $arr){
	// 		if( is_array($arr) ){				
	// 			$product = $arr[3];
	// 			$qty = $arr[4];
	// 			$sql = "UPDATE stock SET qty=qty-$qty WHERE id='$product'";
	// 			mysqli_query($db, $sql);
	// 			$sql1 = "INSERT INTO trackers (invoice, product, qty, date) VALUES('$oldInvoiceId', '$product', '$qty', '".date('Y-m-d')."')";
	// 			mysqli_query($db, $sql1);
	// 		}
	// 	}
	
		
	// }
	
?>