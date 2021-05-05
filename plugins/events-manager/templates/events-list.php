<?php

/**
 * Gebruiker Centraal events-list.php
 * ----------------------------------------------------------------------------------
 * Onderdeel van de vormgeving voor de events-manager
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.4.14
 * @desc.   Events-overzichtspagina - datebadge toegevoegd
 * @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal
 */


showdebug(__FILE__, 'templates');

/*
 * Default Events List Template
 * This page displays a list of events, called during the em_content() if this is an events list page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 *
 * $args - the args passed onto EM_Events::output()
 *
 */
$args = apply_filters('em_content_events_args', $args);

if( get_option('dbem_css_evlist') ) echo "<div class='css-events-list'>";

echo EM_Events::output( $args );

if( get_option('dbem_css_evlist') ) echo "</div>";
