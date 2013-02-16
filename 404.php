<?php get_header(); ?>

<div id="content" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">

	<div id="breadcrumbs">
		<a href="<?php bloginfo('url'); ?>"><?php _e('Home','themejunkie') ?></a> <?php _e('404 Not found','themejunkie') ?>
	</div><!--end #breadcrumbs-->
			
	<?php the_post(); ?>
		
	<div id="post-<?php the_ID(); ?>" class="hentry post error404 not-found">
		
		<h1 class="page-title"><?php _e('404! We couldn\'t find the page!','themejunkie') ?></h1>
			
		<div class="entry entry-content">
			
			<p><?php _e('The page you\'ve requested <strong>can not be displayed</strong>. It appears you\'ve missed your intended destination, either through a bad or outdated link, or a typo in the page you were hoping to reach.','themejunkie') ?></p>
						
		</div><!--end .entry-->
		
	</div><!--end #post-->
			
</div><!--end #content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
