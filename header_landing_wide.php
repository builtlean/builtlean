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
<?php if(is_page('12623') == 1) { 
	$temp_uri=get_template_directory_uri();
	$temp_uri=str_replace('cdn','www',$temp_uri);
	?>
 <link href="http://www.builtlean.com/wp-content/themes/builtlean/styles/style.css" rel="stylesheet" type="text/css" />
<!--<link href="http://www.builtlean.com/wp-content/themes/builtlean/styles/style.css" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/priceformat.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/numOnly.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/custom.js"></script>

<?php } ?> 
		<?php
			$alias = get_post_meta($post->ID, 'alias', true);
			include("infapi.php");
			if((isset($_REQUEST['orderId']) || isset($_REQUEST['contactId'])) && (($alias == 'thank-you-purchase') || ($alias=='thank-you-purchase-paypal'))) {
		?>

		<script type="text/javascript">
				var _gaq = _gaq || [];
					_gaq.push(['_setAccount', 'UA-4567298-5']);
					_gaq.push(['_setDomainName', 'builtlean.com']);
					_gaq.push(['_setAllowLinker', true]);
					_gaq.push(['_trackPageview']);
					_gaq.push(['_addTrans',
						'<?php echo $OrderId;?>','builtlean.com',					
						'<?php echo $TotalPaid;?>',        
						'<?php echo $Taxable;?>',				
						'<?php echo $Shippable;?>',           
						'<?php echo $BillCity;?>',					
						'<?php echo $BillState;?>',					
						'<?php echo $BillCountry;?>'						
					]);
					_gaq.push(['_addItem',
						'<?php echo $OrderId;?>',				
						'<?php echo $Sku;?>',					
						'<?php echo $ProductName;?>',         
						'<?php echo $Category;?>',					
						'<?php echo $ProductPrice;?>',       
						'<?php echo $Qty;?>'			
					]);
					_gaq.push(['_trackTrans']);          
					

			(function() { 
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					})();
		</script>

	<?php } else { ?>
		<script type="text/javascript">
				var _gaq = _gaq || [];
					_gaq.push(['_setAccount', 'UA-4567298-5']);
					_gaq.push(['_setDomainName', 'builtlean.com']);
					_gaq.push(['_setAllowLinker', true]);
					_gaq.push(['_trackPageview']);
			(function() { 
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					})();

		</script>
	<?php } ?>
	
</head>
<body <?php body_class(); ?>>
	  <?php if(!is_page('12623')) { ?>
<div id="primary-nav" style="height:45px; padding: 20px 0 0 0">
<div style="margin:0 auto; width:969px;">
<div><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/logo_landingpage.jpg" width="192" height="26" alt="BuiltLean.com"/></div>           
</div>
</div>
<div class="wrap">
		<?php } else { ?>
<div id="wrapper">
        <div id="header">
            <img src="http://www.builtlean.com/wp-content/themes/builtlean/images/logo_order.png" alt="" />
        </div>

<?php } ?>
