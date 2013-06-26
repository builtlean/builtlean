<?php 
/* Template Name: Menu right */
get_header(); ?>
<style type="text/css">
		#breadcrumbs {
		 background: white;
		 font-family: 'Verdana', 'Geneva', 'Arial';
          }
		#breadcrumbs a { 
		 margin-right: 2px !important;
		 padding-right: 12px !important;
		 background: url(../../../../wp-content/themes/builtlean/images/bullet.png) no-repeat right 3px;
		  } 
	    #breadcrumbs a:last-child {
		 background: none !important;
		 padding-left: 0px !important;
		  }
</style>
<div id="content" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">
		
<?php the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry entry-content">
<?php the_content(); ?>
<?php
	$getTimeUpdate = get_post_custom($post->ID, 'show_update_time');
	if($getTimeUpdate['show_update_time'][0] == 'on'){
	echo '<i>Last modified: '.get_the_modified_time('F j, Y').'</i>';
	}
?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themejunkie' ), 'after' => '</div>' ) ); ?>
</div>
</div>
<?php if(get_option('smartblog_show_page_comments') == 'on') comments_template( '', true ); ?>
</div>
<?php if(is_page('12970') <> 1) get_sidebar('menu'); ?>
<?php get_footer(); ?>
