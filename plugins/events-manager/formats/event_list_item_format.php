<?php 

//
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.8.3
// @desc.   Code-opschoning.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

    
showdebug(__FILE__, 'formats'); 

global $post;    
global $EM_Event;
global $EM_Events;


$event_start_datetime     = '';

if ( is_object( $EM_Event )) {
  $event_start_datetime     = strtotime( $EM_Event->event_start_date . ' ' . $EM_Event->event_start_time );
}

$event_times      = '<div class="event-times">#_EVENTTIMES</div>'; 
$event_location   = '#_EVENTLOCATIONMETA'; 

$header_meta_info = $event_times . $event_location;

echo '<section><a href="#_EVENTURL">';
echo '<header class="wrap">
        #_AVAILABILITYCHECK
        <div class="date-badge">#_DATEBADGE</div>
        <h3 itemprop="name">#_EVENTNAME</h3>
        <div class="meta">' .  $header_meta_info . '</div>
    </header>';

if ( has_excerpt() ) { 
  echo '<div class="wrap excerpt">#_EVENTEXCERPT</div>';
}
echo '</a></section>';

/*
<tr>
  <td>
    #_EVENTDATES<br/>
    #_EVENTTIMES
  </td>
  <td>
    #_EVENTLINK
    {has_location}<br/><i>#_LOCATIONNAME, #_LOCATIONTOWN #_LOCATIONSTATE</i>{/has_location}
  </td>
</tr>

*/