<?php
	/*
	Template Name: Landing Page Narrow
	*/

?>
<?php include(TEMPLATEPATH.'/header_landing_narrow.php'); ?>
	<div class="onecolumn">		
	<div id="content_alt" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">	
<?php the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>
	</div><!--end .entry-->
	</div><!--end #post-->
</div><!--end #content-->
</div><!--end .onecolumn-->
<?php include(TEMPLATEPATH.'/footer-landing-page_narrow.php'); ?>
