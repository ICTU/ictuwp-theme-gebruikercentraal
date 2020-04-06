<?php

// Gebruiker Centraal - page_overzichtspagina.php
// ----------------------------------------------------------------------------------
// Pagina met child-pages
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.7
// @desc.   Spotlight-component toegevoegd; tekstblok-component voor home toegevoegd.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

//========================================================================================================

//* Template Name: GC-pagina - Toon onderliggende pagina's

add_action( 'genesis_entry_content', 'gc_wbvb_show_page_overzichtspagina', 11 );

// relevante content en externe links toevoegen
// @since	  4.2.2
add_action( 'wp_enqueue_scripts', 'ictu_gc_append_header_css_local' );
add_action( 'wp_enqueue_scripts', 'ictu_gctheme_frontend_general_get_related_content_headercss' );

add_action( 'genesis_loop', 'ictu_gctheme_frontend_general_get_spotlight', 12 );

add_action( 'genesis_loop', 'ictu_gctheme_frontend_general_get_related_content', 14 );

showdebug( __FILE__, '/' );

//========================================================================================================

genesis();

//========================================================================================================

function gc_wbvb_show_page_overzichtspagina() {

	global $id;


	$children = get_pages( array(
		'child_of'    => $id,
		'parent'      => $id,
		'sort_order'  => 'ASC',
		'sort_column' => 'menu_order'
	) );

	if ( function_exists( 'get_field' ) ) {

		if ( $children ) {

			$countcount = count( $children );

			echo '<h2>' . __( "Zie ook:", 'gebruikercentraal' ) . '</h2>';
//            echo '<div class="related page_overzichtspagina">';

			$columncounter = 'grid--col-2';

			if ( $countcount < 2 ) {
				$columncounter = 'grid--col-1';
			} elseif ( $countcount === 4 ) {
				$columncounter = 'grid--col-2';
			} elseif ( $countcount > 2 ) {
				$columncounter = 'grid--col-3';
			}


			echo '<div class="grid ' . $columncounter . '">';

			foreach ( $children as $post ):

				setup_postdata( $post );
				$postcounter ++;

				if ( ICTU_GC_CPT_DOELGROEP == get_post_type( $post ) ) {
					$citaat = get_field( 'facts_citaten', $post->ID );
					echo ictu_gctheme_card_doelgroep( $post, $citaat );
				} elseif ( ( 'post' == get_post_type( $post ) ) || ( 'page' == get_post_type( $post ) ) ) {
					echo ictu_gctheme_card_featuredimage( $post );
				} elseif ( ( GC_BEELDBANK_BRIEF_CPT == get_post_type( $post ) ) || ( GC_BEELDBANK_BEELD_CPT == get_post_type( $post ) ) ) {
					echo ictu_gctheme_card_featuredimage( $post );
				} elseif ( ( ICTU_GC_CPT_VAARDIGHEDEN == get_post_type( $post ) ) ) {
					echo ictu_gctheme_card_vaardigheid( $post );
				} else {
					echo ictu_gctheme_card_general( $post );
				}

			endforeach;


			wp_reset_postdata();

			echo '</div>'; // .grid

		}
	}

}

//========================================================================================================

/**
 * Adds extra CSS to header for background images in cards
 *
 * @since 4.1.3
 *
 */
function ictu_gc_append_header_css_local() {

	global $post;

	wp_enqueue_style(
		ID_BLOGBERICHTEN_CSS,
		WBVB_THEMEFOLDER . '/css/blogberichten.css?v=' . CHILD_THEME_VERSION
	);

	$header_css          = '';
	$currentpageID       = get_the_id();
	$gerelateerdecontent = get_field( 'gerelateerde_content_toevoegen', $currentpageID );
	$all_or_some         = get_field( 'overzichtspagina_showall_or_select', $currentpageID );

	if ( 'showsome' === $all_or_some ) {

		$items = get_field( 'overzichtspagina_kies_items', $currentpageID );

		if ( $items ) {

			foreach ( $items as $post ):

				setup_postdata( $post );

				$currentpageID = $post->ID;
				$image         = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

				if ( $image[0] ) {
					$header_css .= "#related_" . $currentpageID . " .card__image { ";
					$header_css .= "background-image: url('" . $image[0] . "'); ";
					$header_css .= "} ";
				}

			endforeach;

			wp_reset_query();

		}
	} else {

		$doelgroeppagina    = get_field( 'themesettings_inclusie_doelgroeppagina', 'option' );
		$vaardighedenpagina = get_field( 'themesettings_inclusie_vaardighedenpagina', 'option' );
		$methodepagina      = get_field( 'themesettings_inclusie_methodepagina', 'option' );
		$tipspagina         = get_field( 'themesettings_inclusie_tipspagina', 'option' );
		$brievenpagina      = get_field( 'themesettings_inclusie_brievenpagina', 'option' );
		$beeldenpagina      = get_field( 'themesettings_inclusie_beeldenpagina', 'option' );

		// by default select vaardigheden
		$select_contenttype = ICTU_GC_CPT_VAARDIGHEDEN;

		if ( is_object( $doelgroeppagina ) && $doelgroeppagina->ID == $currentpageID ) {
			// overzichtspagina voor doelgroepen
			$select_contenttype = ICTU_GC_CPT_DOELGROEP;
		} elseif ( is_object( $tipspagina ) && $tipspagina->ID == $currentpageID ) {
			// overzichtspagina voor (proces)tips
			$select_contenttype = ICTU_GC_CPT_PROCESTIP;
		} elseif ( is_object( $methodepagina ) && $methodepagina->ID == $currentpageID ) {
			// overzichtspagina voor methodes
			$select_contenttype = ICTU_GC_CPT_METHODE;
		} elseif ( is_object( $brievenpagina ) && $brievenpagina->ID == $currentpageID ) {
			// overzichtspagina voor brieven
			$select_contenttype = GC_BEELDBANK_BRIEF_CPT;
		} elseif ( is_object( $beeldenpagina ) && $beeldenpagina->ID == $currentpageID ) {
			// overzichtspagina voor beelden
			$select_contenttype = GC_BEELDBANK_BEELD_CPT;
		}


		$args = array(
			'post_type'      => $select_contenttype,
			'posts_per_page' => - 1,
			'order'          => 'ASC',
			'orderby'        => 'post_title',
		);

		$items = new WP_query( $args );

		if ( $items->have_posts() ) {

			while ( $items->have_posts() ) : $items->the_post();

				setup_postdata( $post );

				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

				if ( $image[0] ) {
					$header_css .= "#related_" . $post->ID . " .card__image { ";
					$header_css .= "background-image: url('" . $image[0] . "'); ";
					$header_css .= "} ";
				}

			endwhile;
		}

	}

	$children = get_pages( array(
		'child_of'    => $currentpageID,
		'parent'      => $currentpageID,
		'sort_order'  => 'ASC',
		'sort_column' => 'menu_order'
	) );

	if ( $children ) {

		$countcount = count( $children );

		foreach ( $children as $post ):

			setup_postdata( $post );
			$postcounter ++;

			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

			if ( $image[0] ) {
				$header_css .= "#related_" . $post->ID . " .card__image { ";
				$header_css .= "background-image: url('" . $image[0] . "'); ";
				$header_css .= "} ";
			}

		endforeach;

		wp_reset_postdata();
	}

	if ( $header_css ) {
		wp_add_inline_style( ID_BLOGBERICHTEN_CSS, $header_css );
	}

}

//========================================================================================================

