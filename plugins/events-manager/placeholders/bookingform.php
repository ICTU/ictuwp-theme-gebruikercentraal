<?php 

/**
// Gebruiker Centraal
// ----------------------------------------------------------------------------------
// Onderdeel van de vormgeving voor de events-manager
// ----------------------------------------------------------------------------------
// @@package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.14.1
// @desc.   Styling & functionaliteit voor formulieren op conference-website.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
// */

    
    showdebug(__FILE__, 'placeholder'); 
/* 
 * This is where the booking form is generated.
 * For non-advanced users, It's SERIOUSLY NOT recommended you edit this form directly if avoidable, as you can change booking form settings in various less obtrusive and upgrade-safe ways:
 * - check your booking form options panel in the Booking Options tab in your settings.
 * - use CSS or jQuery to change the look of your booking forms
 * - edit the files in the forms/bookingform folder individually instead of this file, to make it more upgrade-safe
 * - hook into WP action/filters below to modify/generate information
 * Again, even if you're an advanced user, consider NOT editing this form and using other methods instead.
 */

/* @var $EM_Event EM_Event */   
global $EM_Notices;
global $show_tickets;

//count tickets and available tickets
$tickets_count            = count($EM_Event->get_bookings()->get_tickets()->tickets);
$available_tickets_count  = count($EM_Event->get_bookings()->get_available_tickets());

//decide whether user can book, event is open for bookings etc.
$can_book                 = is_user_logged_in() || (get_option('dbem_bookings_anonymous') && !is_user_logged_in());
$is_open                  = $EM_Event->get_bookings()->is_open(); //whether there are any available tickets right now

$show_tickets             = true;
//if user is logged out, check for member tickets that might be available, since we should ask them to log in instead of saying 'bookings closed'



if( !$is_open && !is_user_logged_in() && $EM_Event->get_bookings()->is_open(true) ){
  $is_open  = true;
  $can_book = false;
  $show_tickets = get_option('dbem_bookings_tickets_show_unavailable') && get_option('dbem_bookings_tickets_show_member_tickets');
}

/*

debugmessage('CHECK', 'h1', 'bookingform');
debugmessage('is_open: ' . $is_open );
debugmessage('is_user_logged_in: ' . is_user_logged_in() );
debugmessage('Andere check: ' . $EM_Event->get_bookings()->is_open(true)  );
debugmessage('show_tickets: ' . $show_tickets );

*/


// * @since	4.3.10
$formtitle = _x( 'Join this event', 'Titel boven inschrijfformulier', 'gebruikercentraal' );

if ( function_exists( 'get_field' ) ) {
    // ACF is actief
    if ( get_field('event_bookingform_title', $post ) && $formtitle !== get_field('event_bookingform_title', $post ) ) {
        // er is een waarde gevonden voor event_bookingform_title en deze
        // waarde is niet gelijk aan de standaardwaarde voor $formtitle
	    $formtitle = get_field('event_bookingform_title', $post );
    }
}

?>
<div id="em-booking" class="em-booking <?php if( get_option('dbem_css_rsvp') ) echo 'css-booking'; ?>">

  <h2><?php echo $formtitle ?></h2>
  <?php 
    // We are firstly checking if the user has already booked a ticket at this event, if so offer a link to view their bookings.
    $EM_Booking = $EM_Event->get_bookings()->has_booking();
  ?>
  <?php if( is_object($EM_Booking) && !get_option('dbem_bookings_double') ): //Double bookings not allowed ?>
    <p class="booking-message attending">
      <?php echo get_option('dbem_bookings_form_msg_attending'); ?>
      <a href="<?php echo em_get_my_bookings_url(); ?>"><?php echo get_option('dbem_bookings_form_msg_bookings_link'); ?></a>
    </p>
    
  <?php elseif( !$EM_Event->event_rsvp ): //bookings not enabled ?>
    <p class="booking-message disabled"><?php echo get_option('dbem_bookings_form_msg_disabled'); ?></p>
  <?php elseif( $EM_Event->get_bookings()->get_available_spaces() <= 0 ): ?>
    <p class="booking-message disabled"><?php echo get_option('dbem_bookings_form_msg_full'); ?></p>
  <?php elseif( !$is_open ): //event has started ?>
    <p class="booking-message disabled"><?php echo get_option('dbem_bookings_form_msg_closed');  ?></p>
  <?php else: ?>
    <?php echo $EM_Notices; ?>
    <?php if( $tickets_count > 0) : ?>
      <?php //Tickets exist, so we show a booking form. ?>
      <form class="em-booking-form" name='booking-form' method='post' action='<?php echo apply_filters('em_booking_form_action_url',''); ?>#em-booking'>
         <input type='hidden' name='action' value='booking_add'/>
         <input type='hidden' name='event_id' value='<?php echo $EM_Event->get_bookings()->event_id; ?>'/>
         <input type='hidden' name='_wpnonce' value='<?php echo wp_create_nonce('booking_add'); ?>'/>
        <?php 
          // Tickets Form


