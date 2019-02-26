<?php

// Gebruiker Centraal - page_home.php
// ----------------------------------------------------------------------------------
// pagina voor eventuele aparte styling voor de homepage. Maar eigenlijk niet nodig...
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.12.1
// @desc.   Renamed functions for better sharing.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


//* Template Name: GC - Homepage

add_filter('genesis_attr_entry-header', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-content', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-footer', 'gc_shared_add_wrap_class');

add_action( 'genesis_entry_content', 'gc_wbvb_add_single_socialmedia_buttons', 1 );


showdebug(__FILE__, '/');


if ( is_home() || is_front_page() ) {
  
  remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
  remove_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );
  remove_action( 'genesis_loop', 'genesis_do_loop' );

  add_action( 'genesis_loop', 'gc_wbvb_home_manifest', 1 );
  add_action( 'wp_enqueue_scripts', 'gc_wbvb_add_berichten_widget_css' );
  add_action( 'genesis_after_header', 'gc_wbvb_home_append_to_header', 11 );

}
elseif ( is_archive() ) {

    remove_action( 'genesis_loop', 'genesis_do_loop' );
    add_action( 'genesis_loop', 'gc_wbvb_archive_loop' );
    
}

genesis();

