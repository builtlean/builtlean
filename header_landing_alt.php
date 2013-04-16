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
<?php wp_head(); 
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

<div id="primary-nav" style="height:45px; padding: 20px 0 0 0">
<div style="margin:0 auto; width:730px;">
 <div><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/logo_landingpage.jpg" width="192" height="26" alt="BuiltLean.com"/></div> 
          
           
</div>

</div><!--#primary-nav-->
<div class="wrap_alt">