//debugmessage('CHECK', 'h1', 'bookingform');
debugmessage('show_tickets: ' . $show_tickets );
debugmessage('can_book: ' . $can_book );
debugmessage('dbem_bookings_tickets_show_loggedout: ' . get_option('dbem_bookings_tickets_show_loggedout') );
debugmessage('tickets_count: ' . $tickets_count );
debugmessage('available_tickets_count: ' . $available_tickets_count );
debugmessage('dbem_bookings_tickets_single_form: ' . get_option( 'dbem_bookings_tickets_single_form' ) );

          
          if( $show_tickets 
              && ( $can_book || get_option( 'dbem_bookings_tickets_show_loggedout' ) ) 
              && ( $tickets_count > 1 || get_option( 'dbem_bookings_tickets_single_form' ) ) ) { //show if more than 1 ticket, or if in forced ticket list view mode

debugmessage('DUS JA', 'h1', 'bookingform');
          
            do_action('em_booking_form_before_tickets', $EM_Event); //do not delete
            //Show multiple tickets form to user, or single ticket list if settings enable this
            //If logged out, can be allowed to see this in settings witout the register form 
            em_locate_template('forms/bookingform/tickets-list.php',true, array('EM_Event'=>$EM_Event));
            do_action('em_booking_form_after_tickets', $EM_Event); //do not delete
            $show_tickets = false;
            
          }
          else {
debugmessage('DUS NEEN', 'h1', 'bookingform');

          }
        ?>
        <?php if( $can_book ): ?>

<?php debugmessage('can_book: ' . $can_book); ?>
        
          <div class='em-booking-form-details'>
            <?php 
              if( $show_tickets && $available_tickets_count == 1 && !get_option('dbem_bookings_tickets_single_form') ){

debugmessage('can_book: <strong>(A)</strong>'); 
                
                do_action('em_booking_form_before_tickets', $EM_Event); //do not delete
                //show single ticket form, only necessary to show to users able to book (or guests if enabled)
                $EM_Ticket = $EM_Event->get_bookings()->get_available_tickets()->get_first();

                do_action('em_booking_form_after_tickets', $EM_Event); //do not delete
              } 

debugmessage('can_book: <strong>(em_booking_form_before_user_details)</strong>'); 

              do_action('em_booking_form_before_user_details', $EM_Event);
              
              if( has_action('em_booking_form_custom') ){ 

                // #_ATT{groupme}{no grouping|confgroup}
                $groupme      = $EM_Event->output('#_ATT{groupme}');
                
                //---------------------------------------------------------------------------------------------------------
                if( 'confgroup' === $groupme ): 
                  // this event is part of a group of events that should have a shared booking form   
debugmessage( 'groupme: ' . $groupme );        
                endif;
        
                //---------------------------------------------------------------------------------------------------------
                
                debugmessage('can_book: <strong>has_action(em_booking_form_custom)</strong>'); 
                
                $EM_Ticket = $EM_Event->get_bookings()->get_available_tickets()->get_first();
                      
                //---------------------------------------------------------------------------------------------------------
                if( $EM_Ticket->get_available_spaces() > 1 && ( empty($EM_Ticket->ticket_max) || $EM_Ticket->ticket_max > 1 ) ): //more than one space available        
                //---------------------------------------------------------------------------------------------------------
                else: //if only one space or ticket max spaces per booking is 1 
                
                  echo '<input type="hidden" name="em_tickets[' . $EM_Ticket->ticket_id . '][spaces]" value="1" class="em-ticket-select" />';
                  do_action('em_booking_form_ticket_spaces', $EM_Ticket); //do not delete
                  
                endif;
                //---------------------------------------------------------------------------------------------------------
      
                //Pro Custom Booking Form. You can create your own custom form by hooking into this action and setting the option above to true
                do_action('em_booking_form_custom', $EM_Event); //do not delete
              } 
              else {

debugmessage('can_book: <strong>NOT: has_action(em_booking_form_custom)</strong>'); 

                //If you just want to modify booking form fields, you could do so here
                em_locate_template('forms/bookingform/booking-fields.php',true, array('EM_Event'=>$EM_Event));
              }
              do_action('em_booking_form_after_user_details', $EM_Event);

              do_action('em_booking_form_footer', $EM_Event); //do not delete ?>
              
            <div class="em-booking-buttons">
              <?php if( preg_match('/https?:\/\//',get_option('dbem_bookings_submit_button')) ): //Settings have an image url (we assume). Use it here as the button.?>
              <input type="image" src="<?php echo get_option('dbem_bookings_submit_button'); ?>" class="em-booking-submit" id="em-booking-submit" />
              <?php else: //Display normal submit button ?>
              <input type="submit" class="em-booking-submit" id="em-booking-submit" value="<?php echo esc_attr(get_option('dbem_bookings_submit_button')); ?>" />
              <?php endif; ?>
            </div>
            <?php do_action('em_booking_form_footer_after_buttons', $EM_Event); //do not delete ?>
          </div>
        <?php else: ?>
          <p class="em-booking-form-details"><?php echo get_option('dbem_booking_feedback_log_in'); ?></p>
        <?php endif; ?>
      </form>  
      <?php 
      if( !is_user_logged_in() && get_option('dbem_bookings_login_form') ){
        //User is not logged in, show login form (enabled on settings page)
        em_locate_template('forms/bookingform/login.php',true, array('EM_Event'=>$EM_Event));
      }
      ?>
    <?php endif; ?>
  <?php endif; ?>
</div>
