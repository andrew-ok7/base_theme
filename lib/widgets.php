<?php
// widget sections in the theme
function ajt_widgets_init() {
	register_sidebar(array(
		'name'=> 'Sidebar 1',
		'id' => 'sidebar1',
    'description'   => 'Sidebar 1',
		'before_widget' => '<div id="" class="sidebar-1 s-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	register_sidebar(array(
		'name'=> 'Directory Sidebar',
		'id' => 'directorySidebar',
    'description'   => 'Directory Sidebar',
		'before_widget' => '<div id="" class="directory-sidebar s-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Footer 1',
		'id' => 'footer-1',
    'description'   => 'Footer 1',
		'before_widget' => '<div id="footerWidget" class="footer1 widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Footer 2',
		'id' => 'footer-2',
    'description'   => 'Footer 2',
		'before_widget' => '<div id="footerWidget" class="footer2 widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	//register_sidebar(array(
	//	'name'=> 'Footer 3',
	//	'id' => 'footer-3',
  //  'description'   => 'Footer 3',
	//	'before_widget' => '<div id="footerWidget" class="footer3 widget">',
	//	'after_widget' => '</div>',
	//	'before_title' => '<h2>',
	//	'after_title' => '</h2>',
	//));
	register_sidebar(array(
		'name'=> 'Header',
		'id' => 'header-widget',
    'description'   => 'Header',
		'before_widget' => '<div class="well widget headerWidget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name'=> 'Home 1',
		'id' => 'home-1',
    'description'   => 'Home 1',
		'before_widget' => '<div id="homeWidget" class="img-box-3-item widget">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1><div class="bor bg-red"></div>',
	));
	register_sidebar(array(
		'name'=> 'Home 2',
		'id' => 'home-2',
    'description'   => 'Home 2',
		'before_widget' => '<div id="homeWidget" class="home2 widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2><div class="bor bg-red"></div>',
	));
	register_sidebar(array(
		'name'=> 'Home 3',
		'id' => 'home-3',
    'description'   => 'Home 3',
		'before_widget' => '<div id="homeWidget" class="home3 widget">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	));
	register_sidebar(array(
		'name'=> 'Home 4',
		'id' => 'home-4',
    'description'   => 'Home 4',
		'before_widget' => '<div id="homeWidget" class="home4 widget">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1><div class="bor bg-red"></div>',
	));
}
/** Register sidebars by running kk_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'ajt_widgets_init' );

// begine links on Title for Widgets

/**
 * Add Title Link field to widget form
 *
 * @since 1.0
 * @uses add_action() 'in_widget_form'
 */
function wtl_add_title_link_field_to_widget_form( $widget, $args, $instance ) {
?>
  <fieldset class="title-link-options">
    <p><label for="<?php echo $widget->get_field_id('title_link'); ?>"><?php _e('Title link <small class="description">(Example: http://google.com)</small>', 'widget-title-links'); ?></label>
    <input type="text" name="<?php echo $widget->get_field_name('title_link'); ?>" id="<?php echo $widget->get_field_id('title_link'); ?>"" class="widefat" value="<?php echo $instance['title_link']; ?>"" /></p>
  </fieldset>
<?php
}
add_action('in_widget_form', 'wtl_add_title_link_field_to_widget_form', 1, 3);

/**
 * Register the additional widget field
 *
 * @since 1.0
 * @uses add_filter() 'widget_form_callback'
 */
function wtl_register_widget_title_link_field ( $instance, $widget ) {
  if ( !isset($instance['title_link']) )
    $instance['title_link'] = null;
  return $instance;
}
add_filter('widget_form_callback', 'wtl_register_widget_title_link_field', 10, 2);

/**
 * Add the additional field to widget update callback
 *
 * @since 1.0
 * @uses add_filter() 'widget_update_callback'
 */
function wtl_widget_update_extend ( $instance, $new_instance ) {
  $instance['title_link'] = esc_url( $new_instance['title_link'] );
  return $instance;
}
add_filter( 'widget_update_callback', 'wtl_widget_update_extend', 10, 2 );

/**
 * Add link to widget title on output
 *
 * Title link should be set by editors 
 * in widget settings in Appearance->Widgets
 *
 * @since 1.o
 * @uses add_filter() 'widget_title'
 */
function wtl_add_link_to_widget_title( $title, $instance = null ) {
  if (!empty($title) && !empty($instance['title_link'])) {
    $title = '<a href="' . $instance['title_link'] . '">' . $title . '</a>';
  }
  return $title;
}
add_filter( 'widget_title', 'wtl_add_link_to_widget_title', 99, 2 );

// widgets in the theme
/**
 *  Post widget class by ajt
 */
class ajtWidgetPost extends WP_Widget {

	function ajtWidgetPost() {
		$widget_ops = array('classname' => 'ajtWidgetPostEntries', 'description' => __( "recent posts by me") );
		$this->WP_Widget('ajt-Post', __('AJT Recent Posts'), $widget_ops);
		$this->alt_option_name = 'ajtWidgetPostEntries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('ajtWidgetPost', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
    
    $r = new WP_Query(array('posts_per_page' => $number, 'order' => 'DESC', 'post_status' => 'publish', 'caller_get_posts' => 1));
		//$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
		if ($r->have_posts()) : ?>
		<?php echo $before_widget;
      if ( ! empty( $title ) ) echo '<div class="block-heading-two"><h2><span>' . $title . '</span></h2></div>';
		?>
					<div class="img-box-4 text-center">
						<div class="row">
      <?php while ($r->have_posts()) : $r->the_post(); ?>
              <?php 
              $blogThumbImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'smallImg' );
              $blogThumbImgUrl = $blogThumbImg['0']; 
              if ($blogThumbImgUrl == '') { 
                $blogThumbImgUrl = get_template_directory_uri() . '/img/logoThum.png';
              }
              ?>
							<div class="col-md-3 col-sm-6">
								<div class="img-box-4-item">
									<a href="<?php the_permalink(); ?>" class="lightbox"><img src="<?php echo $blogThumbImgUrl; ?>" alt="" class="img-responsive" /></a>
									<div class="img-box-4-content">
										<a href="<?php the_permalink(); ?>"><i class="fa fa-sun-o fa-spin bg-red"></i></a>
										<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?></a></h2>
										<div class="bor bg-red"></div>
										<p><?php the_excerpt(); ?></p>
									</div>
								</div>
							</div>

      <?php $i++;endwhile; ?>
						</div>
					</div>
  <?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('ajtWidgetPost', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['ajtWidgetPostEntries']) )
			delete_option('ajtWidgetPostEntries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('ajtWidgetPost', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 2;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}
function register_AJT_Post() {
	register_widget('ajtWidgetPost');
}
add_action('widgets_init', 'register_AJT_Post');

/**
 * Categories widget class Edited by AJT
 *
 * @since 2.8.0
 */
class AJT_Widget_Categories extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'ajt_widget_categories', 'description' => __( "A list or dropdown of categories." ) );
		parent::__construct('ajt_categories', __('AJT Categories'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);

		if ( $d ) {
			$cat_args['show_option_none'] = __('Select Category');

			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
?>
<script type='text/javascript'>
/* <![CDATA[ */
	var dropdown = document.getElementById("cat");
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onCatChange;
/* ]]> */
</script>
<?php
		} else {
?>
		<ul class="list-group">
<?php
		$cat_args['title_li'] = '';

$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '5,17,182',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 

); 

  $categories = get_categories($args); 
  foreach ($categories as $category) {
  
  echo '<a href="' . get_category_link( $category->term_id ) . '"><li class="list-group-item"><span class="pull-right"><span class="badge">' . $category->count . '</span></span>' . $category->name.'</li></a>';
  
  //$option = '<option value="/category/archives/'.$category->category_nicename.'">';
	//$option .= $category->cat_name;
	//$option .= ' ('.$category->category_count.')';
	//$option .= '</option>';
	//echo $option;
  }

		/**
		 * Filter the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $cat_args An array of Categories widget options.
		 */
		//wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
?>
		</ul>
<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<!-- <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p> -->
<?php
	}
}
function register_AJT_Categories() {
	register_widget('AJT_Widget_Categories');
}
add_action('widgets_init', 'register_AJT_Categories');

/**
 * Directory Towns Category widget class Edited by AJT
 *
 * @since 2.8.0
 */
class AJT_Widget_directoryTowns extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'ajt_widget_directoryTowns', 'description' => __( "A list or dropdown of categories." ) );
		parent::__construct('ajt_directoryTowns', __('AJT Directory Towns'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$cat_args = array('orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h);

		if ( $d ) {
			$cat_args['show_option_none'] = __('Select Category');

			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
?>
<script type='text/javascript'>
/* <![CDATA[ */
	var dropdown = document.getElementById("cat");
	function onCatChange() {
		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
		}
	}
	dropdown.onchange = onCatChange;
/* ]]> */
</script>
<?php
		} else {
?>
		<ul class="list-group">
<?php
		$cat_args['title_li'] = '';

$args = array(
	'type'                     => 'directory',
	'child_of'                 => 0,
	'parent'                   => 4,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 

); 

  $categories = get_categories($args); 
  foreach ($categories as $category) {
  
  echo '<a href="' . get_category_link( $category->term_id ) . '"><li class="list-group-item"><span class="pull-right"><span class="badge">' . $category->count . '</span></span>' . $category->name.'</li></a>';
  
  //$option = '<option value="/category/archives/'.$category->category_nicename.'">';
	//$option .= $category->cat_name;
	//$option .= ' ('.$category->category_count.')';
	//$option .= '</option>';
	//echo $option;
  }

		/**
		 * Filter the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $cat_args An array of Categories widget options.
		 */
		//wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
?>
		</ul>
<?php
		}

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<!-- <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p> -->
<?php
	}
}
function register_AJT_directoryTowns() {
	register_widget('AJT_Widget_directoryTowns');
}
add_action('widgets_init', 'register_AJT_directoryTowns');

?>