<?php

//
// Gebruiker Centraal - functions.php
// ----------------------------------------------------------------------------------
// Zonder functions geen functionaliteit, he?
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.23
// @desc.   PHP-codecheck: variabelen netjes declareren.
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal


/**
 * Call Genesis's core functions.
 */
require_once( get_template_directory() . '/lib/init.php' );

/**
 * Define child theme constants.
 */
define( 'CHILD_THEME_NAME', 'Gebruiker Centraal' );
define( 'CHILD_THEME_URL', 'https://www.gebruikercentraal.nl/themes/gebruikercentraal' );
define( 'CHILD_THEME_VERSION', '4.3.23' );
define( 'CHILD_THEME_DESCRIPTION', "4.3.23 - PHP-codecheck: variabelen netjes declareren." );

define( 'GC_TWITTERACCOUNT', 'gebrcentraal' );
define( 'GC_TWITTER_URL', 'https://twitter.com/' );


define( 'WP_THEME_DEBUG', false );
//define( 'WP_THEME_DEBUG', true );

$sharedfolder = get_template_directory();
$sharedfolder = preg_replace( '|genesis|i', 'ictuwp-theme-gebruikercentraal', $sharedfolder );

$sharedfolder = get_stylesheet_directory();

$default_persoon_plaatje = 'voorbeeld-persoon-1.png';

define( 'GC_FOLDER', $sharedfolder );

define( 'GC_WBVB_WIDGET_SITE_FOOTER', 'site-footer-widget' );
define( 'GC_WBVB_WIDGET_HOME_WIDGET_1', 'widgetarea-home-links' );
define( 'GC_WBVB_WIDGET_HOME_WIDGET_2', 'widgetarea-home-rechts' );

define( 'GC_WBVB_WIDGET_BANNERWIDGETS', 'widgetarea-banners-before-content' );


//========================================================================================================

//* Remove the edit link
add_filter( 'genesis_edit_post_link', '__return_false' );

//========================================================================================================

define( 'BLOG_SINGLE_MOBILE', 'blog-single-mobile' );
define( 'BLOG_SINGLE_TABLET', 'blog-single-tablet' );
define( 'BLOG_SINGLE_DESKTOP', 'blog-single-desktop' );
define( 'HALFWIDTH', 'halfwidth' );
define( 'IMG_SIZE_HUGE', 'feature-huge' );
define( 'IMG_SIZE_HUGE_MIN_WIDTH', 1200 );

define( 'ID_BLOGBERICHTEN_CSS', 'blogberichten' );
define( 'ID_BLOG_WIDGET_CSS', 'blog-widget' );
define( 'ID_SINGLE_CSS', 'single-post' );
define( 'ID_GIANTBANNERWIDGET_CSS', 'widget-giant-banner' );

define( 'SOC_MED_NO', 'socmed_nee' );
define( 'SOC_MED_YES', 'socmed_ja' );


if ( ! defined( 'GC_BEELDBANK_BEELD_CPT' ) ) {
	define( 'GC_BEELDBANK_BEELD_CPT', 'beeld' );
} else {
	add_post_type_support( GC_BEELDBANK_BEELD_CPT, 'genesis-layouts' );
}

if ( ! defined( 'GC_BEELDBANK_BRIEF_CPT' ) ) {
	define( 'GC_BEELDBANK_BRIEF_CPT', 'brief' );
} else {
	// Add support for Genesis layouts to force a different layout for brieven
	add_post_type_support( GC_BEELDBANK_BRIEF_CPT, 'genesis-layouts' );
}

if ( ! defined( 'GC_TAX_LICENTIE' ) ) {
	define( 'GC_TAX_LICENTIE', 'licentie' );
}

if ( ! defined( 'GC_TAX_ORGANISATIE' ) ) {
	define( 'GC_TAX_ORGANISATIE', 'organisatie' );
}
if ( ! defined( 'GC_TAX_BRIEFTYPE' ) ) {
	// wordt gebruikt op de beeldbank
	define( 'GC_TAX_BRIEFTYPE', 'brieftype' );
}

if ( ! defined( 'ICTU_GC_CPT_STAP' ) ) {
	define( 'ICTU_GC_CPT_STAP', 'stap' );   // slug for custom taxonomy 'document'
}

if ( ! defined( 'ICTU_GC_CPT_CITAAT' ) ) {
	define( 'ICTU_GC_CPT_CITAAT', 'citaat' );   // slug for custom taxonomy 'citaat'
}

if ( ! defined( 'ICTU_GC_CPT_DOELGROEP' ) ) {
	define( 'ICTU_GC_CPT_DOELGROEP', 'doelgroep' );  // slug for custom post type 'doelgroep'
}

if ( ! defined( 'ICTU_GC_CPT_VAARDIGHEDEN' ) ) {
	define( 'ICTU_GC_CPT_VAARDIGHEDEN', 'vaardigheden' );  // slug for custom post type 'nietzomaarzo'
}

if ( ! defined( 'ICTU_GC_CPT_AANRADER' ) ) {
	define( 'ICTU_GC_CPT_AANRADER', 'aanrader' );  // slug for custom post type 'nietzomaarzo'
}

if ( ! defined( 'ICTU_GC_CPT_AFRADER' ) ) {
	define( 'ICTU_GC_CPT_AFRADER', 'afrader' );  // slug for custom post type 'nietzomaarzo'
}

if ( ! defined( 'ICTU_GC_CPT_METHODE' ) ) {
	define( 'ICTU_GC_CPT_METHODE', 'methode' );  // slug for custom post type 'methode'
}

if ( ! defined( 'ICTU_GC_CPT_PROCESTIP' ) ) {
	define( 'ICTU_GC_CPT_PROCESTIP', 'procestip' );  // slug for custom post type 'methode'
}

if ( ! defined( 'ICTU_GC_CT_TIJD' ) ) {
	define( 'ICTU_GC_CT_TIJD', 'tijd' );  // slug for custom taxonomy 'tijd'
}

if ( ! defined( 'ICTU_GC_CT_MANKRACHT' ) ) {
	define( 'ICTU_GC_CT_MANKRACHT', 'mankracht' );  // slug for custom taxonomy 'mankracht'
}

if ( ! defined( 'ICTU_GC_CT_KOSTEN' ) ) {
	define( 'ICTU_GC_CT_KOSTEN', 'kosten' );  // slug for custom taxonomy 'kosten'
}

if ( ! defined( 'ICTU_GC_CT_EXPERTISE' ) ) {
	define( 'ICTU_GC_CT_EXPERTISE', 'expertise' );  // slug for custom taxonomy 'expertise'
}

if ( ! defined( 'ICTU_GC_CT_DEELNEMERS' ) ) {
	define( 'ICTU_GC_CT_DEELNEMERS', 'deelnemers' );  // slug for custom taxonomy 'deelnemers'
}

if ( ! defined( 'ICTU_GC_CT_ONDERWERP_TIP' ) ) {
	define( 'ICTU_GC_CT_ONDERWERP_TIP', 'onderwerpen' );  // tax for custom cpt do's & dont's
}

if ( ! defined( 'EMP_FORMS_TEXTAREA_SIZE' ) ) {
	define( 'EMP_FORMS_TEXTAREA_SIZE', '4,20' ); // four rows, 20 columns
}

if ( ! defined( 'WBVB_GC_LOGOWIDGET' ) ) {
	define( 'WBVB_GC_LOGOWIDGET', 'GC - Logo-widget' );
}

if ( ! defined( 'GCWBVB_WIDGET_SOKMET_ID' ) ) {
	define( 'GCWBVB_WIDGET_SOKMET_ID', 'social-media-widget' );
}
if ( ! defined( 'GCWBVB_WIDGET_SOKMET_NAME' ) ) {
	define( 'GCWBVB_WIDGET_SOKMET_NAME', 'GC - social media accounts' );  // slug for custom taxonomy 'timeslot'
}


if ( ! defined( 'WBVB_GC_BEELDEN_HOMEWIDGET' ) ) {
	define( 'WBVB_GC_BEELDEN_HOMEWIDGET', 'GC - Featured Content' );
}

if ( ! defined( 'ICTU_GCCONF_CPT_SPEAKER' ) ) {
	define( 'ICTU_GCCONF_CPT_SPEAKER', 'speaker' );   // slug for custom taxonomy 'document'
}

if ( ! defined( 'ICTU_GCCONF_CPT_KEYNOTE' ) ) {
	define( 'ICTU_GCCONF_CPT_KEYNOTE', 'keynote' );  // slug for custom post type 'keynote'
}

if ( ! defined( 'ICTU_GCCONF_CPT_SESSION' ) ) {
	define( 'ICTU_GCCONF_CPT_SESSION', 'session' );   // slug for custom taxonomy 'citaat'
}

if ( ! defined( 'ICTU_GCCONF_CT_LOCATION' ) ) {
	define( 'ICTU_GCCONF_CT_LOCATION', 'location' );  // slug for custom taxonomy 'location'
}

if ( ! defined( 'ICTU_GCCONF_CT_SESSIONTYPE' ) ) {
	define( 'ICTU_GCCONF_CT_SESSIONTYPE', 'sessiontype' );  // slug for custom taxonomy 'sessiontype'
}

if ( ! defined( 'ICTU_GCCONF_CT_LEVEL' ) ) {
	define( 'ICTU_GCCONF_CT_LEVEL', 'expertise' );  // slug for custom taxonomy 'expertise' (workshop level)
}

if ( ! defined( 'ICTU_GCCONF_CT_COUNTRY' ) ) {
	define( 'ICTU_GCCONF_CT_COUNTRY', 'speakercountry' );  // slug for custom taxonomy for a speaker's country
}

if ( ! defined( 'ICTU_GCCONF_CT_TIMESLOT' ) ) {
	define( 'ICTU_GCCONF_CT_TIMESLOT', 'timeslot' );  // slug for custom taxonomy 'timeslot'
}

if ( ! defined( 'WBVB_GC_WIDGET_GIANTBANNER' ) ) {
	define( 'WBVB_GC_WIDGET_GIANTBANNER', 'GC - Giant banner' );
}

if ( ! defined( 'GC_ALLOWED' ) ) {

	define( 'GC_ALLOWED', array(
		0 => 'post',
		1 => 'page',
		2 => ICTU_GC_CPT_DOELGROEP,
		3 => ICTU_GC_CPT_STAP,
		4 => GC_BEELDBANK_BRIEF_CPT,
		5 => GC_BEELDBANK_BEELD_CPT,
		6 => ICTU_GC_CPT_VAARDIGHEDEN,
		7 => ICTU_GC_CPT_PROCESTIP,
		8 => 'podcast'
	) );
}

if ( ! defined( 'LIGHTBOXSCRIPT' ) ) {
	define( 'LIGHTBOXSCRIPT', 'gc-tobi' );
}


define( 'ACF_PLUGIN_NOT_ACTIVE_WARNING', '<p style="position: absolute; top: 3em; left: 3em; display: block; padding: .5em; background: yellow; color: black;">de ACF custom fields plugin is niet actief.</p>' );

define( 'ID_MAINCONTENT', 'maincontent' );
define( 'ID_MAINNAV', 'mainnav' );
define( 'ID_ZOEKEN', 'zoeken' );
define( 'ID_SKIPLINKS', 'skiplinks' );

$siteURL = get_stylesheet_directory_uri();
$siteURL = preg_replace( '|https://|i', '//', $siteURL );
$siteURL = preg_replace( '|http://|i', '//', $siteURL );

define( 'WBVB_THEMEFOLDER', $siteURL );

// Adding excerpt for page
add_post_type_support( 'page', 'excerpt' );

//========================================================================================================

// prepare for translation
load_child_theme_textdomain( 'gebruikercentraal', GC_FOLDER . '/languages' );

//========================================================================================================

add_image_size( HALFWIDTH, 380, 9999, false );
add_image_size( BLOG_SINGLE_MOBILE, 120, 9999, false );
add_image_size( BLOG_SINGLE_TABLET, 250, 9999, false );
add_image_size( BLOG_SINGLE_DESKTOP, 380, 9999, false );
add_image_size( IMG_SIZE_HUGE, IMG_SIZE_HUGE_MIN_WIDTH, 9999, false );

//add_image_size( 'thumb-cardv1', 1600, 900, false );	// max 1600w, max 900h, niet croppen
//add_image_size( 'thumb-cardv2', 1600, 900, true );	// max 1600w, max 900h, wel croppen
add_image_size( 'thumb-cardv3', 99999, 600, false );    // max  600px hoog, niet croppen
//add_image_size( 'thumb-cardv4', 99999, 600, true );	// max  600px hoog, wel croppen
//add_image_size( 'thumb-cardv5', 600, 600, true );		// max  600px hoog en breed, wel croppen

//========================================================================================================

//* Display author box on single posts
add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

//* Display author box on archive pages
add_filter( 'get_the_author_genesis_author_box_archive', '__return_true' );

remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );
add_action( 'genesis_entry_content', 'genesis_do_author_box_single', 20 );



//========================================================================================================

