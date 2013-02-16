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
echo "<pre>";

print_r($_REQUEST);
die;
/*
echo "<br>";

$qry=array('InvoiceId'=>'3475');
$ret=array('Id','InvoiceId','AmtDue','Type','FirstPayAmt');
$result3=$app->dsQuerywithOrderBy('PayPlan',5,0,$qry,$ret,'Id',false);
$qry1=array('ProductId'=>5);
$ret1=array('Id','ProductId','DiscountPercent','Qty','ObjectId','ObjType');
$result4=$app->dsQuerywithOrderBy('ProductInterest',5,0,$qry1,$ret1,'Id',false);
//print_r($result4);
//print_r($result3);
//$contactId=118729;
//$creditCardId =2459;
//$result2 = $app->addOrderItem(intval(3459), 0, 12, floatval(-1.00), intval(1), "special Email Offers", "");

//$qry=array('OrderId'=>'3461');
//$ret=array('OrderId','ProductId','SubscriptionPlanId','ItemType','ItemName','Qty');
//$result3=$app->dsQuery('OrderItem',5,0,$qry,$ret);
//$carray = array($contactId,$creditCardId,3919,(array(5)),'',(true),(array('getlean')));
//$re=$app->placeOrder(intval($contactId),intval($creditCardId),'',array(5),array(),true,(array('getlean')));
//print_r($re);
//$re12=$app->getProductTotalDiscount(5);
//print_r($re12);

//die;
*/
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
$price=$_REQUEST['Price'];
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
//$conID = 119025;


//valdiate credit card
$card = array('CardType' => $cardtype,
              'ContactId' => $conID,
              'CardNumber' => $cardnumber,
              'ExpirationMonth' =>$startdatemonth,
              'ExpirationYear' => $startdateyear
			  //,'CVV2' => '123'
			  );
  $result = $app->validateCard($card);
//print_R($result);
//die;
if($result['Valid'] == true)
{
	$conDat1 = array('ContactId'=>$conID,
		'BillName'=>$first_name.''.$last_name,
		'BillAddress1'=>$address1,
		'BillAddress2'=>$address2,
		'BillCity'=>$city,
		'BillState'=>$state,
		'BillZip'=>$postalcode,
		'BillCountry'=>$country,
		'FirstName' => $first_name,
        'LastName'  =>$last_name,
        'Email'     => $email,
		'CardType'=>$cardtype,
		'CardNumber'=>$cardnumber,
		'ExpirationMonth'=>$startdatemonth,
		'ExpirationYear'=>$startdateyear);

$creditID = $app->dsAdd("CreditCard", $conDat1);
//$creditID ='2475';

}
else { header('location:http://www.builtlean.com/thank-you-purchase/'); // should be error page 
exit; }

//promocodes for the product
$promocodes = $app->dsGetSetting('Product','optionpromocode');
//print_R($promocodes);
$promo=explode(',',$promocodes);
if(!in_array($special_code,$promo))
{
	$special_code='';
}

$prd_id=array();
for($i=0;$i<$qty;$i++)
{
	$prd_id[]=$product['Id'];
}

//add blank order
$oDate = $app->infuDate(date('d-M-Y'));
#$invoiceId = $app->blankOrder($conID,"Product", $oDate, 0, 0);
$re=$app->placeOrder(intval($conID),intval($creditID),'',$prd_id,array(),true,(array($special_code)));
//contactid,creditcardid,payplanid,array(productid1,productid2),array(subscriptionid1,subscriptionid2),processspecial-whether or not order should consider discounts,array(promocode1,promocode2)
//return orderid, invoiceid, code,refnum,success
$invoiceId=$re['InvoiceId'];
$orderId==$re['OrderId'];
//$invoiceId=3511;
/*
$qry=array('OrderId'=>3513);
$ret=array('Id','OrderId','ItemType','ProductId');
$result=$app->dsQuery('OrderItem',10,0,$qry,$ret);
//print_r($result);
foreach($result as $re)
{
	if($re['ItemType'] == 4 && $re['ProductId'] == $productid)
	{
		$orderitemid=$re['Id'];
	}
}
//echo $orderitemid;
$grp = array('Qty'  => $qty);
//$grpID = 97;
$grpID = $app->dsUpdate("OrderItem", $orderitemid, $grp);

*/
//add order item
//$result2 = $app->addOrderItem(intval($invoiceId), intval($productid), 4, floatval($price), intval($qty), $product['ProductName'], $product['ShortDescription']);
// invoice id, product id, type,price,qty,description
//echo $result2;

//charge invoice
$result1 = $app->chargeInvoice($invoiceId,"API Upsell Payment",$creditID,$merchantid,false);
//invooiceid,notes,creditcardid, merchantid,bypasscommissions
//print_r($result1);
//print_r($re);
//die('suchi');
$some_url = "http://www.builtlean.com/thank-you-purchase/?orderId=".$re['OrderId']."&contactId=".$conID;
//$params = array( 'orderId'=>$orderId,'contactId'=>$conID );
//$some_url = add_query_arg( $params, $some_url );
//echo $some_url;
header("location:$some_url");
?>