<?php

/**
 * Gebruiker Centraal - search.php
 * ----------------------------------------------------------------------------------
 * Toont zoekresultaten
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.4.11
 * @desc.   Tabs to spaces, tabs to spaces
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

add_action( 'genesis_before_loop', 'genesis_do_search_title' );
/**
 * Echo the title with the search term.
 *
 * @since 1.9.0
 */
function genesis_do_search_title() {

  $title = sprintf( '<div class="archive-description"><h2 class="archive-title">%s %s</h2></div>', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', 'gebruikercentraal' ) ), get_search_query() );

  echo apply_filters( 'genesis_search_title_output', $title ) . "\n";

}

genesis();
