<?php

/**
// Gebruiker Centraal - 404.php
// ----------------------------------------------------------------------------------
// 404 pagina
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.28.1
// @desc.   Styling voor 404-pagina.
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal
 */



remove_action( 'genesis_loop', 'genesis_do_loop' );
remove_action( 'genesis_loop', 'genesis_404' );

add_action( 'genesis_loop', 'gc_wbvb_404' );

genesis();

