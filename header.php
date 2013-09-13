<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php bloginfo('name'); wp_title(' - ', true, 'left'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo ('template_url');?>/style.css" />
		<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo ('template_url');?>/styles/ie7.css" />
		<![endif]-->
		<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo ('template_url');?>/styles/ie8.css" />
		<![endif]-->
<link rel="icon" href="favicon.icooo" type="image/x-icon" />
<link rel="alternate" type="application/rss+xml" title="BuiltLean.com RSS Feed" href="http://www.builtlean.com/feed/" />
<link rel="alternate" type="application/atom+xml" title="BuiltLean.com Atom Feed" href="http://www.builtlean.com/feed/atom/" />
<link rel="pingback" href="http://www.builtlean.com/xmlrpc.php" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/custom.css" />


<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.stickem.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<?php
	$alias = get_post_meta($post->ID, 'alias', true);
?>
	<script type="text/javascript">
			$(document).ready(function(){
				<?php if(is_single()) {	?>
					////////////////////////////////////
					//Hack to fix breadcrumbs
					////////////////////////////////////
					$('#breadcrumbs').children().each(function(){
						var Item = $(this);
						var Href = Item.attr('href');
						if(Href.indexOf("traffic.outbrain.com/network/redir") >= 0) {
								Item.remove();
						}
					});
					$('#breadcrumbs').append('<a href="<?php echo $cat_link;?>"><?php echo $categories[0]->name; ?></a>');
				<?php } ?>
			});
		
		///////////////////////////////
		// google api
		//////////////////////////////
				<?php
					if((isset($_REQUEST['orderId']) || isset($_REQUEST['contactId'])) && (($alias == 'thank-you-purchase') || ($alias=='thank-you-purchase-paypal'))) {
				?>
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
							ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
						})();


				<?php } else {?>
						var _gaq = _gaq || [];
							_gaq.push(['_setAccount', 'UA-4567298-5']);
							_gaq.push(['_setDomainName', 'builtlean.com']);
							_gaq.push(['_setAllowLinker', true]);
							_gaq.push(['_trackPageview']);
						(function() { 
							var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
							ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
						})();

				<?php } ?>






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
				googletag.cmd.push(function() {
					googletag.defineSlot('/29676084/BuiltLean-Half-Page', [[160, 600], [300, 250], [300, 600]], 'div-gpt-ad-1371054573188-0').addService(googletag.pubads());
					googletag.defineSlot('/29676084/BuiltLeanATFMREC', [300, 250], 'div-gpt-ad-1371054573188-1').addService(googletag.pubads());
					googletag.defineSlot('/29676084/BuiltLeanUnderPost', [300, 250], 'div-gpt-ad-1371054573188-2').addService(googletag.pubads());
					googletag.pubads().enableSingleRequest();
					googletag.enableServices();
				});
</script>
				    
	<?php
	///////////////////////////////
	// Hack to fix menu hover on blog
	//////////////////////////////
	$alias = get_post_meta($post->ID, 'alias', $true);
	if(is_single() || is_category() || ($alias == 'blog')){
		$category = get_the_category($post->ID); 
		$checkCat = $category[0]->cat_name;	
		  if(in_category($category[0]->cat_name) && $checkCat != 'Uncategorized'){ ?>		
			<style type="text/css">
					#primary-nav li#menu-item-13091 a {
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
	<?php
			}
		}
	?>
	<?php
		//Small hack to remove big hover menu from posts
		if(is_single() || is_category() || $alias == 'blog') {
		//if(is_single() || is_category()) {
	?>
			<style type="text/css">
				#menu-hover .sub-menu1 {display: none !important;}
			</style>
	<?php } ?>
<style type="text/css">
#menu-hover #menu-item-13091 ul #menu-item-13100 ul.sub-menu2 li#menu-item-19055 a{
	background: url(http://www.builtlean.com/wp-content/themes/builtlean/images/video-training.jpg) top left no-repeat !important;
	width: 150px !important;
	height: 82px !important;
	border-radius: 0px !important;
}

