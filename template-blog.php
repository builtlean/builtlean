<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

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
</div>

<div id="the_builtlean_report"></div>

<div class="clear"></div>

<div id="content_home" class="<?php if(get_option('smartblog_homepage_layout') == 'Content | Sidebar') { echo('left'); } else { echo('right'); } ?>">

							
	<div id="content-loop" class="<?php if(get_option('smartblog_content_layout') == 'Layout #1') { echo('layout1-content-loop'); }?>">
		<?php 
		
		$thisCat = get_category(41);
		
		echo '<h1 class="title_list">'.$thisCat->name.'</h1>';
		echo '<p>'.$thisCat->category_description.'</p>';
                
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
			query_posts( array(
				'orderby' => 'date', 
				'order' => 'DESC',
                                'paged' => $paged
			) );
			$counter = 0;
			if( have_posts() ) : while( have_posts() ) : the_post();
		?>	
	
			<div class="layout3-entry">
				<div class="layout3-entry-wrap">	
						<?php
						
							$content = get_excerpt();
						
							$args = array(
								'post_type' => 'attachment',
								'numberposts' => 1,
								'post_status' => null,
								'post_parent' => $post->ID
							  );

							  $attachments = get_posts( $args );
						?>
								 
						<div class="thumb-img">
							<?php
							
							if (has_post_thumbnail()) { ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-home_thumb'); ?></a>
								
						<?php	}else if ( $attachments ) {
								
								foreach ( $attachments as $attachment ){
									echo '<a href="'. the_permalink() .'">'. wp_get_attachment_image( $attachment->ID, "post-home_thumb" ).'</a>';
								}
							}else{
				
								echo '<a href="'. the_permalink().'"><img id="img" src="'.get_bloginfo("template_directory").'/images/no_photo.jpg" /></a>';
							}
							
							
							
							?>

					   </div>
					 
						
					<div class="excerpt-content">			
						
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						
							<div class="entry-meta">
					
								<?php _e('by ', 'themejunkie'); ?> <?php the_author_posts_link(); ?> <span class="meta-sep">|</span> <?php _e('', 'themejunkie'); ?> <span class="meta-date"><abbr class="published" title="<?php the_time('g:i a'); ?>"><?php the_time(get_option('date_format')); ?></abbr> | </span>
								
							 <span class="entry-comment">
									<?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?>
								</span>         
						 
							</div> <!--end .entry-meta-->
							
							<div class="clear" style="height: 0px;"></div>		
					
							<div class="entry-excerpt">
								<?php echo $content; ?>
							
								<div class="share_icons">
									<div class="fb-like" data-href="<?php echo get_permalink();?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div> 
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink();?>" data-text="<?php echo $post->post_title;?>">Tweet</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>					
									<div class="clear"></div>
								</div>
							</div><!--end .entry-excerpt-->
					</div>
						
					<div class="clear" style="height: 0px;"></div>		
				</div><!--end .layout3-entry-wrap-->		
				<div class="clear" style="height: 0px;"></div>		
			</div><!--end .layout2-entry-->

	
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

