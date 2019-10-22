<?php

/**
// Gebruiker Centraal - search.php
// ----------------------------------------------------------------------------------
// Toont zoekresultaten
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.27.2
// @desc.   Totale make-over van zoekresultaat-pagina.
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
	global $wp_query;

	
	if ( have_posts() ) {

		// only show the post dates for the post types:
		$postypeswithdate = array( GC_BEELDBANK_BRIEF_CPT, 'post' );

		// how many posts did we find?
		$title  = sprintf( _n( '%s result', '%s results', $wp_query->found_posts, 'gebruikercentraal' ), number_format_i18n( $wp_query->found_posts ) );      
		echo '<p>' . $title  . '.</p>';		


		while(have_posts()) : the_post();
			
			$theid		= get_the_id();
			$thelabelid	= 'title_' . $theid;
			$posttype 	= get_post_type( $theid );
			$obj		= get_post_type_object( $posttype );
			if ( in_array( $posttype, $postypeswithdate ) ) {
				$postdate	= get_the_date( );
			}
			else {
				$postdate	= '';
			}
			$excerpt	= get_the_excerpt( $theid );
			
			echo '<section class="theme-item" aria-labelledby="' . $thelabelid . '">';
			echo '<h2 id="' . $thelabelid . '">';
			echo '<a href="' . get_the_permalink() . '">';
			the_title();
			echo '</a>';
			echo "</h2>";
			
			if ( is_object( $obj ) || $postdate ) {
				echo '<p class="meta">';
				if ( is_object( $obj ) ) {
					echo $obj->labels->singular_name;
					if ( $postdate ) {
						echo ' - ' . $postdate;
					}
				}
				else {
					echo $postdate;
				}
				echo '</p>';
			}

			echo "<p>" . wp_strip_all_tags( $excerpt ) . "</p>";
			echo '</section>';
			
		endwhile;
		
	}
	else {

		// show a (UNIQUE) search form
		$searchform = get_search_form( array( 'echo' => false ) );
		$searchform = preg_replace('|id="zoeken"|i', 'id="zoeken_no_result"', $searchform );
		$searchform = preg_replace('|searchform-2|i', 'searchform-22', $searchform );
		
		
		echo '<p>' . esc_attr( _x( "No results", 'search', 'gebruikercentraal' ) ) . '</p>';
		echo '<h2>' . esc_attr( _x( "Try searching again", 'search', 'gebruikercentraal' ) ) . '</h2>';
		echo $searchform;
		
	}
    

}
 

// ===============================================================================================
