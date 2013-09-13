<?php
/*
Template Name: Success_Stories
*/
get_header(); ?>
<link rel="stylesheet" type="text/css" href="http://www.builtlean.com/wp-content/themes/builtlean/js/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="js/lightbox/themes/default/jquery.lightbox.ie6.css" />
<![endif]-->
<script type="text/javascript" src="http://www.builtlean.com/wp-content/themes/builtlean/js/lightbox/jquery.lightbox.min.js"></script>
<div class="onecolumn">
	<div id="content">
		<?php the_content(); ?>
	</div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function($){
    $('.lightbox').lightbox();
  });
</script>
<?php get_footer(); ?>