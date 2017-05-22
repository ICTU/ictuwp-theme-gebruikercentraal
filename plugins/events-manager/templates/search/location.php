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
<div class="em-search-location" <?php if( !empty($args['search_geo']) && !empty($args['geo']) && !empty($args['near']) ): ?>style="display:none;"<?php endif; /* show location fields if no geo search is made */ ?>>
  <?php
  //figure out if we have a default country or one submitted via search
  if( !empty($args['search_countries']) ){
    em_locate_template('templates/search/location-countries.php',true,array('args'=>$args));
  }else{
    ?><input type="hidden" name="country" value="<?php echo esc_attr($args['country']); ?>" /><?php
  }
  ?>
  <div class="em-search-location-meta" <?php if( empty($args['country']) && !empty($args['search_countries']) ): ?>style="display:none;"<?php endif; /* show location meta if country field has value or not shown */ ?>>
  <?php
  if( !empty($args['search_regions']) ) em_locate_template('templates/search/location-regions.php',true,array('args'=>$args));
  if( !empty($args['search_states']) ) em_locate_template('templates/search/location-states.php',true,array('args'=>$args));
  if( !empty($args['search_towns']) ) em_locate_template('templates/search/location-towns.php',true,array('args'=>$args));
  ?>
  </div>
</div>