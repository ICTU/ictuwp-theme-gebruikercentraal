<?php

// Gebruiker Centraal - page.php
// ----------------------------------------------------------------------------------
// pagina
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.11.2
// @desc.   Betere styling voor template homepage. Mogelijkheid andere content op homepage te zetten.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme



add_filter('genesis_attr_entry-header', 'gc_wbvb_add_wrap_class');
add_filter('genesis_attr_entry-content', 'gc_wbvb_add_wrap_class');
add_filter('genesis_attr_entry-footer', 'gc_wbvb_add_wrap_class');

//add_action( 'genesis_entry_content', 'gc_wbvb_add_single_socialmedia_buttons', 1 );


showdebug(__FILE__, '/');


genesis();