//* voor de widgets
require_once( GC_FOLDER . '/widgets/gc-actieteam-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-e-newsletter.php' );
require_once( GC_FOLDER . '/widgets/gc-user-welcome-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-event-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-berichten-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-footer-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-footer-logo-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-contenttypes-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-socialmedia-widget.php' );
require_once( GC_FOLDER . '/widgets/gc-giant-banner-widget.php' );


require_once( GC_FOLDER . '/includes/common-functions.php' );

// * @since	  4.1.1
require_once( GC_FOLDER . '/includes/related-content-links.php' );

// * @since	  4.1.3
require_once( GC_FOLDER . '/includes/components/cards.php' );

// * @since	  4.1.4
require_once( GC_FOLDER . '/includes/components/home_template_teasers.php' );

// * @since	  4.1.8
require_once( GC_FOLDER . '/includes/components/home_template_stappen.php' );

// * @since	  4.3.6
if ( file_exists( GC_FOLDER . '/includes/ignore-me.php' ) ) {
	require_once( GC_FOLDER . '/includes/ignore-me.php' );
}

// * @since	  4.3.7
require_once( GC_FOLDER . '/includes/spotlight.php' );
require_once( GC_FOLDER . '/includes/textblock-home.php' );

// ACF definitie voor titel bij inschrijformulier
// misschien nog checken of Event Manager actief is?
// @since	4.3.11
require_once( GC_FOLDER . '/includes/acf-definition-bookingform-eventtitle.php' );

//========================================================================================================

require_once( get_stylesheet_directory() . '/nojs.php' );

// does our beloved visitor allow for JavaScript?
$genesis_js_no_js = new Genesis_Js_No_Js;
$genesis_js_no_js->run();

//========================================================================================================

// custom post types, custom taxonomies, custom fields (ACF)
require_once( GC_FOLDER . '/includes/custom-fields-and-post-types.php' );

//========================================================================================================

// functions for the customizer
require_once( GC_FOLDER . '/includes/customizer.php' );

//========================================================================================================

// functions for the author box
require_once( GC_FOLDER . '/includes/author-box.php' );

//========================================================================================================

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//========================================================================================================

$imgbreakpoints = array(
	'break_phone'     => array(
		'direction'             => 'min',
		'width'                 => '1px',
		'header-padding'        => '100px',
		'content-before'        => true,
		'content-height'        => '150px',
		'content-width'         => '50%',
		'img_size_single'       => BLOG_SINGLE_MOBILE,
		'img_size_archive_list' => 'halfwidth'
	),
	'break_tablet'    => array(
		'direction'             => 'min',
		'width'                 => '650px',
		'header-padding'        => '200px',
		'content-before'        => true,
		'content-height'        => '150px',
		'content-width'         => '250px',
		'img_size_single'       => BLOG_SINGLE_TABLET,
		'img_size_archive_list' => 'medium_large'
	),
	'break_fullwidth' => array(
		'direction'             => 'min',
		'width'                 => '960px',
		'header-padding'        => '400px',
		'content-before'        => true,
		'content-height'        => '250px',
		'content-width'         => '350px',
		'img_size_single'       => BLOG_SINGLE_DESKTOP,
		'img_size_archive_list' => IMG_SIZE_HUGE
	),
);

//========================================================================================================

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

//========================================================================================================

//* Reposition the primary navigation menu
//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_header', 'genesis_do_nav', 11 );

//* Reposition the secondary navigation menu
//remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//add_action( 'genesis_footer', 'genesis_do_subnav' );

//* Only register primary menu ( = unregister secondary navigation menu)
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Main menu', 'gebruikercentraal' ) ) );

//========================================================================================================
// deactivate some site layout options
// Remove Genesis layouts

genesis_unregister_layout( 'full-width-content' );
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Unregister primary sidebar
unregister_sidebar( 'sidebar' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove the header right widget area
unregister_sidebar( 'header-right' );

remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );

//========================================================================================================

// Force layout on custom post type 'tip'
add_filter( 'genesis_site_layout', 'allow_only_full_width_layout' );

function allow_only_full_width_layout( $opt ) {

	$opt = 'full-width-content';

	return $opt;
}

//========================================================================================================

// Add site id to body class so we can add layout for a subsite

add_filter( 'body_class', 'gc_add_body_classes' );

function gc_add_body_classes( $classes ) {

	$classes[] = 'site-id-' . get_current_blog_id();

	return $classes;

}


//========================================================================================================

//* Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

//* Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'gc_wbvb_breadcrumb_args' );

function gc_wbvb_breadcrumb_args( $args ) {

	$separator = '<span class="separator">&nbsp;</span>';

	$auteursoverzichtpagina_start = '';
	$auteursoverzichtpagina_end   = $separator;

	if ( function_exists( 'get_field' ) ) {

		if ( get_field( 'auteursoverzichtpagina_link', 'option' ) ):
			$auteursoverzichtpagina_url   = get_field( 'auteursoverzichtpagina_link', 'option' );
			$auteursoverzichtpagina_start = '<a href="' . $auteursoverzichtpagina_url . '">';
			$auteursoverzichtpagina_end   = '</a>' . $separator;
			$args['labels']['author']     = $auteursoverzichtpagina_start . __( "Authors", 'gebruikercentraal' ) . $auteursoverzichtpagina_end;
		else:
			$args['labels']['author'] = '';
		endif;

	} else {
		echo ACF_PLUGIN_NOT_ACTIVE_WARNING;
	}

	if ( is_home() || is_front_page() ) {
		$args['home'] = '';
		$args['sep']  = '';
	} else {
		$args['home'] = __( "Home", 'gebruikercentraal' );
		$args['sep']  = $separator;
	}

	$args['list_sep'] = ', '; // Genesis 1.5 and later

	$args['prefix'] = '<div class="breadcrumb"><div class="wrap"><nav class="breadlist" aria-label="' . _x( "Kruimelpad", 'Aria-label', 'gebruikercentraal' ) . '">';
	$args['suffix'] = '</nav></div></div>';

	$args['heirarchial_attachments'] = true; // Genesis 1.5 and later
	$args['heirarchial_categories']  = true; // Genesis 1.5 and later
	$args['display']                 = true;
	$args['labels']['prefix']        = '';
	$args['labels']['category']      = '';
	$args['labels']['tag']           = __( "Label", 'gebruikercentraal' ) . $separator;
	$args['labels']['date']          = __( "Date archive", 'gebruikercentraal' ) . $separator;
	$args['labels']['search']        = __( "Search result", 'gebruikercentraal' ) . $separator;
	$args['labels']['tax']           = '';
	$args['labels']['post_type']     = '';
	$args['labels']['404']           = __( "Whoops", 'gebruikercentraal' );

	if ( isset( $wp_query->query_vars['taxonomy'] ) ) {

		$tax                   = $wp_query->query_vars['taxonomy'];
		$labels                = get_taxonomy_labels( $tax );
		$args['labels']['tax'] = $labels->singular_name . $separator;

	}

	return $args;

}

//========================================================================================================

add_action( 'genesis_after_entry_content', 'gc_wbvb_after_entry_content' );


function gc_wbvb_after_entry_content() {

	global $post;

	if ( ! is_singular() ) {
		printf( '<div class="read-more"><a href="' . get_permalink() . '">%s%s%s', __( "Read: '", 'gebruikercentraal' ), get_the_title(), "'</a></div>" );
	}

}

//========================================================================================================
//* Customize the entry meta in the entry header (requires HTML5 theme support)

add_filter( 'genesis_entry_header', 'gc_wbvb_page_append_sokmet' );

function gc_wbvb_page_append_sokmet() {

	if ( ! is_page() ) {
		return;
	}
	if ( 'home-inclusie.php' === get_page_template_slug() ) {
		return;
	}
	if ( 'home-beeldbank.php' === get_page_template_slug() ) {
		return;
	}
	if ( ICTU_GC_CPT_STAP === get_post_type() ) {
		return;
	}

	global $wp_query;
	global $post;

	$show_socialmedia_buttons_global       = get_field( 'show_socialmedia_buttons_global', 'option' );
	$show_socialmedia_buttons_on_this_page = SOC_MED_YES;

	if ( function_exists( 'get_field' ) ) {
		$show_socialmedia_buttons_on_this_page = get_field( 'socialmedia_icoontjes', $post->ID );
	}

	if ( ( $show_socialmedia_buttons_global !== SOC_MED_NO ) && ( $show_socialmedia_buttons_on_this_page !== SOC_MED_NO ) ) {
		echo gc_wbvb_socialbuttons( $post, '' );
	}

}

//========================================================================================================
//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'gc_wbvb_post_append_postinfo' );

function gc_wbvb_post_append_postinfo( $post_info ) {

	global $wp_query;
	global $post;


	// @since 4.3.4
	if ( ! function_exists( 'get_field' ) ) {
		return ACF_PLUGIN_NOT_ACTIVE_WARNING;
	} else {

		$show_socialmedia_buttons_global       = get_field( 'show_socialmedia_buttons_global', 'option' );
		$show_socialmedia_buttons_on_this_page = SOC_MED_YES;

		if (
			( 'page' == get_post_type() ) ||
			( 'post' == get_post_type() ) ||
			( 'event' == get_post_type() )
		) {

			if ( function_exists( 'get_field' ) ) {
				$show_socialmedia_buttons_on_this_page = get_field( 'socialmedia_icoontjes', $post->ID );
			} else {
				$show_socialmedia_buttons_on_this_page = '';
			}
		}


		if ( ( $show_socialmedia_buttons_global !== SOC_MED_NO ) && ( $show_socialmedia_buttons_on_this_page !== SOC_MED_NO ) && ( is_single() || is_page() ) ) {
			$show_socialmedia_buttons_on_this_page = gc_wbvb_socialbuttons( $post, '' );
		} else {
			$show_socialmedia_buttons_on_this_page = '';
		}

		if ( is_home() ) {
			// niks, eigenlijk
			return '[post_date]';
		} elseif ( is_page() ) {
			// niks, eigenlijk
			return '[post_date]';
		} else {

			if ( 'event' == get_post_type() ) {
				return '';
//			} elseif ( 'page' == get_post_type() ) {
//				return '';
			} elseif ( 'podcast' == get_post_type() ) {
				return '';
			} elseif ( ICTU_GC_CPT_STAP == get_post_type() ) {
				return '';
			} elseif ( GC_BEELDBANK_BEELD_CPT == get_post_type() ) {
				if ( is_single() ) {
					return do_shortcode( '[post_terms taxonomy="' . GC_TAX_LICENTIE . '" before=""] - [post_terms taxonomy="' . GC_TAX_ORGANISATIE . '" before=""]' );
				}
			} elseif ( GC_BEELDBANK_BRIEF_CPT == get_post_type() ) {
				// toon info over een brief: taxonomie organisatie en brieftype
				if ( is_single() ) {
					$term1 = do_shortcode( '[post_terms taxonomy="' . GC_TAX_ORGANISATIE . '" before=""]' );
					$term2 = do_shortcode( '[post_terms taxonomy="' . GC_TAX_BRIEFTYPE . '" before=""]' );
					if ( $term1 ) {
						$term1 = '<span class="meta-data__item">' . $term1 . '</span>';
					}
					if ( $term2 ) {
						$term2 = '<span class="meta-data__item">' . $term2 . '</span>';
					}
					if ( $term1 || $term1 ) {
						return '<span class="metadata">' . $term1 . $term2 . '</span>';
					} else {
						return '';
					}
				}
			} elseif ( 'post' == get_post_type() ) {
				if ( is_single() ) {
					return __( 'Author', 'gebruikercentraal' ) . ': ' . '[post_author_posts_link]';
				} else {
					return '[post_author_posts_link] [post_date] [post_comments] ' . $show_socialmedia_buttons_on_this_page;
				}
			} else {
				return '';
			}
		}
	}
}

//========================================================================================================

function gc_wbvb_get_date_badge() {

	if ( ( GC_BEELDBANK_BEELD_CPT == get_post_type() )
	     || ( GC_BEELDBANK_BRIEF_CPT == get_post_type() )
	     || ( ICTU_GC_CPT_STAP == get_post_type() )
	     || ( ICTU_GC_CPT_CITAAT == get_post_type() )
	     || ( ICTU_GC_CPT_DOELGROEP == get_post_type() )
	     || ( ICTU_GC_CPT_VAARDIGHEDEN == get_post_type() )
	     || ( ICTU_GC_CPT_METHODE == get_post_type() )
	     || ( ICTU_GCCONF_CPT_SPEAKER == get_post_type() )
	     || ( ICTU_GCCONF_CPT_KEYNOTE == get_post_type() )
	     || ( ICTU_GCCONF_CPT_SESSION == get_post_type() )
	) {
		return;
	}

	$publishdate = get_the_date();

	if ( date( "Y" ) == get_the_date( 'Y' ) ) {
		$jaar = '';
	} else {
		$jaar = '<span class="jaar" aria-hidden="true">' . get_the_date( 'Y' ) . '</span>';
	}

	$publishdate_label = sprintf( __( 'Gepubliceerd op %s', 'gebruikercentraal' ), $publishdate );

	echo ' <span class="date-badge" itemprop="datePublished" content="' . $publishdate . '" aria-labelledby="johohohohoho"><span class="dag" aria-hidden="true">' . get_the_date( 'd' ) . '</span> <span class="maand" aria-hidden="true">' . get_the_date( 'M' ) . '</span>' . $jaar . '<span id="johohohohoho" class="visuallyhidden">' . $publishdate_label . '</span></span>';

}

