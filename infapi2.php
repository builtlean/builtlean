<?php # API Connection functionality start here.
require_once("src/isdk.php");
require_once("src/INFfunctions.php");

$app = new iSDK;

if($app->cfgCon("amitind")){
	
//echo "app connected!<br/>"; 
}	

else {

echo "connection failed!<br/>";
	
}
# API Connection functionality end here.

$first_name=$_REQUEST['FirstName'];
$last_name=$_REQUEST['LastName'];
$company=$_REQUEST['Company'];
$address1=$_REQUEST['Address1'];
$address2=    $_REQUEST['Address2'];
$city=    $_REQUEST['City'];
$state=    $_REQUEST['State'];
$postalcode=    $_REQUEST['PostalCode'];
$country=    $_REQUEST['Country'];
$phone=    $_REQUEST['Phone'];
$email=    $_REQUEST['EmailAddress'];
$cardtype=    $_REQUEST['CardType'];
$startdatemonth=    $_REQUEST['StartDateMonth'];
$startdateyear=    $_REQUEST['StartDateYear'];
$cardnumber=    $_REQUEST['CardNumber'];
$productid=    $_REQUEST['ProductId'];
 $qty=   $_REQUEST['Qty'];
 $special_code=   $_REQUEST['SpecialCode'];
$price=$_REQUEST['Price1'];
$merchantid='3';


$ret=array('Id','ProductName','ProductPrice','ShortDescription');
$products = $app->dsFind('Product',1,0,'Id',$productid,$ret);
$product=$products[0];


$conDat = array('FirstName' => $first_name,
                'LastName'  => $last_name,
				'Company'=>$company,
				'StreetAddress1'=>$address1,
				'StreetAddress2'=>$address2,
				'City'=>$city,
				'State'=>$state,
				'Country'=>$country,
				'PostalCode'=>$postalcode,
				'Phone1'=>$phone,
                'Email'     => $email);

$conID = $app->addCon($conDat);

?>

<form name="frm" method="post" action="paypal_payment.php">
<input name="cmd" type="hidden" value="_xclick" />
        <input name="no_note" type="hidden" value="1" />
        <input name="lc" type="hidden" value="US" />
        <input name="currency_code" type="hidden" value="USD" />
        <input name="bn" type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input name="first_name" type="hidden" value="<?php echo $first_name?>" />
        <input name="item_name" type="hidden" value="<?php echo $product['ProductName'];?>" />
        <INPUT TYPE="hidden" NAME="price" value="<?php echo number_format($price,2);?>">
     	<input type="hidden" name="rm" value="2">
       <input type="hidden" name="custom" value='<?php echo $conID.'|'.$product['Id'].'|'.$special_code.'|'.$merchantid.'|'.$qty;?>'/>
	     <!-- <input type="hidden" name="product_id" value='<?php echo $product['Id'];?>'/> -->
        <input name="item_number" type="hidden" value="1" />
		<!-- <INPUT type="button" class="input_btn" value=" Back " onClick="history.back();"> -->
</form>		
<script language="JavaScript">
document.frm.submit();
</script>

<?php
die;

?>