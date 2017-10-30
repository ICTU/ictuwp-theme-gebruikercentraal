<?php

//
// Gebruiker Centraal - page_contentpagina.php
// ----------------------------------------------------------------------------------
// Pagina met gerelateerde content
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.9.1
// @desc.   Toevoegen posttypes voor klantcontact-in-beeld.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


//* Template Name: GC - Contentpagina


add_action( 'genesis_entry_content', 'gc_wbvb_show_related_content', 11 );

function gc_wbvb_show_related_content() {

    if ( function_exists( 'get_field' ) ) {
        
        $gridcontent    = get_field('gerelateerde_content');
        
        if( $gridcontent ): 

            echo '<h2>' . __( "Zie ook:", 'gebruikercentraal' ) . '</h2><div class="related page_contentpagina">';


            foreach( $gridcontent as $post): 
                setup_postdata($post); 
                
                gc_wbvb_related_content($post);
                
            endforeach; 

            wp_reset_postdata();

           echo '</div>';
    
        else :
        
//            echo "<p>Ai, aan deze pagina zijn nog geen blokken toegevoegd.</p>";
    
            
        endif; 
    }
    else {
      echo 'de ACF custom fields plugin is niet actief.';
    }


}


genesis();


// b3JkZXJfaWQ9NDY1Mzd8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTEyLTE4IDA2OjAzOjIz