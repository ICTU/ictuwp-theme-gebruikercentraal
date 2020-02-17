<?php

// Gebruiker Centraal - page_alle-auteurs.php
// ----------------------------------------------------------------------------------
// Pagina waarop alle auteurs getoond kunnen worden
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.1
// @desc.   Fixes voor actieteamwidget bug (sanitize_title) en authorbox (get user ID from get_queried_object).
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


//* Template Name: GC - Alle auteurs

add_action( 'genesis_entry_content', 'gc_wbvb_show_alle_auteurs', 11 );

//========================================================================================================

function filter_two_roles($user) {

	// nieuwe rol ook hier toegevoegd	
	// * @since	  4.3.1	
	$roles = array('contributor',',author','editor','administrator','rdamadmin');
    return in_array($user->roles[0], $roles);
}

//========================================================================================================

function gc_wbvb_show_alle_auteurs() {
	
	$users = get_users('fields=all_with_meta');

	echo '<div class="actieteam">';
	
	// Iterate through users, filtering out the ones which don't have the roles we want 
	foreach(array_filter($users, 'filter_two_roles') as $user) {
//	foreach( $users as $user) {

//echo 'Rol: ' . $user->roles[0] . '<br>';
		
		$user_post_count        = count_user_posts( $user->ID ); 
		if ( $user_post_count > 0 ) {
			echo  gc_wbvb_authorbox_compose_box( $user->ID );
		}
	}
	
	echo '</div>';
	
}

//========================================================================================================

genesis();

