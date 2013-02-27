<?php

// Custom Menus
function register_main_menus() {
	register_nav_menus(
		array(
			'primary-nav' => __( 'Primary Nav' ),
			'secondary-nav' => __( 'Secondary Nav' ),
			'support-nav' => __( 'Support Nav' ),
			'company-nav' => __( 'Company Nav' ),
			'popular-pages-nav' => __( 'Popular Pages Nav' ),
			'website-usage-nav' => __( 'Website Usage Nav' )
		)
	);
}

if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

// Register and deregister Scripts files	
if(!is_admin()) {
	add_action( 'wp_print_scripts', 'my_deregister_scripts', 100 );
}
	
function my_deregister_scripts() {
		wp_deregister_script( 'jquery' );
		
		wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js', false, '1.6');
		//wp_enqueue_script('jquery', get_bloginfo('template_url').'/includes/js/jquery.min.js', false, '1.4.2');
		//wp_enqueue_script('jquery-superfish', get_bloginfo('template_url').'/includes/js/superfish.js', false, '1.4.2');
		//wp_enqueue_script('jquery-scrolltop', get_bloginfo('template_url').'/includes/js/scrolltop.js', false, '1.1');
		//wp_enqueue_script('jquery-tabber', get_bloginfo('template_url').'/includes/js/tabber.js', false, '1.4.2');	
		//wp_enqueue_script('jquery-custom', get_bloginfo('template_url').'/includes/js/custom.js', false, '1.4.2');				

		if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
}

// Get limit excerpt
function tj_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "...";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
   }
   else {
      echo "";
      echo $content;
   }
}

// Tabber: Get Most Popular Posts
function tj_tabs_popular( $posts = 5 ) {
	$popular = new WP_Query('orderby=comment_count&posts_per_page='.$posts);
	$popular_post_num = 1;
	while ($popular->have_posts()) : $popular->the_post();
?>
<li>
<div class="left">
<?php the_post_thumbnail('tabber-thumb', array('class' => 'tab-thumb')); ?>
<div class="clear"></div>
</div>
 	<div class="info">
 	<h3 class="entry-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
	</div> <!--end .info-->
	<div class="clear"></div>
</li>

<?php $popular_post_num++; endwhile; 
}

// Tabber: Get Recent Comments
function tj_tabs_comments( $posts = 5, $size = 35 ) {
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	comment_type,comment_author_url,
	SUBSTRING(comment_content,1,65) AS com_excerpt
	FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	$wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND
	post_password = ''
	ORDER BY comment_date_gmt DESC LIMIT ".$posts;
	
	$comments = $wpdb->get_results($sql);
	
	foreach ($comments as $comment) {
	?>
	<li>
		<?php echo get_avatar( $comment, $size ); ?>
	
		<h5 class="entry-title"><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php _e('on ', 'themejunkie'); ?> <?php echo $comment->post_title; ?>">
			<?php echo strip_tags($comment->comment_author); ?>: <?php echo strip_tags($comment->com_excerpt); ?>...
		</a></h5>
		<div class="clear"></div>
	</li>
	<?php 
	}
}

function tj_tabs_latest( $posts = 5 ) {
	$the_query = new WP_Query('showposts='. $posts .'&orderby=post_date&order=desc');
	$recent_post_num = 1;		
	while ($the_query->have_posts()) : $the_query->the_post(); 
?>
<li>
<div class="left">
<?php the_post_thumbnail('tabber-thumb', array('class' => 'tab-thumb')); ?>
<div class="clear"></div>
<div class="post-number"><?php echo $recent_post_num; ?></div>
</div>
 	<div class="info">
 	<h2 class="entry-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<div class="meta">
		<span class="meta-date"><abbr class="published" title="<?php the_time('g:i a'); ?>"><?php the_time(get_option('date_format')); ?></abbr></span>
		<span class="meta-comment"><?php comments_popup_link( __( '0', 'themejunkie' ), __( '1', 'themejunkie' ), __( '%', 'themejunkie' ) ); ?></span>
	</div> <!--end .entry-meta--> 	
	</div> <!--end .info-->
	<div class="clear"></div>
</li>

<?php $recent_post_num++; endwhile; 
}

function tj_related_posts() {
	global $post, $wpdb;
	$backup = $post;  // backup the current object
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
	  $tagcount = count($tags);
	  for ($i = 0; $i < $tagcount; $i++) {
	    $tagIDs[$i] = $tags[$i]->term_id;
	  }
	  
	  $args=array(
	    'tag__in' => $tagIDs,
	    'post__not_in' => array($post->ID),
	    'showposts'=>5,
	    'caller_get_posts'=>1
	  );
	  $my_query = new WP_Query($args);
	  if( $my_query->have_posts() ) { $related_post_found = true; ?>
		<h3><?php _e('Related Posts','themejunkie'); ?></h3>
		<div class="clear"></div>
			<ul>		
	    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<li>
					<a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
				</li>				
	    <?php endwhile; ?>
			</ul>		
	  <?php }
	}
	
	//show recent posts if no related found
	if(!$related_post_found){ ?>
		<h3><?php _e('Recent Posts','themejunkie'); ?></h3>
		<div class="clear"></div>		
		<ul>
		<?php
		$posts = get_posts('numberposts=5');
		foreach($posts as $post) { ?>
			<li>
				<a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			</li>
		<?php } ?>
		</ul>
		
		<?php 
	}
	wp_reset_query();
}


if ( !function_exists( 'tj_twitter_script') ) {
	function tj_twitter_script($unique_id,$username,$limit) {
	?>
	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	
	    function twitterCallback2(twitters) {
	    
	      var statusHTML = [];
	      for (var i=0; i<twitters.length; i++){
	        var username = twitters[i].user.screen_name;
	        var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
	          return '<a href="'+url+'">'+url+'</a>';
	        }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
	          return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
	        });
	        statusHTML.push( '<li><span class="content">'+status+'</span> <a style="font-size:85%" class="time" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>' );
	      }
	      document.getElementById( 'twitter_update_list_<?php echo $unique_id; ?>').innerHTML = statusHTML.join( '' );
	    }
	    
	    function relative_time(time_value) {
	      var values = time_value.split( " " );
	      time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
	      var parsed_date = Date.parse(time_value);
	      var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
	      var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
	      delta = delta + (relative_to.getTimezoneOffset() * 60);
	    
	      if (delta < 60) {
	        return 'less than a minute ago';
	      } else if(delta < 120) {
	        return 'about a minute ago';
	      } else if(delta < (60*60)) {
	        return (parseInt(delta / 60)).toString() + ' minutes ago';
	      } else if(delta < (120*60)) {
	        return 'about an hour ago';
	      } else if(delta < (24*60*60)) {
	        return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
	      } else if(delta < (48*60*60)) {
	        return '1 day ago';
	      } else {
	        return (parseInt(delta / 86400)).toString() + ' days ago';
	      }
	    }
	//-->!]]>
	</script>
	<script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $limit; ?>&amp;include_rts=t"></script>
	<?php
	}
}

?>
