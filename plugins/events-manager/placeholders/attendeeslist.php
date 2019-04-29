<?php 

/**
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @@package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.15.6
// @desc.   Attendeelist revised.
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
				
//				if ( $EM_Booking->get_person()->get_name() && $boookinginfo['show_name_attendeelist'] ) {
				
				$thename = getname( $EM_Booking );
				
				if ( $thename ) {
					$nonanon_userlist[] = $thename;
				}
				else {
					$nr_anon_bookings++;
				}
//				}
			}
			else {
				if ( ! in_array( $EM_Booking->get_person()->ID, $people ) ) {
					
					$thename = getname( $EM_Booking );
					
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


function getname( $theobject ) {
	
	$socialmedia	= '';
	$return			= '';
	$name 			= '';
	$boookinginfo	= '';

	if ( $theobject ) {

		$boookinginfo 		= $theobject->meta['booking'];

//dovardump( $boookinginfo );

		if ( $boookinginfo['show_name_attendeelist'] ) {

			if ( $theobject->get_person()->get_name() ) {
				$name = $theobject->get_person()->get_name();
			} else {
				$user_id	= $theobject->get_person()->ID;
				$user_info	= get_userdata( $user_id );
				if ( $user_info->display_name ) {
					$name = $user_info->display_name;
				} elseif ( $user_info->user_nicename ) {
					$name = $user_info->user_nicename;
				} elseif ( $user_info->first_name || $user_info->last_name ) {
					$name = $user_info->first_name . ' ' . $user_info->last_name;
				}
			}
		
			if ( $name ) {
				
				$listitemcount = 0;
				$return = '<span itemprop="name">' . $name . '</span>';
				
				if ( $boookinginfo['organisation'] ) {
				// to do: proper attributes for organisation 
					$return .= ' <span itemprop="memberOf">' . esc_html( $boookinginfo['organisation'] ) . '</span>';	
				}
				
				if ( $boookinginfo['linkedin_profile'] ) {
					if (!filter_var( $boookinginfo['linkedin_profile'] , FILTER_VALIDATE_URL) === false) {
						$socialmedia .= '<li><a href="' . $boookinginfo['linkedin_profile'] . '" class="linkedin" title="' . __('LinkedIn-profiel', 'gebruikercentraal' ) . ' van ' . esc_html( $theobject->get_person()->get_name() ) . '" itemprop="url"><span class="visuallyhidden">' . __('LinkedIn-profiel', 'gebruikercentraal' ) . '</span></a></li>';
						$listitemcount++;
					}						
				}
				if ( $boookinginfo['twitter_handle'] ) {
					$socialmedia .= '<li><a href="' . GC_TWITTER_URL . sanitize_title( $boookinginfo['twitter_handle'] ) . '" class="twitter" title="' . __( 'Twitter-account', 'gebruikercentraal' ) . ' van ' . esc_html( $theobject->get_person()->get_name() ) . '" itemprop="url"><span class="visuallyhidden">' . __( 'Twitter-account', 'gebruikercentraal' ) . '</span></a></li>';
					$listitemcount++;
				}
				
				if ( $socialmedia ) {
					$return = '<ul class="social-media" data-listitemcount="' . $listitemcount . '">' . $socialmedia . '</ul>' . $return;
				}
			}
		}
		else {
//			$return = 'naam verborgen (' . $theobject->get_person()->ID . ')';
		}	
	}

	return $return;
	
}