.related_p  ul li a abbr {
		display:none;
}
.optinbox {float: right;
	display: block;
	width: 300px;
	height: 150px;
	margin: 0 0 15px 0;
	background:url(http://files.builtlean.com/wp-content/themes/builtlean/images/opt-in-new1.jpg) no-repeat;
	z-index: 2;
}
.optinbox-email {
	position: relative;
	left:11px;
	top:81px;
	width:204px;
}
.optinbox-email input[type="text"] {
	background:none;
   border:none;
   color:#A3A3A3;
   font-family: arial;
   font-size:15px;
   letter-spacing: 0.5px;
   text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.8);
   width: 190px;
}
.optinbox-submit {
	position: relative;
	top:47px;
	left:217px;
	width: 72px;
}
.optinbox-submit input[type="submit"] {
	width: 71px;
	border: none;
	background: url(http://files.builtlean.com/wp-content/themes/builtlean/images/button_send.gif) no-repeat;
	text-indent: -9999px;
	cursor: pointer;	
	height: 42px;
	margin-bottom:15px;
}
.optinbox-submit input[type="submit"]:hover {
	background-position: 0 -57px;
}

.optinbox-privacy {
	position: relative;
	top: 40px;
	left: 20px;
	padding: 2px 0 0 20px;
	font-size: 10px;
	color:#fff;/*color: #d9d9d9;*/
	background: url(http://files.builtlean.com/wp-content/themes/builtlean/images/lacat.png) 0 2px no-repeat;
}
.optinbox-privacy a {
	color:#fff;/*color: #ccffff;*/
	text-decoration: underline;
}
.optinbox-privacy a:hover {
	text-decoration: underline;
}

/*.textwidget{margin: 0 0 0 -22px !important;}*/
#popular_posts_title{color: #272727 !important;}
.related_p p{text-transform:uppercase;color:#272727;}



/****menu right****/
.menu_right{float:right;margin-bottom:15px;width:315px;}
.menu_right ul#menu-right-menu li{background:#161616;padding:9px 15px 0;margin-left:15px;width:270px;float:left;}
.menu_right ul#menu-right-menu li a{float:left;color:#fff;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif,sans-serif;border-bottom:1px solid #F0F0F0;font-size:14px;font-weight:bold;line-height:27px !important;text-decoration:none;text-transform:uppercase;padding:0 0 3px;width:257px;}
.menu_right ul#menu-right-menu li:last-child a{border:none;}
.menu_right ul#menu-right-menu li:last-child{padding-bottom:19px;}
.menu_right ul#menu-right-menu li:first-child{padding-top:29px;background-position:0 0 !important;}
.menu_right ul#menu-right-menu li.current-menu-item,.menu_right ul#menu-right-menu li:hover{width:315px;margin-left:0;padding:0 0 16px;margin-bottom:-10px;margin-top:-1px;background:url(http://files.builtlean.com/wp-content/themes/builtlean/images/select2.png) 0 -19px no-repeat;}
.menu_right ul#menu-right-menu li.current-menu-item a,.menu_right ul#menu-right-menu li:hover a{color:#000;padding:7px 0 0 30px;}
.menu_right ul#menu-right-menu li:hover:last-child{padding-bottom:25px;margin-bottom:0;}
.menu_right ul#menu-right-menu li:hover:first-child{margin-top:0;padding-top:19px;}

.menu_right ul#menu-right-menu li.current-menu-item:last-child{padding-bottom:25px;margin-bottom:0;}
.menu_right ul#menu-right-menu li.current-menu-item:first-child{margin-top:0;padding-top:19px;}


.printfriendly img{margin:3px 1px 0 7px !important;}
.printfriendly span{font-size:11px !important;}



#subscribe_ribbon{background:url(http://files.builtlean.com/wp-content/themes/builtlean/images/banner_Chri.png) no-repeat center top;height:170px;}
#ribbon_text_input{height:19px;font-size:14px;background:#fff;border:2px solid #ECECEC;border-radius:5px;left:631px;padding:9px 76px 9px 10px;position:absolute;top:57px;width:215px;}
#ribbon_submit_input{width:72px;height:36px;background:url(http://files.builtlean.com/wp-content/themes/builtlean/images/a1.jpg);border-radius:5px;border:1px solid #C20001;font-size:22px;font-weight:normal;left:862px;letter-spacing:-1px;padding:3px;top:59px;}
#ribbon_submit_input:hover{background:url(http://files.builtlean.com/wp-content/themes/builtlean/images/a2.jpg);}
#to_privacy{left:827px;top:101px;width:73px;} 
 
.author-details-top{height:112px;}
.author-name{margin-top:-15px;}

.testimonial-footer a{margin-left:10px;}


.blocks p.title{
		color: #fff;
		padding: 0;
		font-size: 13px;
		text-transform: uppercase;
		margin: 20px 0 6px;		
		font-weight: bold;
}

.title_list{
	margin-bottom: 0px !important;
	}
	
.related_p p.title{
	font-size:15px;
	font-family: Arial, Helvetica, Sans-serif;
	margin-bottom: 0px;
	margin-top: 0px;
}	

#comments .title{
	margin: 20px 0;
	font-size: 15px;
	font-weight: bold;
	color: #333;
}

#respond .title{
	margin: 20px 0;
	font-size: 15px;
	font-weight: bold;
	color: #333;
}

#popular-posts p.entry-title{
	margin:0px ;
}


