<?php

//
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.4
// @desc.   Event-single: niet meer tonen van samenvatting.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


showdebug( __FILE__, 'formats' );

global $post;
global $EM_Event;
global $EM_Location;
global $EM_gc_wbvb_single_event_availability;
global $EM_gc_wbvb_single_event_aanmeldingen;
global $EM_gc_wbvb_single_event_organizor;
global $EM_gc_wbvb_single_event_programma;
global $EM_gc_wbvb_single_event_links;

$event_start_datetime = '';
$event_end_datetime   = '';
$event_times          = '';
$event_location       = '';

if ( is_object( $EM_Event ) ) {

	$event_start_datetime = strtotime( $EM_Event->event_start_date . ' ' . $EM_Event->event_start_time );
	$event_end_datetime   = strtotime( $EM_Event->event_end_date . ' ' . $EM_Event->event_end_time );

	if ( isset( $EM_Event->location->name ) ) {
		$event_location = '<div class="meta-data__item meta-data--with-icon event-location">' . $EM_Event->location->name . '</div>';
	}

}


if ( $event_start_datetime && ( $EM_Event->event_start_date === $EM_Event->event_end_date ) ) {
	// only accept events with a start time
	$event_times .= '<div class="meta-data__item meta-data--with-icon event-times">
	<span class="starttime" itemprop="startDate" content="' . date_i18n( 'c', $event_start_datetime ) . '">' . date_i18n( 'G:i', $event_start_datetime ) . '</span>';

	if ( $event_end_datetime ) {
		if ( $event_end_datetime > $event_start_datetime ) {
			$event_times .= ' - <span class="endtime" itemprop="endDate" content="' . date_i18n( 'c', $event_end_datetime ) . '">' . date_i18n( 'G:i', $event_end_datetime ) . '</span>';
		}
	}
	$event_times .= '</div>';

} elseif ( $EM_Event->event_start_date != $EM_Event->event_end_date ) {

	$period = sprintf( '%s - %s', date_i18n( 'd', $event_start_datetime ), date_i18n( 'd M', $event_end_datetime ) );

	$startDate = '<span itemprop="startDate" content="' . date_i18n( 'c', $event_start_datetime ) . '">';
	$endDate   = '-<span itemprop="endDate" content="' . date_i18n( 'c', $event_end_datetime ) . '">';

	if ( date_i18n( 'M', $event_start_datetime ) == date_i18n( 'M', $event_end_datetime ) ) {
		$startDate .= date_i18n( 'd', $event_start_datetime );
		$endDate   .= date_i18n( 'd M', $event_end_datetime );
	} else {
		$period = sprintf( '%s - %s', date_i18n( 'd M', $event_start_datetime ), date_i18n( 'd M', $event_end_datetime ) );
	}

	$event_times .= '<div class="meta-data__item meta-data--with-icon event-times">' . $startDate . '</span>' . $endDate . '</span></div>';
	/*
		<span class="starttime" itemprop="startDate" content="' . date_i18n( 'c', $event_start_datetime ) . '">' . date_i18n( 'G:i', $event_start_datetime ) . '</span>

		<span class="starttime" itemprop="endDate" content="' . date_i18n( 'c', $event_end_datetime ) . '">' . $period . '</span>';
		$event_times .= ;
	*/
}


$header_meta_info = '';
$lebookings       = is_object( $EM_Event->bookings ) ? $EM_Event->bookings : "";
$event_cost       = __( 'Free of charge', 'gebruikercentraal' );
$price_min        = 0;
$price_max        = 0;

