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
// @desc.   Code-opschoning
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

    
showdebug(__FILE__, 'formats'); 

global $post;    
global $EM_Event;
global $EM_gc_wbvb_single_event_availability;
global $EM_gc_wbvb_single_event_aanmeldingen;
global $EM_gc_wbvb_single_event_organizor;
global $EM_gc_wbvb_single_event_programma;
global $EM_gc_wbvb_single_event_links;

$event_start_datetime     = ''; 
$event_end_datetime       = ''; 

$event_times              = ''; 
$event_location           = ''; 

if ( is_object( $EM_Event ) ) {
  $event_start_datetime     = strtotime( $EM_Event->event_start_date . ' ' . $EM_Event->event_start_time );
  $event_end_datetime       = strtotime( $EM_Event->event_end_date . ' ' . $EM_Event->event_end_time);

  if ( $EM_Event->location->name ) {
    $event_location  = '<div class="event-location">' . $EM_Event->location->name . '</div>'; 
  }

}


if ( $event_start_datetime ) {
  // only accept events with a start time
  $event_times .= '<div class="event-times">
  <span class="starttime" itemprop="startDate" content="' . date_i18n( 'c', $event_start_datetime ) . '">' . date_i18n( 'G:i', $event_start_datetime ) . '</span>';

  if ( $event_end_datetime ) {
    if ( $event_end_datetime > $event_start_datetime) {
      $event_times .= ' - <span class="endtime" itemprop="endDate" content="' . date_i18n( 'c', $event_end_datetime ) . '">' . date_i18n( 'G:i', $event_end_datetime ) . '</span>';
    }
  }

  $event_times .= '</div>';

}



$header_meta_info = '';
$lebookings       = $EM_Event->bookings;

$kostduurquageld  =  __( 'Gratis', 'gebruikercentraal' );
$price_min        = 0;
$price_max        = 0;

if ( count($lebookings) > 0 ) {
  // has bookings
  $header_meta_info .= $EM_gc_wbvb_single_event_availability;
  $header_meta_info .= $event_times;
  $header_meta_info .= $event_location;

  foreach ( $lebookings->tickets->tickets as $leticket ) {
    // get min & max price
    if ( $price_min > 0 ) {
      if ( floatval( $leticket->ticket_price ) < $price_min ) {
        $price_min = $leticket->ticket_price;
      }
    }
    elseif ( floatval( $leticket->ticket_price ) > $price_min ) {
      $price_min = $leticket->ticket_price;
    }

    if ( floatval( $leticket->ticket_price ) > $price_max ) {
      $price_max = $leticket->ticket_price;
    }
  }

  if ( floatval( $price_min ) > 0 ) {
    $kostduurquageld = '<span itemprop="lowPrice">' . round($price_min,2) . '</span>';
    if ( ( floatval( $price_max ) > 0 )  && ( $price_max > $price_min ) ) {
      $kostduurquageld .= ' - ' . '<span itemprop="highPrice">' . round($price_max,2) . '</span>';
    }  
    $header_meta_info .= '<div class="event-pricing" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">' . $kostduurquageld . '</div>';
  }  
  else {
    $header_meta_info .= '<div class="event-pricing" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">' . $kostduurquageld . '</div>';
  }

  $header_meta_info .= $EM_gc_wbvb_single_event_aanmeldingen;

}
else {

  // no booking availability
  $header_meta_info .= $event_times;
  if ( $EM_Event->location->name ) {
    dovardump($EM_Event->location, 'LOCATIE');
    $header_meta_info .= $EM_Event->location->name;
  }
}


?>

    <header class="wrap">#_AVAILABILITYCHECK
        <div class="date-badge">#_DATEBADGE</div>
        <h1 itemprop="name">#_EVENTNAME</h1>
        <div class="meta"><?php echo $header_meta_info ?></div>

    </header>
    <?php
    //=======================
    if ( has_excerpt() ) { 
    ?>
      <div class="wrap excerpt">
        <?php echo gc_wbvb_socialbuttons($post, '' ) ?>
        #_EVENTEXCERPT
      </div>
      <?php echo $EM_gc_wbvb_single_event_organizor; ?>
      <div class="wrap description" itemprop="description">
      #_EVENTNOTES
      </div>
    <?php
    }
    else { 
    //=======================
    ?>
      <div class="wrap description" itemprop="description">
        <?php echo gc_wbvb_socialbuttons($post, '' ) ?>
        #_EVENTNOTES
      </div>
      <?php echo $EM_gc_wbvb_single_event_organizor;
    
    } 
    //=======================
     
     if ( $EM_gc_wbvb_single_event_links ) {

      echo '<div class="event-links wrap">';
      echo $EM_gc_wbvb_single_event_links;
      echo '</div>';
       
     }

    if ( $EM_gc_wbvb_single_event_programma ) { 
        // toon programma
        ?>
        <div id="event_map_en_programma" class="wrap">
            {has_location}
            <div itemprop="location" itemscope itemtype="http://schema.org/Place" id="event_map">
              <h2>Locatie</h2>
              #_LOCATIONMAP
              <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <h2><a itemprop="url" href="#_LOCATIONURL" itemprop=""><span itemprop="name">#_LOCATIONNAME</span></a></h2>
                <span itemprop="streetAddress">#_LOCATIONADDRESS</span><br>
                <span itemprop="postalCode">#_LOCATIONPOSTCODE</span><br>
                <span itemprop="addressLocality">#_LOCATIONTOWN</span>
    
              </div>
            </div>
            {/has_location}
            <?php echo $EM_gc_wbvb_single_event_programma ?>    
        </div>
        
    <?php 
    }
    else {
        // geen programma
        ?>
        {has_location}
        <div itemprop="location" itemscope itemtype="http://schema.org/Place" id="event_map" class="wrap geen-programma">
          <h2>Locatie</h2>
          #_LOCATIONMAP
          <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <h2><a itemprop="url" href="#_LOCATIONURL" itemprop=""><span itemprop="name">#_LOCATIONNAME</span></a></h2>
            <span itemprop="streetAddress">#_LOCATIONADDRESS</span><br>
            <span itemprop="postalCode">#_LOCATIONPOSTCODE</span><br>
            <span itemprop="addressLocality">#_LOCATIONTOWN</span>

          </div>
        </div>
        {/has_location}

    <?php 
    }
    ?>


    {has_bookings}
      <div class="event-bookings">
        <div class="wrap">
          #_BOOKINGFORM
        
        #_ATTENDEESLIST
        </div>
      </div>    
    {/has_bookings} 
    

