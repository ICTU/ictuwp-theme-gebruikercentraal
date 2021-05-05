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


    showdebug(__FILE__, 'templates search');

    $args = !empty($args) ? $args:array(); /* @var $args array */ ?>
<!-- START Category Search -->
<div class="em-search-category em-search-field">
  <label><?php echo esc_html($args['category_label']); ?></label>
  <?php
    EM_Object::ms_global_switch(); //in case in global tables mode of MultiSite, grabs main site categories, if not using MS Global, nothing happens
    wp_dropdown_categories(array(
        'hide_empty' => 0,
        'orderby' =>'name',
        'name' => 'category',
        'hierarchical' => true,
        'taxonomy' => EM_TAXONOMY_CATEGORY,
        'selected' => $args['category'],
        'show_option_none' => $args['categories_label'],
        'option_none_value'=> 0,
        'class'=>'em-events-search-category'
    ));
    EM_Object::ms_global_switch_back(); //if switched above, switch back
  ?>
</div>
<!-- END Category Search -->
