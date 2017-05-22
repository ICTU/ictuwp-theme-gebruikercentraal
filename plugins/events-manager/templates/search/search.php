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
/* This general search will find matches within event_name, event_notes, and the location_name, address, town, state and country. */ 
$args = !empty($args) ? $args:array(); /* @var $args array */ 
?>
<!-- START General Search -->
<div class="em-search-text em-search-field">
  <script type="text/javascript">
  EM.search_term_placeholder = '<?php echo esc_attr($args['search_term_label']); ?>';
  </script>
  <input type="text" name="em_search" class="em-events-search-text em-search-text" value="<?php echo esc_attr($args['search']); ?>" />
</div>
<!-- END General Search -->