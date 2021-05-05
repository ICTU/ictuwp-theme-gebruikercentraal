<?php

/**
// Gebruiker Centraal - header.php
// ----------------------------------------------------------------------------------
// Overwrites voor header, zoals aparte IE-classes
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.15.1
// @desc.   Restyling main nav menu.
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal
 */


/**
 * Fires at start of header.php, immediately before `genesis_title` action hook to render the Doctype content.
 *
 * @since 1.3.0
 */
do_action( 'genesis_doctype' );


/**
 * Fires immediately after `genesis_doctype` action hook, in header.php to render the document title.
 *
 * @since 1.0.0
 */
do_action( 'genesis_title' );

/**
 * Fires immediately after `genesis_title` action hook, in header.php to render the meta elements.
 *
 * @since 1.0.0
 */
do_action( 'genesis_meta' );

wp_head(); // We need this for plugins.
?>
</head>

<?php
genesis_markup(
	array(
		'open'    => '<body %s>',
		'context' => 'body',
	)
);

/**
 * Fires immediately after the body element opening markup.
 *
 * @since 1.0.0
 */
do_action( 'genesis_before' );

genesis_markup(
	array(
		'open'    => '<div %s>',
		'context' => 'site-container',
	)
);

/**
 * Fires immediately after the site container opening markup, before `genesis_header` action hook.
 *
 * @since 1.0.0
 */
do_action( 'genesis_before_header' );

/**
 * Fires to display the main header content.
 *
 * @since 1.0.2
 */
do_action( 'genesis_header' );

/**
 * Fires immediately after the `genesis_header` action hook, before the site inner opening markup.
 *
 * @since 1.0.0
 */
do_action( 'genesis_after_header' );

genesis_markup(
	array(
		'open'    => '<div %s>',
		'context' => 'site-inner',
	)
);
genesis_structural_wrap( 'site-inner' );

