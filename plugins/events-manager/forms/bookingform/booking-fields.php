<?php 

/**
 * Gebruiker Centraal
 * ----------------------------------------------------------------------------------
 * Onderdeel van de vormgeving voor de events-manager
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.6.6
 * @desc.   mobile menu, infoblock, naming convention functions
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

    
  showdebug(__FILE__, 'forms bookingform'); 

global $allowedposttags;
global $show_tickets;

$req        = get_option( 'require_name_email' );
$aria_req   = ( $req ? ' required aria-required="true"' : '' );

$EM_Ticket = $EM_Event->get_bookings()->get_available_tickets()->get_first();
    

debugmessage('show_tickets: ' . $show_tickets, 'h1', 'bookingfields' ); 
debugmessage('is_user_logged_in: ' . is_user_logged_in(), 'p', 'bookingfields' ); 
debugmessage('apply_filters(etc): ' . apply_filters('em_booking_form_show_register_form',true), 'p', 'bookingfields' ); 



if( !is_user_logged_in() && apply_filters('em_booking_form_show_register_form',true) ) { ?>

  <?php //User can book an event without registering, a username will be created for them based on their email and a random password will be created. ?>
  <input type="hidden" name="register_user" value="1" />
  <p class="booking name">
    <label for='user_name'><?php _e('Naam','reserveringsformulier', 'gebruikercentraal') ?></label>
    <input type="text" <?php echo $aria_req ?> name="user_name" id="user_name" class="input" value="<?php if(!empty($_REQUEST['user_name'])) echo esc_attr($_REQUEST['user_name']); ?>" />
  </p>
  <p class="booking email">
    <label for='user_email'><?php _e('E-mailadres','reserveringsformulier', 'gebruikercentraal') ?></label> 
    <input type="text" <?php echo $aria_req ?> name="user_email" id="user_email" class="input" value="<?php if(!empty($_REQUEST['user_email'])) echo esc_attr($_REQUEST['user_email']); ?>"  />
  </p>

<?php
  
  if ( $show_tickets ) {
  
    echo '<p class="booking phone half"><label for="dbem_phone">' . _x('Telefoonnummer','reserveringsformulier', 'gebruikercentraal') . '</label><input type="text" ' . $aria_req . ' name="dbem_phone" id="dbem_phone" class="input" value="';
     if(!empty($_REQUEST['dbem_phone'])) echo esc_attr($_REQUEST['dbem_phone']);
     echo '" /></p>';

    $collumns = $EM_Event->get_tickets()->get_ticket_collumns(); //array of collumn type => title
    foreach( $collumns as $type => $name ): 
      

debugmessage($type, 'p', 'type' ); 

      //output collumn by type, or call a custom action 
      switch($type){
        
        case 'type':

debugmessage('(A) ' . $type . ':'); 

        
          if(!empty($EM_Ticket->ticket_description)){ //show description if there is one
 
            echo '<p class="ticket-desc">' . wp_kses($EM_Ticket->ticket_description,$allowedposttags) . '</p>';

debugmessage('(B) ' . $type . ':' . $EM_Ticket->ticket_description ); 

          }
          else {
debugmessage('(C) ' . $type . ' ledig ' ); 
            
          }
          
          break;
  
        case 'price':

debugmessage('(D) ' . $type . ':'); 

          echo '<p class="ticket-price"><label>' . $name .'</label><strong>' . $EM_Ticket->get_price(true) .'</strong></p>';
          break;
  
        case 'spaces':

debugmessage('(E) ' . $type . ':'); 
        
          if( $EM_Ticket->get_available_spaces() > 1 && ( empty($EM_Ticket->ticket_max) || $EM_Ticket->ticket_max > 1 ) ): //more than one space available        
  
debugmessage('(F) ' . $type . ': more than one space available'); 
  
            echo '<p class="booking spaces"><label for="em_tickets">' . $name . '</label>';
    
            $default = !empty($_REQUEST['em_tickets'][$EM_Ticket->ticket_id]['spaces']) ? $_REQUEST['em_tickets'][$EM_Ticket->ticket_id]['spaces']:0;
            $spaces_options = $EM_Ticket->get_spaces_options(false,$default);
    
            if( $spaces_options ){
debugmessage('(G) ' . $type . ': spaces_options! ' ); 
              echo $spaces_options;
            }else{
debugmessage('(H) ' . $type . ': spaces_options N/A ' ); 
              echo "<strong>".__('N/A','events-manager')."</strong>";
            }
            
            echo '</p>';
            
            do_action('em_booking_form_ticket_spaces', $EM_Ticket);
          
          else: //if only one space or ticket max spaces per booking is 1 
  
          
            echo '<input type="hidden" name="em_tickets[' . $EM_Ticket->ticket_id . '][spaces]" value="1" class="em-ticket-select" />';
            do_action('em_booking_form_ticket_spaces', $EM_Ticket); //do not delete
          endif;
  
          break;
          
        default:
          //do_action('em_booking_form_ticket_field_'.$type, $EM_Ticket, $EM_Event);
          break;
      
      }
      
    endforeach; 



  
  }
  else {
    echo '<p class="booking phone"><label for="dbem_phone">' . _e('Telefoonnummer','reserveringsformulier', 'gebruikercentraal') . '</label><input type="text" ' . $aria_req . ' name="dbem_phone" id="dbem_phone" class="input" value="';
     if(!empty($_REQUEST['dbem_phone'])) echo esc_attr($_REQUEST['dbem_phone']);
     echo '" /></p>';
  
  }

  
  
  do_action('em_register_form'); //careful if making an add-on, this will only be used if you're not using custom booking forms 
  
}
else {

  debugmessage('Nah, de gebruikert is ingelogd' ); 

  if ( $show_tickets ) {
    debugmessage('En we motte nog tickets showe' ); 
 
     $collumns = $EM_Event->get_tickets()->get_ticket_collumns(); //array of collumn type => title
    foreach( $collumns as $type => $name ): 
      

debugmessage($type, 'p', 'type' ); 

      //output collumn by type, or call a custom action 
      switch($type){
        
        case 'type':

debugmessage('(A) ' . $type . ':'); 

        
          if(!empty($EM_Ticket->ticket_description)){ //show description if there is one
 
            echo '<p class="ticket-desc">' . wp_kses($EM_Ticket->ticket_description,$allowedposttags) . '</p>';

debugmessage('(B) ' . $type . ':' . $EM_Ticket->ticket_description ); 

          }
          else {
debugmessage('(C) ' . $type . ' ledig ' ); 
            
          }
          
          break;
  
        case 'price':

debugmessage('(D) ' . $type . ':'); 

          echo '<p class="ticket-price"><label>' . $name .'</label><strong>' . $EM_Ticket->get_price(true) .'</strong></p>';
          break;
  
        case 'spaces':

debugmessage('(E) ' . $type . ':'); 
        
          if( $EM_Ticket->get_available_spaces() > 1 && ( empty($EM_Ticket->ticket_max) || $EM_Ticket->ticket_max > 1 ) ): //more than one space available        
  
debugmessage('(F) ' . $type . ': more than one space available'); 
  
            echo '<p class="booking space"><label for="em_tickets">' . $name . '</label>';
    
            $default = !empty($_REQUEST['em_tickets'][$EM_Ticket->ticket_id]['spaces']) ? $_REQUEST['em_tickets'][$EM_Ticket->ticket_id]['spaces']:0;
            $spaces_options = $EM_Ticket->get_spaces_options(false,$default);
    
            if( $spaces_options ){
debugmessage('(G) ' . $type . ': spaces_options! ' ); 
              echo $spaces_options;
            }else{
debugmessage('(H) ' . $type . ': spaces_options N/A ' ); 
              echo "<strong>".__('N/A','events-manager')."</strong>";
            }
            
            echo '</p>';
            
            do_action('em_booking_form_ticket_spaces', $EM_Ticket);
          
          else: //if only one space or ticket max spaces per booking is 1 
  
          
            echo '<input type="hidden" name="em_tickets[' . $EM_Ticket->ticket_id . '][spaces]" value="1" class="em-ticket-select" />';
            do_action('em_booking_form_ticket_spaces', $EM_Ticket); //do not delete
          endif;
  
          break;
          
        default:
          //do_action('em_booking_form_ticket_field_'.$type, $EM_Ticket, $EM_Event);
          break;
      
      }
      
    endforeach; 


    
  }
  
}

 ?>    

<p>
  <label for='booking_comment'><?php _e('Opmerkingen', 'gebruikercentraal') ?></label>
  <textarea name='booking_comment' rows="2" cols="20"><?php echo !empty($_REQUEST['booking_comment']) ? esc_attr($_REQUEST['booking_comment']):'' ?></textarea>
</p>