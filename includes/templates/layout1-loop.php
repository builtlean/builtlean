<div class="layout1-entry <?php if($counter % 2 != 0 ) echo 'entry-even'; ?>">
	
	<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('home-layout1-thumb', array('class' => 'entry-thumb')); ?></a>

	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themejunkie' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<div class="entry-meta">
		<?php _e('by ', 'themejunkie'); ?> <?php the_author_posts_link(); ?> <span class="meta-sep">|</span> <?php _e('posted:', 'themejunkie'); ?> <span class="meta-date"><abbr class="published" title="<?php the_time('g:i a'); ?>"><?php the_time(get_option('date_format')); ?></abbr></span>
	</div> <!--end .entry-meta-->
	
	<div class="entry-excerpt">
		<?php tj_content_limit('200'); ?>
	</div><!--end .entry-excerpt-->

	<div class="entry-extra">

		<?php if(get_option('smartblog_retweet_button_enable') == 'on') { ?>

			<span class="left"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-text="<?php the_title();?>" data-url="<?php the_permalink();?>"><?php _e('Tweet','themejunkie'); ?></a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></span>

		<?php } else { ?>

			<a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Continue Reading', 'themejunkie'); ?></a>

		<?php } ?>

		<span class="entry-comment"><?php comments_popup_link( __( '0 comment', 'themejunkie' ), __( '1 comment', 'themejunkie' ), __( '% comments', 'themejunkie' ) ); ?></span>

		<div class="clear"></div>
	
	</div><!--end .entry-extra-->
	
	<div class="clear"></div>

</div><!--end .layout1-entry-->