<?php
	// check if the product already existed so far while inserting new product
	function typeOfInvoice($db, $transaction){
		$transactionType = $transaction['transaction'];
		$returnStatus = $transaction['returnStatus'];
		if( $transactionType == "In" ){
			return array("status"=>false);
		}else{
			if( $returnStatus > 0 ){
				return array("status"=>true, "msg"=>"RETURN");
			}else{
				return array("status"=>true, "msg"=>"PURCHASE");
			}
		}
	}

?>
