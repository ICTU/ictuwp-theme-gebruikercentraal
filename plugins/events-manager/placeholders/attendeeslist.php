<?php 

/**
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @@package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.16.1
// @desc.   CTA-kleuren, a11y groen, sharing buttons optional, beeldbank CPT code separation.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
// */

    
showdebug(__FILE__, 'placeholders'); 
/* @var $EM_Event EM_Event */
$people       = array();
$EM_Bookings  = $EM_Event->get_bookings();

if( count($EM_Bookings->bookings) > 0 ) {
	
	$guest_bookings 		= get_option('dbem_bookings_registration_disable');
	$guest_booking_user		= get_option('dbem_bookings_registration_user');
	$bookings_total			= count($EM_Bookings->bookings);
	$nr_anon_bookings		= 0;
	$usercounter			= 0;
	$confirmedusercounter	= 0;
	$nonanon_userlist 		= [];
	$people					= [];
	
	foreach( $EM_Bookings as $EM_Booking) {
		
		$boookinginfo 		= $EM_Booking->meta['booking'];
		$name 				= '';
		$usercounter++;
		
		// TO DO: check if a custom form is used
		// now older events do not show any attendees because the 'show_name_attendeelist' is missing
		
		// is show_name_attendeelist on the form? (is a custom form used?
		
		// is bookingstatus 'confirmed' (status == 1)
		// is user a registered user or a guest user?
		// can we show user data?
		
		if ( $EM_Booking->booking_status == 1 ) {
			
			$confirmedusercounter++;
			
			if( $guest_bookings && $EM_Booking->get_person()->ID == $guest_booking_user ) {

				$thename = attendeelist_get_the_bookingpersonname( $EM_Booking );
				
				if ( $thename ) {
					$nonanon_userlist[] = $thename;
				}
				else {
					$nr_anon_bookings++;
				}
			}
			else {
				if ( ! in_array( $EM_Booking->get_person()->ID, $people ) ) {
					
					$thename = attendeelist_get_the_bookingpersonname( $EM_Booking );
					
					$people[ $EM_Booking->get_person()->ID ] = $EM_Booking->get_person()->ID;
					
					if ( $thename ) {
						$nonanon_userlist[] = $thename;
					}
					else {
						$nr_anon_bookings++;
					}
				}
			}
		}
	}

	$attendeecounter = sprintf( _n( '%s attendee', '%s attendees', $confirmedusercounter, 'gebruikercentraal' ), $confirmedusercounter );
	
	if ( $nr_anon_bookings > 0 ) {
		// some users prefer not to be listed on the attendeeslist
		$attendeecounter .= ' (' . sprintf( _n( '%s attendee not shown', '%s attendees not shown', $nr_anon_bookings, 'gebruikercentraal' ), $nr_anon_bookings ) . ')';
	}
	
	echo '<div class="attendees-list" id="attendeeslist">';
	echo '<h2>' . __( 'Other attendees', 'gebruikercentraal' ) . '<span class="event-aanmeldingen">' . $attendeecounter .'</span></h2>';
	echo '<ul class="event-attendees">';
	foreach( $nonanon_userlist as $name) {
		if ( $name ) {
			echo '<li class="person"><span itemprop="attendee" itemscope itemtype="http://schema.org/Person">'. $name .'</span></li>';
		}
	}
	echo '</ul>';
	echo '</div>';
	
	
}
else {
	// no bookings
}