if ( is_array( $lebookings ) || is_object( $lebookings ) ) {
	// has bookings
	$header_meta_info .= $EM_gc_wbvb_single_event_availability;
	$header_meta_info .= $event_times;
	$header_meta_info .= $event_location;

	if ( is_object( $lebookings ) ) {

		foreach ( $lebookings->tickets->tickets as $leticket ) {
			// get min & max price
			if ( $price_min > 0 ) {
				if ( floatval( $leticket->ticket_price ) < $price_min ) {
					$price_min = $leticket->ticket_price;
				}
			} elseif ( floatval( $leticket->ticket_price ) > $price_min ) {
				$price_min = $leticket->ticket_price;
			}

			if ( floatval( $leticket->ticket_price ) > $price_max ) {
				$price_max = $leticket->ticket_price;
			}
		}
	}

	$availabletickets = '';

	if ( $EM_Event->get_bookings()->get_available_spaces() ) {
		$availabletickets = ' <div class="visuallyhidden" itemprop="availability">' . $EM_Event->get_bookings()->get_available_spaces() . '</div>';
	}

	if ( floatval( $price_min ) > 0 ) {
		$event_cost = '<span itemprop="lowPrice">' . round( $price_min, 2 ) . '</span>';
		if ( ( floatval( $price_max ) > 0 ) && ( $price_max > $price_min ) ) {
			$event_cost .= ' - ' . '<span itemprop="highPrice">' . round( $price_max, 2 ) . '</span>';
		}
		$header_meta_info .= '<div class=",eta-data__item meta-data--with-icon event-pricing" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">' . $event_cost . $availabletickets . '</div>';
	} else {
		$event_cost       .= '<div class="visuallyhidden" itemprop="price">0</div>';
		$header_meta_info .= '<div class="meta-data__item meta-data--with-icon event-pricing" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">' . $event_cost . $availabletickets . '</div>';
	}

	$header_meta_info .= $EM_gc_wbvb_single_event_aanmeldingen;

} else {
	// no booking availability
	$header_meta_info .= $event_times;
	if ( isset( $EM_Event->location->name ) ) {
		$header_meta_info .= $EM_Event->location->name;
	}
}

?>

<header class="wrap">
    <div class="date-badge">#_DATEBADGE</div>
    <h1 itemprop="name">#_EVENTNAME</h1>
    <div class="meta-data">
        #_AVAILABILITYCHECK<?php echo $header_meta_info ?>
    </div>

</header>
<?php
//=======================
?>
<div class="wrap description" itemprop="description">
	<?php echo gc_wbvb_check_socialbuttons( $post, '' ) ?>
    #_EVENTNOTES
</div>

<?php // echo $EM_gc_wbvb_single_event_organizor;
//=======================

if ( $EM_gc_wbvb_single_event_links ) {

	echo '<div class="event-links wrap">';
	echo $EM_gc_wbvb_single_event_links;
	echo '</div>';

}

/*
 * in sept 2020 is er een nieuwe situatie ontstaan voor events, namelijk een extra soort locatie.
 *
 * Voor events geldt dat ze WEL of NIET een programma hebben.
 *
 * Er zijn twee soorten locaties:
 * - fysieke locatie
 * - URL (een webinar)
 * 
 * En inmiddels zijn er events toegevoegd met een nep-URL. Een soort fysieke locatie met 
 * geen ander doel dan het omzeilen van de plicht om een locatie toe te voegen.
 *
 * De code moet er ook rekening mee houden dat er geen locatie noch URl ingevoerd is.
 * Het kan ook zijn dat er wel iets van een URL is ingevoerd maar dat dit een fake URL is,
 * om de validatie te omzeilen. Dit moeten we eruit filteren.
 *
 * Dus dit zijn de opties:
 * Situatie 1:
 * 1a: Wel locatie + geen programma
 * 1b: Wel locatie + wel programma
 *
 * Situatie 2:
 * 2a: Online via geldige URL + geen programma
 * 2b: Online via geldige URL + wel programma
 *
 * Situatie 3:
 * 3a: Online maar ongeldige URL + geen programma
 * 3b: Online maar ongeldige URL + wel programma
 *
 * Situatie 4:
 * 4a: Geen locatie + geen programma
 * 4b: Geen locatie + wel programma
 *
 * tenslotte moeten we een programma kunnen tonen als dat er is.
 *
 */

$locationurl      = '';
$locationname     = '';
$locationurl      = '';
$locationlinktext = '';

if ( ! is_null( $EM_Location ) ) {
	$locationname     = $EM_Location->output( '#_LOCATIONNAME' );
	$locationurl      = $EM_Location->output( '#_EVENTLOCATION{url}' );
	$locationlinktext = $EM_Location->output( '#_EVENTLOCATION{_self}' );
}
else {
}

