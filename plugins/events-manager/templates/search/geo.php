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
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

    
    showdebug(__FILE__, 'templates search'); 

    $args = !empty($args) ? $args:array(); /* @var $args array */ ?>
<!-- START General Search -->
<div class="em-search-geo em-search-field">
  <?php 
    /* This general search will find matches within event_name, event_notes, and the location_name, address, town, state and country. */
    
  ?>
  <input type="text" name="geo" class="em-search-geo" value="<?php echo esc_attr($args['geo']); ?>"/>
  <input type="hidden" name="near" class="em-search-geo-coords" value="<?php echo esc_attr($args['near']); ?>" />
  <div id="em-search-geo-attr" ></div>
  <script type="text/javascript">
  EM.geo_placeholder = '<?php echo esc_attr($args['geo_label']); ?>';
  EM.geo_alert_guess = '<?php esc_attr_e('We are going to use %s for searching.','events-manager'); ?> \n\n <?php esc_attr_e('If this is incorrect, click cancel and try a more specific address.','events-manager') ?>';
  <?php
  //include separately, which allows you to just modify the html or completely override the JS
  em_locate_template('templates/search/geo.js',true);
  ?>
  </script>
</div>
<!-- END General Search -->