 <div class="clear"></div>
 </div><!--sticky-->
 </div>
 <!--end .wrap-->
 <div class="clear"></div>
	<?php
	if (is_home() ) { 
		$display_logos='display_none ';
		}
	?>
	
	<div id="<?php echo $display_logos; ?>logos_container" class="margin15auto">
		<div class="<?php echo $display_logos; ?>press_ribbon"></div>
		<div class="<?php echo $display_logos; ?>bar_btn_container">
		<div class="<?php echo $display_logos; ?>ribbon"></div>
		<a class="<?php echo $display_logos; ?>bar_btn" href="<?php bloginfo('url'); ?>/press/"></a>
	</div>
    <div class="clear"></div>
    </div>
	<div id="footer">
		<div id="footer-content">
			<div class="blocks no-padd">
				<h2>Join our email list</h2>
				<p>Join our email list for exclusive offers and weekly updates</p>
					<form action="https://builtlean.infusionsoft.com/AddForms/processFormSecure.jsp" target="_blank" onsubmit="_gaq.push(['_setCustomVar', 1, 'newsletter sign up', 'footer', 1]);_gaq.push(['_trackEvent', 'newsletter', 'sign up', 'footer']);" method="POST">
					 <input type="hidden" name="infusion_xid" id="infusion_xid" value="7b5c4c539110daaf295e6bf49596ccc0">
					 <input type="hidden" name="infusion_type" id="infusion_type" value="CustomFormWeb">
					 <input type="hidden" name="infusion_name" id="infusion_name" value="New Lead">				
					 <input type="email" class="mail-list" name="Contact0Email" placeholder="Enter Your Email...">
					 <input type="submit" name="Submit" value="Submit" class="mail-list-btn">
					 <input type="hidden" name="Contact0_GaContent" value="-">
					 <input type="hidden" name="Contact0_GaSource" value="(direct)">
					 <input type="hidden" name="Contact0_GaMedium" value="(none)">
					 <input type="hidden" name="Contact0_GaTerm" value="-">
					 <input type="hidden" name="Contact0_GaCampaign" value="(direct)">
					 <input type="hidden" name="Contact0_GaReferurl" value="<?php bloginfo('url'); ?>">
					 <input type="hidden" name="inf_field_LeadSourceName" value="Web - Direct">
					 <input type="hidden" name="LeadSource" value="Web - Direct">
					 <input type="hidden" name="LeadSource0Vendor" value="">
					 <input type="hidden" name="LeadSource0Medium" value="">
					 <input type="hidden" name="LeadSource0Message" value="">			
				</form>
			</div>
			<div class="blocks">
				<h2>Connect with us</h2>
				<p>Follow Us On:</p>
				<div id="socialbuttons" style="float: left;">
					<a href="http://www.facebook.com/builtlean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/facebook.png" width="32" height="32"></a>
					<a href="http://www.twitter.com/builtlean" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/twitter.png" width="32" height="32"></a>
					<a href="http://www.youtube.com/builtleantv" target="_blank"><img src="http://www.builtlean.com/wp-content/themes/builtlean/images/youtube.png" width="32" height="32"></a>
				</div>	
			</div>
			<div class="blocks">
				<h2>Support</h2>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'support-nav',
						'container' =>false,
						'echo' => true,
						'depth' => 0,
						//'fallback_cb'=>'headermenu',
						'menu_class' => 'menu-company'
					)
				);		
				?>
			</div>  
			<div class="blocks">
				<h2>Company</h2>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'company-nav',
						'container' =>false,
						'echo' => true,
						'depth' => 0,
						//'fallback_cb'=>'headermenu',
						'menu_class' => 'menu-company'
					)
				);		
				?>
			</div>
			<div style="clear: both; height: 30px;"></div>
			<?php
				wp_nav_menu( array(
						'theme_location' => 'popular-pages-nav',
						'container' =>false,
						'echo' => true,
						'depth' => 0,
						//'fallback_cb'=>'headermenu',
						'menu_class' => 'main-f-menu'
					)
				);		
			?>
			<?php
				wp_nav_menu( array(
						'theme_location' => 'website-usage-nav',
						'container' =>false,
						'echo' => true,
						'depth' => 0,
						//'fallback_cb'=>'headermenu',
						'menu_class' => 'main-f-menu'
					)
				);		
			?>		
				<div style="clear: both; height: 15px;"></div>      
				<div class="left_side">   
					This website is for informational purposes only and is no way intended as medical counseling or medical advice. Results may vary.   
				</div>
			
				<div class="right_side">
				&copy; <?php echo date('Y');?> BuiltLean  |  All rights reserved.
				</div>
			<div style="clear: both;"></div>											
		</div>
	</div><!--end #footer -->

	<?php wp_footer(); ?>
<script type='text/javascript' src='http://www.builtlean.com/wp-content/themes/builtlean/includes/js/tabber.js?ver=1.4.2'></script>
	<div id="fb-root"></div>
	<script type="text/javascript">(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<script type="text/javascript">
		window.fbAsyncInit = function() {
			FB.Event.subscribe('edge.create', function(targetUrl) {
				_gaq.push(['_trackSocial', 'facebook', 'like', targetUrl]);
			});
		 };
	</script>
	<?php if(!is_page('7607')) { ?>
	<!-- removed GA code -->
	<?php } ?>
			<script type="text/javascript">
	<!-- Start BounceX tag for BuiltLean -->
			(function(d) {
				var e = d.createElement('script');
				e.src = d.location.protocol + '//bounceexchange.com/bounce/i.js?client_id=223';
				e.async = true;
				d.getElementsByTagName("head")[0].appendChild(e);
				}(document)); <!-- End BounceX tag for BuiltLean --> 
			</script>

</body>
</html>