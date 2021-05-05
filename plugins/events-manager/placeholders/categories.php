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
$count_cats = count($EM_Event->get_categories()->categories) > 0;
if( $count_cats > 0 ){
  ?>
  <ul class="event-categories">
    <?php foreach($EM_Event->get_categories() as $EM_Category): ?>
      <li><?php echo $EM_Category->output("#_CATEGORYLINK"); ?></li>
    <?php endforeach; ?>
  </ul>
  <?php
}else{
  echo get_option ( 'dbem_no_categories_message' );
}
