<?php

/**
 * Gebruiker Centraal - page_login.php
 * ----------------------------------------------------------------------------------
 * Pagina met login form
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.6.6
 * @desc.   mobile menu, infoblock, naming convention functions
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */


//* Template Name: GC - Pagina met login form

add_action( 'genesis_entry_content', 'gc_wbvb_login_form', 15 );


/**
 * Echo the title with the search term.
 *
 * @since 1.9.0
 */
function gc_wbvb_login_form(  ){
    
    if ( is_user_logged_in() ) {

        gc_wbvb_write_widget_loginpage_logged_in(); 
    }
    else {

        wp_login_form();
        gc_wbvb_write_widget_loginpage_not_logged_in(); 
    }
}



genesis();
