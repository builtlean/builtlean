<?php 

//$item_id=$_POST['item_id'];
$product_id=$_POST['product_id'];

// Database variables
/*	$host = "localhost"; //database location
	$user = 'beans_amitbean'; //database username
	$pass ='amit1234'; //database password
	$db_name = "beans_stalkads"; //database name
*/	 
	// PayPal settings
	//$paypal_email ='seller_1293604491_biz@gmail.com';
	$paypal_email ='support@builtlean.com';
	$return_url = 'http://www.builtlean.com/payment-successful.php';
//	$cancel_url = 'http://beanstalkads.com/payment-cancelled.php?item_id='.$item_id.'';
//	$notify_url = 'http://beanstalkads.com/ipnpost.php';
	//$notify_url = 'http://beanstalkads.com/responsepaypal.php';
//die;
	$item_name = $_POST['item_name'];
   
	$item_amount = $_POST['price'];
	 
	// Include Functions
	//include("functions.php");
	 
	//Database Connection
/*	$link = mysql_connect($host, $user, $pass);
	mysql_select_db($db_name);
	*/

	// Check if paypal request or response
	if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	 
	    // Firstly Append paypal account to querystring
	    $querystring .= "?business=".urlencode($paypal_email)."&";
	 
	    // Append amount& currency (£) to quersytring so it cannot be edited in html
	 
	    //The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
      $querystring .= "item_name=".urlencode($item_name)."&";
	    $querystring .= "amount=".urlencode($item_amount)."&";
	 
       //loop for posted values and append to querystring
	    foreach($_POST as $key => $value){
	        $value = urlencode(stripslashes($value));
	        $querystring .= "$key=$value&";
	    }
	 
	    // Append paypal return addresses
	    $querystring .= "return=".urlencode(stripslashes($return_url))."&";
	    $querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	    $querystring .= "notify_url=".urlencode($notify_url);
	 
	    // Append querystring with custom field
	    //$querystring .= "&custom=".USERID;
 
	    // Redirect to paypal IPN
		//print_R($querystring);
		 //header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	    header('location:https://www.paypal.com/cgi-bin/webscr'.$querystring);
	    exit();
	 
	}else{
	    // Response from PayPal
	}
?>