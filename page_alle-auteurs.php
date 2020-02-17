<?php

// Gebruiker Centraal - page_alle-auteurs.php
// ----------------------------------------------------------------------------------
// Pagina waarop alle auteurs getoond kunnen worden
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.2.2
// @desc.   Paginatemplates gecheckt en functionaliteit voor relevante links toegevoegd.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


//* Template Name: GC-pagina - Alle auteurs

//========================================================================================================

add_action( 'genesis_entry_content', 'gc_wbvb_show_alle_auteurs', 11 );

// relevante content en externe links toevoegen
// @since	  4.2.2
add_action('wp_enqueue_scripts', 'ictu_gctheme_frontend_general_get_related_content_headercss' );
add_action( 'genesis_loop', 'ictu_gctheme_frontend_general_get_related_content', 12 );

showdebug(__FILE__, '/');

//========================================================================================================

genesis();

//========================================================================================================

function filter_two_roles($user) {
	$roles = array('contributor',',author','editor','administrator');
	return in_array($user->roles[0], $roles);
}

//========================================================================================================

function gc_wbvb_show_alle_auteurs() {
	
	$users = get_users('fields=all_with_meta');

	echo '<div class="actieteam">';
	
	// Iterate through users, filtering out the ones which don't have the roles we want 
	foreach(array_filter($users, 'filter_two_roles') as $user) {
		$user_post_count        = count_user_posts( $user->ID ); 
		if ( $user_post_count > 0 ) {
			echo  gc_wbvb_authorbox_compose_box( $user->ID );
		}
	}
	
	echo '</div>';
	
}

//========================================================================================================

