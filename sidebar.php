<div id="sidebar" class="stickem <?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('right'); } else { echo('left'); } ?>">	
<div class="optinbox">
		<form accept-charset="UTF-8" action="https://builtlean.infusionsoft.com/app/form/process/c5150c9d1f2a46cf7265fa72d4e07cd9" class="infusion-form" onSubmit="_gaq.push(['_setCustomVar', 1, 'newsletter sign up', 'top right opt-in', 1]);_gaq.push(['_trackEvent', 'newsletter', 'sign up', 'top right opt-in']);" method="POST">
   		<input name="inf_form_xid" type="hidden" value="c5150c9d1f2a46cf7265fa72d4e07cd9" />
   		<input name="inf_form_name" type="hidden" value="Free Workout - Sidebar" />
    		<input name="infusionsoft_version" type="hidden" value="1.29.3.46" />
    		<div class="optinbox-email">
        		<label for="inf_field_Email" style="display:none;">Email *</label>
        		<input class="infusion-field-input-container" name="inf_field_Email" id="inf_field_Email" size="42" type="text" onblur="if (this.value == '') {this.value = 'Enter your email here...';}" onfocus="if (this.value == 'Enter your email here...') {this.value = '';}" value="Enter your email here..." />
    		</div>
    		<div class="optinbox-submit">
        		<input type="submit" value="Submit" />
    		</div>
		</form>
		
      <div class="optinbox-privacy">
         <span>Your email is safe and secure per our <a href="http://www.builtlean.com/privacy-policy/" rel="nofollow" target="_blank">privacy policy</a></span>
      </div>      
      </div>
      <div class="sidebar-block"></div>
	  <div id="popular-posts"  class="widget" style="float: left;">
<?php
		$pop = $wpdb->get_results("SELECT id, post_title, comment_count FROM {$wpdb->prefix}posts WHERE post_type='post' ORDER BY comment_count DESC LIMIT 5");
  ?>
		<ul class="tabs">
    	<li class="nobullet"><a href="javascript: void(0)" class="selected" id="popular_posts_title" >POPULAR ARTICLES</a></li>
		</ul>
		<ul>
	<?php foreach($pop as $post) : ?>
		<li>
    	<div class="left">
    <?php echo get_the_post_thumbnail( $post->id, array(56,56), $attr ); ?> 
		</div>
		<div class="info">
		<div class="entry-title">
			<a title="<?php echo $post->post_title; ?>" href="<?php echo get_permalink($post->id); ?>" class="popular_posts_description"><?php echo $post->post_title; ?>
			</a>
		</div>
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
				<!--<div id='div-gpt-ad-1371054573188-0'>
					<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1371054573188-0'); });
					</script>
				</div>-->
			<!-- BuiltLean-Half-Page -->
				<!--<div id='div-gpt-ad-1363655684868-0' style='width:300px; height:600px;'>
					<script type='text/javascript'>
						//googletag.cmd.push(function() { googletag.display('div-gpt-ad-1363655684868-0'); });
					</script>
				</div>-->
			<!-- end Google DfP -->
			<!-- <a href="http://www.builtlean.com/how-to-get-a-lean-body" onclick="_gaq.push(['_setCustomVar', 1, 'internal ad', 'bottom right sidebar | get lean guide landing page | only 3 workouts per week', 2]);_gaq.push(['_trackEvent', 'internal ad', 'clicked bottom right sidebar | get lean guide landing page', 'medium rectangle | only 3 workouts per week',, false]);"> <img src="<?php bloginfo('template_url'); ?>/images/mediumrectangle1.jpg" width="300" height="250" border="0"></a> -->
		
		<!-- BuiltLean-Half-Page -->
<script type="text/javascript">
jQuery(document).ready(function($) { $('.sharebar').sharebary({horizontal:'true',swidth:'160',minwidth:1000,position:'left',leftOffset:95,rightOffset:10}); });
jQuery.fn.sharebary = function(options) {
	var defaults = {horizontal: true, swidth: 160, minheight: 160, position: 'left', leftOffset: 20, rightOffset: 10};
	var opts = jQuery.extend(defaults, options); 
	var o = jQuery.meta ? jQuery.extend({}, opts, jQueryjQuery.data()) : opts;

	var w = jQuery(window).width();
	var h = jQuery(window).height();
	var sharebary = jQuery('#sharebary');
	var parenth = jQuery(sharebary).parent().height();
	var start = sharebary_init();

	function sharebary_init(){
		jQuery(sharebary).css('width',o.swidth+'px');
		if (o.position == 'left') jQuery(sharebary).css('marginLeft',(0));
		else {
			jQuery(sharebary).css('marginLeft',(parenth+o.rightOffset));
		}
		if(!h < o.minheight && o.horizontal) 
			jQuery(sharebary).fadeIn();
		jQuery.event.add(window, "scroll", sharebary_scroll);
		jQuery.event.add(window, "resize", sharebary_resize);
		return jQuery(sharebary).offset().top;
	}
	function sharebary_resize() {
		var h = jQuery(window).height();
		if(h<o.minheight)
			jQuery(sharebary).fadeOut();
		else
			jQuery(sharebary).fadeIn();
	}
	function sharebary_scroll() {
		var p = jQuery(window).scrollTop();
		var wh = $(document).height();
		var f = $("#footer").height();
		var l = $("#logos_container").height();
		var tt = $("#div-gpt-ad-1371054573188-0").height();
		var aa = $("#footer-content").height();
		var preamic = wh-start-tt-(tt+f+l+aa);
		wh=wh-(tt+f+l+aa); 
		
		if(preamic>0)
		{
			if((p-250)>start)
			{
				jQuery(sharebary).css('position','fixed');
				jQuery(sharebary).css('top','10px');
				if((p-200)>wh)
				{
					jQuery(sharebary).css('position','absolute');
					jQuery(sharebary).css('top',wh+'px');
				}
			}
			else{
				 	jQuery(sharebary).css('position','absolute');
					jQuery(sharebary).css('top','');
				}
		}
	}
};
</script>
		<div id="sharebary" style="background:#f2f9fc;border-color:#fbfbfb;">
			<div id='div-gpt-ad-1371054573188-0'>
				<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1371054573188-0'); });
				</script>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

	<div class="clear"></div>

</div><!--end #sidebar-->
