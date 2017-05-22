<?php

/**
 * Gebruiker Centraal - page_blog.php
 * ----------------------------------------------------------------------------------
 * Pagina met blog-artikelen
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.6.6
 * @desc.   mobile menu, infoblock, naming convention functions
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */


//* Template Name: GC - Pagina met blog-artikelen

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'gc_wbvb_archive_loop' );


genesis();