//========================================================================================================

function gc_wbvb_add_single_socialmedia_buttons() {

	global $post;


	$show_socialmedia_buttons_on_this_page = '';

	if ( 'podcast' == get_post_type() ) {
		return;
	}

	if ( function_exists( 'get_field' ) ) {

		$show_socialmedia_buttons_global = get_field( 'show_socialmedia_buttons_global', 'option' );

		if ( $show_socialmedia_buttons_global !== SOC_MED_NO ) {

			$show_socialmedia_buttons_on_this_page = get_field( 'socialmedia_icoontjes', $post->ID );

			if ( ( $show_socialmedia_buttons_on_this_page !== SOC_MED_NO ) && ( is_single() ) ) {
				$show_socialmedia_buttons_on_this_page = gc_wbvb_socialbuttons( $post, '' );
			}
		}
	}

	echo $show_socialmedia_buttons_on_this_page;

}

//========================================================================================================

function gc_wbvb_check_socialbuttons( $post_info, $hidden = '' ) {

	$show_socialmedia_buttons_global = '';

	// @since 4.3.4
	if ( function_exists( 'get_field' ) ) {
		$show_socialmedia_buttons_global = get_field( 'show_socialmedia_buttons_global', 'option' );
	}

	if ( $show_socialmedia_buttons_global !== SOC_MED_NO ) {
		return gc_wbvb_socialbuttons( $post_info, $hidden );
	} else {
		return '';
	}


}

//========================================================================================================

function gc_wbvb_socialbuttons( $post_info, $hidden = '' ) {

	$thelink   = urlencode( get_permalink( $post_info->ID ) );
	$thetitle  = urlencode( $post_info->post_title );
	$sitetitle = urlencode( get_bloginfo( 'name' ) );
	$summary   = urlencode( $post_info->post_excerpt );
	$comment   = '';

	$twitteraccount = 'gebrcentraal';

	// @since 4.3.4
	if ( function_exists( 'get_field' ) ) {
		$twitteraccount = ( get_field( 'siteoptions_twitter_account', 'option' ) ) ? get_field( 'siteoptions_twitter_account', 'option' ) : GC_TWITTERACCOUNT;
	}


	if ( $hidden ) {
		$comment  = '<!-- ey, we hoeven maar 1 werkende set sokmetknoppen te gebruiken ja? dit hiero is versiering -->';
		$thetag   = 'i';
		$hrefattr = 'data-href';
		$popup    = ' onclick="javascript:window.open(this.dataset.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"';
	} else {
		$thetag   = 'a';
		$hrefattr = 'href';
		$popup    = ' onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;"';
	}

	if ( $thelink ) {
		return $comment . '<ul class="social-media share-buttons">
            <li><' . $thetag . ' ' . $hrefattr . '="https://twitter.com/share?url=' . $thelink . '&via=' . $twitteraccount . '&text=' . $thetitle . '" class="twitter" data-url="' . $thelink . '" data-text="' . $thetitle . '" data-via="' . $twitteraccount . '"' . $popup . '><span class="visuallyhidden">' . __( 'Share on Twitter', 'gebruikercentraal' ) . '</span></' . $thetag . '></li>
            <li><' . $thetag . ' class="facebook" ' . $hrefattr . '="https://www.facebook.com/sharer/sharer.php?u=' . $thelink . '&t=' . $thetitle . '"' . $popup . '><span class="visuallyhidden">' . __( 'Share on Facebook', 'gebruikercentraal' ) . '</span></' . $thetag . '></li>
            <li><' . $thetag . ' class="linkedin" ' . $hrefattr . '="http://www.linkedin.com/shareArticle?mini=true&url=' . $thelink . '&title=' . $thetitle . '&summary=' . $summary . '&source=' . $sitetitle . '"' . $popup . '><span class="visuallyhidden">' . __( 'Share on LinkedIn', 'gebruikercentraal' ) . '</span></' . $thetag . '></li>
            </ul>';

	}
}


//========================================================================================================
//* Customize the entry meta in the entry footer
add_filter( 'genesis_post_meta', 'gc_wbvb_single_post_meta', 4 );

function gc_wbvb_single_post_meta( $post_meta ) {
	global $post;
	$return = '';

	if (
		( ( 'post' == get_post_type() ) && ( is_single() ) ) ||
		( ( 'event' == get_post_type() ) && ( is_single() ) )
	) {

		// remove the footer markup
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

		if ( 'post' == get_post_type() ) {
//            $return = '[post_categories]    [post_tags]';
			remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		} else {
			//* Remove the post meta function
			remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
			remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
		}
	}

	return $return;
}


//========================================================================================================

add_filter( 'genesis_post_title_output', 'gc_wbvb_sharebuttons_for_page_top', 15 );

function gc_wbvb_sharebuttons_for_page_top( $title ) {

	global $post;

	// @since 4.3.4
	if ( ! function_exists( 'get_field' ) ) {
		echo ACF_PLUGIN_NOT_ACTIVE_WARNING;
	} else {

		$show_socialmedia_buttons_global       = get_field( 'show_socialmedia_buttons_global', 'option' );
		$show_socialmedia_buttons_on_this_page = SOC_MED_YES;

		if ( is_page() ) {
			if ( function_exists( 'get_field' ) ) {
				$show_socialmedia_buttons_on_this_page = get_field( 'socialmedia_icoontjes', $post->ID );
			}

			if ( ( $show_socialmedia_buttons_global !== SOC_MED_NO ) && ( $show_socialmedia_buttons_on_this_page !== SOC_MED_NO ) && ( is_single() ) ) {
				$show_socialmedia_buttons_on_this_page = gc_wbvb_socialbuttons( $post, '' );
			} else {
				$show_socialmedia_buttons_on_this_page = '';
			}
			$title .= $show_socialmedia_buttons_on_this_page;
		}

		return $title;

	}

}


//========================================================================================================

// Ervoor zorgen dat het commentform niet leeg gelaten kan worden
add_action( 'wp_enqueue_scripts', 'gc_wbvb_comment_form_script' );

function gc_wbvb_comment_form_script() {

	if ( is_singular() && comments_open() ) {

		wp_enqueue_script( 'commentform', WBVB_THEMEFOLDER . '/js/commentform.js?v3', array( 'jquery' ), '', true );

		$protocol = isset( $_SERVER["HTTPS"] ) ? 'https://' : 'http://'; //This is used to set correct adress if secure protocol is used so ajax calls are working
		$params   = array(
			'ajax_url'    => admin_url( 'admin-ajax.php', $protocol ),
			'empty_email' => __( 'Please enter a valid email address', 'gebruikercentraal' ),
			'saving'      => __( 'Saving...', 'gebruikercentraal' )
		);

		wp_localize_script( 'commentform', 'email_newsletter_widget_scripts', $params );

	}

}

//========================================================================================================
function debugmessage( $message, $tag = 'p', $context = '' ) {


	if ( WP_THEME_DEBUG && WP_DEBUG ) {
		echo '<' . $tag . ' class="debugmessage">' . $message;

		if ( $context ) {
			echo ' (context: ' . $context . ')';
		}
		echo '<br/>R: ' . WP_THEME_DEBUG . ' / D: ' . WP_DEBUG;
		echo '</' . $tag . '>';
	}

}


//========================================================================================================

add_action( 'wp_enqueue_scripts', 'gc_wbvb_add_css' );

if ( WP_DEBUG ) {
	add_action( 'wp_enqueue_scripts', 'gc_shared_add_debug_css' );
}

//========================================================================================================

/**
 * Add a link first thing after the body element that will skip to the inner element.
 */

add_action( 'genesis_before_header', 'gc_wbvb_add_skip_link' );

function gc_wbvb_add_skip_link() {

	$skip_to_maincontent = '';
	$skip_to_main        = sprintf( '<li><a href="#%1$s">%2$s</a></li>', ID_MAINCONTENT, _x( 'Jump to main content', 'Skiplinks', 'gebruikercentraal' ) );

	if ( has_nav_menu( 'primary' ) ) {
		// skiplink alleen toevoegen als er op 'primary' menu locatie een menu actief is
		$skip_to_maincontent = sprintf( '<li><a href="#%1$s">%2$s</a></li>', ID_MAINNAV, _x( 'Jump to main navigation', 'Skiplinks', 'gebruikercentraal' ) );
	}

	echo sprintf( '<ul id="%1$s">' . $skip_to_main . $skip_to_maincontent . '</ul>', ID_SKIPLINKS );

}

//========================================================================================================

function gc_wbvb_check_actieteamlid() {

	if ( ( GC_BEELDBANK_BEELD_CPT == get_post_type() ) || ( GC_BEELDBANK_BRIEF_CPT == get_post_type() ) ) {
		return;
	}

	// checken of dit een lid van het actieteam is

	if ( is_author() ) {

		if ( $author_id = get_query_var( 'author' ) ) {
			$author = get_user_by( 'id', $author_id );
		}


		if ( have_rows( 'actieteamleden', 'option' ) ):

			while ( have_rows( 'actieteamleden', 'option' ) ): the_row();

				$actieteamlid = get_sub_field( 'actielid' );
				$acf_userid   = $actieteamlid['ID'];


				if ( $author_id == $acf_userid ) {

					if ( function_exists( 'get_field' ) && get_field( 'actieteampagina_link', 'option' ) ) {
						$auteursoverzichtpagina_url   = get_field( 'actieteampagina_link', 'option' );
						$auteursoverzichtpagina_start = '<a href="' . $auteursoverzichtpagina_url . '" class="cta">';
						$auteursoverzichtpagina_end   = '</a>';
						$pagina_actieteam_id          = url_to_postid( $auteursoverzichtpagina_url );
						$user_info                    = get_userdata( $author_id );

						$displayname = ( $user_info->first_name ? $user_info->first_name : ( $user_info->display_name ? $user_info->display_name : '?' ) );

						if ( $pagina_actieteam_id ) {
							echo '<div class="author-info lid-actieteam">';
							echo '<div class="bg-color">';
							echo '<h2>' . $displayname . ' ' . __( 'is lid van het actieteam', 'gebruikercentraal' ) . '</h2>';
							$post   = get_post( $pagina_actieteam_id );
							$output = apply_filters( 'the_content', $post->post_content );
							echo $output;
							echo $auteursoverzichtpagina_start . __( 'Alle actieteamleden', 'gebruikercentraal' ) . $auteursoverzichtpagina_end;
							echo '</div>';
							echo '</div>';

						}
					}
					break;
				}

			endwhile;

		else:

		endif;

	}


}

//========================================================================================================

function gc_wbvb_404_no_posts_content_header() {

	if ( is_author() ) {
		gc_wbvb_check_actieteamlid();
	} else {
		printf( '<div class="archive-description"><h1 class="archive-title">%s</h1></div>', __( 'Not found, error 404', 'gebruikercentraal' ) );
	}

}

//========================================================================================================

function gc_wbvb_404_no_posts_content() {

	// show a (UNIQUE) search form
	$searchform = get_search_form( array( 'echo' => false ) );
	$searchform = preg_replace( '|id="zoeken"|i', 'id="zoeken_no_result"', $searchform );
	$searchform = preg_replace( '|searchform-2|i', 'searchform-22', $searchform );

	if ( is_author() ) {
	} else {
		echo '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'gebruikercentraal' ), home_url() ) . '</p>';
		echo $searchform;

	}

}


//========================================================================================================
// voor pagina's zonder goede 404-afhandeling

remove_action( 'genesis_loop_else', 'genesis_404' );
remove_action( 'genesis_loop_else', 'genesis_do_noposts' );


add_action( 'genesis_loop', 'gc_wbvb_check_actieteamlid', 1 );

add_action( 'genesis_loop_else', 'gc_wbvb_404_no_posts_content_header', 13 );
add_action( 'genesis_loop_else', 'gc_wbvb_404_no_posts_content', 14 );
add_action( 'genesis_loop_else', 'gc_wbvb_404', 15 );


//========================================================================================================

