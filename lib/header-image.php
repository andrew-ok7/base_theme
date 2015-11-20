<?php
	// The custom header business starts here.
	$custom_header_support = array(
    //http://sabreuse.com/flexible-headers-in-wordpress-3-4-themes/
    //all options in array
    //$defaults = array(
    //'default-image' => '',
    //'random-default' => false,
    //'width' => 0,
    //'height' => 0,
    //'flex-height' => false,
    //'flex-width' => false,
    //'default-text-color' => '',
    //'header-text' => true,
    //'uploads' => true,
    //'wp-head-callback' => '',
    //'admin-head-callback' => '',
    //'admin-preview-callback' => '',
    //);

		// The default image to use.
		// The %s is a placeholder for the theme template directory URI.
		'default-image' => '%s/img/headers/logo.png',
		// The height and width of our custom header.
		//'width' => 268 ,
		//'height' => 80 ,
		// Support flexible height and width.
		'flex-height' => true,
		'flex-width' => true,
		// Don't support text inside the header image.
		'header-text' => false,
		// Callback for styling the header preview in the admin.
    'admin-head-callback'    => '',
    'admin-preview-callback' => '',
	);
	
	add_theme_support( 'custom-header', $custom_header_support );
?>