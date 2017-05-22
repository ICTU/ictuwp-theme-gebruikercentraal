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
  ?>
  <ol class="event-attendees">
  <?php
  $guest_bookings = get_option('dbem_bookings_registration_disable');
  $guest_booking_user = get_option('dbem_bookings_registration_user');
  foreach( $EM_Bookings as $EM_Booking){
    if($EM_Booking->booking_status == 1 && !in_array($EM_Booking->get_person()->ID, $people) ){
      $people[] = $EM_Booking->get_person()->ID;
      echo '<li>'. get_avatar($EM_Booking->get_person()->ID, 50) .'</li>';
    }elseif($EM_Booking->booking_status == 1 && $guest_bookings && $EM_Booking->get_person()->ID == $guest_booking_user ){
      echo '<li>'. get_avatar($EM_Booking->get_person()->ID, 50) .'</li>';
    }
  }
  ?>
  </ol>
  <?php
}