<?php 

	$product_id=$_POST['product_id'];
		$paypal_email ='support@builtlean.com';
		$return_url = 'http://www.builtlean.com/payment-successful.php';
		$item_name = $_POST['item_name'];   
		$item_amount = $_POST['price'];
		if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
		$querystring .= "?business=".urlencode($paypal_email)."&";
		$querystring .= "item_name=".urlencode($item_name)."&";
		$querystring .= "amount=".urlencode($item_amount)."&";
		foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	    $querystring .= "return=".urlencode(stripslashes($return_url))."&";
	    $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	    $querystring .= "notify_url=".urlencode($notify_url);
	    header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
	    exit();
	 
	}else{

	}
?>
