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
<!-- START Date Search -->
<div class="em-search-scope em-search-field">
  <span class="em-search-scope em-events-search-dates em-date-range">
    <label><?php echo esc_html($args['scope_label']); ?></label>
    <input type="text" class="em-date-input-loc em-date-start" />
    <input type="hidden" class="em-date-input" name="scope[0]" value="<?php echo esc_attr($args['scope'][0]); ?>" />
    <?php echo esc_html($args['scope_seperator']); ?>
    <input type="text" class="em-date-input-loc em-date-end" />
    <input type="hidden" class="em-date-input" name="scope[1]" value="<?php echo esc_attr($args['scope'][1]); ?>" />
  </span>
</div>
<!-- END Date Search -->
