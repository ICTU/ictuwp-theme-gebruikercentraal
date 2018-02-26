<?php

/**
 * Gebruiker Centraal - search.php
 * ----------------------------------------------------------------------------------
 * Toont zoekresultaten
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.10.2
 * @desc.   Styling voor 'niet zo, maar zo' images op richtlijnen-pagina.
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

add_action( 'genesis_before_loop', 'genesis_do_search_title' );

/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'gc_wbvb_searchresults_loop' );

// post navigation verplaatsen tot buiten de flex-ruimte
add_action( 'genesis_after_loop', 'genesis_posts_nav', 3 );


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


// ===============================================================================================

/** Code for custom loop */
function gc_wbvb_searchresults_loop() {
    // code for a completely custom loop
	global $post;

    while(have_posts()) : the_post();

      $theid = get_the_id();
      $thelabelid = 'title_' . $theid;
      
      echo '<section class="theme-item" aria-labelledby="' . $thelabelid . '">';
      echo '<a href="';
      the_permalink();
      echo '">';
      
      echo '<h2 id="' . $thelabelid . '">';
      the_title();
      echo "</h2>";

      echo "<p>";
      the_excerpt();
      echo "</p>";
    
      echo '</a>';
      echo '</section>';

    endwhile;

}
 

// ===============================================================================================
