<?php

// Gebruiker Centraal - single-brief.php
// ----------------------------------------------------------------------------------
// pagina
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.9.4
// @desc.   Bug in single-brief.php opgelost.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


showdebug(__FILE__, '/');


//add_action( 'wp_enqueue_scripts', 'gc_wbvb_add_blog_single_css' );
add_action( 'genesis_entry_content', 'gc_wbvb_add_single_socialmedia_buttons', 1 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'gc_wbvb_add_tweedeveld', 13 );
add_action( 'genesis_entry_content', 'gc_wbvb_add_download_brief', 14 );
add_action( 'genesis_entry_content', 'gc_wbvb_beelden_brieven_show_connected_files', 15 );

add_filter('genesis_attr_entry-header', 'gc_wbvb_add_wrap_class');
add_filter('genesis_attr_entry-content', 'gc_wbvb_add_wrap_class');
add_filter('genesis_attr_entry-footer', 'gc_wbvb_add_wrap_class');



genesis();

// ============================================================

function gc_wbvb_add_tweedeveld() {

  global $post;
  $thecontents = get_the_content();
  
  if ( function_exists( 'get_field' ) && get_field('brief_extra_info') ) {
		$brief_extra_info     = wpautop( get_field('brief_extra_info') );
		echo $brief_extra_info;
	}
  elseif ( has_excerpt() ) {
  }
  if ( $thecontents ) {
    echo '<div class="blokje">';
    echo $thecontents;
    echo '</div>';
  }
  
}

// ============================================================

function gc_wbvb_add_download_brief() {

  global $post;
  
  if ( function_exists( 'get_field' ) ) {
		if ( get_field('brief_attachment') ) {
  		$attachment     = get_field('brief_attachment');
  		$image          = '';
      $url            = wp_get_attachment_url( $attachment['ID'] );
      $filelocation   = get_attached_file( $attachment['ID'] );
      $filesize       = gc_wbvb_get_human_filesize(filesize( $filelocation ),1);

      if (has_post_thumbnail( $post->ID ) ) {

        $size   = 'halfwidth';
        $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size );

      }

      echo '<div class="blokje">';
      echo '<p>';
      if ( isset( $image[0] ) ) {
        echo '<img src="' . $image[0] . '" alt="" width="' . $image[1] . '" height="' . $image[2] . '" /></p><p>';
      }
      echo '<a href="' . $attachment['url'] . '"  download="' . $attachment['filename'] . '" class="download">';
      echo 'Download : ' . $attachment['title'] . ' (' . $filesize . ')';
      echo '</a></p>';
      echo '</div>';
    }
  }
}

// ============================================================

