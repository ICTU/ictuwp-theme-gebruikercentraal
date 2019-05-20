<?php 
  
//
// Gebruiker Centraal - author-box.php
// ----------------------------------------------------------------------------------
// Dinges om de authorbox te vullen
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.16.1
// @desc.   CTA-kleuren, a11y groen, sharing buttons optional, beeldbank CPT code separation.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
  
  

//========================================================================================================


function gc_wbvb_authorbox_actieteamlid( $userid ) {

    global $default_persoon_plaatje;
    
    if ( $default_persoon_plaatje == 'voorbeeld-persoon-2.png' ) {
    	$default_persoon_plaatje = 'voorbeeld-persoon-1.png';
    }
    else {
    	$default_persoon_plaatje = 'voorbeeld-persoon-2.png';
    }

    if ( function_exists( 'get_field' ) ) {
    
        $acf_userid             = "user_" . $userid;       

        $user_info              = get_userdata($userid);
        $gebruikersnaam         = $user_info->display_name;
        $functiebeschrijving    = get_field('functiebeschrijving', $acf_userid);

    		if ( !$functiebeschrijving ) {
    	        $functiebeschrijving            = ( $user_info->description ) ? $user_info->description : '&nbsp;' ;
    		}

        $functiebeschrijving    = nl2br( $functiebeschrijving );
        $pattern                = "/<p[^>]*><\\/p[^>]*>/"; 
        $functiebeschrijving    = preg_replace($pattern, '', $functiebeschrijving); 
                
        $twitter                = get_field('twitter', $acf_userid);
        if ($twitter != '') {
            $twitter            = preg_replace('/@/i','',$twitter);
        }
    
        $authorfoto             = get_field('auteursfoto', $acf_userid);

        $image                  = wp_get_attachment_image_src($authorfoto['id'], 'thumbnail'); 
        $imagetag               = '';

        if ( $image[0] ) {
            $imagetag  = '            <img alt="" src="' . $image[0] . '" class="author-photo photo avatar" height="' . $image[2] . '" width="' . $image[1] . '" alt="' . $authorfoto['id'] . '" />';
        }
        else {

            $imagetag  = '            <img alt="" src="' . WBVB_THEMEFOLDER . '/images/' . $default_persoon_plaatje . '" class="author-photo photo avatar" height="' . $image[2] . '" width="' . $image[1] . '" alt="' . $authorfoto['id'] . '" />';
            
        }


        if ( $image[0] ) {
            $imagetag  = '            <img src="' . $image[0] . '" class="author-photo photo avatar" height="' . $image[2] . '" width="' . $image[1] . '" alt="' . $authorfoto['id'] . '" />';
        }
        else {

          $args = array(
            'size'  => 82,  
            'class' => 'author-photo photo avatar',  
          );

          $defaultplaatje = get_stylesheet_directory_uri() . '/images/' . $default_persoon_plaatje;
          $imagetag  = get_avatar( $userid, 82, $defaultplaatje, $authorfoto['id'], $args ); 

        }
        
    }
    
    $dl = '';
    

    if ($twitter) {
        $dl .= '<dt class="twitter">Twitter</dt><dd><a href="https://twitter.com/' . $twitter . '">@' . $twitter . '</a></dd>';
    }

    
    if ($dl) {
        $dl = '<dl>' . $dl . '</dl>';
    }

    $functiebeschrijving = preg_replace("/&#?[a-z0-9]{2,8};/i","",$functiebeschrijving);

    if ( $functiebeschrijving ) {
        $functiebeschrijving = "<p>" . $functiebeschrijving . "</p>";
    }

    $output = '<section class="author-box" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a href="' . get_author_posts_url( $userid ) . '" class="author-info author-archive">' . $imagetag . '<div style="" class="author-info"><h2 class="author-box-title">' .$gebruikersnaam . '</h2>' . $functiebeschrijving . '</div></a></section>';


    return $output;
    
    
}

//========================================================================================================


