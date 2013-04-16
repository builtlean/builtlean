<?php get_header(); ?>
<div id="wrap_homepage">
     <div id="wrap_banner">
        <img src="<?php bloginfo('template_directory'); ?>/images/Header_2.png" style="border: 1px solid #888; width:100%" />
            <a id="learn_more" href="http://www.builtlean.com/workout-plan/" onclick="_gaq.push(['_setCustomVar', 1, 'learn more', 'home page', 2]);_gaq.push(['_trackEvent', 'learn more', 'clicked', 'home page']);_gaq.push(['_link', this.href, true]); return false;" rel="nofollow">aaaaaaaaaaaaaaaa</a>
            <a id="buy_now" href="https://builtlean.infusionsoft.com/cart/?product_id=5" class="lnk-pr" onclick="_gaq.push(['_setCustomVar', 1, 'add to cart clicks', 'home page', 2]);_gaq.push(['_trackEvent', 'add to cart', 'clicked', 'home page']);_gaq.push(['_link', this.href, true]); return false;" rel="nofollow">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</a>
		<a href="<?php bloginfo('url'); ?>/success-stories/" id="success_st">aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</a>
      </div>
      <div id="logos_container">
			<div class="press_ribbon"></div>
			<div class="bar_btn_container">
			<div class="ribbon"></div>
			<a class="bar_btn" href="<?php bloginfo('url'); ?>/press/"></a>
            </div>
            <div class="clear"></div>
      </div>        
      <h2 class="title_list">RECENT ARTICLES</h2>
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
					$title 	= strlen(get_the_title()) > 60 ? substr(get_the_title(), 0, 60).'...' : get_the_title();
					$author 	= get_the_author($post->ID);				
					$datetime 	= get_the_time(get_option('date_format'));
					$permalink 	= get_permalink($post->ID);
					$thumbnailUrl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-home_thumb');
					$args = array(
							'post_type' => 'attachment',
							'numberposts' => 1,
							'post_status' => null,
							'post_parent' => $post->ID
					  );

                    $attachments = get_posts( $args );				
                                  if ($thumbnailUrl) {
                    $printThumb = get_the_post_thumbnail($post->ID, array('class' => 'square_thumb'));
								 }else if ( $attachments ) {
								  foreach ( $attachments as $attachment ){
                    $printThumb = wp_get_attachment_image( $attachment->ID, 'square_thumb' );
                }
                }else{
                    $printThumb = '<img id="img" src="'.get_bloginfo("template_directory").'/images/no_photo.jpg" />';
                }
   ?>
     <div class="print_article">
          <a class="thumb" href="<?php echo $permalink; ?>">
             <?php echo $printThumb; ?>
       <p><?php echo $title; ?></p>
         </a>
     </div>
   <?php
    }
   ?>
   <div class="clear"></div>
   </div>
	    <h2 class="title_list">FEATURED ARTICLES</h2>
        <div id="list_articles">
            <?php		
               $catID = get_cat_ID(get_option('smartblog_featured_cat_articles'));
               $featured = array(
                    'posts_per_page' => 5,
                    'category' => $catID,
                    'post_status' => 'publish',
                    'orderby' => 'post_date',
                    'order' => 'desc'
            );
            $getFeatured = get_posts($featured);	
            foreach($getFeatured as $post) {
                setup_postdata($post);
                $title 		= get_the_title();
                $author 	= get_the_author($post->ID);				
                $datetime 	= get_the_time(get_option('date_format'));
                $permalink 	= get_permalink($post->ID);
                $thumbnailUrl 	= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'square_thumb');
                $args = array(
                        'post_type' => 'attachment',
                        'numberposts' => 1,
                        'post_status' => null,
                        'post_parent' => $post->ID
                  );
                $attachments = get_posts( $args );				
                if ($thumbnailUrl) {
                        $printThumb = get_the_post_thumbnail($post->ID, array('class' => 'square_thumb'));
                }else if ( $attachments ) {
                        foreach ( $attachments as $attachment ){
                         $printThumb = wp_get_attachment_image( $attachment->ID, 'square_thumb' );
                        }
                    }else{
                         $printThumb = '<img id="img" src="'.get_bloginfo("template_directory").'/images/no_photo.jpg" />';
                    }
                        ?>
                        <div class="print_article">
                           <a class="thumb" href="<?php echo $permalink; ?>">
                               <?php echo $printThumb; ?>
                                <p><?php echo $title; ?></p>
                           </a>
                        </div>
                        <?php
            }
        ?>
		<div class="clear"></div>
			</div>
			 <div class="clear"></div>
			  <div class="space35"></div>
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
