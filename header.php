<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo ('template_url');?>/style.css" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo ('template_url');?>/ie7.css" />
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="BuiltLean.com RSS Feed" href="http://www.builtlean.com/feed/" />
<link rel="alternate" type="application/atom+xml" title="BuiltLean.com Atom Feed" href="http://www.builtlean.com/feed/atom/" />
<link rel="pingback" href="http://www.builtlean.com/xmlrpc.php" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/custom.css" />
<?php if(is_page('12970')) { ?>
<link href="<?php bloginfo('template_directory'); ?>/styles/style.css" rel="stylesheet" type="text/css" />
<?php } ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript">
		jQuery(document).ready(function(){
			
				jQuery('.sub-menu1 ul').removeClass('sub-menu1').addClass('sub-menu2');
			
            jQuery('#menu-blog li').hover(function() {
				jQuery(this).addClass('menu_item_hovered2');
				jQuery(this).children('ul').slideDown(100);
			}, function() {
				jQuery(this).removeClass('menu_item_hovered2');
				jQuery(this).children('ul').slideUp(200);
			});
			
			
            jQuery('#menu-blog-2 li').hover(function() {
				jQuery(this).addClass('menu_item_hovered2');
				jQuery(this).children('ul').slideDown(100);
			}, function() {
				jQuery(this).removeClass('menu_item_hovered2');
				jQuery(this).children('ul').slideUp(200);
			});
			
			
            jQuery('#menu-hover li').hover(function() {
				var selected = jQuery(this).children("a").text();
				/*alert(selected);*/
				if (selected == 'Blog'){
					jQuery(this).addClass('menu_item_hovered3');
					}
				else {
					jQuery(this).addClass('menu_item_hovered4');
					}
				jQuery(this).children('#menu-hover li > ul.sub-menu1').slideDown(100);
			}, function() {
				jQuery(this).removeClass('menu_item_hovered4');
				jQuery(this).removeClass('menu_item_hovered3');
				jQuery(this).children('#menu-hover li > ul.sub-menu1').slideUp(200);
			});
			
		});

		
</script>

<?php wp_head();?> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-scrolltofixed-min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#stickyadd').scrollToFixed({ marginTop: 0 });
});
</script>
<?php
if(is_single() || is_category()){
	$category = get_the_category($post->ID); 
	$checkCat = $category[0]->cat_name;
	
	if(in_category($category[0]->cat_name) && $checkCat != 'Uncategorized'){
	?>
	<style type="text/css">
		#primary-nav li#menu-item-12473 a{
			color: #E9E9E9;
			text-decoration: none;
			background: #272727;
			font-weight: bold;
		}
		.menu_item_hovered_blog{
			display: block;
			color: #fff !important;
			text-decoration:none;
			padding:4px 13px;
			background: #272727;
			font-weight: bold;
		}
		#breadcrumbs a:last-child {
		background: none;
		padding-left: 3px;
		}
	</style>
	<script type="text/javascript">
		jQuery(document).ready( function(){
			jQuery('#outbrain_container_0_stripBox .strip-like').html('FEATURED ARTICLES + RELATED POSTS');
			//alert('aaa');
		});
	</script>
	<?php
}
}

?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js" ></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/stickysidebar.jquery.js" ></script>
<?php if(is_page('test')) { ?>
<script type="text/javascript">
   $(function () {
   sidebar = true;
      if(sidebar) {
        $("#stickyadd").stickySidebar({
            timer: 400
          , easing: "easeInOutQuad"
          , constrain: true
        });
     	}
   });
 </script>

<?php } ?>

<?php if(is_page('test-2')) { ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/stickysidebar2.jquery.js" ></script>
<script type="text/javascript">
	$(document).ready(function () {  
	  //var top = $('.scroll-element').offset().top - parseFloat($('.scroll-element').css('marginTop').replace(/auto/, 0));
	 // var top = $('.scroll-element').offset().top;
		var top = 1400;
		var footer = parseInt($('#footer').offset().top) - 280;	  
	  
	  $(window).scroll(function (event) {
	    // what the y position of the scroll is
	    var y = $(this).scrollTop();
	  
		//$('.scroll-element').append(parseInt($('#footer').offset().top));	  
	  	
	  
	    // whether that's below the form
	    if (y >= top) {
	    	
	      $('.scroll-element').addClass('fixed');
			
			if(y >= footer){
				$('.scroll-element').css({
						'position' : 'absolute',
						'top' : $('#footer').offset().top - 460		
					});
			}else{
				$('.scroll-element').css({
						'position' : '',
						'top' : ''					
					});
			}
	      
		} else {
			
		  $('.scroll-element').removeClass('fixed');
		}
	  });
	});

 </script>

<?php } ?>



