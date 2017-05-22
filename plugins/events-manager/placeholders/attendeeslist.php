<?php 

/**
 * Gebruiker Centraal
 * ----------------------------------------------------------------------------------
 * Onderdeel van de vormgeving voor de events-manager
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.5.1
 * @desc.   Comments, bookingform
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

    
  showdebug(__FILE__, 'placeholders'); 
  /* @var $EM_Event EM_Event */
  $people = array();
  $EM_Bookings = $EM_Event->get_bookings();
  if( count($EM_Bookings->bookings) > 0 ){

    $aanmeldingen = sprintf( _n( '%s aanmelding', '%s aanmeldingen', count($EM_Bookings->bookings), 'your_textdomain' ), count($EM_Bookings->bookings) );


    echo '<div class="attendees-list">';
    echo '<h2>' . __( 'Wie komt er nog meer?', 'gebruikercentraal' ) . '<span class="event-aanmeldingen">' . $aanmeldingen .'</span></h2>';
  
    
    echo '<ul class="event-attendees">';

    $guest_bookings       = get_option('dbem_bookings_registration_disable');
    $guest_booking_user   = get_option('dbem_bookings_registration_user');
    foreach( $EM_Bookings as $EM_Booking){
      
      if($EM_Booking->booking_status == 1 && !in_array($EM_Booking->get_person()->ID, $people) ){

        $people[] = $EM_Booking->get_person()->ID;

        if ( $EM_Booking->get_person()->get_name() ) {
          echo '<li><span>'. $EM_Booking->get_person()->get_name() .'</span></li>';
        }

       
      }
      elseif($EM_Booking->booking_status == 1 && $guest_bookings && $EM_Booking->get_person()->ID == $guest_booking_user ) {

        if ( $EM_Booking->get_person()->get_name() ) {
          echo '<li><span>'. $EM_Booking->get_person()->get_name() .'</span></li>';
        }


      }
    }

    echo '</ul>';
    echo '</div>';
  }