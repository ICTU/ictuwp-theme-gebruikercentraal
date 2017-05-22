<?php

/**
 * Gebruiker Centraal - page_newsletterarchive.php
 * ----------------------------------------------------------------------------------
 * pagina met nieuwsbriefarchief
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.6.6
 * @desc.   mobile menu, infoblock, naming convention functions
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */

//* Template Name: ZZZ (niet gebruiken)



add_action( 'genesis_entry_content', 'gc_wbvb_newsletter_archive', 11 );


/**
 * Echo the title with the search term.
 *
 * @since 1.9.0
 */
function gc_wbvb_newsletter_archive(  ){


    global $email_newsletter, $email_builder;
    
    $newsletters = $email_newsletter->get_newsletters();
//    var_dump($newsletters);

    foreach($newsletters as $key=>$value){
        if ( $value['sent'] ) {
            echo 'Verstuurd: newsletter_id ' . $value['newsletter_id'] . ' (' . $value['sent'] . ' / ' . md5($value['create_date']) . ')<br />';
        }
        else {
//            echo 'Niet verstuurd: newsletter_id ' . $value['newsletter_id'] . ' (' . $value['sent'] . ' / ' . md5($value['create_date']) . ')<br />';
        }
//        var_dump($value);
    }


//    $example_id = $newsletters[0]['newsletter_id'];
    
//    $content = $email_newsletter->make_email_body($example_id, 1);
//    $content = $this->prepare_preview($content);
//    echo $content;

// http://www.gebruikercentraal.nl/?view_newsletter=1&view_newsletter_code=1421764040&view_newsletter_send_id=1422285491        

    // http://www.gebruikercentraal.nl/?view_newsletter=1&view_newsletter_code=1421764040&view_newsletter_send_id=1422285491

//        $newrules['e-newsletter/view/([\w\d]{15})(\d*)/?$'] = 'index.php?view_newsletter=1&view_newsletter_code=$matches[1]&view_newsletter_send_id=$matches[2]';

    
    
    if ( 2 == 3 ) {
        
        // uit page-view-newsletter.php
        
        $view_newsletter_code = get_query_var( 'view_newsletter_code' );
        $view_newsletter_send_id = get_query_var( 'view_newsletter_send_id' );
        
        $result = $this->get_member_by_join_date($view_newsletter_code);
        if($result['member_id'] > 0 || $result['wp_only_user_id'] > 0)
          $ok = 1;
        else {
          $result = $this->get_member_id_by_code($view_newsletter_code);
          if($result['member_id'] > 0 || $result['wp_only_user_id'] > 0)
            $ok = 1;
        }
        
        if(isset($ok)) {
          $member_id = $wp_only_user_id = 0;
          if($result['member_id'] > 0) {
            $member_id = $result['member_id'];
            $member_data = $this->get_member( $member_id );
          }
          elseif($result['wp_only_user_id'] > 0) {
            $wp_only_user_id = $result['wp_only_user_id'];
            $member_data = $this->get_wp_user_only( $wp_only_user_id );
          }
        
          $send_details = $this->get_sent_email($view_newsletter_send_id, $member_id, $wp_only_user_id);
        
          if($send_details > 0) {
            $content = $send_details['email_body'];
        
            $user_name = $this->get_nicename($member_data['wp_user_id'], $member_data['member_nicename']);
            $first_name = $this->get_firstname($member_data['wp_user_id'], $member_data['member_nicename']);
            $content = $this->personalise_email_body($content, $member_id, $wp_only_user_id, $view_newsletter_code, $member_data['unsubscribe_code'], $view_newsletter_send_id, array('user_name' => $user_name, 'first_name' => $first_name, 'to_email' => $member_data["member_email"]));
            echo $content;
          }
        }
    }





}



genesis();
