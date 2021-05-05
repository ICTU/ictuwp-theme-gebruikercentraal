<?php

/**
 * Gebruiker Centraal
 * ----------------------------------------------------------------------------------
 * Onderdeel van de vormgeving voor de events-manager
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.4.11
 * @desc.   Tabs to spaces, tabs to spaces
 * @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal
 */


    showdebug(__FILE__, 'placeholder');
/* @var $EM_Event EM_Event */
$tags = get_the_terms($EM_Event->post_id, EM_TAXONOMY_TAG);
if( is_array($tags) && count($tags) > 0 ){
  $tags_list = array();
  foreach($tags as $tag){
    $link = get_term_link($tag->slug, EM_TAXONOMY_TAG);
    if ( is_wp_error($link) ) $link = '';
    $tags_list[] = '<a href="'. $link .'">'. $tag->name .'</a>';
  }
  echo implode(', ', $tags_list);
}
