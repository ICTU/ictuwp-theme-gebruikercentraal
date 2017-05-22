<?php 

/**
 * Gebruiker Centraal events-list-grouped.php
 * ----------------------------------------------------------------------------------
 * Onderdeel van de vormgeving voor de events-manager
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.4.15
 * @desc.   Events-overzichtspagina - styling sections
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

    
showdebug(__FILE__, 'templates'); 


//dovardump($args,'events-list-grouped.php');
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


echo EM_Events::output_grouped($args); //note we're grabbing the content, not em_get_events_list_grouped function
    
