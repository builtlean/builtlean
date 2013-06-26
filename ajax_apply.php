<?php 

# API Connection functionality start here.
require_once("src/isdk.php");
require_once("src/INFfunctions.php");

$app = new iSDK;

		if($app->cfgCon("amitind")){ 
	}	
		else {

	echo "connection failed!<br/>";
	}
# API Connection functionality end here.
		$disc_id_amt=array('3'=>'146.00','7'=>'25%','9'=>'50.00','11'=>'146.00','15'=>'98.00','17'=>'50%','19'=>'50.00','21'=>'58.00','22'=>'50%');
		$code_disc_id=array('deltaone'=>'3','deltafriend'=>'7','getlean'=>'9','builtleanone'=>'11','blp49'=>'15','blstudent'=>'17','netparty'=>'19','blp89'=>'21','earndit53621'=>'22');
		$special_code=$_REQUEST['code'];
		$pid=$_REQUEST['product_id'];
		$product_amt=$_REQUEST['ptotal'];
		$qty=$_REQUEST['qty'];
//promocodes for the product
		$promocodes = $app->dsGetSetting('Product','optionpromocode');
//print_R($promocodes);
		$promo=explode(',',$promocodes);
		if(!in_array($special_code,$promo)) {
		$special_code=''; }
		else
		{
		$ret=$app->getProductTotalDiscount($code_disc_id[$special_code]);
		if($pid == $ret['productId']) {
		$code_id=$code_disc_id[$special_code];
		$amt=$disc_id_amt[$code_disc_id[$special_code]];;
		$reverse = strrev( $amt );
		if($reverse{0} == '%') { 
		$amt=substr($amt, 0, -1);
		$amount=number_format(($product_amt *$amt*$qty / 100),2);
		} else {  $amount=number_format($amt*$qty,2); }
		?>	 
		<td class="productCell" colspan="2"><h1><?php echo $ret['name']; ?></h1>
              <p class="p_txt"><?php echo $ret['description']; ?></p></td>
              <td><?php if($reverse{0} == '%') { echo $amt.'%'; } else { ?> -$<?php echo number_format($amt,2);  } ?></td>
              <td align="center">1<input type="hidden" id="code_cost_each" value="<?php echo ($amount/$qty); ?>"/></td>
              <td id="code_amt">-$<?php echo $amount; ?></td>

		<?php }
	}
		?>