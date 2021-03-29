<?php

//
// Gebruiker Centraal - author-box.php
// ----------------------------------------------------------------------------------
// Dinges om de authorbox te vullen
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.1
// @desc.   Fixes voor actieteamwidget bug (sanitize_title) en authorbox (get user ID from get_queried_object).
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


//========================================================================================================


function gc_wbvb_authorbox_actieteamlid( $userid ) {

	global $default_persoon_plaatje;

	if ( $default_persoon_plaatje == 'voorbeeld-persoon-2.png' ) {
		$default_persoon_plaatje = 'voorbeeld-persoon-1.png';
	} else {
		$default_persoon_plaatje = 'voorbeeld-persoon-2.png';
	}

	if ( function_exists( 'get_field' ) ) {

		$acf_userid = "user_" . $userid;

		$user_info           = get_userdata( $userid );
		$functiebeschrijving = get_field( 'functiebeschrijving', $acf_userid );

		if ( is_object( $user_info ) ) {
			$gebruikersnaam = $user_info->display_name;

			if ( ! $functiebeschrijving ) {
				$functiebeschrijving = ( $user_info->description ) ? $user_info->description : '&nbsp;';
			}
		} else {
			$gebruikersnaam = '';
		}

		$functiebeschrijving = nl2br( $functiebeschrijving );
		$pattern             = "/<p[^>]*><\\/p[^>]*>/";
		$functiebeschrijving = preg_replace( $pattern, '', $functiebeschrijving );

		$twitter = get_field( 'twitter', $acf_userid );
		if ( $twitter != '' ) {
			$twitter = preg_replace( '/@/i', '', $twitter );
		}

		$imagetag       = '';
		$img_width      = 300;
		$img_height     = 300;
		$img_alt        = $gebruikersnaam;
		$authorfoto_url = get_user_meta( $userid, 'auteursfoto_url', true );

		if ( ! $authorfoto_url ) {
			$authorfoto     = get_field( 'auteursfoto', $acf_userid );
			$authorfoto_url = wp_get_attachment_image_src( $authorfoto['id'], 'thumbnail' );
		}

		if ( $authorfoto_url ) {
			$imagetag = '            <img src="' . $authorfoto_url . '" class="author-photo photo avatar" height="' . $img_height . '" width="' . $img_width . '" alt="' . $img_alt . '" />';
		} else {
			$args = array(
				'size'  => 82,
				'class' => 'author-photo photo avatar',
			);

			$defaultplaatje = get_stylesheet_directory_uri() . '/images/' . $default_persoon_plaatje;
			$imagetag       = get_avatar( $userid, 82, $defaultplaatje, $authorfoto['id'], $args );

		}

	}

	$dl = '';


	if ( $twitter ) {
		$dl .= '<dt class="twitter">Twitter</dt><dd><a href="https://twitter.com/' . $twitter . '">@' . $twitter . '</a></dd>';
	}


	if ( $dl ) {
		$dl = '<dl>' . $dl . '</dl>';
	}

	$functiebeschrijving = preg_replace( "/&#?[a-z0-9]{2,8};/i", "", $functiebeschrijving );

	if ( $functiebeschrijving ) {
		$functiebeschrijving = "<p>" . $functiebeschrijving . "</p>";
	}

	$output = '<section class="author-box" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a href="' . get_author_posts_url( $userid ) . '" class="author-info author-archive">' . $imagetag . '<div style="" class="author-info"><h2 class="author-box-title">' . $gebruikersnaam . '</h2>' . $functiebeschrijving . '</div></a></section>';


	return $output;


}

//========================================================================================================


