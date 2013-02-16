<?php get_header(); ?>

<div id="content_home" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">

	<?php if(get_option('smartblog_content_layout') == 'Layout #1') { ?>

	<div id="featured">

		<?php 
			query_posts( array(
				'showposts' => get_option('smartblog_featured_post_num'),
				'tag' => get_option('smartblog_featured_post_tags')
			) );
			if( have_posts() ) : while( have_posts() ) : the_post();
		?>	
			
			<?php include(TEMPLATEPATH. '/includes/templates/layout1-featured-loop.php'); ?>

		<?php endwhile; endif; wp_reset_query(); ?>
			
		<div class="clear"></div>
	
	</div><!--end #featured-->
	
	<?php if(get_option('smartblog_home_content_ad_enable') == 'on') { ?>

		<div class="home-content-ad">
			<div class="ad-code">
				<?php echo get_option('smartblog_home_content_ad_code'); ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div><!--end .home-content-ad-->
		
	<?php } ?>
	
	<div class="clear"></div>

	<?php } ?>
							
	<div id="content-loop" class="<?php if(get_option('smartblog_content_layout') == 'Layout #1') { echo('layout1-content-loop'); }?>">

		<?php 
			$counter = 0;
			if( have_posts() ) : while( have_posts() ) : the_post();
		?>	
	
			<?php if( get_option('smartblog_content_layout') == 'Layout #2' ) { 
			
				include(TEMPLATEPATH. '/includes/templates/layout2-loop.php'); ?>
				
			<?php } elseif(get_option('smartblog_content_layout') == 'Layout #3') { 
			
				include(TEMPLATEPATH. '/includes/templates/layout3-loop.php'); ?>
				
			<?php } else { 
				include(TEMPLATEPATH. '/includes/templates/layout1-loop.php'); } ?>
	
			<?php
				if( $counter % 2 != 0 )
				echo'<div class="clear"> </div>';
				$counter++;
			?>
					 
		<?php endwhile; ?>
		
		<div class="clear"></div>
			
		<?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
			<div class="pagination">
			    <div class="newer"><?php previous_posts_link(__('Newer Entries', 'themejunkie')) ?></div>
			    <div class="older"><?php next_posts_link(__('Older Entries', 'themejunkie')) ?></div>
			    <div class="clear"></div>
			</div><!--end .pagination-->				    
		<?php } ?>
				
		<?php endif; wp_reset_query(); ?>
			
	<div class="clear"></div>
	
	</div><!--end #content-loop-->

</div><!--end #content-->

<?php get_sidebar(); ?> 

<?php get_footer(); ?>
