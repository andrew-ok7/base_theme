<?php
/* Register a Custom Post Type (Testimonials) */
add_action('init', 'testimonial_init');
function testimonial_init() {
	$labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'Testimonial'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonial'),
		'search_items' => __('Search Testimonials'),
		'not_found' => __('No Testimonials found'),
		'not_found_in_trash' => __('No Testimonials found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Testimonials'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => false,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail')
		//'register_meta_box_cb' => 'add_title_position_metaboxes'
	); 
	register_post_type('testimonial', $args);
}

/* Update Testimonial Messages */
add_filter('post_updated_messages', 'testimonial_updated_messages');
function testimonial_updated_messages($messages) {
	global $post, $post_ID;
	$messages['testimonial'] = array(
		0 => '',
		1 => sprintf(__('Testimonial updated.'), esc_url(get_permalink($post_ID))),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Slide updated.'),
		5 => isset($_GET['revision']) ? sprintf(__('Testimonial restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => sprintf(__('Testimonial published.'), esc_url(get_permalink($post_ID))),
		7 => __('Testimonial saved.'),
		8 => sprintf(__('Testimonial submitted.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		9 => sprintf(__('Testimonial scheduled for: <strong>%1$s</strong>. '), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
		10 => sprintf(__('Testimonial draft updated.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
	);
	return $messages;
}

/* Update Testimonial Help */
add_action('contextual_help', 'testimonial_help_text', 10, 3);
function testimonial_help_text($contextual_help, $screen_id, $screen) {
	if ('testimonial' == $screen->id) {
		$contextual_help =
		'<p>' . __('Things to remember when adding a testimonial:') . '</p>' .
		'<ul>' .
		'<li>' . __('Give the testimonial a title. The title will be used as the testimonial\'s headline.') . '</li>' .
		//'<li>' . __('Attach a Featured Image to give the slide its background.') . '</li>' .
		'<li>' . __('Enter text into the Visual or HTML area. The text will appear within each testimonial during transitions.') . '</li>' .
		'</ul>';
	}
	elseif ('edit-testimonial' == $screen->id) {
		$contextual_help = '<p>' . __('A list of all testimonials appears below. To edit a testimonial, click on the testimonial\'s title.') . '</p>';
	}
	return $contextual_help;
}

/* Register a Custom Post Type (Slide) */
add_action('init', 'slide_init');
function slide_init() {
	$labels = array(
		'name' => _x('Slides', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New', 'slide'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' => __('No slides found'),
		'not_found_in_trash' => __('No slides found in Trash'), 
		'parent_item_colon' => '',
		'menu_name' => 'Slides'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => false,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail')
		//'register_meta_box_cb' => 'add_title_position_metaboxes'
	); 
	register_post_type('slide', $args);
}

/* Update Slide Messages */
add_filter('post_updated_messages', 'slide_updated_messages');
function slide_updated_messages($messages) {
	global $post, $post_ID;
	$messages['slide'] = array(
		0 => '',
		1 => sprintf(__('Slide updated.'), esc_url(get_permalink($post_ID))),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Slide updated.'),
		5 => isset($_GET['revision']) ? sprintf(__('Slide restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
		6 => sprintf(__('Slide published.'), esc_url(get_permalink($post_ID))),
		7 => __('Slide saved.'),
		8 => sprintf(__('Slide submitted.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
		9 => sprintf(__('Slide scheduled for: <strong>%1$s</strong>. '), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
		10 => sprintf(__('Slide draft updated.'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
	);
	return $messages;
}

/* Update Slide Help */
add_action('contextual_help', 'slide_help_text', 10, 3);
function slide_help_text($contextual_help, $screen_id, $screen) {
	if ('slide' == $screen->id) {
		$contextual_help =
		'<p>' . __('Things to remember when adding a slide:') . '</p>' .
		'<ul>' .
		'<li>' . __('Give the slide a title. The title will be used as the slide\'s headline.') . '</li>' .
		'<li>' . __('Attach a Featured Image to give the slide its background.') . '</li>' .
		'<li>' . __('Enter text into the Visual or HTML area. The text will appear within each slide during transitions.') . '</li>' .
		'</ul>';
	}
	elseif ('edit-slide' == $screen->id) {
		$contextual_help = '<p>' . __('A list of all slides appears below. To edit a slide, click on the slide\'s title.') . '</p>';
	}
	return $contextual_help;
}

function nerdy_project_slide_get_images($size = 'thumbnail', $limit = '0', $offset = '0') {
	global $post;

	$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	if ($images) {

		$num_of_images = count($images);

		if ($offset > 0) : $start = $offset--; else : $start = 0; endif;
		if ($limit > 0) : $stop = $limit+$start; else : $stop = $num_of_images; endif;

		$i = 0;
		foreach ($images as $image) {
			if ($start <= $i and $i < $stop) {
			$img_title = $image->post_title;   // title.
			$img_description = $image->post_content; // description.
			$img_caption = $image->post_excerpt; // caption.
			$img_url = wp_get_attachment_url($image->ID); // url of the full size image.
			$preview_array = image_downsize( $image->ID, $size );
 			$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.

 			///////////////////////////////////////////////////////////
			// This is where you'd create your custom image/link/whatever tag using the variables above.
			// This is an example of a basic image tag using this method.
			?>
        <div><img src="<?php echo $img_preview; ?>" /></div>
			<?php
			// End custom image tag. Do not edit below here.
			///////////////////////////////////////////////////////////

			}
			$i++;
		}
	}
} // end nerdy project slide

function customize_meta_boxes() {
  /* Removes meta boxes from Posts */
  remove_meta_box('postcustom','Slides','normal');
}

add_action('admin_init','customize_meta_boxes');

// move slider featured image box to left in admin area
//Use "Featured Image" box as a custom box
//function customposttype_image_box() {

//	remove_meta_box('postimagediv', 'au-portfolio', 'side');
//	remove_meta_box('postimagediv', 'au-gallery', 'side');

//	add_meta_box('galleryimagediv', __('Full Size Image. Ratio 4:3, minimum size 800 x 600 pixels.'), 'post_thumbnail_meta_box', 'au-gallery', 'normal', 'low');

//}
//add_action('do_meta_boxes', 'customposttype_image_box');



add_action( 'add_meta_boxes', 'slides_add_custom_box' );
add_action( 'save_post', 'slides_save_postdata' );

function slides_add_custom_box() {
    add_meta_box( 
        'slides_options',
        'Slide Options',
        'slides_inner_custom_box',
        'slide' 
    );
}

function slides_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'slides_noncename' );

  $mydata = get_post_meta($post->ID, 'slides_slider', TRUE);

  if (isset($mydata['slides_imageurl'])) {
    $slides_image_url = $mydata['slides_imageurl'];
  } else {
    $slides_image_url = '';
  }

  if (isset($mydata['slides_caption'])) {
    $slides_caption = $mydata['slides_caption'];
  } else {
    $slides_caption = '';
  }

  if (isset($mydata['slides_caption_position'])) {
    $slides_caption_position = $mydata['slides_caption_position'];
  } else {
    $slides_caption_position = '';
  }

  // The actual fields for data entry
  echo '<label for="slides_imageurl">';
  echo 'URL on slide:';
  echo '</label> ';
  echo '<input type="text" id="slides_imageurl" name="slides_imageurl" value="'.$slides_image_url.'" size="25" /><br /><br />';
  echo '<label for="slides_caption">';
  echo 'Caption for slide:';
  echo '</label> ';
  echo '<input type="text" id="slides_caption" name="slides_caption" value="'.$slides_caption.'" size="25" /><br /><br />';
  //echo '<label for="slides_caption_position">';
  //echo 'Caption position:';
  //echo '</label> ';

  //echo '<label for="slides_caption_position" >';
  //echo 'Caption position: ';
  //echo '</label>';
  //echo '<select name="slides_caption_position" id="slides_caption_position">';
  //echo '<option';
  //selected( $slides_caption_position, 'Top Left' );
  //echo '>Top Left</option>';
  //echo '<option';
  //selected( $slides_caption_position, 'Top Right' );
  //echo '>Top Right</option>';
  //echo '<option';
  //selected( $slides_caption_position, 'Bottom Left' );
  //echo '>Bottom Left</option>';
  //echo '<option';
  //selected( $slides_caption_position, 'Bottom Right' );
  //echo '>Bottom Right</option>';
  //echo '</select>';

  //Add more fields as you need them...
}

function slides_save_postdata( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if (isset($_POST['slides_noncename'])) {
    $slides_noncename = $_POST['slides_noncename'];
  } else {
    $slides_noncename = '';
  }

  if ( !wp_verify_nonce( $slides_noncename, plugin_basename( __FILE__ ) ) )
      return;

  if ( !current_user_can( 'edit_post', $post_id ) )
        return;

  $mydata = array();
  foreach($_POST as $key => $data) {
    if($key == 'slides_noncename')
      continue;
    if(preg_match('/^slides/i', $key)) {
      $mydata[$key] = $data;
    }
  }
  update_post_meta($post_id, 'slides_slider', $mydata);
  return $mydata;
}
?>