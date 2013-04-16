<?php get_header(); ?>
<!--
 Breadcrumbs css 
 -->

<style type="text/css">	
		#breadcrumbs {
				float: left;
				background: white;
				font-family: 'Verdana', 'Geneva', 'Arial';
		}
		#breadcrumbs a { 
				margin-right: 6px !important;
				padding-right: 9px !important;
				background: url(../../../../wp-content/themes/builtlean/images/bullet.png) no-repeat right 3px;
			} 
			#breadcrumbs a:last-child {
				background: none !important;
				padding-left: 0px !important;
			}
		.single #breadcrumbs2, .page #breadcrumbs2 {
			margin-bottom: 10px;
			padding: 0;
			/*margin-top: -4px;*/
			}
		#breadcrumbs2 {
			float: left;
			background: white;
			font-family: 'Verdana', 'Geneva', 'Arial';
			font-size: 10px;
			color: #999;
		}
		#breadcrumbs2 a { 
			padding-right: 13px !important;
			margin-right: 2px !important;
			background: url(../../../../wp-content/themes/builtlean/images/bullet.png) no-repeat right 3px;
			color: #999;
			text-transform: uppercase;
		} 
		#breadcrumbs2 a:last-child {
			background: none !important;
			padding-left: 0px !important;
		}			
</style> <!-- end breadcrumbs css-->

		<div class="blog_menu">
	<?php
			wp_nav_menu( array(
					'theme_location' => 'secondary-nav',
					'container' =>false,
					'echo' => true,
					'depth' => 0,
					//'fallback_cb'=>'headermenu',
					'menu_id' => 'menu-blog',
					'walker' => new My_Walker_Nav_Menu()
				)
			);
	?>  
	</div> <!-- closed div blog_menu -->
	<div class="clear"></div>
	<div id="content" class="content <?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">	 
	
	<?php
			$url = wp_get_referer();
			$path_parts = pathinfo($url);
			$path_lvl1 = explode("/", $path_parts['dirname']);
			$path_lvl2 = explode("-", $path_parts['filename']);
			$lvl2 = '';
		foreach($path_lvl2 as $lvl){
			$lvl2 .=$lvl;
			$lvl2 .=' ';
		}
		if ($lvl2 == 'recovery rehab ') $lvl2 ='recovery & rehab ';
			else if ($lvl2 == 'gear tech ') $lvl2 ='gear & tech ';
			else if ($lvl2 == 'best of series ') $lvl2 ='“Best Of…” Series';
	?>
	<?php if (($path_lvl1[4] =='') || (is_numeric($path_lvl1[4])) || (is_numeric($lvl2))) {
			 dimox_breadcrumbs();
		}
		else {
		echo '<div id="breadcrumbs">';
	?>	 
		<a href="<?php bloginfo('url'); ?>"> Home </a>
		<a href="<?php bloginfo('url'); echo'/blog'; ?>"> Blog </a>
		<a href="<?php echo $path_parts['dirname'], "\n";?>"> <?php echo $path_lvl1[4]; ?> </a>
		<a href="<?php echo $path_parts['dirname'],"/",$path_parts['filename'], "\n";?>"> <?php echo $lvl2 ?></a>		
	<?php echo '</div>';
	}
	?>	
	<?php 
	if(is_single() || is_page()) {
		$customFields = get_post_custom($post->ID);
		$dr_name = $customFields["review_dr.name"][0];
		$dr_url = $customFields["review_dr.url"][0];		
		if($dr_name !='' & $dr_url !=''){	
	?>		
		<div class="review_dr"><i>Medically reviewed by <a href="<?php echo $dr_url; ?>"><?php echo $dr_name; ?></a></i></div>	
	<?php 
	  }
	}	
		echo '<div style="clear: both;"></div>';		
		the_post(); ?>	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>			
		  <h1 class="post_title entry-title"><?php the_title(); ?></h1>		
				<div class="entry-meta">
				<div class="author-gravatar">
			<?php echo get_avatar( get_the_author_email(), '35' ); ?>
				</div>
			<?php _e('by ', 'themejunkie'); ?><span class="vcard"><span class="fn"><?php the_author_posts_link(); ?></span></span> <span class="meta-sep">|</span> <?php _e('', 'themejunkie'); ?> <span class="meta-date updated"><abbr class="published" title="<?php the_time('g:i a'); ?>"><?php the_time(get_option('date_format')); ?></abbr> | </span> <span class="meta-date"><?php if( get_the_modified_date() != get_the_date()) echo ' Updated: ' . get_the_modified_date() . ' | '; ?></span>            
				<span class="entry-comment">
			<?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?>
				</span>
				</div> <!--end .entry-meta-->
				<div class="entry entry-content">
			<?php if(get_option('smartblog_integrate_singletop_enable') == 'on') echo (get_option('smartblog_integration_single_top')); ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>
			<?php if(get_option('smartblog_integrate_singlebottom_enable') == 'on') echo (get_option('smartblog_integration_single_bottom')); ?>
				</div> <!--end .entry-->
			<div class="clear"></div>
				</div> <!--end #post-->
			<div style="clear:both; margin-left: 119px; margin-bottom: -3px;">
				<a style="color: #aaa" href="http://www.builtlean.com/advertising-policy/" rel="nofollow"><small>Advertisement</small></a>
			</div>
			<div style="float:left; clear:left; margin:5px 0 15px 0;">
	  <a href="http://www.builtlean.com/how-to-get-a-lean-body" target="_blank" onclick="_gaq.push(['_setCustomVar', 1, 'internal ad', 'underneath article | get lean guide landing page | only 3 workouts per week', 2]);_gaq.push(['_trackEvent', 'internal ad', 'clicked underneath article | get lean guide landing page', 'medium rectangle | only 3 workouts per week',, false]);"> <img src="http://www.builtlean.com/wp-content/uploads/2012/06/mediumrectangle1.jpg" width="300" height="250" border="0"></a>    
    </div>
 <div class="related_p">
    <?php related_posts(); ?>
    </div>
<div class="clear"></div>
<?php if ( ! comments_open() ) : ?>
<!-- WE JUST HIDE IT FOR LATER USE :) -->
<div class="comments-closed" style="display:none">
	<h3>Comments Are Now Closed</h3>
	<p>We close comments periodically on articles that generate more comments and questions than we can effectively moderate.  If you are a first time visitor looking to lose fat &amp; improve your health, we highly recommend reading our free <a href="http://www.builtlean.com/how-to-get-a-lean-body/" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| get lean guide link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked get lean guide', 'comment rules| get lean guide',, false]);">Get Lean Guide</a>.  If you have a question, we encourage you to join our <a href="http://www.facebook.com/builtlean" target="_blank" rel="nofollow" onclick="_gaq.push(['_setCustomVar', 1, 'comment rules', 'comment rules| facebook link', 2]);_gaq.push(['_trackEvent', 'comment rules', 'clicked facebook link', 'comment rules| facebook link',, false]);">BuiltLean Facebook Community</a> where thousands of fans can help you.  Thank you for visiting our website!</p>
</div>
<?php endif; ?>
	<?php if(get_option('smartblog_show_post_comments') == 'on') comments_template( '', true ); ?>
</div><!--end #content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<script type="text/javascript">
		jQuery(document).ready(function(){
			
				var singleValues = jQuery("li.blog a").html();
				if (singleValues == 'Articles &amp; Videos'){
					jQuery("li.blog").addClass('menu_item_hovered_blog');
					jQuery("li.blog").css('font-weight','bold');
					}		
			});
</script>

