<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Fitness Tips to Get Lean, Toned, &amp; Lose Fat | BuiltLean.com</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="http://www.builtlean.com/wp-content/themes/builtlean/style.css" />
<link rel="alternate" type="application/rss+xml" title="BuiltLean.com RSS Feed" href="http://www.builtlean.com/feed/" />
<link rel="alternate" type="application/atom+xml" title="BuiltLean.com Atom Feed" href="http://www.builtlean.com/feed/atom/" />
<link rel="pingback" href="http://www.builtlean.com/xmlrpc.php" />
<?php wp_head(); ?>
<?php if(is_page('12970') == 1) { 
	$temp_uri=get_template_directory_uri();
	$temp_uri=str_replace('cdn','www',$temp_uri);
	?>
 <link href="http://www.builtlean.com/wp-content/themes/builtlean/styles/style.css" rel="stylesheet" type="text/css" />
<!--<link href="http://www.builtlean.com/wp-content/themes/builtlean/styles/style.css" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/priceformat.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/numOnly.js"></script>
<script>
$(document).ready(function(){
		var qty=$('#qty').val();
		var price=$('#price').text();
		var cost=price.substring(1, price.length);
		var total2=qty*cost;
		var total='$'+total2;
		$("#sub_total_1").text(total).formatCurrency(); 
		$("#price1").text(total).formatCurrency();  
		$('#total_due').text(total).formatCurrency();
		$('#sub_total').text(total).formatCurrency();
		$('#price2').attr('value',total2);


	$('#qty_update').click(function(){
		var qty=$('#qty').val();
		var price=$('#price').text();
		var cost=price.substring(1, price.length);
		//alert(qty);
		//alert(cost);
		
		var total1=qty*cost;
		//var total='$'+total;
		//alert(total);

		if( $('#product_tr1').is(':hidden') ) {
			//alert('23');
			var total=total1;
		}
		else
		{
			//var code_amt=$('#code_amt').text();
			//var code_amt=(code_amt.substring(2, code_amt.length));
			var code_cost_each=$('#code_cost_each').val();
			//alert(code_cost_each);
			//alert(qty);
			var cod_amt=code_cost_each*qty;
			var total=total1-cod_amt;
			$("#code_amt").text('-$'+cod_amt); 
			
		}
			 $("#price1").text(total1).formatCurrency();  
			 $("#sub_total_1").text(total).formatCurrency();  
			 $('#total_due').text(total).formatCurrency();
			 $('#sub_total').text(total).formatCurrency();
			 $('#price2').attr('value',total);
	});
	

	$('#apply').click(function(){
		var code=$('#SpecialCode').val();
		var pid=$('#pid').val();
		var ptotal=$("#price").text();
		var ptotal=ptotal.substring(1, ptotal.length);
		var qty=$('#qty').val();

		$.ajax({
			data:'code='+code+'&product_id='+pid+'&ptotal='+ptotal+'&qty='+qty,
			url:'<?php echo get_template_directory_uri();?>/ajax_apply.php',
			success:function(msg){
					//alert(msg);
					//$line = $('table.viewcart tbody tr:first').html();
					//$('table tbody').append(msg);
					//$('#product_tr').after(msg);
					$('#product_tr1').html(msg);
					$('#product_tr1').show();
					

			}
		}).done(function() { 
			
			//var code_amt=$('#code_amt').text();
			//var code_amt=code_amt.substring(2, code_amt.length);
			var code_cost_each=$('#code_cost_each').val();
			var code_amt=code_cost_each*qty;

			var prd_price= $("#price1").text();
			var prd_price=prd_price.substring(1, prd_price.length);
			if(isNaN(code_amt)) { code_amt='0';}
			//alert(code_amt); alert(prd_price);
			var net=prd_price-code_amt;
				$("#sub_total_1").text(net).formatCurrency();  
				$('#total_due').text(net).formatCurrency();
				$('#sub_total').text(net).formatCurrency();
				$('#price2').attr('value',net);

			});
		
	});
	
	if( $('#credit_card').is(':checked') ) {
		$('#CardType').addClass('required');
		$('#CardNumber').addClass('required');
		$('#StartDateMonth').addClass('required');
		$('#StartDateYear').addClass('required');
		$('#cc_detail').show();
	} else
	{
		$('#CardType').removeClass('required');
		$('#CardNumber').removeClass('required');
		$('#StartDateMonth').removeClass('required');
		$('#StartDateYear').removeClass('required');
		$('#cc_detail').hide();
	}

	$('#credit_card').click(function(){
		$('#CardType').addClass('required');
		$('#CardNumber').addClass('required');
		$('#StartDateMonth').addClass('required');
		$('#StartDateYear').addClass('required');
		$("form").attr("action", "<?php bloginfo('template_directory'); ?>/infapi1.php");
		$('#cc_detail').show();

	});
	
	$('#paypal').click(function(){
		$('#CardType').removeClass('required');
		$('#CardNumber').removeClass('required');
		$('#StartDateMonth').removeClass('required');
		$('#StartDateYear').removeClass('required');
		$("form").attr("action", "<?php bloginfo('template_directory'); ?>/infapi2.php");
		$('#cc_detail').hide();
	});

	$('#shopping_cart').validate();
});
</script>
<script type="text/javascript">
jQuery(document).ready( function($) {
 
    // remove the empty p tags
    $('#shopping_cart p').each(function() {
    var $this = $(this);
   if($this.attr('class') == 'undefined')
		{
			//alert($this.attr('class'));
	//if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
       $this.remove();
		}
		if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
       $this.remove();
});
	$('#shopping_cart br').each(function() {
		  var $this = $(this);
		  $this.remove();
	});
});
</script>
<?php 
	
} 
include("infapi.php"); 
if(isset($_REQUEST['orderId']) && isset($_REQUEST['contactId']) && (is_page('7607')))
{
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4567298-5']);
  _gaq.push(['_setDomainName', 'builtlean.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  _gaq.push(['_addTrans',
    '<?php echo $OrderId;?>',             // order ID - required
    'builtlean.com',					// affiliation or store name
    '<?php echo $TotalPaid;?>',           // total - required
    '<?php echo $Taxable;?>',				// tax
     '<?php echo $Shippable;?>',           // shipping
    '<?php echo $BillCity;?>',							// city 
   '<?php echo $BillState;?>',					// state or province
    '<?php echo $BillCountry;?>'							// country
  ]);

   // add item might be called for every item in the shopping cart
   // where your ecommerce engine loops through each item in the cart and
   // prints out _addItem for each


  _gaq.push(['_addItem',
    '<?php echo $OrderId;?>',				// order ID - required
    '<?php echo $Sku;?>',					// SKU/code - required
    '<?php echo $ProductName;?>',         // product name
    '<?php echo $Category;?>',						// category or variation 
    '<?php echo $ProductPrice;?>',        // unit price - required
    '<?php echo $Qty;?>'					// quantity - required
  ]);
  _gaq.push(['_trackTrans']);           //submits transaction to the Analytics servers


  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php } ?>
</head>

<body <?php body_class(); ?>>
<?php if(!is_page('12970')) { ?>
<div id="primary-nav" style="height:65px">
<div style="margin:20px auto; width:969px;">
 <div><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/logo_landingpage.jpg" width="192" height="26" alt="BuiltLean.com"/></div> 
          
           
</div>

</div><!--#primary-nav-->
<div class="wrap">
<?php } else { ?>
<div id="wrapper">
        <!--start header-->
        <div id="header">
            <img src="http://www.builtlean.com/wp-content/themes/builtlean/images/logo_order.png" alt="" />
        </div><!--end header-->

<?php } ?>