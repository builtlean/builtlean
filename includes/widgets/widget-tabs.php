<?php
/**
 * Theme Junkie Tabs Widget
 */
 
class TJ_Widget_Tabs extends WP_Widget {

	function TJ_Widget_Tabs() {
		$widget_ops = array('classname' => 'widget_tab', 'description' => __('Display an Ajax tabber with Popular Posts and Latest Posts'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('tab', __('ThemeJunkie - Tabs'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$popular_post_num = $instance['popular_post_num'];
		$recent_comment_num = $instance['recent_comment_num'];
		$avatar_size = $instance['avatar_size'];
		?>

	<div id="tabber">
			
		<ul class="tabs">
			<li><a href="#popular-posts"><?php _e('Popular', 'themejunkie'); ?></a></li>
			<li><a href="#categories"><?php _e('Categories', 'themejunkie'); ?></a></li>
			<li><a href="#recent-comments"><?php _e('Comments', 'themejunkie'); ?></a></li>
		</ul> <!--end .tabs-->
			
		<div class="clear"></div>
		
		<div class="inside">
		
			<div id="popular-posts">
				<ul>
					<?php rewind_posts(); ?>
					<?php tj_tabs_popular($popular_post_num); ?>
				</ul>			
		    </div> <!--end #popular-posts-->
		       
		    <div id="categories"> 
		        <ul>
					<?php
$args=array(
  'orderby' => 'id',
  'order' => 'ASC'
  );
$categories=get_categories($args);
  foreach($categories as $category) { 
    echo '<li><h5 class="entry-title"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a></h5></li>';
      } 
?> 
				</ul>	
		    </div> <!--end #rcategories-->
			
			<div id="recent-comments"> 
			<ul>
		       <?php tj_tabs_comments($recent_comment_num, $avatar_size); ?>   
						</ul>
		    </div> <!--end #recent-comments-->
				
				<div id="tag-cloud"> 
		        <?php wp_tag_cloud('smallest=12&largest=20'); ?>
		    </div> <!--end #tags-->
			
			<div class="clear"></div>
			
		</div> <!--end .inside -->
		
		<div class="clear"></div>
		
	</div><!--end #tabber -->

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['popular_post_num'] = $new_instance['popular_post_num'];
		$instance['recent_comment_num'] =  $new_instance['recent_comment_num'];
		$instance['avatar_size'] =  $new_instance['avatar_size'];
		return $instance;
	}

	function form( $instance ) { 
		$instance = wp_parse_args( (array) $instance, array( 'popular_post_num' => '5', 'recent_comment_num' => '5', 'avatar_size' => '42' ) );
		$popular_post_num = $instance['popular_post_num'];
		$recent_comment_num = format_to_edit($instance['recent_comment_num']);
		$avatar_size = format_to_edit($instance['avatar_size']);
	?>
		<p><label for="<?php echo $this->get_field_id('popular_post_num'); ?>"><?php _e('Number of popular posts to show::'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('popular_post_num'); ?>" name="<?php echo $this->get_field_name('popular_post_num'); ?>" type="text" value="<?php echo $popular_post_num; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('recent_comment_num'); ?>"><?php _e('Number of recent comments to show:'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('recent_comment_num'); ?>" name="<?php echo $this->get_field_name('recent_comment_num'); ?>" value="<?php echo $recent_comment_num; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('Avatar size: e.g. 42'); ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id('avatar_size'); ?>" name="<?php echo $this->get_field_name('avatar_size'); ?>" value="<?php echo $avatar_size; ?>" /></p>

	<?php }
}

register_widget('TJ_Widget_Tabs');

?>