if ( $locationname && ( ! $locationurl ) ) {
	// situate 1:
	if ( $EM_gc_wbvb_single_event_programma ) {
		echo '<!--  1b: Wel locatie + wel programma  -->';
		// wel locatie, wel programma
		?>
        <div id="event_map_en_programma" class="wrap">
            {has_location}
            <div itemprop="location" itemscope itemtype="http://schema.org/Place" id="event_map">
				<?php
				if ( 22 == 33 ) {
					/*
                <!-- TO DO: wacht op invoeren non-google maps kaartje -->
				<h2><?php echo __( 'Location', 'gebruikercentraal' ) ?></h2>
				#_LOCATIONMAP
					*/
				}
				?>
                <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <h2 itemprop="name">#_LOCATIONNAME</span></h2>
                    <span itemprop="streetAddress">#_LOCATIONADDRESS</span><br>
                    <span itemprop="postalCode">#_LOCATIONPOSTCODE</span><br>
                    <span itemprop="addressLocality">#_LOCATIONTOWN</span>

                </div>
            </div>
            {/has_location}
			<?php echo $EM_gc_wbvb_single_event_programma ?>
        </div>

		<?php

	} else {
		// wel locatie, geen programma
		echo '<!--  1a: Wel locatie + geen programma  -->';
		?>
        {has_location}
        <div itemprop="location" itemscope itemtype="http://schema.org/Place" id="event_map"
             class="wrap geen-programma">
			<?php
			if ( 22 == 33 ) {
				/*
            <!-- TO DO: wacht op invoeren non-google maps kaartje -->
			<h2><?php echo __( 'Location', 'gebruikercentraal' ) ?></h2>
			#_LOCATIONMAP
				*/
			}
			?>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <h2 itemprop="name">#_LOCATIONNAME</span></h2>
                <span itemprop="streetAddress">#_LOCATIONADDRESS</span><br>
                <span itemprop="postalCode">#_LOCATIONPOSTCODE</span><br>
                <span itemprop="addressLocality">#_LOCATIONTOWN</span>

            </div>
        </div>
        {/has_location}
		<?php
	}
} elseif ( $locationurl ) {
	// geen locatie, maar wel een URL
	if ( filter_var( $locationurl, FILTER_VALIDATE_URL ) ) {
		if ( $EM_gc_wbvb_single_event_programma ) {
			// 2b: wel een link en wel een programma
			echo '<!--  2b: wel een link en wel een programma  -->';
			?>
            <div id="event_map_en_programma" class="wrap">
                <div id="event_map">
                    <h2><?php echo __( 'Link voor dit webinar', 'gebruikercentraal' ) ?></h2>
                    <p><?php echo $locationlinktext ?></p>
                </div>
				<?php echo $EM_gc_wbvb_single_event_programma ?>
            </div>
			<?php
		} else {
			// 2a: wel een link, maar geen programma
			echo '<!--  2a: wel een link, maar geen programma  -->';
			?>
            <div class="wrap">
                <h2><?php echo __( 'Link voor dit webinar', 'gebruikercentraal' ) ?></h2>
                <p><?php echo $locationlinktext ?></p>
            </div>
			<?php
		}
	} else {

		if ( $EM_gc_wbvb_single_event_programma ) {
			echo '<!--  3b: Online maar ongeldige URL + wel programma  -->';
			?>
            <div id="event_map_en_programma" class="wrap">
				<?php echo $EM_gc_wbvb_single_event_programma; ?>
            </div>
			<?php
		} else {
			echo '<!--  3a: Online maar ongeldige URL + geen programma  -->';
		}
	}
} else {
	// geen locatie, geen URL
	if ( $EM_gc_wbvb_single_event_programma ) {
		echo '<!--  4b: Geen locatie + wel programma  -->';
		?>
        <div class="wrap">
			<?php echo $EM_gc_wbvb_single_event_programma; ?>
        </div>
		<?php
	} else {
		echo '<!--  4a: Geen locatie + geen programma  -->';
	}
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
    