function gc_wbvb_authorbox_compose_box( $userid, $gravatar = '', $sectiontype = '' ) {
	// niet tonen voor de beeldbank-CPTs en podcast
	if ( ( GC_BEELDBANK_BEELD_CPT == get_post_type() ) || ( GC_BEELDBANK_BRIEF_CPT == get_post_type() ) || ( 'podcast' == get_post_type() ) ) {
		return;
	}

	global $default_persoon_plaatje;

	$header_tag = 'h2';
	if ( is_archive() ) {
		$header_tag = 'h1';
		$prefix     = _x( 'Posts by', 'author box', 'gebruikercentraal' );
	}


	if ( ! $userid ) {
		// * @since	  4.3.1	
		$userid = get_queried_object()->data->ID;
	}

	if ( $default_persoon_plaatje == 'voorbeeld-persoon-2.png' ) {
		$default_persoon_plaatje = 'voorbeeld-persoon-1.png';
	} else {
		$default_persoon_plaatje = 'voorbeeld-persoon-2.png';
	}

	if ( function_exists( 'get_field' ) ) {

		$acf_userid      = "user_" . $userid;
		$user_info       = get_userdata( $userid );
		$gebruikersnaam  = '';
		$biografie       = '';
		$displayname     = '';
		$user_post_count = count_user_posts( $userid );
		$contact_info    = '';

		$social_links = [];
		$links        = [];

		$author_link = '';

		if ( is_object( $user_info ) ) {
			$gebruikersnaam = $user_info->display_name;
			$biografie      = ( $user_info->description ) ? $user_info->description : '';
			$displayname    = ( $user_info->user_firstname ? $user_info->user_firstname : ( $user_info->display_name ? $user_info->display_name : 'geen naam' ) );
		}

		// Functie, biografie

		$functiebeschrijving = get_field( 'functiebeschrijving', $acf_userid );

		// Avatar
		$imagetag       = '';
		$img_width      = 300;
		$img_height     = 300;
		$img_alt        = $gebruikersnaam;
		$authorfoto_url = get_user_meta( $userid, 'auteursfoto_url', true );

		if ( ! $authorfoto_url ) {
			// hopelijk een eenmalige actie
			// geen waarde gevonden voor 'auteursfoto_url' dus we gaan de waarde van het ACF-veld voor
			// 'auteursfoto' opzoeken. Als dat er is, slaan we de URL op in 'auteursfoto_url'.
			// Daarmee zou dit dus een eenmalige actie moeten zijn
			$authorfoto       = get_field( 'auteursfoto', $acf_userid );
			$authorfoto_array = wp_get_attachment_image_src( $authorfoto['id'], 'thumbnail' );

			if ( $authorfoto_array ) {

				$authorfoto_url = $authorfoto_array[0];
				$img_width      = $authorfoto_array[1];
				$img_height     = $authorfoto_array[2];

				if ( $authorfoto_url ) {
					update_user_meta( $userid, 'auteursfoto_url', $authorfoto_url );
				}
			}
		}

		if ( $authorfoto_url ) {
			$imagetag = '<img alt="" src="' . $authorfoto_url . '" class="author-photo photo avatar" height="' . $img_height . '" width="' . $img_width . '" alt="' . $img_alt . '" />';
		} else {
			$args = array(
				'size'  => 82,
				'class' => 'author-photo photo avatar',
			);

			$defaultplaatje = get_stylesheet_directory_uri() . '/images/' . $default_persoon_plaatje;
			$imagetag       = get_avatar( $userid, 82, $defaultplaatje, $authorfoto['id'], $args );

		}

		// Contact info
		$contact_fields['tel']  = get_field( 'publiek_telefoonnummer', $acf_userid );
		$contact_fields['mail'] = get_field( 'publiek_mailadres', $acf_userid );

		if ( get_field( 'personalurl', $acf_userid ) ) {
			$links['website']['class'] = 'website';
			$links['website']['title'] = _x( 'Personal website', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam;
			$links['website']['url']   = get_field( 'personalurl', $acf_userid );
			$links['website']['text']  = 'Website';
		}

		if ( get_field( 'publiek_telefoonnummer', $acf_userid ) ) {
			$links['phone']['class'] = 'phone';
			$links['phone']['title'] = _x( 'Phone number', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam;
			$links['phone']['url']   = 'tel:' . get_field( 'publiek_telefoonnummer', $acf_userid );
			$links['phone']['text']  = get_field( 'publiek_telefoonnummer', $acf_userid );
		}

		if ( get_field( 'publiek_mailadres', $acf_userid ) ) {
			$links['mail']['class'] = 'email';
			$links['mail']['title'] = _x( 'E-mail adress', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam;
			$links['mail']['url']   = 'mailto:' . get_field( 'publiek_telefoonnummer', $acf_userid );
			$links['mail']['text']  = get_field( 'publiek_mailadres', $acf_userid );
		}

		if ( $links ) {
			foreach ( $links as $link ) {
				$contact_info .= '<a href="' . $link['url'] . '" class="link link--contact link--' . $link['class'] . '" title="' . $link['title'] . '" itemprop="' . $link['class'] . '">' . $link['text'] . '</a>';
			}
		}

		// Social links
		$sl = '';

		if ( get_field( 'twitter', $acf_userid ) ) {
			$social_links[1]['class'] = 'twitter';
			$social_links[1]['title'] = _x( 'Twitter account', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam;
			$social_links[1]['url']   = 'https://twitter.com/' . preg_replace( '/@/i', '', get_field( 'twitter', $acf_userid ) );
		}

		if ( get_field( 'linkedin', $acf_userid ) ) {
			$social_links[2]['class'] = 'linkedin';
			$social_links[2]['title'] = _x( 'Linked-In profiel', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam;
			$social_links[2]['url']   = get_field( 'linkedin', $acf_userid );
		}

		if ( get_field( 'facebook', $acf_userid ) ) {
			$social_links[3]['class'] = 'facebook';
			$social_links[3]['title'] = _x( 'Facebook profiel', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam;
			$social_links[3]['url']   = get_field( 'facebook', $acf_userid );
		}

		if ( $social_links ) {
			foreach ( $social_links as $social_link ) {
				$sl .= '<li class="social-links__item">' .
				       '<a href="' . $social_link['url'] . '" class="link link--social ' . $social_link['class'] . '" title="' . $social_link['title'] . '">' . $social_link['title'] . '</a></li>';
			}
		}

		// If there are social links we add them to contact info
		( $sl ? $contact_info .= '<ul class="social-links">' . $sl . '</ul>' : '' );

		// Title - with or without link

		$author_title = $gebruikersnaam;

		if ( ! ( is_author() ) && $user_post_count > 0 && ! is_archive() ) {
			$author_title = '<a class="arrow-link" href="' . get_author_posts_url( $userid ) . '" title="' . _x( 'All posts', 'author box', 'gebruikercentraal' ) . '">' .
			                '<span class="arrow-link__text"><span class="visuallyhidden">Over</span> ' . $gebruikersnaam . '</span>' .
			                '<span class="arrow-link__icon"></span></a>';
		}

		/*
		 * Section HTML
		 */

		// Plaatje
		$author_box = '<section class="author ' . ( is_archive() ? 'author--full' : 'author--box' ) . ' ' . ( $imagetag ? 'l-with-image' : 'l-without-image' ) . '" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">' .
		              ( $imagetag ? '<figure class="author__picture">' . $imagetag . '</figure>' : '' );

		// Content
		$author_box .= '<div class="author__content">' .
		               '<div class="l-author-header">' .
		               '<' . $header_tag . ' class="' . ( is_archive() ? 'page__title' : 'author__title' ) . '">'
		               . $author_title . '</' . $header_tag . '>' .
		               ( $functiebeschrijving ? '<span class="meta-data__item author__function">' . $functiebeschrijving . '</span>' : '' ) .
		               '</div>' . // End header
		               ( $biografie ? '<p>' . $biografie . '</p>' : '' );

		// Info
		$author_box .= '<div class="author__contact-info">' . $contact_info . '</div>';
		$author_box .= '</div></section>';

		$output = $author_box;

	} else {
		$output = ACF_PLUGIN_NOT_ACTIVE_WARNING;
	}


	return $output;


}


//========================================================================================================

add_filter( 'genesis_author_box', 'gc_wbvb_authorbox_filter_output', 10, 6 );

function gc_wbvb_authorbox_filter_output( $output, $context, $pattern, $gravatar, $title, $description ) {

	global $post;
	$imagetag    = $gravatar;
	$sectiontype = '';
	if ( function_exists( 'get_field' ) ) {
		$acf_userid = get_the_author_meta( 'ID' );
		$output     = gc_wbvb_authorbox_compose_box( $acf_userid, $gravatar, $sectiontype );
	} else {

	}

	return $output;
}

//========================================================================================================
