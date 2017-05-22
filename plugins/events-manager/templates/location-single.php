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
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

    
    showdebug(__FILE__, 'templates'); 

/* 
 * Remember that this file is only used if you have chosen to override location pages with formats in your events manager settings!
 * You can also override the single location page completely in any case (e.g. at a level where you can control sidebars etc.), as described here - http://codex.wordpress.org/Post_Types#Template_Files
 * Your file would be named single-location.php
 */
/*
 * This page displays a single event, called during the em_content() if this is an event page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 * 
 * $args - the args passed onto EM_Events::output() 
 */
global $EM_Location;
/* @var $EM_Location EM_Location */
echo  $EM_Location->output_single();
?>