<?php 

/**
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @@package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.14.1c
// @desc.   Styling & functionaliteit voor formulieren op conference-website.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
// */

    
  showdebug(__FILE__, 'placeholders'); 
  /* @var $EM_Event EM_Event */
  $people       = array();
  $EM_Bookings  = $EM_Event->get_bookings();

  if( count($EM_Bookings->bookings) > 0 ){

    $aanmeldingen = sprintf( _n( '%s aanmelding', '%s aanmeldingen', count($EM_Bookings->bookings), 'your_textdomain' ), count($EM_Bookings->bookings) );

    echo '<div class="attendees-list">';
    echo '<h2>' . __( 'Other attendees', 'gebruikercentraal' ) . '<span class="event-aanmeldingen">' . $aanmeldingen .'</span></h2>';
    echo '<ul class="event-attendees">';

    $guest_bookings       = get_option('dbem_bookings_registration_disable');
    $guest_booking_user   = get_option('dbem_bookings_registration_user');

    foreach( $EM_Bookings as $EM_Booking){
      
      if ( $EM_Booking->get_person()->get_name() ) {

        $name = $EM_Booking->get_person()->get_name();
        
        $person = $EM_Booking->get_person();

/*
// #_BOOKINGFORMCUSTOM{field_id}

$check = $EM_Booking->output('#_BOOKINGFORMCUSTOM{toon_mijn_naam_op_aanwezigenlijst}');
if ( $check && ( ! '#_BOOKINGFORMCUSTOM{toon_mijn_naam_op_aanwezigenlijst}' == $check ) ) {
  echo '<h1>check 1 "' . $check . '"</h1>';
}

$check = $EM_Booking->output('#_BOOKINGFORMCUSTOMREG{toon_mijn_naam_op_aanwezigenlijst}');
if ( $check && ( ! '#_BOOKINGFORMCUSTOMREG{toon_mijn_naam_op_aanwezigenlijst}' == $check ) ) {
  echo '<h1>check 2 "' . $check . '"</h1>';
}

$check = $EM_Booking->output('#_BOOKINGFORMCUSTOMFIELDS');
if ( $check && ( ! '#_BOOKINGFORMCUSTOMFIELDS' == $check ) ) {
  echo '<h1>check 3 "' . $check . '"</h1>';
}
if ( $person->data->display_name == 'paulvanbuuren' ) {
//  dovardump( $person->data );
}        

//'toon_mijn_naam_op_aanwezigenlijst'
*/        
      }

      if ( $EM_Booking->booking_status == 1 ) {
      
        if( $guest_bookings && $EM_Booking->get_person()->ID == $guest_booking_user ) {
  
          if ( $EM_Booking->get_person()->get_name() ) {
  
            $name = $EM_Booking->get_person()->get_name();
            
          }
        }
        else {
          
          if ( ! in_array( $EM_Booking->get_person()->ID, $people ) ) {
            $people[] = $EM_Booking->get_person()->ID;
          }
          else {
            $name = '';
          }
        }
      
      }
      
      if ( $name ) {
        echo '<li><span>'. $name .'</span></li>';
      } 
      
    }

    echo '</ul>';
    echo '</div>';
  }
