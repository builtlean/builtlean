<?php
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
	//////////////////////////////////
	//Twitter user
	//////////////////////////////////	
		function rarst_twitter_user( $username, $field, $display = false ) {
			$interval = 3600;
			$cache = get_option('rarst_twitter_user');
			$url = 'http://api.twitter.com/1/users/show.json?screen_name='.urlencode($username);
			if ( false == $cache )
			$cache = array();
			if ( !isset( $cache[$username][$field] ) ) {
			$cache[$username][$field] = NULL;
			$cache[$username]['lastcheck'] = 0;
			}
			if( $cache[$username]['lastcheck'] < (time()-$interval) ) {
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
		class My_Walker_Nav_Menu extends Walker_Nav_Menu {
					function start_lvl(&$output, $depth) {
						$indent = str_repeat("\t", $depth);
						$output .= "\n$indent<ul class=\"sub-menu1\">\n";
				}	
			}
	//////////////////////////////////
	//The excerpt function
	//////////////////////////////////		
	function get_excerpt(){
			$excerpt = get_the_excerpt();
		if($excerpt){
			$excerpt = get_the_excerpt();
		if(strlen($excerpt) > 160){
			$excerpt = substr($excerpt, 0, 160).'...';
		}
		}else{			
			$excerpt = get_the_content();
			$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
			$excerpt = strip_shortcodes($excerpt);
			$excerpt = strip_tags($excerpt);
			$excerpt = substr($excerpt, 0, 160);
			$excerpt = $excerpt.'...';
		}		
	return $excerpt;
		}
			add_theme_support('post-thumbnails');
			set_post_thumbnail_size( 300, 150, true );
			add_image_size( 'post-home_thumb', 195, 160, true );
			add_image_size( 'square_thumb', 150, 150, true );
			add_image_size( 'tab-thumb', 56, 56, true );
	////////////////////////////////
	//Update post time box
	//////////////////////////////
function add_update_post_time_box(){
		 add_meta_box("show_update_time", "Display last update time ?", 'show_update_post_time', "page", "normal", "high");
	  }
		 add_action('admin_menu', 'add_update_post_time_box');
	////////////////////////////////
	//Update time post show
	///////////////////////////////		
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
	/////////////////////////////
	//Save update post time
	/////////////////////////////
	function save_update_post_time($post_id) {
		if (!wp_verify_nonce($_POST['custom_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
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
	////////////////////////////////////////
	// Popular posts
	///////////////////////////////////////
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
		}
		if ( function_exists('register_sidebars') )
		register_sidebars(2); 
///////////////////////////////////
//Home page Menu args
////////////////////////////////////		
function home_page_menu_args( $args ) {
		$args['show_home'] = true;
	return $args;
	}
		add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
		add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
		add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
//////////////////////////////////
//Extra profile
//////////////////////////////////	
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
/////////////////////////////////////////
// My extra profile fields
////////////////////////////////////////
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
//function pagination($pages = '', $range = 4)
//	{  
//		$showitems = ($range * 2)+1;  
//		global $paged;
//		if(empty($paged)) $paged = 1;
//	if($pages == '') {		
//        global $wp_query;
//         $pages = $wp_query->max_num_pages;
//         if(!$pages)
//    {
//         $pages = 1;
//         }
//     }   
//		 if(1 != $pages)
//     {
//         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
//         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
//         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
//         for ($i=1; $i <= $pages; $i++)
//         {
//             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
//             {
//                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
//             }
//         }
//         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
//         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
//         echo "</div>\n";
//     }
//}
//////////////////////////////////
//The breadcrumbs menu
//////////////////////////////////	
function dimox_breadcrumbs() {
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
} 
// Disables Kses only for textarea saves
foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter) {
	remove_filter($filter, 'wp_filter_kses');
}
// Disables Kses only for textarea admin displays
foreach (array('term_description', 'link_description', 'link_notes', 'user_description') as $filter) {
	remove_filter($filter, 'wp_kses_data');
}
//[infusions_of]
function infusions_of_func( $atts ){
$form = '<form id="orderForm" action="https://builtlean.infusionsoft.com/AddForms/processFormSecure.jsp" method="post" name="orderForm" style="height: 1010px;"><input id="type" type="hidden" name="type" value="CustomFormSale" /><input id="processor" type="hidden" name="processor" value="com.infusion.crm.modules.accounting.cart.saleform.SaleFormProcess" /><input id="CopySubject" type="hidden" name="CopySubject" value="New BuiltLean Program order" /><input id="MerchantAccountId" type="hidden" name="MerchantAccountId" value="3" /><input id="ProductId" type="hidden" name="ProductId" value="5" /><input id="AllowDups" type="hidden" name="AllowDups" value="no" /><input id="CopyAddresses" type="hidden" name="CopyAddresses" value="" /><input id="DoShipping" type="hidden" name="DoShipping" value="false" /><input id="ID" type="hidden" name="ID" value="3" /><input id="formid" type="hidden" name="formid" value="3" /><input id="as" type="hidden" name="as" value="0" /><input id="PType" type="hidden" name="PType" value="A" /><input id="PurchaseType" type="hidden" name="PurchaseType" value="A" /><input id="Contact0_ccexpiredate" type="hidden" name="Contact0_ccexpiredate" />
			<div id="header">
				<div id="CUSTOM_HTML"></div>
				<div id="IMAGE">
				<div id="companyLogoTopBanner"><img alt="Built Lean" src="/wp-content/themes/builtlean/images/builtleanlogo.jpg" /></div>
			</div>
				</div>
			<div class="clear"></div>
			<div id="content">
			<div id="ORDER_FORM_PRODUCT_LIST">
				<table class="viewCart tabular grid">
					<tbody>
			<tr>
			<th class="leftAlign">Products</th>
				<th></th>
		<th class="rightAlign priceCell">Price</th>
		<th class="centerAlign qtyCell">Quantity</th>
		<th class="rightAlign priceCell">Total</th>
						</tr>
						<tr>
							<td class="productCell" colspan="2">
								<h1><img style="float: left;" alt="" src="/wp-content/themes/builtlean/images/blpkg.jpg" width="98" height="60" />BuiltLean Program</h1>
								<p class="productDescription">8-Week Body Transformation Program</p>
							</td>
							<td class="rightAlign priceCell"><span class="price">$147.00</span></td>
							<td class="centerAlign qtyCell"><span class="qty">1</span></td>
							<td class="rightAlign priceCell">$147.00</td>
						</tr>
						<tr class="subtotal">
							<td class="leftAlign"><span class="totalPrice">Subtotal</span></td>
							<td colspan="2"></td>
							<td class="qtyCell"></td>
							<td class="rightAlign priceCell"><span class="priceBold">$147.00</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="clear"></div>
							<div id="CUSTOM_HTML"></div>
							<div id="UP_SELLS"></div>
							<div id="ORDER_FORM_BILLING_ENTRY">
								<div id="orderFormBillingEntry">
									<table class="billingTable tabular grid">
										<tbody>
											<tr>
												<th class="leftAlign" colspan="2">Billing Information</th>
											</tr>
											<tr>
												<td class="rightAlignTop"><label class="checkoutLabel">* First Name</label></td>
												<td><input class="regula-validation checkoutTop" id="Contact0FirstName" type="text" name="Contact0FirstName" size="10" data-constraints="@Required(label=&quot;First Name&quot;, groups=[customer])" /></td>
											</tr>
											<tr>
												<td class="rightAlign"><label class="checkoutLabel">* Last Name</label></td>
												<td><input class="regula-validation checkout" id="Contact0LastName" type="text" name="Contact0LastName" size="12" data-constraints="@Required(label=&quot;Last Name&quot;, groups=[customer])" /></td>
											</tr>
											<tr>
												<td class="rightAlign"><label class="checkoutLabel">Company Name </label></td>
												<td><input class="checkout" id="Contact0Company" type="text" name="Contact0Company" size="25" /></td>
											</tr>
											<tr>
												<td class="rightAlign"><label class="checkoutLabel">* Address - Line 1</label></td>
												<td><input class="regula-validation checkout" id="Contact0StreetAddress1" type="text" name="Contact0StreetAddress1" size="25" data-constraints="@Required(label=&quot;Address - Line 1&quot;, groups=[customer])" /></td>
											</tr>
											<tr>
												<td class="rightAlign"><label class="checkoutLabel">Address - Line 2</label></td>
												<td><input class="checkout" id="Contact0StreetAddress2" type="text" name="Contact0StreetAddress2" size="25" /></td>
											</tr>
											<tr>
												<td class="rightAlign"><label class="checkoutLabel">* City</label></td>
												<td><input class="regula-validation checkout" id="Contact0City" type="text" name="Contact0City" size="15" data-constraints="@Required(label=&quot;City&quot;, groups=[customer])" /></td>
											</tr>
											<tr>
												<td class="rightAlign">
													<div id="stateRequired">* State</div>
												</td>
												<td><input class="regula-validation checkout" id="Contact0State" type="text" name="Contact0State" size="2" data-constraints="@StateRequiredForSpecificCountries(countryFieldName=&quot;country&quot;, label=&quot;State&quot;, groups=[customer])" /></td>
											</tr>
											<tr>
												<td class="rightAlign"><label class="checkoutLabel">* Zip Code</label></td>
												<td><input class="regula-validation checkoutShortest" id="Contact0PostalCode" type="text" name="Contact0PostalCode" size="5" data-constraints="@Required(label=&quot;Zip Code&quot;, groups=[customer])" /></td>
											</tr>
											<tr>
												<td class="rightAlign"><label class="checkoutLabel">* Country</label></td>
												<td><select class="regula-validation checkout" id="Contact0Country" name="Contact0Country" data-constraints="@Required(label=&quot;Billing Country&quot;, groups=[customer])" data-on="Component.Select"><option value="">Please select one</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Åland Islands">Åland Islands</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Democratic Republic Of Congo">Democratic Republic Of Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Côte D\'Ivoire">Côte D\'Ivoire</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard and McDonald Islands">Heard and McDonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="North Korea">North Korea</option><option value="South Korea">South Korea</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Republic of Macedonia">Republic of Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Federated States of Micronesia">Federated States of Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestine">Palestine</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Réunion">Réunion</option><option value="St. Barthélemy">St. Barthélemy</option><option value="St. Helena, Ascension and Tristan Da Cunha">St. Helena, Ascension and Tristan Da Cunha</option><option value="St. Kitts And Nevis">St. Kitts And Nevis</option><option value="St. Lucia">St. Lucia</option><option value="St. Martin">St. Martin</option><option value="St. Pierre And Miquelon">St. Pierre And Miquelon</option><option value="St. Vincent And The Grenedines">St. Vincent And The Grenedines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan Mayen">Svalbard And Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option selected="selected" value="United States">United States</option><option value="US Minor Outlying Islands">US Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select></td>
											</tr>
											<tr>
												<td class="rightAlign">* Phone Number</td>
												<td><input class="regula-validation checkout" id="Contact0Phone1" type="text" name="Contact0Phone1" size="25" data-constraints="@Required(label=&quot;Phone Number&quot;, groups=[customer])" /></td>
											</tr>
											<tr>
												<td class="rightAlign">* Email Address</td>
												<td><input class="regula-validation checkoutBottom" id="Contact0Email" type="text" name="Contact0Email" size="15" data-constraints="@Required(label=&quot;Email Address&quot;, groups=[customer]) @Email(label=&quot;Email Address&quot;, groups=[customer])" /></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div></div>
							<div class="clear"></div>
							<div id="ORDER_FORM_SHIPPING_ENTRY"></div>
							<div id="SHIPPING_OPTIONS"></div>
							<div id="PAYMENT_PLANS"></div>
							<div id="ORDER_FORM_SUMMARY">
								<table class="orderSummary tabular grid">
									<tbody>
										<tr>
											<th class="leftAlign">Order Summary</th>
											<th class="rightAlign"></th>
										</tr>
										<tr>
											<td class="listCell">Subtotal</td>
											<td class="rightAlign">$147.00</td>
										</tr>
										<tr>
											<td class="subtotal">Total Due</td>
											<td class="rightAlign subtotal">$147.00</td>
										</tr>
										<tr>
											<td colspan="2">Promo Code: <input class="promoField" id="promoCode" type="text" name="promoCode" /> <a class="codeButton" href="javascript:Infusion.Ecomm.OrderForms.ajaxSubmitForm(\'orderForm\', false, 0, 0, \'90b0bbae-fb36-498c-bc57-78625ef4dd90\', \'RENDER_ORDER_FORM\', [\'ORDER_FORM_PRODUCT_LIST\', \'ORDER_FORM_SUMMARY\', \'UP_SELLS\', \'PAYMENT_PLANS\'])">Apply</a></td>
										</tr>
									</tbody>
								</table>
								<img alt="" src="/wp-content/themes/builtlean/images/guarantee2.jpg" />
								<table width="439" align="center">
									<tbody>
										<tr align="center" valign="middle">
											<td valign="middle" width="25%"><!-- Begin Official BBB Seal --><a title="Built Lean BBB Business Review" href="http://www.bbb.org/new-york-city/business-reviews/personal-trainers/builtlean-in-new-york-ny-128703/#bbbonlineclick" target="_blank"><img style="border: 0;" title="Free E Book" alt="bbb logo without click About Builtlean" src="/wp-content/uploads/bbb-logo-without-click.png" /></a><!-- End Official BBB Seal --></td>
											<td width="25%"><!-- Begin Official Verisign Seal --><script type="text/javascript" src="https://seal.verisign.com/getseal?host_name=www.builtlean.com&amp;size=M&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en"></script><!-- End Official Verisign Seal --></td>
											<td valign="middle" width="25%">
												<!-- (c) 2005, 2010. Authorize.Net is a registered trademark of CyberSource Corporation -->
												<script type="text/javascript" language="javascript">// <![CDATA[
													var ANS_customer_id="d24b70c1-f7d7-4f92-b8be-75eb0ef11385";
													// ]]></script><script type="text/javascript" src="//verify.authorize.net/anetseal/seal.js" language="javascript"></script></td>
											<td align="center" valign="middle" width="25%"><!-- Begin Official PayPal Seal --><a href="https://www.paypal.com/us/verified/pal=support@builtlean.com" target="_blank"><img title="About Builtlean" alt="paypal seal About Builtlean" src="/products/transformation/images/paypal-seal.jpg" border="0" /></a><!-- End Official PayPal Seal --></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="clear"></div>
								<div id="PAYMENT_SELECTION">
									<table class="paymentMethodTable tabular grid">
										<tbody>
											<tr>
												<th class="leftAlign" colspan="5">Payment Information</th>
											</tr>
											<tr>
												<td><input class="choosePlan" id="creditCardType" type="radio" checked="checked" name="paymentType" value="creditcard" /> <label for="creditCardType"><img class="paymentIcon" alt="" src="/wp-content/themes/builtlean/images/creditcard.png" /> <span class="smallHeader">Credit card</span> </label></td>
												<td><input class="choosePlan" id="payPalType" type="radio" name="paymentType" value="paypal" /> <label for="creditCardType"><img class="paymentIcon" alt="" src="/wp-content/themes/builtlean/images/paypal.png" /> <span class="smallHeader">PayPal</span> </label></td>
											</tr>
											<!-- creditCardForm v2 -->
											<tr class="cellLow">
												<td class="pay1"><span class="paymentLabel">Credit Card Type</span>
												<select class="CreditCard0CardType" id="CreditCard0CardType" name="CreditCard0CardType" size="1" data-on="Component.Select"><option value="American Express">American Express</option><option value="Discover">Discover</option><option value="MasterCard">MasterCard</option><option value="Visa">Visa</option></select></td>
												<td class="pay2"><span class="paymentLabel">Credit Card Number</span>
												<input class="regula-validation checkout" id="CreditCard0CardNumber" type="text" autocomplete="off" maxlength="16" name="CreditCard0CardNumber" data-constraints="@Required(label=&quot;Credit Card Number&quot;, groups=[creditCard])" /></td>
												<td class="pay3"><span class="paymentLabel">Expiration Date</span>
												<select class="checkoutShortest" id="CreditCard0ExpirationMonth" name="CreditCard0ExpirationMonth" size="1" data-on="Component.Select"><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select class="checkoutShortest" id="CreditCard0ExpirationYear" name="CreditCard0ExpirationYear" size="1" data-on="Component.Select"><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option></select></td>
												<td class="pay4"></td>
											</tr>
										</tbody>
									</table>
								</div> <!-- end PAYMENT SELECTION -->
								<div class="checkoutLinks"><a class="continueButton" href="javascript:document.orderForm.submit();">Place Order</a></div>
							<div class="clear"></div>
						</div><!-- end #content -->
			</form>
	';
 return $form;
}
add_shortcode( 'infusions_of', 'infusions_of_func' );
?>