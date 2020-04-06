<?php

/**
 * Gebruiker Centraal - page_sitemap.php
 * ----------------------------------------------------------------------------------
 * Toont de sitemap
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
// @version 4.2.2
// @desc.   Paginatemplates gecheckt en functionaliteit voor relevante links toegevoegd.
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

//* Template Name: GC-pagina - Sitemap

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


//========================================================================================================

// widget voor grote banners
add_action( 'genesis_entry_header', 'gc_wbvb_write_widget_home_widget_beforecontent', 8 );

add_action( 'genesis_entry_content', 'gc_wbvb_404', 15 );

// relevante content en externe links toevoegen
// @since	  4.2.2
add_action('wp_enqueue_scripts', 'ictu_gctheme_frontend_general_get_related_content_headercss' );

add_action( 'genesis_loop', 'ictu_gctheme_frontend_general_get_spotlight', 12 );

add_action( 'genesis_loop', 'ictu_gctheme_frontend_general_get_related_content', 14 );

showdebug(__FILE__, '/');

//========================================================================================================

genesis();

//========================================================================================================
