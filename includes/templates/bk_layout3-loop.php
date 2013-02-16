<div class="layout3-entry">
<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('home-layout3-thumb', array('class' => 'entry-thumb')); ?></a>

	<div class="layout3-entry-wrap">	
	

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	
		<div class="entry-meta">
			<div class="author-gravatar">
				<?php echo get_avatar( get_the_author_email(), '35' ); ?>
			</div>
			<?php _e('by ', 'themejunkie'); ?> <?php the_author_posts_link(); ?> <span class="meta-sep">|</span> <?php _e('', 'themejunkie'); ?> <span class="meta-date"><abbr class="published" title="<?php the_time('g:i a'); ?>"><?php the_time(get_option('date_format')); ?></abbr> | </span> <span class="meta-date"><?php if( get_the_modified_date() != get_the_date()) echo ' Updated: ' . get_the_modified_date() . ' | '; ?></span>
            
            <span class="entry-comment">
				<?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?>
			</span>
            
                     
     
		</div> <!--end .entry-meta-->
        
		    		<div class="clear"></div>		

		<div class="entry-excerpt">    
		<?php the_content("Continue Reading " . the_title('', '', false)); ?>      
		</div><!--end .entry-excerpt-->		
		<div class="clear"></div>		
	</div><!--end .layout3-entry-wrap-->		
	<div class="clear"></div>		
</div><!--end .layout2-entry-->