function gc_wbvb_authorbox_compose_box( $userid, $gravatar = '', $sectiontype = '' ) {

	if ( ( GC_BEELDBANK_BEELD_CPT == get_post_type() ) || ( GC_BEELDBANK_BRIEF_CPT == get_post_type() ) )  {
		return;
	}  
	
    global $default_persoon_plaatje;
    
    $publiek_mailadres      = '';
    $publiek_telefoonnummer = '';
    $header_tag             = 'h2';
    $prefix                 = _x( 'About', 'author box', 'gebruikercentraal');
    $user_info              = '';
    
    if ( is_archive() ) {
      $header_tag             = 'h1';
      $prefix                 = _x( 'Posts by', 'author box', 'gebruikercentraal');
    }

    $sectiondiv = '<section class="author-box wrap" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">';

    if ( 'even' == get_post_type() ) {
      $sectiondiv = '<section class="author-box wrap" itemprop="organizer" itemscope="itemscope" itemtype="http://schema.org/Person">';
    }

    if ( $default_persoon_plaatje == 'voorbeeld-persoon-2.png' ) {
    	$default_persoon_plaatje = 'voorbeeld-persoon-1.png';
    }
    else {
    	$default_persoon_plaatje = 'voorbeeld-persoon-2.png';
    }

    if ( function_exists( 'get_field' ) ) {
    
        $acf_userid             = "user_" . $userid;       

        $user_info              = get_userdata($userid);

        $gebruikersnaam         = $user_info->display_name;
        $functiebeschrijving    = get_field('functiebeschrijving', $acf_userid);
        $biografie              =( $user_info->description ) ? $user_info->description : '';
        $user_post_count        = count_user_posts( $userid ); 

    		if ( !$functiebeschrijving ) {
  	        $functiebeschrijving = $biografie;
  	        $biografie = '';
    		}

        $functiebeschrijving     = nl2br( $functiebeschrijving );

    		if ( $biografie ) {
          $biografie     = '<p>' . nl2br( $biografie ) . '</p>';
    		}




        $pattern = "/<p[^>]*><\\/p[^>]*>/"; 
        $functiebeschrijving = preg_replace($pattern, '', $functiebeschrijving); 
        
        
        $twitter                = get_field('twitter', $acf_userid);
        if ($twitter != '') {
            $twitter            = preg_replace('/@/i','',$twitter);
        }
        
        $linkedin               = get_field('linkedin', $acf_userid);
        $facebook               = get_field('facebook', $acf_userid);
        $personalurl            = get_field('personalurl', $acf_userid);
        

        
        
        $publiek_mailadres      = get_field('publiek_mailadres', $acf_userid);
        $publiek_telefoonnummer = get_field('publiek_telefoonnummer', $acf_userid);
    
        $authorfoto             = get_field('auteursfoto', $acf_userid);

        $image                  = wp_get_attachment_image_src($authorfoto['id'], 'thumbnail'); 
        $imagetag               = '';

        if ( $image[0] ) {
            $imagetag  = '            <img src="' . $image[0] . '" class="author-photo photo avatar" height="' . $image[2] . '" width="' . $image[1] . '" alt="' . $authorfoto['id'] . '" />';
        }
        else {

          $args = array(
            'size'  => 82,  
            'class' => 'author-photo photo avatar',  
          );

          $defaultplaatje = get_stylesheet_directory_uri() . '/images/' . $default_persoon_plaatje;
          $imagetag  = get_avatar( $userid, 82, $defaultplaatje, $authorfoto['id'], $args ); 

        }
    
    $dl = '';
    
    $displayname = ( $user_info->user_firstname ? $user_info->user_firstname : ( $user_info->display_name ? $user_info->display_name : 'geen naam'  ) );

    if ($publiek_telefoonnummer) {
        $publiek_telefoonnummer_d = preg_replace("/[^0-9+]/", "", $publiek_telefoonnummer);
        $publiek_telefoonnummer = '<a href="tel://' . $publiek_telefoonnummer_d . '" itemprop="telephone">' . ' ' . $publiek_telefoonnummer . '</a> ';
    }

    if ($publiek_mailadres) {
        $publiek_mailadres = '<a href="mailto:' . $publiek_mailadres . '" itemprop="email">' . _x('Mail','Event: CTA om mail te versturen aan organisator','gebruikercentraal' ) . ' ' . $displayname . '</a> ';
    }

    if ($publiek_mailadres) {
        $dl .= '<li>' . $publiek_mailadres . '</li>';
    }

    if ($publiek_telefoonnummer) {
        $dl .= '<li>' . $publiek_telefoonnummer . '</li>';
    }


    if ($personalurl) {
        $dl .= '<li><a href="' . $personalurl . '" class="personallink" title="' . _x('Personal website', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . _x('Personal website', 'author box', 'gebruikercentraal' ) . '</span></a></li>';
    }

    if ($linkedin) {
        $dl .= '<li><a href="' . $linkedin . '" class="linkedin" title="' . _x('LinkedIn page', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . _x('LinkedIn page', 'author box', 'gebruikercentraal' ) . '</span></a></li>';
    }

    if ($facebook) {
        $dl .= '<li><a href="' . $facebook . '" class="facebook" title="' . _x('Facebook account', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . _x('Facebook account', 'author box', 'gebruikercentraal' ) . '</span></a></li>';
    }

    if ($twitter) {
        $dl .= '<li><a href="https://twitter.com/' . $twitter . '" class="twitter" title="' . _x('Twitter account', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . _x('Twitter account', 'author box', 'gebruikercentraal' ) . '</span></a></li>';
    }

    
    if ($dl) {
        $dl = '<ul class="social-media">' . $dl . '</ul>';
    }
    
    $functiebeschrijving = preg_replace("/&#?[a-z0-9]{2,8};/i","",$functiebeschrijving);

    if ( $functiebeschrijving ) {
        $functiebeschrijving = '<p span itemprop="jobTitle">' . $functiebeschrijving . "</p>";
    }

    $output = '<div class="wrap contains-author-box">' . $sectiondiv . '<div class="bg-color">' . $imagetag . '
      <div class="author-info">
        <' . $header_tag . ' class="author-box-title"><span class="visuallyhidden">' . $prefix . ' </span><span itemprop="name">' .$gebruikersnaam . '</span></' . $header_tag . '>
        ' . $functiebeschrijving . '
        <hr>' . $biografie . '
        <p>' . $dl;
        if ( !is_author() ) {
          if ( $user_post_count > 0 ) {
            $output .= '<a href="' . get_author_posts_url( $userid ) . '" class="author-archive more" title="' . _x('All posts', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '"><span class="visuallyhidden">' . _x('All posts', 'author box', 'gebruikercentraal' ) . ' van ' . $gebruikersnaam . '</span></a>';
          }
        }

    $output .= '</p></div></div></section></div>';

    }
    else {
			$output =  ACF_PLUGIN_NOT_ACTIVE_WARNING;
    }


    return $output;
    
    
}

  
//========================================================================================================

add_filter( 'genesis_author_box', 'gc_wbvb_authorbox_filter_output', 10, 6 );
 
function gc_wbvb_authorbox_filter_output( $output, $context, $pattern, $gravatar, $title, $description ) {

    global $post;
    $imagetag = $gravatar;
    $sectiontype = '';
    if ( function_exists( 'get_field' ) ) {
        $acf_userid         = get_the_author_meta('ID');
        $output             = gc_wbvb_authorbox_compose_box( $acf_userid, $gravatar, $sectiontype );
    }
    else {
        
    }

    return $output;
}

//========================================================================================================
