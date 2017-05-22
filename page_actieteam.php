<?php

// Gebruiker Centraal - page_actieteam.php
// ----------------------------------------------------------------------------------
// Pagina waarop alle leden van het actieteam getoond worden
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.7.7
// @desc.   Added author overview page, alignment avatars homepage.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme

//* Template Name: GC - Actieteampagina

add_action( 'genesis_entry_content', 'gc_wbvb_show_actieteamleden', 11 );

function gc_wbvb_show_actieteamleden() {


    if( have_rows('actieteamleden', 'option') ):
      
      echo '<div class="actieteam">';
      
      // loop through the rows of data
      while ( have_rows('actieteamleden', 'option') ) : the_row();

        $username = get_sub_field('actielid');
        $acf_userid = $username['ID'];   // grabs the user ID        
        echo  gc_wbvb_authorbox_compose_box( $acf_userid );
      
      endwhile;
      
      echo '</div>';
      
    else :
      
      // no rows found
      echo 'Geen actieteam bekend';
      
    endif;
    



      
}


genesis();

