<?php

/**
// Gebruiker Centraal - search.php
// ----------------------------------------------------------------------------------
// Toont zoekresultaten
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.27.1
// @desc.   Betere zoekresultaatpagina, ook bij geen resultaat.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
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

  $title = sprintf( '<div class="archive-description"><h1 class="archive-title">%s %s</h1></div>', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', 'gebruikercentraal' ) ), get_search_query() );

  echo apply_filters( 'genesis_search_title_output', $title ) . "\n";

}

genesis();


// ===============================================================================================

/** Code for custom loop */
function gc_wbvb_searchresults_loop() {
	
	// code for a completely custom loop
	global $post;
	
	if ( have_posts() ) {

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
	else {

		$searchform = get_search_form( array( 'echo' => false ) );
		$searchform =  preg_replace('|id="zoeken"|i', 'id="zoeken_no_result"', $searchform );
		$searchform =  preg_replace('|searchform-2|i', 'searchform-22', $searchform );
		
		
		echo '<p>' . esc_attr( _x( "No results", 'search', 'gebruikercentraal' ) ) . '</p>';
		echo '<h2>' . esc_attr( _x( "Try searching again", 'search', 'gebruikercentraal' ) ) . '</h2>';
		echo $searchform;
		
	}
    

}
 

// ===============================================================================================
