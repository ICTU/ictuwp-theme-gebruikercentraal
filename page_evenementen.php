<?php


/**
 * Gebruiker Centraal page_evenement.php
 * ----------------------------------------------------------------------------------
 * Pagina voor het tonen van een event. Deze combineert template files met custom code
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.6.6
 * @desc.   mobile menu, infoblock, naming convention functions
 * @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal
 */

showdebug(__FILE__, 'page_evenementen');

// Template naam hernoemd
// * @since	  4.2.2
//* Template Name: GC-events - pagina met overzicht van de agenda




//* Remove the entry footer markup (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// deze pagina zou moeten worden gebruikt voor een single event.
// in dit theme wordt de weergave van een evenement afgehandeld door bestanden in de folder
// /ictuwp-theme-gebruikercentraal/plugins/events-manager/

// meer specifiek: de opbouw van een single event komt uit
// <themes>/ictuwp-theme-gebruikercentraal/plugins/events-manager/formats/single_event_format.php
// met wat hulpfuncties in functions.php, die aangeroepen worden in
// <themes>/ictuwp-theme-gebruikercentraal/plugins/events-manager/templates/event-single.php
// deze variabelen worden later door die functies van een waarde voorzien.
// ofzoiets.


add_action( 'genesis_before_footer', 'gc_wbvb_andere_bijeenkomsten', 5 );

//========================================================================================================
// schema attribute for event
add_filter( 'genesis_attr_entry', 'page_evenement_change_schema_attribute' );

function page_evenement_change_schema_attribute( $attributes ) {

 $attributes['itemtype'] = 'http://schema.org/Event';
 return $attributes;

}

//========================================================================================================

// schema attribute for event
add_filter( 'genesis_attr_entry-content', 'page_evenement_change_content_attribute' );
//add_filter( 'genesis_attr_entry', 'page_evenement_change_content_attribute' );

function page_evenement_change_content_attribute( $attributes ) {

 $attributes['itemprop'] = '';

 return $attributes;

}

//========================================================================================================

function gc_wbvb_andere_bijeenkomsten( ) {


  if ( function_exists( 'get_field' ) ) {

    $andere_bijeenkomsten    = get_field('toon_andere_bijeenkomsten');

    if( have_rows( 'bijeenkomsten' ) ):

      $titel      = get_field('titel');
      $inleiding  = get_field('inleiding');

      echo '<div class="andere-bijeenkomsten">';
      echo '<div class="wrap"><h2 class="entry-title">' . $titel . '</h2>';
      echo '<p>' . $inleiding . '</p>';

      echo '<ul class="event-program">';

      // loop through the rows of data
      while ( have_rows('bijeenkomsten') ) : the_row();

        $naam_bijeenkomst = strip_tags( get_sub_field('naam_bijeenkomst'), '<br>' );
        $bijeenkomst_URL  = strip_tags( get_sub_field('bijeenkomst_URL'), '<br>' );

        echo '<li><a href="' . $bijeenkomst_URL  . '">' . $naam_bijeenkomst . '</a></li>';

      endwhile;

      echo '</ul>';

      echo '</div>';
      echo '</div>';

  endif;

  }
}

//========================================================================================================




$EM_gc_wbvb_single_event_availability  =   '';
$EM_gc_wbvb_single_event_aanmeldingen  =   '';
$EM_gc_wbvb_single_event_organizor     =   '';
$EM_gc_wbvb_single_event_programma     =   '';
$EM_gc_wbvb_single_event_links         =   '';


genesis();