function gc_wbvb_404() {

	if ( is_author() ) {
	} else {

//		echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';

		if ( is_404() ) {
			gc_wbvb_404_no_posts_content_header();
		}

		echo '<div class="entry-content">';

		if ( is_404() ) {
			gc_wbvb_404_no_posts_content();
		}

		$count_pages = wp_count_posts( 'page' );

		if ( $count_pages ) {
			?>
            <h2><?php _e( 'Pages:', 'gebruikercentraal' ); ?></h2>
            <ul>
				<?php wp_list_pages( 'exclude=78,80&title_li=' ); ?>
            </ul>
			<?php
		}

		$maxnr       = 20;
		$count_posts = wp_count_posts();

		if ( $count_posts->publish > 1 ) {

			echo '<h2>' . sprintf( __( 'The %s most recent posts', 'gebruikercentraal' ), $maxnr ) . '</h2>';
			?>

            <ul>
				<?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => $maxnr ) ); ?>
            </ul>

            <h2><?php _e( 'Topics:', 'gebruikercentraal' ); ?></h2>
            <ul>
				<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
            </ul>

            <h2><?php _e( 'Authors:', 'gebruikercentraal' ); ?></h2>
            <ul>
				<?php wp_list_authors( 'exclude_admin=0&optioncount=0' ); ?>
            </ul>
			<?php
		}

		if ( defined( 'ICTU_GC_CPT_STAP' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GC_CPT_STAP ) );
		}

		if ( defined( 'ICTU_GC_CPT_DOELGROEP' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GC_CPT_DOELGROEP ) );
		}

		if ( defined( 'ICTU_GC_CPT_VAARDIGHEDEN' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GC_CPT_VAARDIGHEDEN ) );
		}

		if ( defined( 'ICTU_GC_CPT_METHODE' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GC_CPT_METHODE ) );
		}

		if ( defined( 'ICTU_GC_CPT_PROCESTIP' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GC_CPT_PROCESTIP ) );
		}

		if ( defined( 'ICTU_GCCONF_CPT_SESSION' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GCCONF_CPT_SESSION ) );
		}

		if ( defined( 'ICTU_GCCONF_CPT_KEYNOTE' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GCCONF_CPT_KEYNOTE ) );
		}

		if ( defined( 'ICTU_GCCONF_CPT_SPEAKER' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GCCONF_CPT_SPEAKER ) );
		}

		// beelden en brieven
		if ( defined( 'GC_KLANTCONTACT_BRIEF_CPT' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => ICTU_GCCONF_CPT_SPEAKER ) );
		}

		if ( defined( 'GC_KLANTCONTACT_BEELDEN_CPT' ) ) {
			gc_wbvb_sitemap_show_cpt_content( array( 'customcpt' => GC_KLANTCONTACT_BEELDEN_CPT ) );
		}


		echo '</div>';

//		echo genesis_html5() ? '</article>' : '</div>';

	}

}

//========================================================================================================

if ( ! function_exists( 'gc_wbvb_sitemap_show_cpt_content' ) ) {

	function gc_wbvb_sitemap_show_cpt_content( $args = [] ) {

		$defaults = array(
			'customcpt' => '',
			'order'     => 'ASC',
			'orderby'   => 'name',
			'limit'     => '',
			'type'      => 'alpha',
			'echo'      => true
		);

		// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );


		if ( $args['customcpt'] && post_type_exists( $args['customcpt'] ) ) {

			$obj   = get_post_type_object( $args['customcpt'] );
			$titel = $obj->labels->name;

			$args2     = array(
				'type'      => 'postbypost',
				'title_li'  => '',
				'post_type' => $args['customcpt'],
				'orderby'   => $args['orderby'],
				'order'     => $args['order'],
				'limit'     => $args['limit'],
				'type'      => $args['type'],
				'echo'      => 0,
			);
			$listpages = wp_list_pages( $args2 );

			if ( ! $listpages ) {

				$args2     = array(
					'post_type' => $args['customcpt'],
					'title_li'  => '',
					'orderby'   => $args['orderby'],
					'order'     => $args['order'],
					'limit'     => $args['limit'],
					'type'      => $args['type'],
					'echo'      => 0,
				);
				$listpages = wp_get_archives( $args2 );

			}

			if ( $listpages ) {

				echo '<h2>' . $titel . '</h2>';
				echo '<ul>';
				echo $listpages;
				echo '</ul>';

			}
		}
	}
}

//========================================================================================================

if ( ! function_exists( 'dovardump' ) ) {

	function dovardump( $data, $context = '', $echo = true ) {

		if ( WP_DEBUG ) {
			$contextstring = '';
			$startstring   = '<hr><div class="debug-context-info">';
			$endtring      = '</div>';

			if ( $context ) {
				error_log( 'context "' . $context . '"' );
				$contextstring = '<p>Vardump ' . $context . '</p>';
			}

			if ( is_array( $data ) || is_object( $data ) ) {
				$theline = "array: " . print_r( $data, false );
			} else {
				$theline = $data;
			}

			error_log( $theline );

			if ( $echo ) {
				echo $startstring . '<hr>';
				echo $contextstring;
				echo '<pre>';
				print_r( $data );
				echo '</pre><hr>' . $endtring;
			} else {
				return '<hr>' . $contextstring . '<pre>' . print_r( $data, true ) . '</pre><hr>';
			}
		}
	}
}

//========================================================================================================

function gc_wbvb_add_pageheader_tags() {

	$postid                   = get_the_ID();
	$featimg_automatic_insert = 'ja';

	// @since 4.3.4
	if ( function_exists( 'get_field' ) ) {
		$featimg_automatic_insert = get_field( 'featimg_automatic_insert', $postid );
	}

	if ( 'nee' !== $featimg_automatic_insert ) {
		$featimg_automatic_insert = 'ja';
	}

	// check of het eerste bericht een enorme afbeelding heeft
	if ( has_post_thumbnail( $postid ) && 'ja' === $featimg_automatic_insert ) {

		$img_id = get_post_thumbnail_id( $postid );
		$image  = wp_get_attachment_image_src( $img_id, IMG_SIZE_HUGE );
		$alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true );

		if ( $image[1] >= IMG_SIZE_HUGE_MIN_WIDTH ) {
			echo '<figure class="hero-image"><img src="' . $image[0] . '" class="hero-image__image" alt="' . $alt_text . '"></figure>';
		}

	}

}

//========================================================================================================

function gc_wbvb_add_pageheader_css() {

	global $imgbreakpoints;

	if ( is_singular( ICTU_GCCONF_CPT_SPEAKER ) ) {
		return;
	}

	$BLOGBERICHTEN_CSS = '';


	if ( have_posts() ) :

		$countertje = 0;

		while ( have_posts() ) : the_post();

			// do loop stuff
			$countertje ++;
			$postid                   = get_the_ID();
			$permalink                = get_permalink( $postid );
			$publishdate              = get_the_date();
			$theID                    = 'featured_image_post_' . $postid;
			$the_image_ID             = 'image_' . $theID;
			$extra_class              = '';
			$class                    = 'feature-image noimage';
			$featimg_automatic_insert = get_field( 'featimg_automatic_insert', $postid );
			$theid                    = 'imgid_' . $postid;

			if ( 'nee' !== $featimg_automatic_insert ) {
				$featimg_automatic_insert = 'ja';
			}

			// check of het eerste bericht een enorme afbeelding heeft
			if ( has_post_thumbnail( $postid ) && 'ja' === $featimg_automatic_insert ) {

				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), IMG_SIZE_HUGE );

				if ( $image[1] >= IMG_SIZE_HUGE_MIN_WIDTH ) {

					$BLOGBERICHTEN_CSS .= "   background-image: url('" . $image[0] . "');\n";

					foreach ( $imgbreakpoints as $breakpoint ) {

						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), $breakpoint['img_size_archive_list'] );

						$BLOGBERICHTEN_CSS .= "   background-image: url('" . $image[0] . "');\n";

					}
				}
			}

		endwhile;
	/** end of one post **/

	else : /** if no posts exist **/

	endif;
	/** end loop **/

	wp_add_inline_style( ID_SKIPLINKS, $BLOGBERICHTEN_CSS );

}

//========================================================================================================

function gc_wbvb_add_blog_single_css() {

	global $imgbreakpoints;

	if ( is_singular( ICTU_GCCONF_CPT_SPEAKER ) ) {
		return;
	}

	$BLOGBERICHTEN_CSS = '';

	if ( have_posts() ) :

		$countertje = 0;

		while ( have_posts() ) : the_post();

			if ( ( GC_BEELDBANK_BEELD_CPT === get_post_type() ) || ( GC_BEELDBANK_BRIEF_CPT === get_post_type() ) ) {
				// * @since	  4.2.1
				// niet meer tonen voor beelden of brieven
				continue;
			}


			// do loop stuff
			$countertje ++;
			$postid                   = get_the_ID();
			$permalink                = get_permalink( $postid );
			$publishdate              = get_the_date();
			$theID                    = 'featured_image_post_' . $postid;
			$the_image_ID             = 'image_' . $theID;
			$extra_class              = '';
			$class                    = 'feature-image noimage';
			$featimg_automatic_insert = 'ja';

			// @since 4.3.4
			if ( function_exists( 'get_field' ) ) {
				$featimg_automatic_insert = get_field( 'featimg_automatic_insert', $postid );
			}

			if ( 'nee' !== $featimg_automatic_insert ) {
				$featimg_automatic_insert = 'ja';
			}

			// check of het eerste bericht een enorme afbeelding heeft
			if ( has_post_thumbnail( $postid ) && 'ja' === $featimg_automatic_insert ) {

				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), IMG_SIZE_HUGE );

				if ( $image[1] >= IMG_SIZE_HUGE_MIN_WIDTH ) {

					$BLOGBERICHTEN_CSS .= "\n\n" .
					                      ".content:before {\n" .
					                      "   content: ' '; \n" .
					                      "   display: block; \n " .
					                      "} \n\n";

					foreach ( $imgbreakpoints as $breakpoint ) {

						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), $breakpoint['img_size_archive_list'] );

						$BLOGBERICHTEN_CSS .=
							"@media only screen and (" . $breakpoint['direction'] . "-width: " . $breakpoint['width'] . " ) {\n" .
							"   .content:before { \n" .
							"       background-image: url('" . $image[0] . "');\n" .
							"   } \n" .
							"} \n\n";

					}

					$class       = 'feature-image';
					$extra_class = ' enorm-huge';

				} else {

					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );

					if ( $image[0] ) {

						foreach ( $imgbreakpoints as $breakpoint ) {

							if ( $breakpoint['content-before'] ) {

								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), $breakpoint['img_size_single'] );

								$BLOGBERICHTEN_CSS .= '@media only screen and (' . $breakpoint['direction'] . '-width: ' . $breakpoint['width'] . " ) {\n";
								$BLOGBERICHTEN_CSS .= " .content .entry-content:before { \n";
								$BLOGBERICHTEN_CSS .= "   content: ' ';\n";
								$BLOGBERICHTEN_CSS .= "   width: " . $image[1] . "px;\n";
								$BLOGBERICHTEN_CSS .= "   height: " . $image[2] . "px;\n";
								$BLOGBERICHTEN_CSS .= "   margin: 0 0 16px 16px;\n";
								$BLOGBERICHTEN_CSS .= "   display: block;\n";
								$BLOGBERICHTEN_CSS .= "   float: right;\n";
								$BLOGBERICHTEN_CSS .= "   background-image: url('" . $image[0] . "');\n";
								$BLOGBERICHTEN_CSS .= "   background-size: cover;\n";
								$BLOGBERICHTEN_CSS .= " } \n";
								$BLOGBERICHTEN_CSS .= "} \n";
							}
						}
					} else {
						// heeft geen image
					}
				}
			} else {

			}


		endwhile;
	/** end of one post **/

	else : /** if no posts exist **/

	endif;
	/** end loop **/

	wp_add_inline_style( ID_SKIPLINKS, $BLOGBERICHTEN_CSS );

}

//========================================================================================================

function gc_wbvb_add_berichten_widget_css() {

	$args = array(
		'post_type'           => 'post',
		'posts_per_page'      => 5,
		'ignore_sticky_posts' => 1,
		'order'               => 'DESC',
		'orderby'             => 'date'
	);


	$sidebarposts = new WP_query( $args );

	$custom_css = '';

	$countertje = 0; // Run your normal loop

	if ( $sidebarposts->have_posts() ) {

		while ( $sidebarposts->have_posts() ) : $sidebarposts->the_post();

			// do loop stuff
			$countertje ++;
			$getid = get_the_ID();
			$theID = 'featured_image_post_' . $getid;

			if ( has_post_thumbnail( $sidebarposts->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $sidebarposts->ID ), 'large' );

				if ( $image[0] ) {
					$custom_css .= '#' . $theID . " { \n";
					$custom_css .= "background-image: url('" . $image[0] . "');\n";
					$custom_css .= "}\n";
				}
			}

		endwhile;

		wp_reset_postdata();

	}

	wp_add_inline_style( ID_SKIPLINKS, $custom_css );

}

//========================================================================================================


//========================================================================================================

