<?php

// Gebruiker Centraal - archive.php
// ----------------------------------------------------------------------------------
// Voor een archive pagina
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.6.6
// @desc.   mobile menu, infoblock, naming convention functions

add_action( 'wp_enqueue_scripts', 'gc_wbvb_add_blog_archive_css' );

//Removes Title and Description on Archive, Taxonomy, Category, Tag
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
add_action( 'genesis_before_loop', 'gc_wbvb_add_taxonomy_description', 15 );

/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'gc_wbvb_archive_loop' );



genesis();


