<?php get_header(); ?>
	
<div id="content" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">
	
	<?php include(TEMPLATEPATH. '/includes/templates/breadcrumbs.php'); ?>
		
	<div id="content-loop" class="<?php if(get_option('smartblog_content_layout') == 'Layout #1') { echo('layout1-content-loop'); }?>">

		<?php
	
			rewind_posts();
			if (have_posts()) {
				while (have_posts()) : the_post();
				global $post; 
			?>
			
			<?php if( get_option('smartblog_content_layout') == 'Layout #2' ) { 
			
				include(TEMPLATEPATH. '/includes/templates/layout2-loop.php'); ?>
				
			<?php } elseif(get_option('smartblog_content_layout') == 'Layout #3') { 
			
				include(TEMPLATEPATH. '/includes/templates/layout3-loop.php'); ?>
				
			<?php } else { 
				include(TEMPLATEPATH. '/includes/templates/layout1-loop.php'); } ?>	
		
		<?php
			$postcount++;
			endwhile;
	
			} else { 
				include(TEMPLATEPATH. '/includes/templates/not-found.php'); 
			}
		?>
		
		<?php wp_reset_query(); ?>
			
	<div class="clear"></div>
	
	</div><!--end #content-loop-->
	
	<div class="clear"></div>

	<?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
		<div class="pagination">
		    <div class="newer"><?php previous_posts_link(__('Newer Entries', 'themejunkie')) ?></div>
		    <div class="older"><?php next_posts_link(__('Older Entries', 'themejunkie')) ?></div>
		    <div class="clear"></div>
		</div><!--end .pagination-->				    
	<?php } ?>

</div><!--end #content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>