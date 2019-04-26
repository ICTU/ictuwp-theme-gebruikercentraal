<?php 

/**
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @@package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.15.2
// @desc.   Event manager for conference, translations, bugfixes CSS menu.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
// */

    
  showdebug(__FILE__, 'placeholders'); 
  /* @var $EM_Event EM_Event */
  $people       = array();
  $EM_Bookings  = $EM_Event->get_bookings();

  if( count($EM_Bookings->bookings) > 0 ){

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

		if ( $EM_Booking->booking_status == 1 ) {
			
			$confirmedusercounter++;

			if( $guest_bookings && $EM_Booking->get_person()->ID == $guest_booking_user ) {

				if ( $EM_Booking->get_person()->get_name() && $boookinginfo['show_name_attendeelist'] ) {

					$socialmedia = '';
					$name = $EM_Booking->get_person()->get_name();
					
					if ( $boookinginfo['organisation'] ) {
						$name .= ' (' . esc_html( $boookinginfo['organisation'] ) . ')';	
					}

					if ( $boookinginfo['linkedin_profile'] ) {
						if (!filter_var( $boookinginfo['linkedin_profile'] , FILTER_VALIDATE_URL) === false) {
							$socialmedia .= '<li><a href="' . $boookinginfo['linkedin_profile'] . '" class="linkedin" title="' . __('LinkedIn-profiel', 'gebruikercentraal' ) . ' van ' . esc_html( $EM_Booking->get_person()->get_name() ) . '"><span class="visuallyhidden">' . __('LinkedIn-profiel', 'gebruikercentraal' ) . '</span></a></li>';
						}						
					}title
					if ( $boookinginfo['twitter_handle'] ) {
						$socialmedia .= '<li><a href="' . GC_TWITTER_URL . sanitize_title( $boookinginfo['twitter_handle'] ) . '" class="twitter" title="' . __( 'Twitter-account', 'gebruikercentraal' ) . ' van ' . esc_html( $EM_Booking->get_person()->get_name() ) . '"><span class="visuallyhidden">' . __( 'Twitter-account', 'gebruikercentraal' ) . '</span></a></li>';
					}

				    if ( $socialmedia ) {
				        $name .= '<ul class="social-media">' . $socialmedia . '</ul>';
				    }

					// we are allowed to show the user's name
					$nonanon_userlist[] = $name;
				}
				else {
					$nr_anon_bookings++;
				}
			}
			else {
				if ( ! in_array( $EM_Booking->get_person()->ID, $people ) ) {

					if ( $boookinginfo['organisation'] ) {
						$name .= ' (' . esc_html( $boookinginfo['organisation'] ) . ')';	
					}

					if ( $boookinginfo['linkedin_profile'] ) {
						if (!filter_var( $boookinginfo['linkedin_profile'] , FILTER_VALIDATE_URL) === false) {
							$socialmedia .= '<li><a href="' . $boookinginfo['linkedin_profile'] . '" class="linkedin" title="' . __('LinkedIn-profiel', 'gebruikercentraal' ) . ' van ' . esc_html( $EM_Booking->get_person()->get_name() ) . '"><span class="visuallyhidden">' . __('LinkedIn-profiel', 'gebruikercentraal' ) . '</span></a></li>';
						}						
					}title
					if ( $boookinginfo['twitter_handle'] ) {
						$socialmedia .= '<li><a href="' . GC_TWITTER_URL . sanitize_title( $boookinginfo['twitter_handle'] ) . '" class="twitter" title="' . __( 'Twitter-account', 'gebruikercentraal' ) . ' van ' . esc_html( $EM_Booking->get_person()->get_name() ) . '"><span class="visuallyhidden">' . __( 'Twitter-account', 'gebruikercentraal' ) . '</span></a></li>';
					}

				    if ( $socialmedia ) {
				        $name .= '<ul class="social-media">' . $socialmedia . '</ul>';
				    }

					// we are allowed to show the user's name
					$nonanon_userlist[] = $name;


				}
				else {
					$nr_anon_bookings++;
				}
			}
		}
		else {
		}
		
		
	}


    $attendeecounter = sprintf( _n( '%s attendee', '%s attendees', $confirmedusercounter, 'gebruikercentraal' ), $confirmedusercounter );
    
    if ( $nr_anon_bookings > 0 ) {
	    // some users prefer not to be listed on the attendeeslist
	    $attendeecounter .= ' (' . sprintf( _n( '%s attendee not shown', '%s attendees not shown', $nr_anon_bookings, 'gebruikercentraal' ), $nr_anon_bookings ) . ')';
    }

    echo '<div class="attendees-list">';
    echo '<h2>' . __( 'Other attendees', 'gebruikercentraal' ) . '<span class="event-aanmeldingen">' . $attendeecounter .'</span></h2>';
    echo '<ul class="event-attendees">';
	foreach( $nonanon_userlist as $name) {
		echo '<li><span>'. $name .'</span></li>';
	}
    echo '</ul>';
    echo '</div>';
    
  }
