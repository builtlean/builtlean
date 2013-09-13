<?php get_header(); ?>
			<div id="content" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">
		<?php include(TEMPLATEPATH. '/includes/templates/breadcrumbs.php'); ?>
		<?php if(get_option('smartblog_show_author_box') == 'on') { ?> 
		<?php
			$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
			//print_r($curauth);
    ?>
<!-- author avatar div -->
    <div class="author-details">
    <div class="author-details-top">
    <div class="author-avatar">
		<?php echo get_avatar($curauth->user_email, '140', $avatar); ?>
	</div> 
<!--end .author-avatar-->
	<div class="author-name">
		<?php if (get_the_author_meta('fullname', $curauth->id)) { ?>
		<h2><?php echo get_the_author_meta('fullname', $curauth->id); ?></h2>
		<?php }?>
		<?php if (get_the_author_meta('designations', $curauth->id)) { ?>
		<span><?php echo get_the_author_meta('designations', $curauth->id); ?></span>
		<?php }?>
		<?php if (get_the_author_meta('customrole', $curauth->id)) { ?>
		<h3><?php echo get_the_author_meta('customrole', $curauth->id); ?></h3>
		<?php }?>
	</div>
	</div>
    <div class="author-desc">
    <p>
    <?php echo $curauth->user_description; ?>
    </p>
    </div>
    <div class="author-links">
    <h4>Connect with <?php echo $curauth->first_name; ?></h4>
		<?php if (get_the_author_meta('facebook', $curauth->id)) { ?>
			<a href="<?php echo get_the_author_meta('facebook', $curauth->id); ?>" class="author-lnk icon-facebook" target="_blank"><!-- --></a>
		<?php }	?>			
		<?php if (get_the_author_meta('twitter', $curauth->id)) { ?>
			<a href="<?php echo get_the_author_meta('twitter', $curauth->id); ?>" class="author-lnk icon-twitter" target="_blank"><!-- --></a>
		<?php }	?>
		<?php if (get_the_author_meta('youtube', $curauth->id)) { ?>
			<a href="<?php echo get_the_author_meta('youtube', $curauth->id); ?>" class="author-lnk icon-youtube" target="_blank"><!-- --></a>
		<?php }	?>
		<?php if (get_the_author_meta('google', $curauth->id))  { ?>
			<a href="<?php echo get_the_author_meta('google', $curauth->id); ?>" class="author-lnk icon-google" target="_blank"><!-- --></a>
		<?php }	?>
		<?php if (get_the_author_meta('linkedin', $curauth->id)) { ?>
			<a href="<?php echo get_the_author_meta('linkedin', $curauth->id); ?>" class="author-lnk icon-linkedin" target="_blank"><!-- --></a>
		<?php }?>
		<?php if (get_the_author_meta('homepage', $curauth->id)) { ?>
			<a href="<?php echo get_the_author_meta('homepage', $curauth->id); ?>" class="author-lnk icon-homepage" target="_blank"><!-- --></a>
		<?php }?>		
    </div>
    </div>
		<?php } ?>
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
		<?php
				wp_reset_query(); ?>
			
	<div class="clear"></div>
	</div>
<!--end #content-loop-->
	<div class="clear"></div>
	<?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
			<div class="pagination">
		    <div class="newer"><?php previous_posts_link(__('Newer Entries', 'themejunkie')) ?></div>
		    <div class="older"><?php next_posts_link(__('Older Entries', 'themejunkie')) ?></div>
		    <div class="clear"></div>
			</div>
<!--end .pagination-->				    
	<?php } ?>
			
</div>
<!--end #content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>