function gc_wbvb_add_blog_archive_css() {

	global $imgbreakpoints;

	$BLOGBERICHTEN_CSS = '';
	$countertje        = 0;

	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			// do loop stuff
			$countertje ++;
			$getid        = get_the_ID();
			$posttype     = get_post_type( $getid );
			$permalink    = get_permalink( $getid );
			$publishdate  = get_the_date();
			$theID        = 'featured_image_post_' . $getid; // archive header css
			$the_image_ID = 'image_' . $theID; // HIERO, header css
			$extra_class  = '';
			$class        = 'feature-image noimage';
			$image        = '';

			$BLOGBERICHTEN_CSS .= '/* gc_wbvb_add_blog_archive_css: ' . sanitize_title( $the_image_ID ) . " */\n";

			// check of het eerste bericht een enorme afbeelding heeft
			if ( $countertje == 1 && 'post' == $posttype ) {

				if ( has_post_thumbnail( $getid ) ) {

					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), IMG_SIZE_HUGE );

					if ( $image[1] >= IMG_SIZE_HUGE_MIN_WIDTH ) {

						$breakpointcounter = 0;
						// width > 1200px

						foreach ( $imgbreakpoints as $breakpoint ) {

							$breakpointcounter ++;

							$theID2            = $theID;
							$image             = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), $breakpoint['img_size_archive_list'] );
							$BLOGBERICHTEN_CSS .= '@media only screen and (' . $breakpoint['direction'] . '-width: ' . $breakpoint['width'] . " ) {\n";
							$BLOGBERICHTEN_CSS .= ' #' . $theID2 . " { \n";
							$BLOGBERICHTEN_CSS .= "	background-image: url('" . $image[0] . "');\n";
							$BLOGBERICHTEN_CSS .= "	background-repeat: no-repeat;\n";
							$BLOGBERICHTEN_CSS .= " } \n";
							$BLOGBERICHTEN_CSS .= "} \n";
						}

						$class       = 'feature-image';
						$extra_class = ' enorm-huge';

					} else {

						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'large' );

						if ( $image[0] ) {
							$BLOGBERICHTEN_CSS .= '#' . $theID . " .feature-image { \n";
							$BLOGBERICHTEN_CSS .= " background-image: url('" . $image[0] . "');\n";
							$BLOGBERICHTEN_CSS .= " background-repeat: no-repeat;\n";
							$BLOGBERICHTEN_CSS .= "} \n";
							$extra_class       = ' ';
							$class             = 'simple feature-image';
//							$BLOGBERICHTEN_CSS .= '/* gc_wbvb_add_blog_archive_css: ' . sanitize_title( $image[0] ) . " */\n";
						}
					}
				}
			} else {

				if ( has_post_thumbnail( $getid ) ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'large' );
				} elseif ( function_exists( 'get_field' ) && GC_BEELDBANK_BEELD_CPT == get_post_type( $getid ) ) {

					$attachment = get_field( 'beeld_foto', $getid );
					if ( isset( $attachment['ID'] ) ) {
						$image = wp_get_attachment_image_src( $attachment['ID'], 'large' );
					}
				}

				if ( $image && $image[0] ) {
					$BLOGBERICHTEN_CSS .= '#' . $the_image_ID . "_thumbnail { ";
					$BLOGBERICHTEN_CSS .= "background-image: url('" . $image[0] . "'); ";
					$BLOGBERICHTEN_CSS .= "} ";
					$class             = 'feature-image';
//					$BLOGBERICHTEN_CSS .= '/* ' . sanitize_title( $image[0] ) . " */\n";
//					$BLOGBERICHTEN_CSS .= '/* gc_wbvb_add_blog_archive_css: ' . sanitize_title( $image[0] ) . " */\n";
				}

			}

		endwhile;
	/** end of one post **/

	else : /** if no posts exist **/

	endif;
	/** end loop **/

	wp_add_inline_style( ID_SKIPLINKS, $BLOGBERICHTEN_CSS );

}

//========================================================================================================

function gc_wbvb_add_css() {

//			$dependencies = array( ID_SKIPLINKS );
	$dependencies = array();

	wp_enqueue_style(
		ID_SKIPLINKS,
		get_stylesheet_directory_uri() . '/css/gc-style.css',
		$dependencies,
		CHILD_THEME_VERSION,
		'all'
	);

	$custom_css = '
	ul#' . ID_SKIPLINKS . ', ul#' . ID_SKIPLINKS . ' li {
		list-style-type: none;
		list-style-image: none;
		padding: 0;
		margin: 0;
	}
	ul#' . ID_SKIPLINKS . ' li {
		background: none;
	}
	#' . ID_SKIPLINKS . ' li a {
		position: absolute;
		top: -1000px;
		left: 50px;
	}
	#' . ID_SKIPLINKS . ' li a:focus {
		left: 6px;
		top: 7px;
		height: auto;
		width: auto;
		display: block;
		font-size: 14px;
		font-weight: 700;
		padding: 15px 23px 14px;
		background: #f1f1f1;
		color: #21759b;
		z-index: 100000;
		line-height: normal;
		text-decoration: none;
		-webkit-box-shadow: 0 0 2px 2px rgba(0,0,0,.6);
		box-shadow: 0 0 2px 2px rgba(0,0,0,.6)
	}

	#' . ID_MAINNAV . ':focus {
		position: relative;
		z-index: 100000;
	}

	#' . ID_MAINNAV . ' a:focus {
		position: relative;
		z-index: 100000;
		color: #fff;
	}


	#' . ID_ZOEKEN . ':focus label {
		position: relative;
		left: 0;
		top: 0;
	}';

	wp_add_inline_style( ID_SKIPLINKS, $custom_css );

}

//========================================================================================================
/* CSS voor admin, site en debug
*/

function admin_append_editor_styles() {
	add_editor_style( WBVB_THEMEFOLDER . '/css/editor-styles.css?v=' . CHILD_THEME_VERSION );
}

add_action( 'init', 'admin_append_editor_styles' );


//========================================================================================================


// Change favicon location and add touch icons
add_filter( 'genesis_pre_load_favicon', 'gc_wbvb_add_favicon_filter' );

function gc_wbvb_add_favicon_filter( $favicon ) {

	$nuttig = false;

	echo '<link rel="Shortcut Icon" href="' . WBVB_THEMEFOLDER . '/images/favicon.ico" type="image/x-icon" />' . "\n";
	if ( $nuttig ) {

		echo '<link rel="apple-touch-icon" sizes="60x60" href="' . WBVB_THEMEFOLDER . '/images/icon-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="60x60" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-60x60-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="120x120" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-120x120-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="57x57" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-57x57-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-114x114-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="76x76" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-76x76-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="152x152" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-152x152-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-72x72-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-144x144-precomposed.png" />' . "\n";
		echo '<link rel="apple-touch-icon-precomposed" href="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-precomposed.png" />' . "\n";

		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="msapplication-TileImage" content="' . WBVB_THEMEFOLDER . '/images/apple-touch-icon-precomposed.png"/>' . "\n";
		echo '<meta name="msapplication-TileColor" content="#BFD00C"/>' . "\n";
		echo '<meta name="msapplication-navbutton-color" content="#BFD00C" />' . "\n";
		echo '<meta name="msapplication-tooltip" content="' . get_bloginfo( 'description' ) . '" />' . "\n";
		echo '<meta name="msapplication-starturl" content="/" />' . "\n";

		echo '<meta name="application-name" content="' . get_bloginfo( 'name' ) . '" />' . "\n";
		echo '<meta name="generator" content="' . get_bloginfo( 'name' ) . '" />' . "\n";
	}


}

//========================================================================================================

//* Hook after post widget area after post content
genesis_widget_area( 'after-post', array(
	'before' => 'AFTER POOST<div class="after-post widget-area">',
	'after'  => '</div>'
) );

//========================================================================================================


// LOGIN PAGE WIDGET for users not currently logged in
function gc_wbvb_write_widget_site_footer() {
	if ( ! dynamic_sidebar( GC_WBVB_WIDGET_SITE_FOOTER ) ) {
		// do nothing
	}
}

