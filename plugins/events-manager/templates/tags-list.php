<?php

/**
 * Gebruiker Centraal
 * ----------------------------------------------------------------------------------
 * Onderdeel van de vormgeving voor de events-manager
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.4.4
 * @desc.   comments toegevoegd
 * @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal
 */


    showdebug(__FILE__, 'templates');
/*
 * Default tags List Template
 * This page displays a list of locations, called during the em_content() if this is an events list page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display locations (or whatever) however you wish, there are a few variables made available to you:
 *
 * $args - the args passed onto EM_Locations::output()
 *
 */
$args = apply_filters('em_content_tags_args', $args);

if( get_option('dbem_css_taglist') ) echo "<div class='css-tags-list'>";

echo EM_Tags::output( $args );

if( get_option('dbem_css_taglist') ) echo "</div>";


