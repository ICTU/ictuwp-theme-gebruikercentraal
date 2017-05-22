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
<!-- START Geo Units Search -->
<div class="em-search-geo-units em-search-field" <?php if( empty($args['geo']) || empty($args['near']) ): ?>style="display:none;"<?php endif; /* show location fields if no geo search is made */ ?>>
  <label><?php echo esc_html($args['geo_units_label']); ?></label>
  <select name="near_distance" class="em-search-geo-distance">
      <?php foreach( $args['geo_distance_values'] as $unit ) : ?>
    <option value="<?php echo $unit; ?>" <?php if($args['near_distance'] == $unit) echo 'selected="selected"' ?>><?php echo $unit; ?></option>
    <?php endforeach; ?>
  </select>
  <select name="near_unit" class="em-search-geo-unit">
    <option value="mi">mi</option>
    <option value="km" <?php if($args['near_unit'] == 'km') echo 'selected="selected"' ?>>km</option>
  </select>
</div>
<!-- END Geo Units Search -->