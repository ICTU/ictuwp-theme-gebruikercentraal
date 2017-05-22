<?php

/**
 * Gebruiker Centraal - page_mailinglijst.php
 * ----------------------------------------------------------------------------------
 * pagina voor inschrijving op mailinglijst
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.6.6
 * @desc.   mobile menu, infoblock, naming convention functions
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */


//* Template Name: GC - Pagina met mailinglijstinschrijving

global $current_user;
global $email_newsletter;
global $email_builder;
global $email_newsletter_result;



$e_newsletter_email_tip = '';
$e_newsletter_email_css = '';

if ( isset( $_REQUEST['xxx_newsletter_action'] ) ) {

    global $email_newsletter;
    global $e_newsletter_email_tip;
    global $e_newsletter_email_css;

    if ( isset( $_REQUEST['e_newsletter_email'] ) && ( $_REQUEST['e_newsletter_email']  === '' ) ) {
        $email_newsletter_result['error']       = true;
        $email_newsletter_result['message']     = __('We hebben onvoldoende informatie ontvangen.<br />Vul alsnog de vereiste velden in.','gebruikercentraal');

        $e_newsletter_email_tip = '<span role="alert" class="wpcf7-not-valid wpcf7-not-valid-tip">' .  __('Vul een mail-adres in, alsjeblieft.','gebruikercentraal') . '</span>';
        $e_newsletter_email_css = ' class="wpcf7-not-valid"';
        
    }
    else if(!is_email($_REQUEST['e_newsletter_email'])) {
        $email_newsletter_result['error']       = true;
        $email_newsletter_result['message']     = __('We hebben onvoldoende informatie ontvangen.<br />Vul alsnog de vereiste velden in.','gebruikercentraal');

        $e_newsletter_email_tip = '<span role="alert" class="wpcf7-not-valid-tip">' . __( 'E-mailadres lijkt ongeldig.','gebruikercentraal' ) . '</span>';
        $e_newsletter_email_css = ' class="wpcf7-not-valid"';
    }
 
    else {

        switch( $_REQUEST[ 'xxx_newsletter_action' ] ) {
    
            case "new_subscribe":
                $email_newsletter_result = $email_newsletter->new_subscribe();
                break;

        }
    }

}


add_action( 'genesis_entry_content', 'gc_wbvb_show_page_overzichtspagina', 11 );


function gc_wbvb_show_page_overzichtspagina() {


    global $current_user;
    global $email_newsletter;
    global $email_builder;
    global $email_newsletter_result;
    global $e_newsletter_email_tip;
    global $e_newsletter_email_css;

    $settings       = $email_newsletter->settings;

    if ( isset($current_user->data->ID) ) {
        $member_id      = $email_newsletter->get_members_by_wp_user_id( $current_user->data->ID );
        $member_data    = $email_newsletter->get_member( $member_id );
    }
    else {
    }


    if ( "" != $member_data['unsubscribe_code'] ) {
        $groups         = $email_newsletter->get_groups();
        $member_groups  = $email_newsletter->get_memeber_groups( $member_id );
        if ( ! is_array( $member_groups ) )
            $member_groups = array();

    }

    $only_public    = (isset($settings['non_public_group_access']) && $settings['non_public_group_access'] == 'nobody') ? 1 : 0;
    $groups         = $email_newsletter->get_groups($only_public);
    $groups_echo    = array();

    //Display status message
    if ( isset( $email_newsletter_result['message'] ) ) {

//        $groups_id = isset($_REQUEST['e_newsletter_add_groups_id']) ? $_REQUEST['e_newsletter_add_groups_id'] : array();
//        echo '<pre>';
//        var_dump($groups_id);
//        echo '</pre>';
        
        $css = 'updated';
        
        if ( true == $email_newsletter_result['error'] ) {
            $css = 'error';
        }
    
    
        ?><div class="em-warning <?php echo $css ?>"><p><?php echo  $email_newsletter_result['message']; ?></p></div><?php
    }


        if ( "" != $member_data['unsubscribe_code']) {
            ?>

            <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="post" name="subscribes_form" id="subscribes_form" class="wpcf7">
                <fieldset id="aanmelden_mailinglijst">
                <legend><?php _e( 'Geef aan voor welke mailinglijsten je je in of uit wilt schrijven', 'gebruikercentraal' ) ?></legend>
                <input type="hidden" name="xxx_newsletter_action" id="xxx_newsletter_action" value="" />
                <input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo esc_url( $_SERVER['REQUEST_URI'] ) ?>" />
                <input type="hidden" name="unsubscribe_code" value="<?php echo $member_data['unsubscribe_code']; ?>" />
                <?php
                if($groups) {
                ?>
                    <table id="subscribes_table" class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <?php _e( 'Newsletters:', 'email-newsletter' ) ?>
                            </th>
                            <td>
                                <?php
                                        foreach( $groups as $group ){
                                            if ( false === array_search ( $group['group_id'], $member_groups ) )
                                                $checked = '';
                                            else
                                                $checked = 'checked="checked"';
    
                                            $groups_echo[] = '<label><input type="checkbox" name="e_newsletter_groups_id[]" ' . $checked . ' value="' . $group['group_id'] . '" />' . $group['group_name'] . '</label>';
                                        }
                      echo implode('<br/>', $groups_echo);
                                ?>
                            </td>
                        </tr>
                    </table>
                <?php
                }
                ?>
          <p class="submit">
            <?php if ( $groups ) { ?>
                <input class="button button-primary" type="submit" id="save_subscribes" value="<?php _e( 'Save Subscribes', 'email-newsletter' ) ?>" />
            <?php } ?>
            <input class="button button-secondary" type="submit" id="unsubscribe" value="<?php _e( 'Unsubscribe from all newsletters', 'email-newsletter' ) ?>" />
          </p>
                </fieldset>
            </form>
        <?php
        } 
        else {
            ?>
            <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ) ?>" method="post" name="" id="" class="wpcf7">
                <fieldset id="aanmelden_mailinglijst">
                <legend><?php _e( 'Meld je aan voor onze nieuwsbrief', 'gebruikercentraal' ) ?></legend>
                <p class="e_newsletter_email">
                    <label for="e_newsletter_email"><?php _e( 'Your Email:', 'email-newsletter' ) ?></label>
                    <input type="text" name="e_newsletter_email" id="e_newsletter_email" value="<?php echo $_REQUEST['e_newsletter_email'] ?>" <?php echo $e_newsletter_email_css ?> /><?php echo $e_newsletter_email_tip; ?>
                </p>

                <?php
                if( count($groups) > 0 ) {
                    foreach( ( array ) $groups as $group ) {
                        echo '<input type="hidden" name="e_newsletter_add_groups_id[]" value="'.$group['group_id'].'" /> ';
                        
                    }
                }
                ?>
            
                <p class="submit">
                    <input type="hidden" name="xxx_newsletter_action" id="subscribe" value="new_subscribe" />
                    <input type="hidden" name="redirect_to" id="redirect_to" value="<?php echo esc_url( $_SERVER['REQUEST_URI'] ) ?>" />
                    <input class="button button-primary" type="submit" value="<?php _e( 'Subscribe on Newsletters', 'email-newsletter' ) ?>" />
                </p>
                </fieldset>
            </form>
            <?php
        }
        ?>


<?php 
}

genesis();

    
    