genesis_register_sidebar(
	array(
		'name'          => __( "Widget in de site footer", 'gebruikercentraal' ),
		'id'            => GC_WBVB_WIDGET_SITE_FOOTER,
		'description'   => __( "Ruimte voor widgets in de site footer. Hier bijvoorbeeld footerlinks.", 'gebruikercentraal' ),
		'before_widget' => genesis_markup( array(
			'html5' => '<div id="%1$s" class="widget %2$s site-footer-widget ' . GC_WBVB_WIDGET_SITE_FOOTER . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></div>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => '<h2 class="widget-title widgettitle">',
		'after_title'   => "</h2>\n",
	)
);

//========================================================================================================

//* Customize the site footer
add_action( 'genesis_footer', 'gc_wbvb_bg_custom_footer' );

function gc_wbvb_bg_custom_footer() {
	gc_wbvb_write_widget_site_footer();
}

//========================================================================================================


// Right widget space on home page
function gc_wbvb_write_widget_home_widget_beforecontent() {
	if ( ! dynamic_sidebar( GC_WBVB_WIDGET_BANNERWIDGETS ) ) {
		// do nothing
	}
}

//--------------------------------------------------------------------------------------------------------

genesis_register_sidebar(
	array(
		'name'          => __( "Banners boven hoofdcontent", 'gebruikercentraal' ),
		'id'            => GC_WBVB_WIDGET_BANNERWIDGETS,
		'description'   => __( "Widgets die op home en pagina's getoond worden boven alle verdere content. Op berichtpagina's onder de inhoud.", 'gebruikercentraal' ),
		'before_widget' => genesis_markup( array(
			'html5' => '<div id="%1$s" class="widget %2$s ' . GC_WBVB_WIDGET_BANNERWIDGETS . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></div>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => '<p class="widget-title widgettitle">',
		'after_title'   => "</p>\n",
	)
);

//========================================================================================================

// Left widget space on home page
function gc_wbvb_write_widget_home_widget_left() {
	if ( ! dynamic_sidebar( GC_WBVB_WIDGET_HOME_WIDGET_1 ) ) {
		// do nothing
	}
}

//--------------------------------------------------------------------------------------------------------

genesis_register_sidebar(
	array(
		'name'          => __( "Home-widget links", 'gebruikercentraal' ),
		'id'            => GC_WBVB_WIDGET_HOME_WIDGET_1,
		'description'   => __( "Hier kun je de widgets plaatsen voor events en blogberichten", 'gebruikercentraal' ),
		'before_widget' => genesis_markup( array(
			'html5' => '<div id="%1$s" class="widget %2$s ' . GC_WBVB_WIDGET_HOME_WIDGET_1 . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></div>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => '<h2 class="widget-title widgettitle">',
		'after_title'   => "</h2>\n",
	)
);

//========================================================================================================


// Right widget space on home page
function gc_wbvb_write_widget_home_widget_right() {
	if ( ! dynamic_sidebar( GC_WBVB_WIDGET_HOME_WIDGET_2 ) ) {
		// do nothing
	}
}

//--------------------------------------------------------------------------------------------------------

genesis_register_sidebar(
	array(
		'name'          => __( "Home-widget rechts", 'gebruikercentraal' ),
		'id'            => GC_WBVB_WIDGET_HOME_WIDGET_2,
		'description'   => __( "Hier kun je de widgets plaatsen voor o.m. het actieteam", 'gebruikercentraal' ),
		'before_widget' => genesis_markup( array(
			'html5' => '<div id="%1$s" class="widget %2$s ' . GC_WBVB_WIDGET_HOME_WIDGET_2 . '"><div class="widget-wrap">',
			'xhtml' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'echo'  => false,
		) ),
		'after_widget'  => genesis_markup( array(
			'html5' => '</div></div>' . "\n",
			'xhtml' => '</div></div>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => '<h2 class="widget-title widgettitle">',
		'after_title'   => "</h2>\n",
	)
);


//========================================================================================================

//* Add class to .site-container
add_filter( 'genesis_attr_site-container', 'jive_attributes_st_container' );

function jive_attributes_st_container( $attributes ) {

	global $post;
	setup_postdata( $post );

	if ( function_exists( 'get_field' ) ) {

		if ( is_page_template( 'page_home.php' ) ) {

			$jaofnee = get_field( 'link_naar_manifest_toevoegen' );

			if ( 'ja' == $jaofnee ) {
				$attributes['class'] .= ' home-with-manifest';
			} else {
				$attributes['class'] .= ' home-without-manifest';
			}
		}
	}

	return $attributes;
}

//========================================================================================================

function gc_wbvb_home_manifest() {

	global $post;
	setup_postdata( $post );

	$leesmeer = '';
	$class    = 'entry';

	if ( function_exists( 'get_field' ) ) {
		$jaofnee = get_field( 'link_naar_manifest_toevoegen' );

		if ( 'ja' == $jaofnee ) {
			$class = 'manifest entry';

			if ( get_field( 'lees-meer-link' ) && get_field( 'lees-meer-tekst' ) ) {
				$leesmeer = '<a class="btn btn--white" href="' . get_field( 'lees-meer-link' ) . '">' . get_field( 'lees-meer-tekst' ) . '</a>';
			}
		}
	}

	echo '<div id="widgetarea-banners-before-content">';
	// GC_WBVB_WIDGET_BANNERWIDGETS
	gc_wbvb_write_widget_home_widget_beforecontent();
	echo '</div>';

	echo '<article class="' . $class . '" itemscope="" itemtype="http://schema.org/CreativeWork">';
	echo '<header><h1 class="entry-title" itemprop="headline">';
	the_title();
	echo '</h1></header>';
	echo '<div class="content">';
	the_content();
	echo $leesmeer;
	echo '</div>';
	echo '</article>';

	echo '<div class="l-widget-wrapper"><div id="home-widgets-left">';
	// GC_WBVB_WIDGET_HOME_WIDGET_1
	gc_wbvb_write_widget_home_widget_left();
	echo '</div>';
	echo '<div id="home-widgets-right">';
	// GC_WBVB_WIDGET_HOME_WIDGET_2
	gc_wbvb_write_widget_home_widget_right();
	echo '</div></div>';

}

//========================================================================================================

//========================================================================================================

// remove Open Sans font
// Remove Open Sans that WP adds from frontend

if ( ! function_exists( 'gc_wbvb_remove_wp_open_sans' ) ) :

	function gc_wbvb_remove_wp_open_sans() {

		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );

		// all actions related to emojis
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		if ( ! is_admin() ) {
			// filter to remove TinyMCE emojis
			add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
		}


	}

	add_action( 'wp_enqueue_scripts', 'gc_wbvb_remove_wp_open_sans' );

	// Uncomment below to remove from admin
	add_action( 'admin_enqueue_scripts', 'gc_wbvb_remove_wp_open_sans' );

endif;

//========================================================================================================
// options page
if ( function_exists( 'acf_add_options_page' ) ):

	$args = array(
		'slug'       => 'instellingen',
		'title'      => 'Theme-instelling',
		'capability' => 'manage_options',
		'parent'     => 'themes.php'
	);

	acf_add_options_page( $args );

endif;

//========================================================================================================

function gc_wbvb_eventmanager_custom_formats( $array_in ) {

	$my_formats = array();


	if ( ( 'page' == get_post_type() ) ||
	     ( 'post' == get_post_type() ) ||
	     ( 'event' == get_post_type() )
	) {
		if ( is_page() ) {
			$my_formats = array(
				'dbem_event_list_item_format',
				'dbem_event_list_item_format_header',
				'dbem_event_list_item_format_footer',
				'dbem_event_single_format',
			);
		} elseif ( is_single() ) {
			$my_formats = array( 'dbem_single_event_format' ); //the format you want to override, corresponding to file above.
		}
	} else {

	}

	return array_merge( $array_in, $my_formats ); //return the default array and your formats.
}

add_filter( 'em_formats_filter', 'gc_wbvb_eventmanager_custom_formats', 1, 1 );

//========================================================================================================

add_filter( 'em_event_output_placeholder', 'gc_wbvb_eventmanager_styles_placeholders', 1, 3 );

function gc_wbvb_eventmanager_styles_placeholders( $replace, $EM_Event, $result ) {

	global $wp_query;
	global $wp_rewrite;
	global $EM_Event;


	switch ( $result ) {
		case '#_EVENTEXCERPT':

			if ( is_object( $EM_Event ) ) {

				if ( $EM_Event->post_excerpt !== '' ) {
					$return = $EM_Event->post_excerpt;
				} else {
					$return = $EM_Event->post_content;
				}
			} else {
				$return = 'No event found';
			}

			return strip_tags( $return, '<br>' );
			break;

		case '#_AVAILABILITYCHECK':

			if ( ( $EM_Event->get_bookings()->get_available_spaces() <= 0 ) && ( $EM_Event->get_bookings()->tickets->tickets ) ) {
				return '<div class="tickets unavailable">' . __( 'fully booked', 'gebruikercentraal' ) . '</div>';
			} else {
				return '';
			}
			break;

		case '#_DATEBADGE':

			$event_start_datetime = strtotime( $EM_Event->event_start_date . ' ' . $EM_Event->event_start_time );
			$event_end_datetime   = strtotime( $EM_Event->event_end_date . ' ' . $EM_Event->event_end_time );

			if ( date( "Y" ) == date_i18n( 'Y', $event_start_datetime ) ) {
				$jaar = '';
			} else {
				$jaar = '<span class="jaar">' . date_i18n( 'Y', $event_start_datetime ) . '</span>';
			}

			$dedag = date_i18n( 'd', $event_start_datetime );
			$class = 'dag';

			if ( $EM_Event->event_start_date == $EM_Event->event_end_date ) {
				// not a multiple day event
			} else {
				$class = 'dag multiple';
				$dedag = sprintf( '%s-%s', date_i18n( 'd', $event_start_datetime ), date_i18n( 'd', $event_end_datetime ) );
			}

			return '<span class="' . $class . '">' . $dedag . '</span><span class="maand">' . date_i18n( 'M', $event_start_datetime ) . '</span>' . $jaar;
			break;

		case '#_EVENTLOCATIONMETA':

			$event_start_datetime = strtotime( $EM_Event->event_start_date . ' ' . $EM_Event->event_start_time );

			if ( $EM_Event->location_id ) {
				return '<div class="meta-data__item meta-data--with-icon event-location">#_LOCATIONNAME</div>';
			} else {
				return '';
			}
			break;

		case '#_REMOTEIP':

			return $_SERVER['REMOTE_ADDR'];
			break;

	}

	return $replace;

}

//========================================================================================================

function gc_wbvb_clean_url( $url_to_clean ) {

	$url_to_clean_linktext = $url_to_clean;

	if ( substr( $url_to_clean_linktext, - 1 ) == '/' ) {
		$url_to_clean_linktext = substr( $url_to_clean_linktext, 0, - 1 );
	}

	$link_array            = explode( '/', $url_to_clean_linktext );
	$url_to_clean_linktext = end( $link_array );


	$pos = strpos( $url_to_clean_linktext, '#' );
	if ( $pos ) {
		$link_array            = explode( '#', $url_to_clean_linktext );
		$url_to_clean_linktext = $link_array[0];
	}

	if ( substr( strtolower( $url_to_clean_linktext ), - 4 ) == '.pdf' ) {
		$url_to_clean_linktext   = substr( $url_to_clean_linktext, 0, - 4 );
		$url_to_clean_toevoeging = ' (PDF)';
	}

	if ( substr( strtolower( $url_to_clean_linktext ), - 5 ) == '.html' ) {
		$url_to_clean_linktext = substr( $url_to_clean_linktext, 0, - 5 );
	}

	$url_to_clean_linktext = str_replace( "_", " ", $url_to_clean_linktext );
	$url_to_clean_linktext = str_replace( "-", " ", $url_to_clean_linktext );


	return $url_to_clean_linktext;

}


//========================================================================================================


function gc_wbvb_event_get_programma() {

	global $post;

	$return = '';

	if ( function_exists( 'have_rows' ) ) {

		if ( have_rows( 'programmaonderdelen' ) ) {

			$return = '<div id="programma"><h2>' . _x( 'Programme', 'Kopje op evenementpagina', 'gebruikercentraal' ) . '</h2>';
			$return .= '<ul class="event-program">';

			// loop through the rows of data
			while ( have_rows( 'programmaonderdelen' ) ) : the_row();

				$programmaonderdeel_tijd         = strip_tags( get_sub_field( 'programmaonderdeel_tijd' ), '<br>' );
				$programmaonderdeel_beschrijving = strip_tags( get_sub_field( 'programmaonderdeel_beschrijving' ), '<br>' );

				$programmaonderdeel_beschrijving = '<span class="beschrijving">' . $programmaonderdeel_beschrijving . '</span>';

				if ( $programmaonderdeel_tijd ) {
					$programmaonderdeel_tijd = '<span class="tijd">' . $programmaonderdeel_tijd . '</span>';
				}

				$return .= '<li>' . $programmaonderdeel_tijd . $programmaonderdeel_beschrijving . '</li>';

			endwhile;

			$return .= '</ul></div>';

		}
	} else {
		echo ACF_PLUGIN_NOT_ACTIVE_WARNING;
	}


	return $return;

}


//========================================================================================================


function gc_wbvb_post_print_downloads() {
	echo gc_wbvb_post_get_downloads();
}


//========================================================================================================


function gc_wbvb_post_print_links() {
	echo gc_wbvb_post_get_links();
}

//========================================================================================================


function gc_wbvb_post_get_downloads() {

	global $post;

	$return = '';

	if ( function_exists( 'have_rows' ) ) {

		if ( have_rows( 'post_downloads_collection' ) ) {

			$return = '<h2>' . _x( 'Downloads', 'Kopje op berichtpagina', 'gebruikercentraal' ) . '</h2>';
			$return .= '<ul class="link-list">';

			// loop through the rows of data
			while ( have_rows( 'post_downloads_collection' ) ) : the_row();

				$event_link_linktekst   = strip_tags( get_sub_field( 'post_download_title' ), '' );
				$post_download_filetype = strip_tags( get_sub_field( 'post_download_filetype' ), '' );
				$post_download_file     = get_sub_field( 'post_download_file' );
				$size_to_display        = size_format( filesize( get_attached_file( $post_download_file['ID'] ) ) );

				if ( ! $event_link_linktekst ) {
					$event_link_linktekst = gc_wbvb_clean_url( $post_download_file['url'] );
				}

				if ( $size_to_display && $post_download_filetype ) {
					$event_link_linktekst .= ' (' . $post_download_filetype . ', ' . $size_to_display . ')';
				} else {
					if ( $post_download_filetype ) {
						$event_link_linktekst .= ' (' . $post_download_filetype . ')';
					} elseif ( $size_to_display ) {
						$event_link_linktekst .= ' (' . $size_to_display . ')';
					}
				}

				$return .= '<li><a href="' . $post_download_file['url'] . '" itemprop="url">' . $event_link_linktekst . '</a></li>';

			endwhile;

			$return .= '</ul>';
		}
	} else {
		echo ACF_PLUGIN_NOT_ACTIVE_WARNING;
	}

	return $return;
}

//========================================================================================================

function gc_wbvb_beelden_brieven_show_connected_files() {

	if ( GC_BEELDBANK_BEELD_CPT == get_post_type() ) {
		$titel        = "Brieven";
		$beschrijving = "Deze foto wordt gebruikt in deze brieven gebruikt:";
	} else {
		$titel        = "Foto's";
		$beschrijving = "Deze brief gebruikt deze foto's:";
	}

	$return = '';

	if ( function_exists( 'have_rows' ) ) {

		$posts = get_field( 'beelden_brieven_connectie' );

		if ( $posts ) {

			$return = '<div class="connected-files for-' . get_post_type() . '"><h2>' . $titel . '</h2>';
			if ( $beschrijving ) {
				$return .= '<p>' . $beschrijving . '</p>';
			}
			$return .= '<ul class="link-list">';

			// loop through the rows of data
			foreach ( $posts as $p ) {

				$plaatje = '';
				$size    = BLOG_SINGLE_MOBILE;

				if ( has_post_thumbnail( $p->ID ) ) {

					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $p->ID ), $size );
					if ( isset( $image[0] ) ) {
						$plaatje = '<img src="' . $image[0] . '" alt="" width="' . $image[1] . '" height="' . $image[2] . '" />';
					}

				} else {

					$attachment = '';

					if ( function_exists( 'get_field' ) ) {
						$attachment = get_field( 'beeld_foto', $p->ID );
					}

					if ( isset( $attachment['ID'] ) ) {

						// thumbnail
						$thumb  = $attachment['sizes'][ $size ];
						$width  = $attachment['sizes'][ $size . '-width' ];
						$height = $attachment['sizes'][ $size . '-height' ];

						$plaatje = '<img src="' . $thumb . '" alt="' . $attachment['alt'] . '" width="' . $width . '" height="' . $height . '" />';
					}
				}


				$return .= '<li><a href="' . get_permalink( $p->ID ) . '" itemprop="url">' . $plaatje . ' ' . get_the_title( $p->ID ) . '</a></li>';

			}

			$return .= '</ul>';
			$return .= '</div>';
		} else {

		}
	} else {
		echo ACF_PLUGIN_NOT_ACTIVE_WARNING;
	}

	echo $return;
}

//========================================================================================================


function gc_wbvb_post_get_links() {

	global $post;

	$return = '';

	if ( function_exists( 'have_rows' ) ) {

		if ( have_rows( 'event_post_links_collection' ) ) {

			$return = '<h2>' . _x( 'Links', 'Kopje op bericht- of evenementpagina', 'gebruikercentraal' ) . '</h2>';
			$return .= '<ul class="link-list">';

			// loop through the rows of data
			while ( have_rows( 'event_post_links_collection' ) ) : the_row();

				$event_link_url       = strip_tags( get_sub_field( 'event_post_link_url' ), '' );
				$event_link_linktekst = strip_tags( get_sub_field( 'event_post_link_linktekst' ), '' );

				if ( ! $event_link_linktekst ) {
					$event_link_linktekst = gc_wbvb_clean_url( $event_link_url );
				}

				$return .= '<li><a href="' . $event_link_url . '" itemprop="url">' . $event_link_linktekst . '</a></li>';

			endwhile;

			$return .= '</ul>';

		}
	} else {
		echo ACF_PLUGIN_NOT_ACTIVE_WARNING;
	}

	return $return;
}

//========================================================================================================


function gc_wbvb_event_get_organizer_info() {
	global $post;

	return gc_wbvb_authorbox_compose_box( get_the_author_meta( 'ID' ) );
}


//========================================================================================================

if ( ! function_exists( 'gc_wbvb_comment_nav' ) ) :

	function gc_wbvb_comment_nav() {

		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
            <nav class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'gebruikercentraal' ); ?></h2>
                <div class="nav-links">
					<?php
					if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'gebruikercentraal' ) ) ) :
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					endif;

					if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'gebruikercentraal' ) ) ) :
						printf( '<div class="nav-next">%s</div>', $next_link );
					endif;
					?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->

		<?php
		endif;

	}

