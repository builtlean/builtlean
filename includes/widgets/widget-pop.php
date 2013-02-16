<?php
/**
 * Theme Junkie Tabs Widget
 */
 
class TJ_Widget_Pop extends WP_Widget {

	function TJ_Widget_Pop() {
		$widget_ops = array('classname' => 'widget_tab', 'description' => __('Display Popular Posts'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('popular', __('ThemeJunkie - Popular posts'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$popular_post_num = $instance['popular_post_num'];
		$recent_comment_num = $instance['recent_comment_num'];
		$avatar_size = $instance['avatar_size'];
		
		if(is_single()){
	?>
		
		<h2 class="title_list" style="padding: 0;">Popular Posts</h2>
		<div id="tabber" class="pop">
			<div class="inside">
				<div>
					<ul>
						<?php rewind_posts(); ?>
						<?php tj_tabs_popular($popular_post_num); ?>
					</ul>			
			    </div> <!--end #popular-posts-->
				
				<div class="clear"></div>
				
			</div> <!--end .inside -->
			
			<div class="clear"></div>
			
		</div><!--end #tabber -->
	
			<?php
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['popular_post_num'] = $new_instance['popular_post_num'];
		//$instance['recent_comment_num'] =  $new_instance['recent_comment_num'];
		$instance['avatar_size'] =  $new_instance['avatar_size'];
		return $instance;
	}

	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'popular_post_num' => '5', 'recent_comment_num' => '5', 'avatar_size' => '42' ) );
		$popular_post_num = $instance['popular_post_num'];
		//$recent_comment_num = format_to_edit($instance['recent_comment_num']);
		$avatar_size = format_to_edit($instance['avatar_size']);
	?>
		<p><label for="<?php echo $this->get_field_id('popular_post_num'); ?>"><?php _e('Number of popular posts to show:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('popular_post_num'); ?>" name="<?php echo $this->get_field_name('popular_post_num'); ?>" type="text" value="<?php echo $popular_post_num; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('Avatar size: e.g. 42'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('avatar_size'); ?>" name="<?php echo $this->get_field_name('avatar_size'); ?>" value="<?php echo $avatar_size; ?>" /></p>

	<?php }
}

register_widget('TJ_Widget_Pop');

?>