<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>	
<div id="content" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">
<?php include(TEMPLATEPATH. '/includes/templates/breadcrumbs.php'); ?>
<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry">
		<ul>
<?php wp_list_bookmarks('title_li=&category_before=&category_after=&title_before=<h3>&title_after=</h3>'); ?>
		</ul>
		</div><!--end .entry-->
	</div><!--end #post-->
</div><!--end #content-->		
<?php get_sidebar(); ?>
<?php get_footer(); ?>