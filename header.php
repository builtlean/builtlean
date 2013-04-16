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
	<script type="text/javascript">
		
		<?php if(is_single()) {	?>
			$(document).ready(function(){
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
			});
		<?php } ?>
		
		///////////////////////////////
		// google api
		//////////////////////////////
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


		(function()
				{var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();
				 var googletag = googletag || {};
					 googletag.cmd = googletag.cmd || [];
		(function() {
				 var gads = document.createElement('script');
					 gads.async = true;
					 gads.type = 'text/javascript';
				 var useSSL = 'https:' == document.location.protocol;
					 gads.src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js';
				 var node = document.getElementsByTagName('script')[0];
					 node.parentNode.insertBefore(gads, node);
				})();
				googletag.cmd.push(function() {
					googletag.defineSlot('/29676084/BuiltLean-Half-Page', [300, 600], 'div-gpt-ad-1363655684868-0').addService(googletag.pubads());
					googletag.pubads().enableSingleRequest();
					googletag.enableServices();
			});
		</script>	


					    
	<?php
	///////////////////////////////
	// Hack to fix menu hover on blog
	//////////////////////////////
	if(is_single() || is_category()){
		$category = get_the_category($post->ID); 
		$checkCat = $category[0]->cat_name;	
		  if(in_category($category[0]->cat_name) && $checkCat != 'Uncategorized'){ ?>		
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
	<?php
			}
		}
	?>
	<?php
		//Small hack to remove big hover menu from posts
		$alias = get_post_meta($post->ID, 'alias', $true);
		if(is_single() || is_category() || $alias == 'blog') {
	?>
			<style type="text/css">
				#menu-hover .sub-menu1 {display: none !important;}
			</style>
	<?php } ?>
    
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
						<div class="logo"><a href="http://www.builtlean.com"><img src="<?php echo get_option('smartblog_logo'); ?>" alt="BuiltLean.com" id="logo"/></a></div> 
						<div style="height: 20px; float:right; margin-top:18px; width:280px">
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
