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
					<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('post-home_thumb'); ?></a>
					
				<?php }else if ( $attachments ) {
					
					foreach ( $attachments as $attachment ){
						echo '<a href="'. the_permalink() .'">'. wp_get_attachment_image( $attachment->ID, 'post-home_thumb' ).'</a>';
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
					</div>
				</div><!--end .entry-excerpt-->
		</div>
			
		<div class="clear" style="height: 0px;"></div>		
	</div><!--end .layout3-entry-wrap-->		
	<div class="clear" style="height: 0px;"></div>		
</div><!--end .layout2-entry-->
