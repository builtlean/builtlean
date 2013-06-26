<?php # API Connection functionality start here.
	require("src/isdk.php");
	require("src/INFfunctions.php");
		$app = new iSDK;
	 if($app->cfgCon("amitind")){
	}	
else {
	echo "connection failed!<br/>";
	
}
# API Connection functionality end here.
# Getting order details to pass into Goolge code Start here #
//dsQuery($tName,$limit,$page,$query,$rFields)

	$qry = array('OrderId'=>$_REQUEST['orderId']);
	$rets= array('Id', 'ItemName', 'Qty', 'ProductId','OrderId','ItemDescription','ItemType','CPU','PPU');
	$proinfo=$app->dsQuery("OrderItem",2,0,$qry,$rets);
	$Qty = $proinfo[0]['Qty'];
	$OrderId = $proinfo[0]['OrderId'];
	$ItemType = $proinfo[0]['ItemType'];
	$ProductId = $proinfo[0]['ProductId'];
	$ProductName = $proinfo[0]['ItemName'];
	$query = array('JobId'=>$_REQUEST['orderId']);
	$res= array('Id', 'JobId', 'InvoiceTotal', 'TotalPaid','TotalDue','ProductSold');
	$price=$app->dsQuery("Invoice",2,0,$query,$res);
	$TotalPaid = $price[0]['TotalPaid'];
	$query1 = array('Id'=>$ProductId);
	$res1= array('ProductPrice', 'Sku', 'Taxable','Shippable');
	$pro=$app->dsQuery("Product",2,0,$query1,$res1);
	$ProductPrice = $pro[0]['ProductPrice']; 
	$Taxable = $pro[0]['Taxable'];
	$Sku = $pro[0]['Sku'];
	$Shippable = $pro[0]['Shippable'];
	$Category = 'BuiltLean Products';
	$query2 = array('ContactId'=>$_REQUEST['contactId']);
	$res2= array('BillCity','BillState','BillCountry');
	$pro2=$app->dsQuery("CreditCard",2,0,$query2,$res2);
	$BillCity = $pro2[0]['BillCity'];
	$BillState = $pro2[0]['BillState'];
	$BillCountry = $pro2[0]['BillCountry'];

?>