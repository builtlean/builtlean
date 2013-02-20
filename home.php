<?php

get_header();

?>

<div id="wrap_homepage">
        <div id="wrap_banner">
            <img src="<?php bloginfo('template_directory'); ?>/images/home-banner.jpg" style="border: 1px solid #888; width:100%" />
            <a id="learn_more" href="http://www.builtlean.com/workout-plan/" onclick="_gaq.push(['_setCustomVar', 1, 'learn more', 'home page', 2]);_gaq.push(['_trackEvent', 'learn more', 'clicked', 'home page']);_gaq.push(['_link', this.href, true]); return false;" rel="nofollow"></a>
            <a id="buy_now"  href="https://builtlean.infusionsoft.com/cart/?product_id=5" class="lnk-pr" onclick="_gaq.push(['_setCustomVar', 1, 'add to cart clicks', 'home page', 2]);_gaq.push(['_trackEvent', 'add to cart', 'clicked', 'home page']);_gaq.push(['_link', this.href, true]); return false;" rel="nofollow"></a>
        </div>
        
        <div id="logos_container">
            <a class="bar_btn" href="http://sandbox.builtlean.com/press/"></a>
        </div>
        
	<div id="wrap_list" class="left">
		<h2 class="title_list">Recent Articles</h2>
		
		<div id="list_articles">
		<?php		
		
		$latest = array(
			'post_type' => 'post',
			'posts_per_page' => 5,
			'post_status' => 'publish',
			'orderby' => 'post_date',
			'order' => 'desc'
		);
		
		$getPosts = get_posts($latest);	
		
		foreach($getPosts as $post) {
			
				setup_postdata($post);
				
				$title 			= get_the_title();
				$author 			= get_the_author($post->ID);				
				$datetime 		= get_the_time(get_option('date_format'));
				$permalink 		= get_permalink($post->ID);
				$thumbnailUrl 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-home_thumb');
				
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => 1,
					'post_status' => null,
					'post_parent' => $post->ID
				  );

				$attachments = get_posts( $args );				
				
				
				if ($thumbnailUrl) {
					$printThumb = get_the_post_thumbnail($post->ID, array('class' => 'post-home_thumb'));
					
				}else if ( $attachments ) {
					
					foreach ( $attachments as $attachment ){
						$printThumb = wp_get_attachment_image( $attachment->ID, 'post-home_thumb' );
					}
		    	}else{
	
		    		$printThumb = '<img id="img" src="'.get_bloginfo("template_directory").'/images/no_photo.jpg" />';
		    	}
				?>
				
				<div class="print_article">
					<a class="thumb" href="<?php echo $permalink; ?>"><?php echo $printThumb; ?></a>
					<h2><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h2>
					<div class="entry-meta">by <a href="#" title="Posts by '.$author.'" rel="author"><?php echo $author; ?>'</a>
						<span class="meta-sep">|</span>  <span class="meta-date"><abbr class="published" title="<?php echo get_the_time('g:i a'); ?>"><?php echo $datetime; ?></abbr> | </span>
			         <span class="entry-comment">
			        	 <?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?>
			         </span>
					</div>
					<div class="clear"></div>
				</div>
				
				<?php
		}

		?>
		</div>
	</div>
	
	<div id="wrap_list" class="right">
		<h2 class="title_list">Featured Articles</h2>
		
		<div id="list_articles">
			<?php		
			$catID = get_cat_ID(get_option('smartblog_featured_cat_articles'));
			
			$featured = array(
				//'post_type' => 'post',
				'posts_per_page' => 5,
				'category' => $catID,
				'post_status' => 'publish',
				'orderby' => 'post_date',
				'order' => 'desc'
			);
			
			$getFeatured = get_posts($featured);	
			
			foreach($getFeatured as $post) {
				
					setup_postdata($post);
					
					$title 			= get_the_title();
					$author 			= get_the_author($post->ID);				
					$datetime 		= get_the_time(get_option('date_format'));
					$permalink 		= get_permalink($post->ID);
					$thumbnailUrl 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-home_thumb');
					
					$args = array(
						'post_type' => 'attachment',
						'numberposts' => 1,
						'post_status' => null,
						'post_parent' => $post->ID
					  );
	
					$attachments = get_posts( $args );				
					
					
					if ($thumbnailUrl) {
						$printThumb = get_the_post_thumbnail($post->ID, array('class' => 'post-home_thumb'));
						
					}else if ( $attachments ) {
						
						foreach ( $attachments as $attachment ){
							$printThumb = wp_get_attachment_image( $attachment->ID, 'post-home_thumb' );
						}
			    	}else{
		
			    		$printThumb = '<img id="img" src="'.get_bloginfo("template_directory").'/images/no_photo.jpg" />';
			    	}
					?>
					
					<div class="print_article">
						<a class="thumb" href="<?php echo $permalink; ?>"><?php echo $printThumb; ?></a>
						<h2><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></h2>
						<div class="entry-meta">by <a href="#" title="Posts by '.$author.'" rel="author"><?php echo $author; ?>'</a>
							<span class="meta-sep">|</span>  <span class="meta-date"><abbr class="published" title="<?php echo get_the_time('g:i a'); ?>"><?php echo $datetime; ?></abbr> | </span>
				         <span class="entry-comment">
				        	 <?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?>
				         </span>
						</div>
						<div class="clear"></div>
					</div>
					
					<?php
			}

		?>	
		</div>
	</div>
        <div class="clear"></div>
        
        <div id="subscribe_ribbon">
            <form action="https://builtlean.infusionsoft.com/AddForms/processFormSecure.jsp" target="_blank" onSubmit="_gaq.push(['_setCustomVar', 1, 'newsletter sign up', 'top right opt-in', 1]);_gaq.push(['_trackEvent', 'newsletter', 'sign up', 'top right opt-in']);" method='POST'>
                <input type="hidden" name="infusion_xid" id="infusion_xid" value="7b5c4c539110daaf295e6bf49596ccc0" />
                <input type="hidden" name="infusion_type" id="infusion_type" value="CustomFormWeb" />
                <input type="hidden" name="infusion_name" id="infusion_name" value="New Lead" />
                <input type="email" name="Contact0Email" id="ribbon_text_input" placeholder="Enter Your Email..." />
                <input type="submit" name="Submit" value="Get instant access" id="ribbon_submit_input" />
                <input type="hidden" name="Contact0_GaContent" value="-">
                <input type="hidden" name="Contact0_GaSource" value="(direct)">
                <input type="hidden" name="Contact0_GaMedium" value="(none)">
                <input type="hidden" name="Contact0_GaTerm" value="-">
                <input type="hidden" name="Contact0_GaCampaign" value="(direct)">
                <input type="hidden" name="Contact0_GaReferurl" value="<?php echo get_home_url(); ?>">
                <input type="hidden" name="inf_field_LeadSourceName" value="Web - Direct">
                <input type="hidden" name="LeadSource" value="Web - Direct">
                <input type="hidden" name="LeadSource0Vendor" value="">
                <input type="hidden" name="LeadSource0Medium" value="">
                <input type="hidden" name="LeadSource0Message" value="">
            </form>
            <a href="http://www.builtlean.com/privacy-policy/" id="to_privacy"></a>
        </div>
</div><!--end #content-->

<?php get_footer(); ?>