<?php

/**
 * Gebruiker Centraal - gc-e-newsletter.php
 * ----------------------------------------------------------------------------------
 * Widget voor inschrijvingen op de nieuwsbrief
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.7.5
 * @desc.   Beta-versie voor live-gang. CSS-corrections. Post - file-uploads. Corrections for mobile menu button. Widget-corrections.
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */


//========================================================================================================


// Widget for Subscribe
class gc_newsletter_subscribe extends WP_Widget {


    /** constructor */
    function __construct() {

        $widget_ops = array( 'description' => __( 'Aangepaste versie van de e-newsletter widget voor het inschrijven op de nieuwsbrief.', 'gebruikercentraal' ) );
        parent::__construct(false, $name = __( 'GC - Mailinglijstwidget', 'gebruikercentraal' ), $widget_ops);  

    }


    //====================================================================================================
    
    /** @see WP_Widget::widget */
    function widget( $args, $instance ) {
        global $email_newsletter;
        global $current_user;

        extract( $args );

        $title                  = apply_filters( 'widget_title', $instance['title'] );
        $show_name              = $instance['name'];
        $show_groups            = $instance['groups'];
        $inschrpagina           = $instance['inschrpagina'];
        $subscribe_to_groups    = isset($instance['auto_groups']) ? $instance['auto_groups'] : array();

        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;

        echo subscribe_widget($show_name, $show_groups, $subscribe_to_groups, $inschrpagina);

        echo $after_widget;
    }

    //====================================================================================================

    /** @see WP_Widget::update */
    function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags($new_instance['title']);
        $instance['name']           = strip_tags($new_instance['name']);
        $instance['groups']         = strip_tags($new_instance['groups']);
        $instance['inschrpagina']   = strip_tags($new_instance['inschrpagina']);
        $instance['auto_groups']    = isset($new_instance['auto_groups']) ? $new_instance['auto_groups'] : array();
        return $instance;
    }

    //====================================================================================================

    /** @see WP_Widget::form */
    function form( $instance ) {
        global $email_newsletter;

        if ( isset( $instance['title'] ) )
            $title = esc_attr( $instance['title'] );
        else
            $title = __( 'Subscribe to our Newsletters', 'gebruikercentraal' );

        if ( isset( $instance['name'] ) )
            $name = esc_attr( $instance['name'] );
        else
            $name = 0;

        if ( isset( $instance['groups'] ) )
            $groups = esc_attr( $instance['groups'] );
        else
            $groups = 0;

            $all_groups = $email_newsletter->get_groups();
            $groups_html = array();
            foreach ($all_groups as $group) {
            $checked = (isset($instance['auto_groups']) && is_array($instance['auto_groups']) && in_array($group['group_id'], $instance['auto_groups'])) ? 'checked="checked"' : '';
            $groups_html[] = '
                <input id="'.$this->get_field_id( 'auto_groups_'.$group['group_id'] ).'" name="'.$this->get_field_name( 'auto_groups' ).'[]" type="checkbox" value="'.$group['group_id'].'" '.$checked.'/>
                <label for="'.$this->get_field_id( 'auto_groups_'.$group['group_id'] ).'">'.$group['group_name'].'</label>
            ';
        }
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="checkbox" value="1" <?php echo $name ? ' checked' : '';?> />
            <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Ask the name?', 'gebruikercentraal' ) ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'groups' ); ?>" name="<?php echo $this->get_field_name( 'groups' ); ?>" type="checkbox" value="1" <?php echo $groups ? ' checked' : '';?> />
            <label for="<?php echo $this->get_field_id( 'groups' ); ?>"><?php _e( 'Show Groups?', 'gebruikercentraal' ) ?></label>
        </p>
        <?php
        if(is_array($all_groups) && count($all_groups) > 0) {
            $groups_html = implode('<br/>', $groups_html)
        ?>
            <p>
                <?php _e( 'Automatically subscribe to following groups:', 'gebruikercentraal' ) ?>
            </p>
            <p><?php echo $groups_html; ?></p>
        <?php
        } ?>


        <label for="<?php echo $this->get_field_id('inschrpagina') . '">' . __( "Linkt naar pagina:", 'gebruikercentraal' ) ?><br />
        <?php
            $args = array(
                'depth'            => 0,
                'child_of'         => 0,
                'selected'         => esc_attr($inschrpagina),
                'echo'             => 1,
                'name'             => $this->get_field_name('inschrpagina')
            );
            
            wp_dropdown_pages( $args );
            
            echo '</label></p>';




    }
} // class gc_newsletter_subscribe

//========================================================================================================

if ( isset( $email_newsletter ) ) {
  add_action( 'widgets_init', 'gc_wbvb_load_subscribe_widget' );
}

/**
 * Register widgets for use in the Gebruiker Centraal theme.
 *
 * @since 1.7.0
 */