input.gsc-search-button{
	background: url("<?php bloginfo('template_directory'); ?>/images/search_icon.jpg") #fff no-repeat !important;
	color: transparent !important;
	border: 0px !important;
	min-width: 34px !important;
	height: 26px !important;
	padding: 0px !important;
	position: absolute;
	margin-left: -44px !important;
	margin-top: -13px;
}

input.gsc-input{
	padding: 6px 5px 7px 5px !important;
	border: 1px solid #000 !important;
	border-radius: 5px !important;
	-moz-border-radius: 5px !important;
	-webkit-border-radius: 5px !important;
	-o-border-radius: 5px !important;
}

td.gsc-clear-button{
	display:none !important;
}

#content-loop input.gsc-input{
	border: 1px solid #999 !important;
}

#content-loop input.gsc-search-button{
	margin-left: -46px !important;
	}
	
.cse input.gsc-search-button, input.gsc-search-button{
	font-size: 10px !important;
}	

<!-- Corrections-->
.logo{
	margin-top: 17px !important;
}

.logo a {
	display: block;
}

.logo a img{
		margin-bottom: 30px !important;
}

#menu-hover{
	margin: 1px 0px 0px 0px !important;
}
#socialbuttons{
	margin-top: 3px !important;
}
</style>
</head>
<body <?php body_class(); ?>>
	<!------------------
	Facebook Init
	---------------------->
    <div id="fb-root"></div>
	<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		//js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1&appId=439101682818247";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
				<div id="primary-nav">
					<div style="margin:0px auto; width:969px;">
						<div class="logo">
							<a href="http://www.builtlean.com">
								<img src="<?php echo get_option('smartblog_logo'); ?>" alt="BuiltLean.com" id="logo"/>
								</a>
						</div> 
						<div style="height: 20px; float: right; margin-top: 18px; width: 366px; margin-right: 2px;">
						<div id="cse-search-form" style="width: 100%;">Loading</div>
							<!------------------
							Google search
							---------------------->
							<script src="http://www.google.com/jsapi" type="text/javascript"></script>
								<script type="text/javascript"> 
									google.load('search', '1', {language : 'en', style : google.loader.themes.MINIMALIST});
									google.setOnLoadCallback(function() {
									var customSearchOptions = {};
									var customSearchControl = new google.search.CustomSearchControl('013455458792431772096:WMX-725798303', customSearchOptions);
										customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
									var options = new google.search.DrawOptions();
										options.setAutoComplete(true);
										options.enableSearchboxOnly("http://www.builtlean.com", "s");
										customSearchControl.draw('cse-search-form', options);
									}, true);
							</script>
						</div>
					</div>
						<div class="menu_top"> 
						<!------------------
						Start Main Menu Links
						----------------------> 
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary-nav',
								'container' =>false,
								'echo' => true,
								'depth' => 0,
								'menu_id' => 'menu-hover',
								'walker' => new My_Walker_Nav_Menu()));
						?>
							<div id="socialbuttons">
								<div class="fb-like fb-from-header" data-href="https://www.facebook.com/builtlean" data-send="false" data-layout="button_count" data-width="150" data-show-faces="true"></div>
								<a href="http://www.facebook.com/builtlean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/facebook.png" width="32" height="32"></a>
								<a href="http://www.twitter.com/builtlean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/twitter.png" width="32" height="32"></a>
								<a href="http://www.youtube.com/builtleantv" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/youtube.png" width="32" height="32"></a>
								<a href="http://feeds.feedburner.com/BuiltLean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/rss.png" width="32" height="32"></a>
							</div>
						</div> <!-- end #menu_top -->
			<div class="clear"></div>
		</div><!--#primary-nav-->
		<div class="wrap container">
			<div class="stickem-container">
<script type="text/javascript">
/*
	jQuery(document).ready(function() {
		jQuery(".ratingblock").click(function() { gdsr_rating_standard(this); });
	});*/
</script>
