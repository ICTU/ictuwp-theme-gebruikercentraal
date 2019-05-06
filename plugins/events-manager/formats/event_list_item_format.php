<?php 

//
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.15.9
// @desc.   Extra checkbox for mailinglist, a11y improvements.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

    
showdebug(__FILE__, 'formats'); 

global $post;    
global $EM_Event;
global $EM_Events;


$event_start_datetime   = '';
//$classmultiple 			= ' hoho';
$classmultiple 			= '';

if ( is_object( $EM_Event ) ) {
	$event_start_datetime     = strtotime( $EM_Event->event_start_date . ' ' . $EM_Event->event_start_time );
	
	if ( $EM_Event->event_start_date == $EM_Event->event_end_date ) {
		$classmultiple = ' ' . $EM_Event->event_start_date . ' '  . $EM_Event->event_end_date;
	} else {
		$classmultiple = ' multiple';
	}
}

$event_times      = '<div class="event-times">#_EVENTTIMES</div>'; 
$event_location   = '#_EVENTLOCATIONMETA'; 
$header_meta_info = $event_times . $event_location;


echo '<section><a href="#_EVENTURL">';
echo '<header class="wrap' . $classmultiple . '">
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
