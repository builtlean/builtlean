<?php

// Translations can be filed in the /lang/ directory
load_theme_textdomain( 'themejunkie', TEMPLATEPATH . '/lang' );	

require_once(TEMPLATEPATH . '/includes/sidebar-init.php');
require_once(TEMPLATEPATH . '/includes/custom-functions.php'); 
require_once(TEMPLATEPATH . '/includes/post-thumbnails.php'); 

require_once(TEMPLATEPATH . '/includes/theme-options.php');
require_once(TEMPLATEPATH . '/includes/theme-comments.php'); 
require_once(TEMPLATEPATH . '/includes/theme-widgets.php');
require_once(TEMPLATEPATH . '/includes/widgets/widget-pop.php');

require_once(TEMPLATEPATH . '/functions/theme_functions.php'); 
require_once(TEMPLATEPATH . '/functions/admin_functions.php');

    function rarst_twitter_user( $username, $field, $display = false ) {
    $interval = 3600;
    $cache = get_option('rarst_twitter_user');
    $url = 'http://api.twitter.com/1/users/show.json?screen_name='.urlencode($username);

    if ( false == $cache )
    $cache = array();

    // if first time request add placeholder and force update
    if ( !isset( $cache[$username][$field] ) ) {
    $cache[$username][$field] = NULL;
    $cache[$username]['lastcheck'] = 0;
    }

    // if outdated
    if( $cache[$username]['lastcheck'] < (time()-$interval) ) {

    // holds decoded JSON data in memory
    static $memorycache;

    if ( isset($memorycache[$username]) ) {
    $data = $memorycache[$username];
    }
    else {
    $result = wp_remote_retrieve_body(wp_remote_request($url));
    $data = json_decode( $result );
    if ( is_object($data) )
    $memorycache[$username] = $data;
    }

    if ( is_object($data) ) {
    // update all fields, known to be requested
    foreach ($cache[$username] as $key => $value)
    if( isset($data->$key) )
    $cache[$username][$key] = $data->$key;

    $cache[$username]['lastcheck'] = time();
    }
    else {
    $cache[$username]['lastcheck'] = time()+60;
    }

    update_option( 'rarst_twitter_user', $cache );
    }

    if ( false != $display )
    echo $cache[$username][$field];
    return $cache[$username][$field];
    }


/*
remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );

function my_twentyten_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'my_twentyten_excerpt_length' );
*/

function get_excerpt(){

		$excerpt = get_the_excerpt();
	
	if($excerpt){
		
		$excerpt = get_the_excerpt();
		
		
		if(strlen($excerpt) > 160){
			$excerpt = substr($excerpt, 0, 160).'...';
		}
		
		//$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		//$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		//$excerpt = $excerpt.'...';
			
	}else{
		
		$excerpt = get_the_content();
		$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, 160);
		//$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		//$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
		$excerpt = $excerpt.'...';
	}		

	return $excerpt;
}


add_theme_support('post-thumbnails');
set_post_thumbnail_size( 300, 150, true );
add_image_size( 'post-home_thumb', 195, 160, true );
//add_image_size( 'small-home-thumb', 80, 55, true );




//add metabox for show update post time or not
function add_update_post_time_box(){
    add_meta_box("show_update_time", "Display last update time ?", 'show_update_post_time', "page", "normal", "high");
}
add_action('admin_menu', 'add_update_post_time_box');

//display metabox function
function show_update_post_time(){
	
	global $post;
	
	$current_show_update_time = get_post_meta($post->ID, "show_update_time", true);
	
	if($current_show_update_time == 'on'){
		
		$checked1 = 'checked ="checked"';
		$checked2 = '';
		
	} else {
		$checked1 = '';
		$checked2 = 'checked ="checked"';
	}
	
	echo '<input type="radio" '.$checked1.' name="show_update_time" value="on"/> Yes &nbsp;&nbsp;';
	echo '<input type="radio" '.$checked2.' name="show_update_time" value="off"/> No';
	echo '<input type="hidden" name="custom_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
}

//save post
function save_update_post_time($post_id) {
	
    // verify nonce
    if (!wp_verify_nonce($_POST['custom_nonce'], basename(__FILE__))) {
        return $post_id;
    }
 
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
 
    // check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
	
	$old_show_update_time = get_post_meta($post_id, "show_update_time", true);
	$new_show_update_time = $_POST['show_update_time'];
	
	if ($new_show_update_time && $new_show_update_time != $old_show_update_time){
        update_post_meta($post_id, "show_update_time", $new_show_update_time);
    } elseif ($new_show_update_time == ""){
        delete_post_meta($post_id, "show_update_time", $new_show_update_time);
    }
}
add_action('save_post', 'save_update_post_time');





function most_popular_posts($no_posts = 5, $before = '<li>', $after = '</li>', $show_pass_post = false, $duration='') {
global $wpdb;
$request = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
if(!$show_pass_post) $request .= " AND post_password =''";
if($duration !="") { $request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
}
$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
$posts = $wpdb->get_results($request);
$output = '';
if ($posts) {
foreach ($posts as $post) {
$post_title = stripslashes($post->post_title);
$comment_count = $post->comment_count;
$permalink = get_permalink($post->ID);
$output .= $before . '<a href="' . $permalink . '" title="' . $post_title.'">' . $post_title . '</a>' . $after;
}
} else {
$output .= $before . "None found" . $after;
}
echo $output;
} ?>
<?php
if ( function_exists('register_sidebars') )
register_sidebars(2);
?>
<?php 
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );


//extra profile fields

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );



