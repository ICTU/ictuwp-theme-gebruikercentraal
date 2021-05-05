<?php

// Gebruiker Centraal - page_stappenplan.php
// ----------------------------------------------------------------------------------
// Pagina met child-pages
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.7
// @desc.   Spotlight-component toegevoegd; tekstblok-component voor home toegevoegd.
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal


//* Template Name: GC-pagina - Pagina met stappenplan

//========================================================================================================

add_action( 'genesis_entry_content', 'check_stappenplan', 8 );

// relevante content en externe links toevoegen
// @since	  4.2.2
add_action( 'wp_enqueue_scripts', 'ictu_gctheme_frontend_general_get_related_content_headercss' );

add_action( 'genesis_loop', 'ictu_gctheme_frontend_general_get_spotlight', 12 );

add_action( 'genesis_loop', 'ictu_gctheme_frontend_general_get_related_content', 14 );

//========================================================================================================

/*
	stappenplan invoegen voor de rest content
*/
function check_stappenplan() {

	global $post;

	if ( ! is_page() ) {
		return;
	}

	if ( function_exists( 'get_field' ) ) {

		$stappen         = get_field( 'steptable_steps', $post->ID );
		$stappenplan_add = get_field( 'stappenplan_add', $post->ID );


		if ( $stappen && ( 'ja' == $stappenplan_add ) ) {

			$stappenteller = 0;
			$headline      = sprintf( _x( '%s in %s stappen', 'stappen', 'gebruikercentraal' ), get_the_title(), count( $stappen ) );

			echo '<h2 class="visuallyhidden">' . $headline . '</h2>';
			echo '<ol class="stappenplan flexbox">';

			while ( have_rows( 'steptable_steps', $post->ID ) ) : the_row();

				$stappenteller ++;

				$steptable_step_title        = get_sub_field( 'steptable_step_title' );
				$steptable_step_introduction = get_sub_field( 'steptable_step_introduction' );
				$steptable_step_text         = get_sub_field( 'steptable_step_text' );
				$steptable_step_example      = get_sub_field( 'steptable_step_example' );
//				$steptable_step_arrow_right 	= '<span class="step-arrow-right">&nbsp;</span>';
				$steptable_step_arrow_right = '';

				$section_id = 'post-' . $post->ID . '-stap-' . $stappenteller;
				$title_id   = 'title-' . $section_id;

				if ( $stappenteller === 1 ) {
					$steptable_step_titlecounter = '<span class="step-counter first-step">' . $stappenteller . '</span>';
				} else if ( $stappenteller === count( $stappen ) ) {
					$steptable_step_titlecounter = '<span class="step-counter last-step">' . $stappenteller . '</span>';
				} else {
					$steptable_step_titlecounter = '<span class="step-counter">' . $stappenteller . '</span>';
				}


				if ( ! $steptable_step_title ) {
					$steptable_step_title = __( 'Stap', 'gebruikercentraal' ) . ' ' . $stappenteller;
				} else {

				}

				$steptable_step_sectiontitle = sprintf( _x( '<span class="visuallyhidden">Stap</span> %s <span class="visuallyhidden">van %s:</span> %s', 'stappen', 'gebruikercentraal' ), $stappenteller, count( $stappen ), $steptable_step_title );


				echo '<li class="stap" id="' . $section_id . '" aria-labelledby="' . $title_id . '">';
				echo '<div class="step-content">';

				echo '<h3 class="titelspan" id="' . $title_id . '">' . $steptable_step_titlecounter . '<span class="step-title">' . $steptable_step_title . '</span>' . $steptable_step_arrow_right . '</h3>';

				if ( $steptable_step_introduction ) {
					echo '<div class="stap-intro"><p>' . $steptable_step_introduction . '</p></div>';
				}
				if ( $steptable_step_text ) {
					echo '<div class="stap-text"><p>' . $steptable_step_text . '</p></div>';
				}
				if ( $steptable_step_example ) {
					echo '<div class="stap-example"><h4>' . _x( 'Bijvoorbeeld:', 'Stap, voorbeeld', 'gebruikercentraal' ) . '</h4><p>' . $steptable_step_example . '</p></div>';
				}
				echo '</div>';
				echo '</li>';


			endwhile;

			echo '</ol>';

		}
	}
}

//========================================================================================================

genesis();

