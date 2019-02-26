<?php

// Gebruiker Centraal - single-beeld.php
// ----------------------------------------------------------------------------------
// pagina
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.12.1
// @desc.   Renamed functions for better sharing.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


showdebug(__FILE__, '/');

//add_action( 'wp_enqueue_scripts', 'gc_wbvb_add_blog_single_css' );
add_action( 'genesis_entry_content', 'gc_wbvb_add_single_socialmedia_buttons', 1 );
add_action( 'genesis_entry_content', 'gc_wbvb_add_download_beeld', 4 );
add_action( 'genesis_entry_content', 'gc_wbvb_add_extra_text', 11 );
add_action( 'genesis_entry_content', 'gc_wbvb_beelden_brieven_show_connected_files', 15 );

add_filter('genesis_attr_entry-header', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-content', 'gc_shared_add_wrap_class');
add_filter('genesis_attr_entry-footer', 'gc_shared_add_wrap_class');

genesis();

// ============================================================


function gc_wbvb_add_extra_text() {
  if ( function_exists( 'get_field' ) ) {
		if ( get_field('beeld_manier_van_gebruiken') ) {
  		$extra     = get_field('beeld_manier_van_gebruiken');
      echo '<p>' . $extra . '<p>';
    }
  }
}


// ============================================================


function gc_wbvb_add_download_beeld() {
  if ( function_exists( 'get_field' ) ) {
		if ( get_field('beeld_foto') ) {
  		$attachment     = get_field('beeld_foto');

  		if ( isset( $attachment['ID'] ) ) {
      		
        $url            = wp_get_attachment_url( $attachment['ID'] );
        $filelocation   = get_attached_file( $attachment['ID'] );
        $filesize       = gc_wbvb_get_human_filesize(filesize( $filelocation ),1);
      
        $class = preg_replace('/[^\da-z]/i',"-",$attachment['mime_type']);
  
        // thumbnail
        $size   = 'halfwidth';
        $thumb  = $attachment['sizes'][ $size ];
        $width  = $attachment['sizes'][ $size . '-width' ];
        $height = $attachment['sizes'][ $size . '-height' ];
        
        echo '<p style="width: 50%; float: right; padding: 0 0 1em 1em;">';
        echo '<a href="' . $attachment['url'] . '"  download="' . $attachment['filename'] . '">';
        echo '<img src="' . $thumb . '" alt="' . $attachment['alt'] . '" width="' . $width . '" height="' . $height . '" />';
        echo '</a><br><br>';
        echo '<a href="' . $attachment['url'] . '"  download="' . $attachment['filename'] . '" class="download">';
        echo 'Download : ' . $attachment['title'] . ' (' . $filesize . ')';
        echo '</a><p>';
        
  		}


/*  		echo '<pre>';
  		var_dump( $attachment );
  		echo '</pre>';
*/
      
    }
  }
}

// ============================================================
