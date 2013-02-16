<?php
/**
 * Theme Junkie Social Widget
 */
 
class TJ_Widget_Social extends WP_Widget {

	function TJ_Widget_Social() {
		$widget_ops = array('classname' => 'widget_social', 'description' => __('Display Social Profiles'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('social', __('ThemeJunkie - Social'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$feedburner_id = $instance['feedburner_id'];
		$twitter_id = $instance['twitter_id'];
		$facebook_id = $instance['facebook_id'];
		$youtube_id = $instance['youtube_id'];		
		?>

	<div id="newsletter">

	<ul class="social">
		<li><a class="social-facebook" href="http://www.facebook.com/<?php echo $facebook_id; ?>" rel="nofollow" target="_blank"><?php _e('Facebook', 'themejunkie'); ?></a></li>
        <li><a class="social-twitter" href="http://twitter.com/<?php echo $twitter_id; ?>" rel="nofollow" target="_blank"><?php _e('Twitter', 'themejunkie'); ?></a></li>
			<li><a class="social-youtube" href="http://www.youtube.com/user/<?php echo $youtube_id; ?>"><?php _e('YouTube', 'themejunkie'); ?></a></li>
        <li class="last"><a class="social-feed" href="http://feeds.feedburner.com/<?php echo $feedburner_id; ?>" rel="nofollow" target="_blank"><?php _e('RSS feed', 'themejunkie'); ?></a></li>					
	</ul>

	<div class="clear"></div>
	
	<div class="newsletter">	
	 <h3 class="widget-title"><?php _e('E-mail Newsletter', 'themejunkie'); ?></h3>
	 <p><?php _e('Complete the form below, and we\'ll send you an e-mail every now and again with all latest news.', 'themejunkie'); ?></p>
	 
	 		<form class="newsletter-form" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner_id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<input class="email" type="text" name="email" value="E-mail" onfocus="if (this.value == 'E-mail') {this.value = '';}" onblur="if (this.value == '') {this.value = 'E-mail';}" />

				<input type="hidden" value="<?php echo $feedburner_id; ?>" name="uri"/>
				<input type="hidden" value="<?php echo $feedburner_id; ?>" name="title"/>
				<input type="hidden" name="loc" value="en_US"/>
				<input class="submit" type="submit" name="submit" value="Submit" />
			</form>
			<span><?php _e('', 'themejunkie'); ?> <a href="http://www.builtlean.com/email-rss/" target="_blank"><?php _e('More Info...', 'themejunkie'); ?></a></span>
		</div>			
	</div>	

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['feedburner_id'] = $new_instance['feedburner_id'];
		$instance['twitter_id'] =  $new_instance['twitter_id'];
		$instance['facebook_id'] =  $new_instance['facebook_id'];
		$instance['youtube_id'] =  $new_instance['youtube_id'];		
		return $instance;
	}

	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'feedburner_id' => 'themejunkie', 'twitter_id' => 'theme_junkie', 'facebook_id' => 'themejunkie', 'youtube_id' => 'themejunkie' ) );
		$feedburner_id = $instance['feedburner_id'];
		$twitter_id = format_to_edit($instance['twitter_id']);
		$facebook_id = format_to_edit($instance['facebook_id']);
		$youtube_id = format_to_edit($instance['youtube_id']);		
	?>
		<p><label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Enter your Feedburner ID:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Enter your Twitter ID:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $twitter_id; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Enter your Facebook ID:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" value="<?php echo $facebook_id; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('youtube_id'); ?>"><?php _e('Enter your YouTube ID:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('youtube_id'); ?>" value="<?php echo $youtube_id; ?>" /></p>		
		<?php }
}

register_widget('TJ_Widget_Social');

