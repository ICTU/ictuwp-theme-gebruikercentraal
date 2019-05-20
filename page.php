<?php

// Gebruiker Centraal - page.php
// ----------------------------------------------------------------------------------
// pagina
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.12.1
// @desc.   Renamed functions for better sharing.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme



add_filter('genesis_attr_entry-header', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-content', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-footer', 'gc_shared_add_wrap_class');

showdebug(__FILE__, '/');


genesis();