function gc_wbvb_load_subscribe_widget() {

    // unregister bbpres groups widget  
    unregister_widget('e_newsletter_subscribe');

    // register bbpres groups widget  
  register_widget( 'gc_newsletter_subscribe' );
  
  
}


function wpdocs_dequeue_script() {
//  wp_deregister_script( 'email-newsletter-widget-scripts' ); 

  wp_dequeue_script( 'email-newsletter-widget-scripts' ); 
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );


//========================================================================================================


    function subscribe_widget($show_name = false, $show_groups = true, $subscribe_to_groups = array(), $inschrpagina = '', $titlestring = '') {
        global $email_newsletter, $current_user;

        $displaynone = ' aria-hidden="true"';
        $displaynoneclass = ' class="display-none"';
                

        $groups = $email_newsletter->get_groups(1);

        if ( isset($current_user->data->ID) ) {
            $member_id      = $email_newsletter->get_members_by_wp_user_id( $current_user->data->ID );
            $member_data    = $email_newsletter->get_member( $member_id );
            $only_public    = (isset($email_newsletter->settings['non_public_group_access']) && $email_newsletter->settings['non_public_group_access'] == 'nobody') ? 1 : 0;
            $groups         = $email_newsletter->get_groups();

            if ( "" != $member_data['unsubscribe_code'] )
                $member_groups = $email_newsletter->get_memeber_groups( $member_id );

            if ( !isset($member_groups) || ! is_array( $member_groups ) )
                $member_groups = array();

            if(!$subscribe_to_groups)
                $show_groups = true;
        }
        else
            $groups = $email_newsletter->get_groups(1);

        if ( !isset($current_user->data->ID) ) {
            $view = "add_member";
        } 
        else if ( $current_user->data && $subscribe_to_groups && !$show_groups ) {
            if( $member_groups && !array_diff($subscribe_to_groups, $member_groups) )
                $view = "unsubscribe_from_groups";
            else
                $view = "subscribe_to_groups";
        } 
        else if ( isset( $member_data['unsubscribe_code'] ) && "" != $member_data['unsubscribe_code'] && 0 < $current_user->data->ID ) {
            $view = "manage_subscriptions";
        } 
        else if ( $current_user->data && 0 < $current_user->data->ID ) {
            $view = "subscribe";
        } 
        else {
            $view = "";
        }
        
        if ( (  $inschrpagina  ) && ( ! is_user_logged_in() ) ) {
                $inschrpagina    = '<p><a href="' . get_permalink($inschrpagina) . '">' . __( 'Schrijf je in via deze pagina', 'gebruikercentraal' ) . '</a></p>';
        }
        else {
            $inschrpagina    = '<p><a href="/wp-admin/admin.php?page=newsletters-subscribes">' . __( 'Je instellingen voor de nieuwsbrief', 'gebruikercentraal' ) . '</a></p>';
        }
        

        
        $return = '
        <div class="e-newsletter-widget">
            <div id="message"' . $displaynone . '></div>
            <noscript>' . $inschrpagina . '</noscript>
            
            <form action="/" method="post" name="subscribes_form" id="subscribes_form" class="nojs">
            <fieldset>
            



                <legend>' . __("Voer een geldig e-mailadres in om voortaan via mail op de hoogte gehouden te worden van alles nieuws rond Gebruiker Centraal", "gebruikercentraal") . '</legend>
            
                <input type="hidden" name="newsletter_action" id="newsletter_action" value="" />';
        if(is_array($subscribe_to_groups))
            foreach($subscribe_to_groups as $group_id )
                if(is_numeric($group_id))
                    $return .= '<input type="hidden" name="e_newsletter_auto_groups_id[]" value="'.$group_id.'" />';

        if($view != 'add_member')
            $return .= '
                <div id="add_member" class="e-newsletter-widget-screen"' . $displaynone . '>';
        else
            $return .=
                '<div id="add_member" class="e-newsletter-widget-screen">';
        $return .= '
                        <label for="e_newsletter_email">'.__( 'Your Email:', 'gebruikercentraal' ).'</label>
                        <input type="text" name="e_newsletter_email" id="e_newsletter_email" value="" />';
        if( isset($show_name) && $show_name )
            $return .= '
                        <br/>

                        <label for="e_newsletter_name">'.__( 'Your Name:', 'gebruikercentraal' ).'</label>
                        <input type="text" name="e_newsletter_name" id="e_newsletter_name" />';

        if( $show_groups && count($groups) > 0 ) {
            $return .='
                        <h3>'.__( 'Subscribe to:', 'gebruikercentraal' ).'</h3>
                        <p>
                            <ul class="subscribe_groups">';
            foreach( ( array ) $groups as $group ) {
                if( ! $group['public'] ) continue;
                    $return .= '
                                    <li>

                                        <input type="checkbox" name="e_newsletter_groups_id[]" value="'.$group['group_id'].'" id="e_newsletter_groups_id_'.$group['group_id'].'" class="e_newsletter_groups_id_'.$group['group_id'].'" />
                                        <label for="e_newsletter_groups_id_'.$group['group_id'].'">'.$group['group_name'].'</label>

                                    </li>';
            }
            $return .= '
                            </ul>
                        </p>';

        }
        $return .='
                        <input type="button" id="new_subscribe" class="enewletter_widget_submit" value="'.__( 'Subscribe', 'gebruikercentraal' ).'" />

                </div>';



        if($view != 'subscribe_to_groups')
            $return .= '
                <div id="subscribe_to_groups" class="e-newsletter-widget-screen"' . $displaynone . '>';
        else
            $return .='
                <div id="subscribe_to_groups" class="e-newsletter-widget-screen">';

        if( count($groups) > 0 )
            foreach( (array) $subscribe_to_groups as $subscribe_to_group_id )
                $return .= '<input type="hidden" name="e_newsletter_add_groups_id[]" value="'.$subscribe_to_group_id.'"/>';
        
                $return .= '
                            <p>
                                <input type="button" id="subscribe_to_groups_button" class="enewletter_widget_submit" value="'.__( 'Subscribe', 'gebruikercentraal' ).'" />
                            </p>';
                $return .= '
                        </div>';

        if($view != 'unsubscribe_from_groups')
            $return .= '
                <div id="unsubscribe_from_groups" class="e-newsletter-widget-screen"' . $displaynone . '>';
        else
            $return .='
                <div id="unsubscribe_from_groups" class="e-newsletter-widget-screen"' . $displaynone . '>';

        if( count($groups) > 0 )
            foreach( (array) $subscribe_to_groups as $subscribe_to_group_id )
                $return .= '
                    <input type="hidden" name="e_newsletter_remove_groups_id[]" value="'.$subscribe_to_group_id.'"/>';

        $return .= '
                    <p>
                        <input type="button" id="unsubscribe_from_groups_button" class="enewletter_widget_submit" value="'.__( 'Unsubscribe', 'gebruikercentraal' ).'" />
                    </p>';
        $return .= '
                </div>';



        if($view != 'manage_subscriptions') {
            $return .= '<div id="manage_subscriptions" class="e-newsletter-widget-screen"' . $displaynone . '>';
        }
        else {
            $return .='<div id="manage_subscriptions" class="e-newsletter-widget-screen">';
        }

        $unsubscribe_code = isset( $member_data['unsubscribe_code'] ) ? $member_data['unsubscribe_code'] : '';
        $return .='<input type="hidden" name="unsubscribe_code" id="unsubscribe_code" value="'.$unsubscribe_code.'" />';

        if( $show_groups && count($groups) > 0 ) {
            if( isset($only_public) && $only_public == 1 )
                foreach( (array) $groups as $group )
                    if (!$group['public'] && in_array($group['group_id'], $member_groups) )
                        $return .= '<input type="hidden" name="e_newsletter_groups_id[]" value="'.$group['group_id'].'"/>';
                        $return .= '<h3>'.__( 'Subscribe to:', 'gebruikercentraal' ).'</h3>
                                    <p><ul class="subscribe_groups">';
            foreach( (array) $groups as $group ){
                if ( isset($member_groups) && in_array($group['group_id'], $member_groups) ) {
                    $checked = 'checked="checked"';
                }
                else {
                    $checked = '';
                }
                
                if(!isset($only_public) || ($only_public && $group['public']) || !$only_public)
                    $return .= '<li><input type="checkbox" name="e_newsletter_groups_id[]" value="'.$group['group_id'].'" '.$checked.' id="e_newsletter_groups_id_'.$group['group_id'].'" class="e_newsletter_groups_id_'.$group['group_id'].'" /><label for="e_newsletter_groups_id_'.$group['group_id'].'">'.$group['group_name'].'</label></li>';
            }
            
            $return .= '</ul></p>
                    <p><input type="button" id="save_subscribes" class="enewletter_widget_button" value="'.__( 'Save Subscriptions', 'gebruikercentraal' ).'" /></p>';
        }
        
        $return .= '<p><a href="#" id="unsubscribe" class="enewletter_widget_submit" >'.__( 'Unsubscribe', 'gebruikercentraal' ).'</a></p>';
        $return .= '</div>';

        if($view != 'subscribe') {
            $return .= '<div id="subscribe" class="e-newsletter-widget-screen"' . $displaynone . '>';
        }
        else {
            $return .= '<div id="subscribe" class="e-newsletter-widget-screen">';
        }
            
        $return .= '
                    <input type="submit" id="subscribe_submit" class="enewletter_widget_submit" value="'.__( 'Subscribe to Newsletters', 'gebruikercentraal' ).'" />
                </div>
            </fieldset>
            </form>
        </div><!--//e-newsletter-widget  -->';

        return $return;
    }


//========================================================================================================


