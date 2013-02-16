<?php

/* sets predefined Post Thumbnail dimensions */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	
	//default thumbnail size
	add_image_size( 'featured-thumb', 596, 222, true );
	add_image_size( 'home-layout1-thumb', 273, 100, true );
	add_image_size( 'home-layout2-thumb', 596, 222, true );
	add_image_size( 'home-layout3-thumb', 150, 150, true );	
	add_image_size( 'tabber-thumb', 56, 56, true );
	
};

?>