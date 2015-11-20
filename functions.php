<?php
// grab different functions
require_once('lib/header-image.php');
require_once('lib/menus.php');
require_once('lib/meta-boxes.php');
require_once('lib/post-types.php');
require_once('lib/taxonomies.php');
require_once('lib/widgets.php');

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );

//Customize image size for posts
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'slider', 1067, 365, true ); 
  //add_image_size( 'custom-size', 220, 180 ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode
	//add_image_size( 'category-thumb', 300 ); //300 pixels wide (and unlimited height)
	//add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
	//add_image_size( 'custom-size', 220, 220, array( 'left', 'top' ) ); // Set the image size by cropping the image and defining a crop position
}

// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
add_theme_support( 'post-thumbnails' );
//set_post_thumbnail_size( 160, 160 );

// add column for thumbnails on Slides Custom Post type  
add_filter('manage_slide_posts_columns', 'posts_columns', 5);
add_action('manage_slide_posts_custom_column', 'posts_custom_columns', 5, 2);  

function posts_columns($defaults){
    $defaults['ajt_post_thumbs'] = __('Thumbs');
    return $defaults;
}

function posts_custom_columns( $column_name, $id ){
    if( $column_name != 'ajt_post_thumbs' )
        return;
    echo get_the_post_thumbnail( $id, array(80,80) );
}

// New Read More Button
function new_excerpt_more($more) {
  global $post;
  //if(is_home()) {
  //  return '...';
  //} else {
  //return ' &nbsp; <a class="btn btn-default btn-sm" href="'. get_permalink($post->ID) . '">Read More...</a>';
  if(is_post_type_archive( array( 'directory' ) ) ) {
    return '<div class="read-more"><a class="btn btn-primary btn-lg" href="'. get_permalink($post->ID) . '">more info</a></div>';
  } else {
    return '<div class="read-more"><a class="btn btn-primary btn-lg" href="'. get_permalink($post->ID) . '">read more</a></div>';
  }
}
add_filter('excerpt_more', 'new_excerpt_more');

//Change Excerpt Length
function new_excerpt_length($length) {
	return 16;
}
add_filter('excerpt_length', 'new_excerpt_length');

// default media link to none
update_option('image_default_link_type','none');

// get rid of stupid pointless color picker in admin user profile area
remove_action("admin_color_scheme_picker", "admin_color_scheme_picker");

// 
/*===================================================================================
 * edit user profile area in dashboard and Add Author Links
 * =================================================================================*/
function edit_contactmethods( $contactmethods ) {
  //unset($contactmethods['googleplus']);
  unset($contactmethods['yim']);
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);

	//$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';

  return $contactmethods;
}
add_filter('user_contactmethods','edit_contactmethods',10,1);

// Custom Meta Boxes for Contact Page Template
add_action( 'add_meta_boxes', 'ajtContact_embed_add_custom_box' );
add_action( 'save_post', 'ajtContact_save_postdata' );

function ajtContact_embed_add_custom_box() {
    global $post;
    if ( 'template-contact.php' == get_post_meta( $post->ID, '_wp_page_template', true ) ) {
        add_meta_box( 'ajtContact_options', 'Contact Page Options', 'ajtContact_inner_custom_box', 'page', 'normal', 'high' );
    }
}

function ajtContact_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'ajtContact_noncename' );

  $mydata = get_post_meta($post->ID, 'ajtContact', TRUE);

  if (isset($mydata['ajtContact_street'])) {
    $ajtContact_street = $mydata['ajtContact_street'];
  } else {
    $ajtContact_street = '';
  }

  if (isset($mydata['ajtContact_city'])) {
    $ajtContact_city = $mydata['ajtContact_city'];
  } else {
    $ajtContact_city = '';
  }

  if (isset($mydata['ajtContact_state'])) {
    $ajtContact_state = $mydata['ajtContact_state'];
  } else {
    $ajtContact_state = '';
  }

  if (isset($mydata['ajtContact_zip'])) {
    $ajtContact_zip = $mydata['ajtContact_zip'];
  } else {
    $ajtContact_zip = '';
  }

  if (isset($mydata['ajtContact_phone'])) {
    $ajtContact_phone = $mydata['ajtContact_phone'];
  } else {
    $ajtContact_phone = '';
  }

  if (isset($mydata['ajtContact_email'])) {
    $ajtContact_email = $mydata['ajtContact_email'];
  } else {
    $ajtContact_email = '';
  }

  if (isset($mydata['ajtContact_map'])) {
    $ajtContact_map = $mydata['ajtContact_map'];
  } else {
    $ajtContact_map = '';
  }

  // The actual fields for data entry
  echo '<label for="ajtContact_street">';
  echo 'Street Address:';
  echo '</label> ';
  echo '<input type="text" id="ajtContact_street" name="ajtContact_street" value="' . $ajtContact_street . '" size="100" /><br /><br />';
  echo '<label for="ajtContact_city">';
  echo 'City:';
  echo '</label> ';
  echo '<input type="text" id="ajtContact_city" name="ajtContact_city" value="' . $ajtContact_city . '" size="100" /><br /><br />';
  echo '<label for="ajtContact_state">';
  echo 'State:';
  echo '</label> ';
  echo '<input type="text" id="ajtContact_state" name="ajtContact_state" value="' . $ajtContact_state . '" size="100" /><br /><br />';
  echo '<label for="ajtContact_zip">';
  echo 'zip code:';
  echo '</label> ';
  echo '<input type="text" id="ajtContact_zip" name="ajtContact_zip" value="' . $ajtContact_zip . '" size="100" /><br /><br />';
  echo '<label for="ajtContact_phone">phone:</label> ';
  echo '<input type="text" id="ajtContact_phone" name="ajtContact_phone" value="' . $ajtContact_phone . '" size="100" /><br /><br />';
  echo '<label for="ajtContact_email">email:</label> ';
  echo '<input type="text" id="ajtContact_email" name="ajtContact_email" value="' . $ajtContact_email . '" size="100" /><br /><br />';
  echo '<label for="ajtContact_map">map:</label> ';
  echo '<input type="text" id="ajtContact_map" name="ajtContact_map" value="' . $ajtContact_map . '" size="100" /><br /><br />';
  }

function ajtContact_save_postdata( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if (isset($_POST['ajtContact_noncename'])) {
    $ajtContact_noncename = $_POST['ajtContact_noncename'];
  } else {
    $ajtContact_noncename = '';
  }

  if ( !wp_verify_nonce( $ajtContact_noncename, plugin_basename( __FILE__ ) ) )
      return;

  if ( !current_user_can( 'edit_post', $post_id ) )
        return;

  $mydata = array();
  foreach($_POST as $key => $data) {
    if($key == 'ajtContact_noncename')
      continue;
    if(preg_match('/^ajtContact/i', $key)) {
      $mydata[$key] = $data;
    }
  }
  update_post_meta($post_id, 'ajtContact', $mydata);
  return $mydata;
}

?>