endif;


//========================================================================================================

function gc_wbvb_comment_item( $comment, $args, $depth ) {
	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}

	$status = '';

	if ( $comment->comment_approved == '0' ) {
		$status = ' data-status="comment-awaiting-moderation"';
	}

	?>
    <<?php echo $tag ?><?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>"<?php echo $status ?>>

	<?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

	<?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is held for moderation', 'gebruikercentraal' ); ?></em>
        <br/>
	<?php endif; ?>


    <div class="comment-author vcard">
		<?php if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment, $args['avatar_size'] );
		} ?>
		<?php printf( __( '<cite class="fn">%s</cite> <span class="says">wrote:</span>' ), get_comment_author_link() ); ?>
    </div>

    <div class="comment-content">
		<?php comment_text(); ?>
    </div>

    <div class="comment-meta commentmetadata"><a
                href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
			/* translators: 1: date, 2: time */
			printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
		?>

        <div class="reply">
			<?php comment_reply_link( array_merge( $args, array(
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth']
			) ) ); ?>
        </div>

    </div>


	<?php if ( 'div' != $args['style'] ) : ?>
        </div>
	<?php endif; ?>
	<?php
}

//========================================================================================================

function gc_wbvb_write_widget_loginpage_logged_in() {

}

//========================================================================================================

function gc_wbvb_write_widget_loginpage_not_logged_in() {

}

//========================================================================================================

function gc_wbvb_archive_loop() {

	//** Use old loop hook structure if < HTML5
	if ( ! genesis_html5() ) {

		genesis_legacy_loop();

		return;
	}

	if (
		( is_tax( ICTU_GCCONF_CT_LOCATION ) ) ||
		( is_tax( ICTU_GCCONF_CT_SESSIONTYPE ) ) ||
		( is_tax( ICTU_GCCONF_CT_LEVEL ) ) ||
		( is_tax( ICTU_GCCONF_CT_COUNTRY ) ) ||
		( is_tax( ICTU_GCCONF_CT_TIMESLOT ) )
	) {
		// these have their own loop in the 'ictuwp-plugin-conference' plugin
		return;
	}

	$countertje = 0;

	if ( have_posts() ) :

		echo '<!-- gc_wbvb_archive_loop -->';
		echo '<div class="archive-list">';

		while ( have_posts() ) : the_post();

			// do loop stuff
			$countertje ++;
			$getid          = get_the_ID();
			$posttype       = get_post_type( $getid );
			$permalink      = get_permalink( $getid );
			$publishdate    = get_the_date();
			$theID          = 'featured_image_post_' . $getid; // archive loop
			$the_image_ID   = 'image_' . $theID; // HIERO, the loop
			$extra_cssclass = ' ' . $posttype;
			$image_class    = 'l-without-image';
			$image          = [];
			$huge           = false;


			if ( has_post_thumbnail( $getid ) ) {

				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'large' );

				$image_class = 'l-has-image';

				// check of het eerste bericht een enorme afbeelding heeft
				if ( $countertje == 1 ) {

					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), IMG_SIZE_HUGE );

					if ( $image[1] >= IMG_SIZE_HUGE_MIN_WIDTH ) {

						if ( 'post' == $posttype ) {
							$image_class .= ' enorm-huge l-has-huge-image';
							$huge        = true;
						}
					} else {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'large' );

						if ( isset( $image[0] ) ) {
							$image_class = 'l-has-image';
						}
					}
				}
			}


			echo '<section class="entry teaser ' . $image_class . '" itemscope itemtype="http://schema.org/SocialMediaPosting" id="' . $theID . '">';
			echo '<a href="' . $permalink . '" itemprop="url" class="teaser__link">';

			if ( $image && ! ( $huge ) ) { // only sho image if layout is not enorm huge
				echo '  <div class="feature-image teaser__image">';
//				echo 'ID: ' . $getid . '<br>';
//				echo '<pre>';
//				var_dump( $image );
//				echo '</pre>';
//				echo get_the_post_thumbnail( $getid, 'thumb-cardv3' ); // dit beeldformaat is ongelimiteerd breed en max. 600px hoog
				echo get_the_post_thumbnail( $getid, BLOG_SINGLE_DESKTOP ); // dit beeldformaat is max. 380px breed en ongelimiteerd hoog
				echo '  </div>';
			}

			echo '<div class="bloginfo">';

			if ( date( "Y" ) == get_the_date( 'Y' ) ) {
				$jaar = '';
			} else {
				$jaar = '<span class="jaar">' . get_the_date( 'Y' ) . '</span>';
			}


			echo '<header>';

			if ( ( GC_BEELDBANK_BEELD_CPT == get_post_type() )
			     || ( GC_BEELDBANK_BRIEF_CPT == get_post_type() )
			     || ( ICTU_GC_CPT_STAP == get_post_type() )
			     || ( ICTU_GC_CPT_CITAAT == get_post_type() )
			     || ( ICTU_GC_CPT_DOELGROEP == get_post_type() )
			     || ( ICTU_GC_CPT_VAARDIGHEDEN == get_post_type() )
			     || ( ICTU_GC_CPT_METHODE == get_post_type() )
			     || ( ICTU_GCCONF_CPT_SPEAKER == get_post_type() )
			     || ( ICTU_GCCONF_CPT_KEYNOTE == get_post_type() )
			     || ( ICTU_GCCONF_CPT_SESSION == get_post_type() )
			) {
				// nothing
			} else {

				echo '<span class="date-badge" itemprop="datePublished" content="' . $publishdate . '"><span class="dag">' . get_the_date( 'd' ) . '</span> <span class="maand">' . get_the_date( 'M' ) . '</span>' . $jaar . '</span>';

			}

			echo '<h2 class="teaser__title entry-title" itemprop="headline"><span class="arrow-link"><span class="arrow-link__text">' . get_the_title() . '</span><span class="arrow-link__icon"></span></span></h2></header>';
			echo '<div class="excerpt">';
			echo the_excerpt();
			echo '</div>';
			echo '</div>';
			echo '</a>';
			echo '</section>';

		endwhile;
		/** end of one post **/

		echo '</div>';

		do_action( 'genesis_after_endwhile' );

	else : /** if no posts exist **/
		do_action( 'genesis_loop_else' );
	endif;
	/** end loop **/

}

//========================================================================================================

function gc_wbvb_add_taxonomy_description() {
	global $wp_query;


	if ( ! is_category() && ! is_tag() && ! is_tax() && ! is_page() ) {

		if ( ! is_category() && ! is_tag() && ! is_tax() && ! is_page() ) {
			if ( is_post_type_archive( 'podcast' ) ) {
				$object     = get_post_type_object( get_post_type() )->labels;
				$site_title = get_bloginfo( 'name' );
				$headline   = sprintf( '<h1 class="archive-title">%s</h1>', $site_title . ' podcasts' );
				if ( $headline || $intro_text ) {
					printf( '<div class="taxonomy-description">%s</div>', $headline );
				} else {
					echo '';
				}
			}

			return;
		}
	}

//    if ( get_query_var( 'paged' ) >= 2 )
//        return;

	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

	if ( ! $term || ! isset( $term->meta ) ) {
		return;
	}

	$headline   = '';
	$intro_text = '';

	if ( is_page() ) {
		$headline = sprintf( '<h1 class="archive-title">%s</h1>', get_the_title() );
	}
	if ( $term->name ) {
		$headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->name ) );
	}

	if ( isset( $term->meta['headline'] ) ) {
		$headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->meta['headline'] ) );
	}

	if ( isset( $term->meta['intro_text'] ) ) {
		$intro_text = apply_filters( 'genesis_term_intro_text_output', $term->meta['intro_text'] );
	}

	if ( $term->description ) {
		$intro_text = apply_filters( 'genesis_term_intro_text_output', $term->description );
	}

	if ( $headline || $intro_text ) {
		printf( '<div class="taxonomy-description">%s</div>', $headline . $intro_text );
	} else {
		echo '';
	}

}

//========================================================================================================

add_filter( 'theme_page_templates', 'gc_wbvb_remove_genesis_page_templates' );

function gc_wbvb_remove_genesis_page_templates( $page_templates ) {
	// deze paginatemplates zijn verwijderd als php bestand
	// * @since	  4.2.2
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );

	return $page_templates;
}

//========================================================================================================

add_filter( 'genesis_next_link_text', 'gc_wbvb_paging_next' );

function gc_wbvb_paging_next( $text ) {
	if ( is_category() ) {
		return '<span>' . __( "Older", 'gebruikercentraal' ) . '</span>';
	} else {
		return $text;
	}
}

//========================================================================================================

add_filter( 'genesis_prev_link_text', 'gc_wbvb_paging_previous' );

function gc_wbvb_paging_previous( $text ) {
	if ( is_category() ) {
		return '<span>' . __( "Newer", 'gebruikercentraal' ) . '</span>';
	} else {
		return $text;
	}
}

//========================================================================================================

function eo_prev_next_post_nav() {

	if ( is_single() && ( in_array( get_post_type(), array(
			'post',
			GC_BEELDBANK_BEELD_CPT,
			GC_BEELDBANK_BRIEF_CPT
		) ) ) ) {

		echo '<nav class="pagination">';
		previous_post_link( '<div class="pagination-previous alignleft">%link</div>', '%title' );
		next_post_link( '<div class="pagination-next alignright">%link</div>', '%title' );
		echo '</nav><!-- .eo_prev_next_post_nav -->';

	}

}

//========================================================================================================

add_filter( 'avatar_defaults', 'gc_wbvb_new_default_avatar' );

function gc_wbvb_new_default_avatar( $avatar_defaults ) {

	$default_persoon_plaatje = 'voorbeeld-persoon-1.png';

	//Set the URL where the image file for your avatar is located
	$new_avatar_url = WBVB_THEMEFOLDER . '/images/' . $default_persoon_plaatje;
	//Set the text that will appear to the right of your avatar in Settings>>Discussion
	$avatar_defaults[ $new_avatar_url ] = 'Your New Default Avatar';

	return $avatar_defaults;

}

//========================================================================================================

add_filter( 'user_contactmethods', 'gc_wbvb_modify_contact_methods' );

function gc_wbvb_modify_contact_methods( $profile_fields ) {

	// Add new fields
	$profile_fields['linkedin']    = _x( 'LinkedIn page', 'author box', 'gebruikercentraal' );
	$profile_fields['personalurl'] = _x( 'Personal website', 'author box', 'gebruikercentraal' );

	// Remove old fields
	unset( $profile_fields['user-url'] );
	unset( $profile_fields['aim'] );

	return $profile_fields;
}

//========================================================================================================

function gc_wbvb_get_human_filesize( $bytes, $decimals = 2 ) {
	$sz     = 'BKMGTP';
	$factor = floor( ( strlen( $bytes ) - 1 ) / 3 );

	return sprintf( "%.{$decimals}f", $bytes / pow( 1024, $factor ) ) . @$sz[ $factor ] . 'B';
}

//========================================================================================================

add_filter( 'genesis_single_crumb', 'gc_wbvb_breadcrumb_add_newspage', 10, 2 );
add_filter( 'genesis_page_crumb', 'gc_wbvb_breadcrumb_add_newspage', 10, 2 );
add_filter( 'genesis_archive_crumb', 'gc_wbvb_breadcrumb_add_newspage', 10, 2 );

function gc_wbvb_breadcrumb_add_newspage( $crumb, $args ) {

	global $post;

	$span_before_start  = '<span class="breadcrumb-link-wrap" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$span_between_start = '<span itemprop="name">';
	$span_before_end    = '</span>';

	if ( function_exists( 'get_field' ) ) {
		if ( is_singular( GC_BEELDBANK_BEELD_CPT ) && ( get_field( 'beelden_page_overview', 'option' ) ) ) {
			$actueelpageid    = get_field( 'beelden_page_overview', 'option' );
			$actueelpagetitle = get_the_title( $actueelpageid );

			if ( $actueelpageid ) {
				$crumb = ictu_gctheme_breadcrumbstring( $actueelpageid, $args );
			}
		}

		if ( is_singular( GC_BEELDBANK_BRIEF_CPT ) && ( get_field( 'brief_page_overview', 'option' ) ) ) {
			$currentpageID = get_field( 'brief_page_overview', 'option' );

			if ( $currentpageID ) {
				$crumb = ictu_gctheme_breadcrumbstring( $currentpageID, $args );
			}
		}
	} else {
		return ACF_PLUGIN_NOT_ACTIVE_WARNING;
	}

	return $crumb;

}

//========================================================================================================

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

add_action( 'genesis_after_endwhile', 'gc_wbvb_prev_next_post_nav' );

//========================================================================================================

