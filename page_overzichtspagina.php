<?php

/**
 * Gebruiker Centraal - page_overzichtspagina.php
 * ----------------------------------------------------------------------------------
 * Pagina met child-pages
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.4.11
 * @desc.   Tabs to spaces, tabs to spaces
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */


//* Template Name: GC - Overzichtspagina

add_action( 'genesis_entry_content', 'gc_wbvb_show_page_overzichtspagina', 11 );

function gc_wbvb_show_page_overzichtspagina() {

    global $id;
 

    $children = get_pages(array(
      'child_of'      => $id,
      'parent'        => $id,
      'sort_order'    => 'ASC',
      'sort_column'   => 'menu_order'
    ));



    if ( function_exists( 'get_field' ) ) {
        if ($children) {
            echo '<h2>' . __( "Zie ook:", 'gebruikercentraal' ) . '</h2><div class="related">';
    
            foreach( $children as $post): 
                setup_postdata($post); 
                
                gc_wbvb_related_content($post);
                
            endforeach; 
            
            wp_reset_postdata();
            echo '</div>';
        }
    }




      
}


genesis();

