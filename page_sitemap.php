<?php

/**
 * Gebruiker Centraal - page_sitemap.php
 * ----------------------------------------------------------------------------------
 * Toont de sitemap
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
// @version 3.29.1
// @desc.   Public Service nominatie-widget op homepage.
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

//* Template Name: GC - Sitemap

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


//========================================================================================================

// widget voor grote banners
add_action( 'genesis_entry_header', 'gc_wbvb_write_widget_home_widget_beforecontent', 8 );

//========================================================================================================


add_action( 'genesis_entry_content', 'gc_wbvb_404', 15 );

genesis();
