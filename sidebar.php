<div id="sidebar" class="stickem <?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('right'); } else { echo('left'); } ?>">	
<div class="optinbox">
      <form action="https://builtlean.infusionsoft.com/AddForms/processFormSecure.jsp" onSubmit="_gaq.push(['_setCustomVar', 1, 'newsletter sign up', 'top right opt-in', 1]);_gaq.push(['_trackEvent', 'newsletter', 'sign up', 'top right opt-in']);" method='POST'>
         <input type="hidden" name="infusion_xid" id="infusion_xid" value="7b5c4c539110daaf295e6bf49596ccc0" />
         <input type="hidden" name="infusion_type" id="infusion_type" value="CustomFormWeb" />
         <input type="hidden" name="infusion_name" id="infusion_name" value="New Lead" />
     <div class="optinbox-email">
         <input size="42" type="text" onblur="if (this.value == '') {this.value = 'Enter your email...';}" onfocus="if (this.value == 'Enter your email...') {this.value = '';}" name="Contact0Email" id="Contact0Email" value="Enter your email..." />
     </div>
     <div class="optinbox-submit">
          <input type="submit" name="Submit" value="Submit" />
     </div>
		  </form>
      <div class="optinbox-privacy">
         <span>Your email is safe and secure per our <a href="http://www.builtlean.com/privacy-policy/" rel="nofollow" target="_blank">privacy policy</a></span>
      </div>      
      </div>
      <div class="sidebar-block">
	</div>
	  <div id="popular-posts"  class="widget">
<?php
		$pop = $wpdb->get_results("SELECT id, post_title, comment_count FROM {$wpdb->prefix}posts WHERE post_type='post' ORDER BY comment_count DESC LIMIT 5");
  ?>
		<ul class="tabs">
    	<li class="nobullet"><a href="javascript: void(0)" class="selected" id="popular_posts_title" >POPULAR POSTS</a></li>
		</ul>
		<ul>
	<?php foreach($pop as $post) : ?>
		<li>
    	<div class="left">
    <?php echo get_the_post_thumbnail( $post->id, array(56,56), $attr ); ?> 
		</div>
		<div class="info">
		<h3 class="entry-title"><a title="<?php echo $post->post_title; ?>" href="<?php echo get_permalink($post->id); ?>" class="popular_posts_description"><?php echo $post->post_title; ?></a></h3>
		</div> <!--end .info-->
		<div class="clear"></div>
		</li>
	<?php endforeach; ?>
		</ul>
	<div class="clear"></div>
		</div>		
	<?php if ( is_active_sidebar('sidebar') ) :  ?>
	<?php dynamic_sidebar('sidebar'); ?>
	<?php endif; ?>
		<div id="stickyadd" class="scroll-element ">
		  <div style="clear:both; padding: 0 0 5px 119px;">
		  <a href="http://www.builtlean.com/advertising-policy/" rel="nofollow" style="color: #aaa"><small>Advertisement</small></a>
		</div>
			<!-- Google DFP -->
			<!-- BuiltLean-Half-Page -->
				<!--<div id='div-gpt-ad-1363655684868-0' style='width:300px; height:600px;'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1363655684868-0'); });
					</script>
				</div>-->
			<!-- end Google DfP -->
			<a href="http://www.builtlean.com/how-to-get-a-lean-body" onclick="_gaq.push(['_setCustomVar', 1, 'internal ad', 'bottom right sidebar | get lean guide landing page | only 3 workouts per week', 2]);_gaq.push(['_trackEvent', 'internal ad', 'clicked bottom right sidebar | get lean guide landing page', 'medium rectangle | only 3 workouts per week',, false]);"> <img src="<?php bloginfo('template_url'); ?>/images/mediumrectangle1.jpg" width="300" height="250" border="0"></a>
	</div>
	<div class="clear"></div>
</div>

	<div class="clear"></div>

</div><!--end #sidebar-->
