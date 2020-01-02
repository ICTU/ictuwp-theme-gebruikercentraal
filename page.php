<?php

// Gebruiker Centraal - page.php
// ----------------------------------------------------------------------------------
// pagina
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.29.1
// @desc.   Public Service nominatie-widget op homepage.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

// check if a placeholder for a header image is needed
add_action( 'genesis_before_content', 'gc_wbvb_add_pageheader_tags' );

// css in header for the header image
add_action( 'wp_enqueue_scripts', 'gc_wbvb_add_pageheader_css' );


//========================================================================================================

// widget voor grote banners
add_action( 'genesis_entry_header', 'gc_wbvb_write_widget_home_widget_beforecontent', 8 );

//========================================================================================================


add_filter('genesis_attr_entry-header', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-content', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-footer', 'gc_shared_add_wrap_class');

showdebug(__FILE__, '/');


genesis();