<?php if(is_page('12970') == 1) { ?>
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
});
</script>
<?php 
	
} include("infapi.php"); 
//echo "<pre>";
//print_r($_REQUEST);
//die('suchi');
if(isset($_REQUEST['orderId']) && isset($_REQUEST['contactId']) && (is_page('7607'))) { 
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
<link rel="icon" href="favicon.icooo" type="image/x-icon" />


<!-- Google DFP -->
<script type='text/javascript'>
	var googletag = googletag || {};
		googletag.cmd = googletag.cmd || [];
		(function() {
		var gads = document.createElement('script');
		gads.async = true;
		gads.type = 'text/javascript';
		var useSSL = 'https:' == document.location.protocol;
		gads.src = (useSSL ? 'https:' : 'http:') + 
		'//www.googletagservices.com/tag/js/gpt.js';
		var node = document.getElementsByTagName('script')[0];
		node.parentNode.insertBefore(gads, node);
	})();
</script>

<script type='text/javascript'>
	googletag.cmd.push(function() {
		googletag.defineSlot('/29676084/BuiltLean-Half-Page', [300, 600], 'div-gpt-ad-1363655684868-0').addService(googletag.pubads());
		googletag.pubads().enableSingleRequest();
		googletag.enableServices();
	});
</script>
<!-- END Google DFP -->


</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=439101682818247";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php if(!is_page('12970')) { ?>
<div id="primary-nav">
<div style="margin:0px auto; width:969px;">
<div class="logo"><a href="http://www.builtlean.com"><img src="<?php echo get_option('smartblog_logo'); ?>" alt="BuiltLean.com" id="logo"/></a></div> 
  
<div style="height: 20px; float:right; margin-top:18px; width:280px">
<div id="cse-search-form" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'en', style : google.loader.themes.MINIMALIST});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};
    var customSearchControl = new google.search.CustomSearchControl(
      '013455458792431772096:WMX-725798303', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.setAutoComplete(true);
    options.enableSearchboxOnly("http://www.builtlean.com", "s");
    customSearchControl.draw('cse-search-form', options);
  }, true);
</script>

</div><!--end #search -->       
</div>

<div class="menu_top"> 
 
<!--<div style="display:none"><ul id="menu-main" class=""><li id="menu-item-5348" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-5348"><a href="http://www.builtlean.com/">Home</a></li>
<li id="menu-item-5349" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5349"><a href="http://www.builtlean.com/about/">About</a></li>
<li id="menu-item-5351" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5351"><a href="http://www.builtlean.com/workout-plan/">The Program</a></li>
<li id="menu-item-5352" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5352"><a href="http://www.builtlean.com/how-to-get-a-lean-body/">Free E-Book</a></li>
<li id="menu-item-5353" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5353"><a href="http://www.builtlean.com/success-stories/">Success Stories</a></li>
<li id="menu-item-5354" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5354"><a href="http://www.builtlean.com/press/">Press</a></li>
</ul>
</div>-->


                
<?php 

class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu1\">\n";
  }
}

//if(is_page(12513)){
wp_nav_menu( array(
						'theme_location' => 'primary-nav',
						'container' =>false,
						'echo' => true,
						'depth' => 0,
						//'fallback_cb'=>'headermenu',
						'menu_id' => 'menu-hover',
						'walker' => new My_Walker_Nav_Menu()));
				

/*} else {
wp_nav_menu( array(
						'theme_location' => 'primary-nav',
						'container' =>false,
						'echo' => true,
						'depth' => 0,
						//'fallback_cb'=>'headermenu',
						'menu_id' => 'menu-main' ));
}*/


if(is_single() || is_category() || is_page('blog')){
?>
<style type="text/css">
	#menu-hover .sub-menu1{
		display: none !important;	
	}
</style>
<?php
}
//global $post;
//echo $post->ID;
?>


<div id="socialbuttons">
	<div class="fb-like fb-from-header" data-href="https://www.facebook.com/builtlean" data-send="false" data-layout="button_count" data-width="150" data-show-faces="true"></div>
	<a href="http://www.facebook.com/builtlean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/facebook.png" width="32" height="32"></a>
	<a href="http://www.twitter.com/builtlean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/twitter.png" width="32" height="32"></a>
	<a href="http://www.youtube.com/builtleantv" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/youtube.png" width="32" height="32"></a>
	<a href="http://feeds.feedburner.com/BuiltLean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/rss.png" width="32" height="32"></a>
</div>
        
</div><!--end .nav-->
<div class="clear"></div>
</div><!--#primary-nav-->
<div class="wrap">

<?php } else { ?>
<div id="wrapper">
        <!--start header-->
        <div id="header">
            <img src="http://www.builtlean.com/wp-content/themes/builtlean/images/logo_order.png" alt="" />
        </div><!--end header-->

<?php } ?>