function gc_wbvb_prev_next_post_nav() {

	$label     = get_post_type();
	$labelprev = __( "Previous", 'gebruikercentraal' );
	$labelnext = __( "Next", 'gebruikercentraal' );

	$prev_link = get_previous_posts_link( apply_filters( 'genesis_prev_link_text', $labelprev ) );
	$next_link = get_next_posts_link( apply_filters( 'genesis_next_link_text', $labelnext ) );

	if ( get_previous_posts_link() || get_next_posts_link() ) {

		echo '<nav class="pagination">';

		if ( is_single() && ( in_array( get_post_type(), array(
				'post',
				GC_BEELDBANK_BEELD_CPT,
				GC_BEELDBANK_BRIEF_CPT
			) ) ) ) {
			previous_post_link( '<div class="pagination-previous alignleft">%link</div>', '%title' );
			next_post_link( '<div class="pagination-next alignright">%link</div>', '%title' );
		} else {

			$pagination = $prev_link ? sprintf( '<div class="pagination-previous alignleft">%s</div>', $prev_link ) : '';
			$pagination .= $next_link ? sprintf( '<div class="pagination-next alignright">%s</div>', $next_link ) : '';

			genesis_markup( array(
				'open'    => '<div %s>',
				'close'   => '</div>',
				'content' => $pagination,
				'context' => 'archive-pagination',
			) );

		}
		echo '</nav><!-- .gc_wbvb_prev_next_post_nav -->';
	}
}

//========================================================================================================

/* Remove empty paragraph tags from the_content */

function gc_wbvb_remove_empty_paragraphs( $content ) {

	$content = str_replace( "<p></p>", "", $content );

	return $content;

}

add_filter( 'the_content', 'gc_wbvb_remove_empty_paragraphs', 99999 );

//========================================================================================================

/**
 * Set correct values for email sender name and sender email address
 * @source:   https://premium.wpmudev.org/blog/wordpress-email-settings/
 *
 */

function gc_wbvb_filter_wp_mail_from_email( $email ) {

	$blog_admin_email = get_bloginfo( 'admin_email' );

	return $blog_admin_email;

}


function gc_wbvb_filter_wp_mail_from_name( $original_email_from ) {

	$blog_title = get_bloginfo( 'name' );

	return $blog_title;

}

add_filter( 'wp_mail_from', 'gc_wbvb_filter_wp_mail_from_email' );

add_filter( 'wp_mail_from_name', 'gc_wbvb_filter_wp_mail_from_name' );

//========================================================================================================

/**
 * Add Site Description to Title
 *
 */
function gc_wbvb_customize_site_title( $title, $inside, $wrap ) {

	$blogname = ( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : 'Gebruiker Centraal' );


	$branding = '<a href="' . home_url() . '" class="site__home-link site-id-' . get_current_blog_id() . ' ' . sanitize_title_for_query( get_bloginfo( 'name' ) ) . '" rel="home">';
	$branding .= ( $blogname ? '<span class="site__name">' . $blogname . '</span>' : '' );
	$branding .= ( get_bloginfo( 'description' ) ? '<span class="site__slogan"> ' . get_bloginfo( 'description' ) . '</span>' : '' );
	$branding .= '<span class="screen-reader-text">' .  _x( ", to the homepage", 'link op logo', 'gebruikercentraal' ) . '</span>';
	$branding .= '</a>';

	return $branding;
}

add_filter( 'genesis_seo_title', 'gc_wbvb_customize_site_title', 10, 3 );

//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//========================================================================================================

function attendeelist_get_the_bookingpersonname( $theobject ) {

	$socialmedia  = '';
	$returnstring = '';
	$name         = '';
	$bookinginfo  = '';

	if ( $theobject ) {

		$bookinginfo = [];
		if ( isset( $theobject->meta['booking'] ) ) {
			$bookinginfo = $theobject->meta['booking'];
		}
		$countryinfo = $theobject->get_person()->custom_user_fields['dbem_country'];

		if ( isset( $bookinginfo['show_name_attendeelist'] ) && ( $bookinginfo['show_name_attendeelist'] !== '0' ) ) {

			if ( $theobject->get_person()->get_name() ) {
				$name = $theobject->get_person()->get_name();
			} else {
				$user_id   = $theobject->get_person()->ID;
				$user_info = get_userdata( $user_id );
				if ( $user_info->display_name ) {
					$name = $user_info->display_name;
				} elseif ( $user_info->user_nicename ) {
					$name = $user_info->user_nicename;
				} elseif ( $user_info->first_name || $user_info->last_name ) {
					$name = $user_info->first_name . ' ' . $user_info->last_name;
				}
			}

			if ( $name ) {

				$listitemcount = 0;
				$returnstring  = '<span itemprop="name">' . $name . '</span>';
				$xtra          = '';

				if ( isset( $bookinginfo['organisation'] ) && trim( $bookinginfo['organisation'] ) ) {
					$xtra = '<span itemprop="memberOf" class="additionalinfo">' . esc_html( trim( $bookinginfo['organisation'] ) ) . '</span>';
				}

				if ( $countryinfo['value'] && $countryinfo['value'] != 'none selected' ) {
					if ( $xtra !== '' ) {
						$xtra .= ', ';
					}
					$xtra .= '<span class="additionalinfo" itemprop="nationality">' . esc_html( $countryinfo['value'] ) . '</span>';
				}

				if ( $xtra ) {
					$returnstring .= '<br>' . $xtra;
				}

				if ( isset( $bookinginfo['linkedin_profile'] ) && trim( $bookinginfo['linkedin_profile'] ) ) {
					if ( ! filter_var( $bookinginfo['linkedin_profile'], FILTER_VALIDATE_URL ) === false ) {
						$socialmedia .= '<li><a href="' . $bookinginfo['linkedin_profile'] . '" class="linkedin" title="' . __( 'LinkedIn-profiel', 'gebruikercentraal' ) . ' van ' . esc_html( $theobject->get_person()->get_name() ) . '" itemprop="url"><span class="visuallyhidden">' . __( 'LinkedIn-profiel', 'gebruikercentraal' ) . '</span></a></li>';
						$listitemcount ++;
					}
				}

				if ( isset( $bookinginfo['twitter_handle'] ) && trim( $bookinginfo['twitter_handle'] ) ) {
					$socialmedia .= '<li><a href="' . GC_TWITTER_URL . sanitize_title( $bookinginfo['twitter_handle'] ) . '" class="twitter" title="' . __( 'Twitter-account', 'gebruikercentraal' ) . ' van ' . esc_html( $theobject->get_person()->get_name() ) . '" itemprop="url"><span class="visuallyhidden">' . __( 'Twitter-account', 'gebruikercentraal' ) . '</span></a></li>';
					$listitemcount ++;
				}

				if ( $socialmedia ) {
					$returnstring = '<ul class="social-media" data-listitemcount="' . $listitemcount . '">' . $socialmedia . '</ul>' . $returnstring;
				}
			}
		}
	}

	return $returnstring;

}

//========================================================================================================

/**
 * Remove Contact Form 7 scripts + styles unless we're on the contact page
 *
 */
add_action( 'wp_enqueue_scripts', 'rhswp_remove_external_styles' );

function rhswp_remove_external_styles() {

	wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'toc-screen' );

	wp_deregister_style( 'cptch_stylesheet' );
	wp_deregister_style( 'cptch_desktop_style' );

	wp_deregister_style( 'block-gallery-frontend' ); // plugins/block-gallery, substitued with plugins/block-gallery.less

	if ( ! is_admin() ) {
//		wp_deregister_style( 'dashicons' );
	}

}

//========================================================================================================

add_filter( 'embed_defaults', 'rhswp_embed_defaults' );

function rhswp_embed_defaults( $embed_size ) {

	$breedte = 832; // 832px

	$embed_size['width']  = $breedte;
	$embed_size['height'] = ( ( $breedte / 16 ) * 9 ); // for 16:9 aspect

	return $embed_size;

}

//========================================================================================================

/*
voor de podcast: laat de castos plugin naar het bestand zelf verwijzen, niet via
een maskering van de URL voor het MP3-bestand
*/
add_filter( 'ssp_episode_download_link', 'ssp_use_raw_audio_file_url', 10, 3 );

function ssp_use_raw_audio_file_url( $url, $episode_id, $file ) {
	return $file;
}

//========================================================================================================

// bij het wijzigen van de avatar van een slaan we de URL voor de foto op als een
// globaal beschikbare waarde voor de gebruiker.
// zo is de avatar die je invoerde op site [x] ook beschikbaar op site [y]
// de user variable 'auteursfoto_url' kan ook door andere themes (zoals ictuwp-theme-gc2020)
// worden gebruikt.

add_action( 'acf/save_post', 'gc_wbvb_update_auteursfoto' );

function gc_wbvb_update_auteursfoto( $post_id ) {

	$user_id     = str_replace( "user_", "", $post_id );
	$auteursfoto = get_user_meta( $user_id, 'auteursfoto', true );
	$size        = 'thumb-cardv3';

	if ( $auteursfoto ) {
		$image = wp_get_attachment_image_src( $auteursfoto, $size );
		if ( $image[0] ) {
			update_user_meta( $user_id, 'auteursfoto_url', $image[0] );
		}
	}

}

//========================================================================================================

function gc_wbvb_auteursfoto_waarschuwing( $value, $post_id, $field ) {

	$size                 = 'thumb-cardv3';
	$authorfoto_acf_field = wp_get_attachment_image_src( $value, $size );
	$user_id              = str_replace( "user_", "", $post_id );
	$authorfoto_url       = get_user_meta( $user_id, 'auteursfoto_url', true );
	$warning              = '';

	if ( ! $authorfoto_acf_field ) {
		// er is geen mediabestand gevonden voor dit ID, dus
		// mediabestand bestaat niet op deze omgeving
		$warning = '<div style="border: 1px solid silver; background: white; padding: 1rem; overflow:hidden;">';
		if ( $authorfoto_url ) {
			$warning .= '<a href="' . $authorfoto_url . '" target="_blank"><img alt="" src="' . $authorfoto_url . '" width="150" style="float: left; margin-right: 1rem;"></a>';
			$warning .= '<h1 style="margin: 0; padding: 0;">Let op!</h1>';
			$warning .= '<p>De auteursfoto die je hiernaast ziet is geupload via een andere subsite op deze WordPress-omgeving.<br>';
			$warning .= 'Daarom zie je hieronder als waarde voor de auteurs-foto: ';
			$warning .= '<strong><em>Geen afbeelding geselecteerd</em></strong><br>';
		} else {
			// nog geen plaatje beschikbaar
			$warning .= '<h1 style="margin: 0; padding: 0;">Let op!</h1>';
		}
		$warning .= 'De foto die je hier uploadt, wordt hierna getoond op elke andere subsite die het Gebruiker Centraal-theme gebruikt.<br>';
		$warning .= 'Er is maar 1 auteursfoto mogelijk voor een auteur. ';
		$warning .= 'Een gebruiker / auteur MOET een auteursfoto hebben. Als je geen auteursfoto meer wil, upload dan een neutraal plaatje.</p>';
		$warning .= '</div>';

	} else {

		// voor het ID is wel een mediabestand gevonden. Als de URL hiervan ook in de metadata voor de gebruiker staat
		// weten we zeker dat dit de goede avatar is. Anders is het misschien een willekeurig plaatje dat op een andere
		// subsite hoort bij de gebruiker, maar daar nooit eerder is opgeslagen in de metadata voor de gebruiker

		if ( $authorfoto_url === $authorfoto_acf_field[0] ) {
			// prima
		} else {
			//
			$warning = '<div style="border: 1px solid silver; background: white; padding: 1rem; overflow:hidden;">';

			if ( $authorfoto_acf_field[0] ) {

				// voor de zekerheid slaan we de foto alvast op
				update_user_meta( $user_id, 'auteursfoto_url', $authorfoto_acf_field[0] );

				$warning .= '<a href="' . $authorfoto_acf_field[0] . '" target="_blank"><img alt="" src="' . $authorfoto_acf_field[0] . '" width="150" style="float: left; margin-right: 1rem;"></a>';
				$warning .= '<h1 style="margin: 0; padding: 0;">Let op!</h1>';
				$warning .= '<p>We weten niet zeker dat de foto die je hiernaast ziet, de avatar is die je bedoeld had.';
				$warning .= 'De foto staat namelijk nog niet in de metadata voor deze gebruiker. ';
				$warning .= 'Doordat deze metadata  pas sinds maart 2021 beschikbaar zijn, is het dus goed mogelijk dat de foto VOOR deze tijd is toegevoegd. <br>';
				$warning .= 'Als deze foto wel klopt, kun je op \'opslaan\' klikken en dan zie je deze waarschuwing niet meer.<br> Wil je de foto opnieuw uploaden? Klik op de foto om deze in een nieuw tabblad te openen. Sla deze foto op en uploadt opnieuw. <br>';
			}
			$warning .= 'De foto die je hier uploadt, wordt hierna getoond op elke andere subsite die het Gebruiker Centraal-theme gebruikt.<br>';
			$warning .= 'Er is maar 1 auteursfoto mogelijk voor een auteur. ';
			$warning .= 'Een gebruiker / auteur MOET een auteursfoto hebben. Als je geen auteursfoto meer wil, upload dan een neutraal plaatje.</p>';
			$warning .= '</div>';

		}

	}

	if ( is_admin() ) {
		echo $warning;
	}

	return $value;
}

// Apply to auteursfoto field
add_filter( 'acf/load_value/name=auteursfoto', 'gc_wbvb_auteursfoto_waarschuwing', 10, 3 );

//========================================================================================================