function my_show_extra_profile_fields($user) { 

function get_user_role($id=null){
	global $current_user;
	
	if(!$id) $id = $current_user->ID;
	
	if ( is_user_logged_in() ) {
		$user = new WP_User( $id );
		
		if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
			foreach ( $user->roles as $role ){
			 return $role;
			}
		}
	}
}
    

	$fullName = get_the_author_meta( 'fullname', $user->ID ) == '' ? get_the_author_meta( 'nickname', $user->ID ) : get_the_author_meta( 'fullname', $user->ID );
	$customRole = get_the_author_meta( 'customrole', $user->ID ) == '' ? get_user_role($user->ID) : get_the_author_meta( 'customrole', $user->ID );
	$website = get_the_author_meta( 'homepage', $user->ID ) == '' ? get_the_author_meta( 'user_url', $user->ID ) : get_the_author_meta( 'homepage', $user->ID );
	$googlePlus = get_the_author_meta( 'google', $user->ID ) == '' ? get_the_author_meta( 'googleplus', $user->ID ) : get_the_author_meta( 'google', $user->ID );

?>

    <h3>Custom profile information</h3> 

    <table class="form-table">
        <tr>
            <th><label for="full-name">Full name</label></th>

            <td>
                <input type="text" name="fullname" id="full-name" value="<?php echo $fullName; ?>" class="regular-text" /><br />
            </td>
        </tr>

        <tr>
            <th><label for="designations">Designations</label></th>

            <td>
               <input type="text" name="designations" id="designations" value="<?php echo esc_attr( get_the_author_meta( 'designations', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>

        <tr>
            <th><label for="custom-role">Role</label></th>

            <td>
                <input type="text" name="customrole" id="custom-role" value="<?php echo $customRole; ?>" class="regular-text" /><br />
            </td>
        </tr>          

        <tr>
            <th><label for="facebook">Facebook</label></th>

            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>

        <tr>
            <th><label for="twitter">Twitter</label></th>

            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>

        <tr>
            <th><label for="youtube">Youtube</label></th>

            <td>
                <input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>

        <tr>
            <th><label for="google">Google+</label></th>

            <td>
                <input type="text" name="google" id="google" value="<?php echo $googlePlus; ?>" class="regular-text" /><br />
            </td>
        </tr>

        <tr>
            <th><label for="linkedin">LinkedIn</label></th>

            <td>
                <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>

        <tr>
            <th><label for="homepage">Personal website</label></th>

            <td>
                <input type="text" name="homepage" id="homepage" value="<?php echo $website; ?>" class="regular-text" /><br />
            </td>
        </tr>   

    </table>

<?php 
}

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    update_usermeta($user_id, 'fullname', $_POST['fullname']);
    update_usermeta($user_id, 'designations', $_POST['designations']);
    update_usermeta($user_id, 'customrole', $_POST['customrole']);
    update_usermeta($user_id, 'facebook', $_POST['facebook']);
    update_usermeta($user_id, 'twitter', $_POST['twitter']);
    update_usermeta($user_id, 'youtube', $_POST['youtube']);
    update_usermeta($user_id, 'google', $_POST['google']);
    update_usermeta($user_id, 'linkedin', $_POST['linkedin']);
    update_usermeta($user_id, 'homepage', $_POST['homepage']);
}


function pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

function dimox_breadcrumbs() {
 
  /* === OPTIONS === */
  $text['home']     = 'Home'; // text for the 'Home' link
  $text['category'] = 'Archive by Category "%s"'; // text for a category page
  $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
  $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
  $text['author']   = 'Articles Posted by %s'; // text for an author page
  $text['404']      = 'Error 404'; // text for the 404 page
 
  $showCurrent = 0; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter   = ' '; // delimiter between crumbs
  $before      = '<span class="current">'; // tag before the current crumb
  $after       = '</span>'; // tag after the current crumb
  /* === END OF OPTIONS === */
 
  global $post;
  $homeLink = get_bloginfo('url') . '/';
  $linkBefore = '';
  $linkAfter = ' ';
  $linkAttr = ' rel="v:url" property="v:title"';
  $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s" style="padding-right: 13px !important;margin-right: 2px !important;">%2$s</a>' . $linkAfter;
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '" style="padding-right: 13px !important; margin-right: 2px !important;">' . $text['home'] . '</a></div>';
 
  } else {
 
    echo '<div id="breadcrumbs2" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
	echo '<a style="padding-right: 13px !important; margin-right: 7px !important;" href="' . $homeLink . 'blog">Blog</a>';
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
        $cats = str_replace('<a style="padding-right: 13px !important; margin-right: 2px !important;"', $linkBefore . '<a style="padding-right: 13px !important; margin-right: 2px !important;"' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
      }
      echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
 
    } elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;
 
    } elseif ( is_day() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); 
        $cat = $cat[0]; 
       
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a style="padding-right: 13px !important; margin-right: 2px !important;"', $linkBefore . '<a style="padding-right: 13px !important; margin-right: 2px !important;"' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
       echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      $cats = get_category_parents($cat, TRUE, $delimiter);
      $cats = str_replace('<a style="padding-right: 13px !important; margin-right: 2px !important;"', $linkBefore . '<a style="padding-right: 13px !important; margin-right: 2px !important;"' . $linkAttr, $cats);
      $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
      echo $cats;
      printf($link, get_permalink($parent), $parent->post_title);
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo $delimiter;
      }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;
 
    } elseif ( is_404() ) {
      echo $before . $text['404'] . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end dimox_breadcrumbs()



// Disables Kses only for textarea saves
foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
	remove_filter($filter, 'wp_filter_kses');
}

// Disables Kses only for textarea admin displays
foreach (array('term_description', 'link_description', 'link_notes', 'user_description') as $filter) {
	remove_filter($filter, 'wp_kses_data');
}




?>
