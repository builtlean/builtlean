<div id="sidebar" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('right'); } else { echo('left'); } ?>">
	

<?php if ( is_active_sidebar('sidebar') ) :  ?>
		<?php dynamic_sidebar('sidebar'); ?>
	<?php endif; ?>
	
	<div id="stickyadd">
		<div style="clear:both; padding: 0 0 5px 119px;">
		  <a href="http://www.builtlean.com/advertising-policy/" rel="nofollow" style="color: #aaa"><small>Advertisement</small></a>
	   </div>

		<!-- Google DFP -->
		<!-- BuiltLean-Half-Page -->
			<div id='div-gpt-ad-1363655684868-0' style='width:300px; height:600px;'>
				<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1363655684868-0'); });
				</script>
			</div>
		<!-- end Google DfP -->
			
		<div class="clear"></div>
    </div>
</div><!--end #sidebar-->
