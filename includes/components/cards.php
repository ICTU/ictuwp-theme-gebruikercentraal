<?php

///
// * Gebruiker Centraal - includes/components/cards.php
// * ----------------------------------------------------------------------------------
// * Functies voor het tonen van cards
// * ----------------------------------------------------------------------------------
// * @package gebruiker-centraal
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @since   4.1.3
// * @version 4.1.9
// * @desc.   Card-type 'card--vaardigheid' added.
// * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

if ( !function_exists( 'ictu_gctheme_card_general' ) ) :


	/**
	 * Writes out a single card, without frills or fancy stuff
	 *
	 * @since 4.1.3
	 *
	 * @param object $post 
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 */

    function ictu_gctheme_card_general( $post = [] ) {

        if ( is_object( $post ) ) {
            $post_ID = $post->ID;
        }
        elseif ( $post > 0 ) {
            $post_ID = $post;
        }
        else {
            return;
        }

        $section_title	= get_the_title( $post_ID );
        $section_text	= get_the_excerpt( $post_ID );
        $section_link	= get_sub_field( 'home_template_teaser_link' );
        $title_id		= sanitize_title( $section_title );

        echo '<div class="card no-image">';
        echo '<h3 id="' . $title_id . '"><a href="' . get_permalink( $post_ID ) . '">' . $section_title .
          '<span class="btn btn--arrow"></span>' .
          '</a></h3>';
        echo '<p>';
        echo $section_text;
        echo '</p>';
        echo '</div>';

	    
    }


endif;

//========================================================================================================

if ( !function_exists( 'ictu_gctheme_card_vaardigheid' ) ) :


	/**
	 * Writes out a single card voor een vaardigheid, with an icon
	 *
	 * @since 4.1.9
	 *
	 * @param object $post 
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 */

    function ictu_gctheme_card_vaardigheid( $post = [] ) {

        if ( is_object( $post ) ) {
            $post_ID = $post->ID;
        }
        elseif ( $post > 0 ) {
            $post_ID = $post;
        }
        else {
            return;
        }

        $section_title	= get_the_title( $post_ID );
        $section_text	= get_the_excerpt( $post_ID );
        $section_link	= get_sub_field( 'home_template_teaser_link' );
        $title_id		= sanitize_title( $section_title );
		$posttype 		= get_post_type( $post_ID );
		$icoon			= get_field( 'vaardigheid_icoon', $post_ID );
		$titleclass 	= '';		
		$cardclass 		= "card--" . $posttype;
		
		if ( $icoon ) {
			$titleclass  = "icon--" . $icoon;
			$cardclass 	.= " icon";
		}
		

        echo '<div class="card ' . $cardclass . '">';
        echo '<h3 id="' . $title_id . '" class="' . $titleclass . '"><a href="' . get_permalink( $post_ID ) . '">' . $section_title . ' - ' . $icoon .
          '<span class="btn btn--arrow"></span>' .
          '</a></h3>';
        echo '<p>';
        echo $section_text;
        echo '</p>';
        echo '</div>';

	    
    }


endif;

//========================================================================================================

if ( !function_exists( 'ictu_gctheme_card_doelgroep' ) ) :


	/**
	 * Writes out a single doelgroep card, with a matching avatar and quote
	 *
	 * @since 4.1.3
	 *
	 * @param object $post 
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 */

	function ictu_gctheme_card_doelgroep( $post, $quoteobject ) {
	
	    if (is_object($quoteobject) && 'WP_Post' == get_class($quoteobject)) {
	        $quoteobject_post 			= get_post($quoteobject->ID);
	        $quoteobject_auteur			= sanitize_text_field(get_field('citaat_auteur', $quoteobject->ID));
	        $content 					= '&ldquo;' . $quoteobject_post->post_content . '&rdquo;';
	    }
	    else {
	        if ($quoteobject[0]->post_content) {
	            $content 				= '&ldquo;' . $quoteobject[0]->post_content . '&rdquo;';
	            $quoteobject_auteur 	= sanitize_text_field(get_field('citaat_auteur', $quoteobject[0]->ID));
	        }
	        else {
	            return '';
	        }
	    }
	
	    $content = apply_filters('the_content', $content);
	
	    if (is_object($post)) {
	        $post_ID = $post->ID;
	    }
	    elseif ($post > 0) {
	        $post_ID = $post;
	    }
	    else {
	        return;
	    }
	
	    $posttype 		= get_post_type($post_ID);
	    $title_id 		= sanitize_title('title-' . $posttype . '-' . $post_ID);
	    $section_id 	= sanitize_title('section-' . $posttype . '-' . $post_ID);
	    $postpoppetje 	= 'poppetje-1';
	    $cardtitle 		= esc_html(get_the_title($post->ID));
	
	    // wat extra afbreekmogelijkheden toevoegen in de titel
		$cardtitle 		= od_wbvb_custom_post_title( $cardtitle );	
	
	    if (get_field('doelgroep_avatar', $post_ID)) {
	        $postpoppetje = get_field('doelgroep_avatar', $post_ID);
	    }
	
	    $return = '<section aria-labelledby="' . $title_id . '" class="card card--doelgroep ' . $postpoppetje . '" id="' . $section_id . '">';
	    $return .= '<div class="card__image"></div>';
	    $return .= '<div class="card__content">';
	    $return .=
	      '<h2 class="card__title" id="' . $title_id . '">' .

	      '<a href="' . get_permalink($post->ID) . '" class="arrow-link">' .
	      '<span class="arrow-link__descr">' . _x('Ontwerpen voor', 'Home section doelgroep', 'ictu-gc-posttypes-inclusie') . ' </span>' .
	      '<span class="arrow-link__text">' . $cardtitle . '</span>' .
	      '<span class="arrow-link__icon"></span>' .
	      '</a>'.
        '</h2>';
	    $return .= '<div class="tegeltje">' . $content . '<p><strong>' . $quoteobject_auteur . '</strong></p></div>';
	    $return .= '</div>';
	    $return .= '</section>';
	
	    return $return;
        
	}

endif;

//========================================================================================================

if ( !function_exists( 'ictu_gctheme_card_featuredimage' ) ) :


	/**
	 * Writes out a single doelgroep card, with a matching avatar and quote
	 *
	 * @since 4.1.3
	 *
	 * @param object $post 
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 */

	function ictu_gctheme_card_featuredimage( $post ) {
	
	    if ( is_object( $post ) ) {
	        $post_ID = $post->ID;
	    }
	    elseif ($post > 0) {
	        $post_ID = $post;
	    }
	    else {
	        return;
	    }
	
		$posttype 			= get_post_type( $post_ID );
		$section_title		= get_the_title( esc_html( $post_ID ) );
		$title_id 			= sanitize_title('title-' . $posttype . '-' . $post_ID );
		$section_text		= get_the_excerpt( $post_ID );
		$block_id       	= sanitize_title( 'related_' . $post_ID );
		$image 				= wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID ), 'large' );
		$imageplaceholder 	= '';
		$section_meta 		= '';

		if ( 'post' === get_post_type() ) {
			$section_meta = get_the_author( $post_ID ) . ' - ' . do_shortcode( '[post_date]' );
		}

		if ( $image[0] ) {
			$imageplaceholder = '<div class="card__image"></div>';
		}
		
		$return = '<div class="card card--featured-image ' . $posttype . '" id="' . $block_id . '">';
		$return .= $imageplaceholder;
		$return .= '<div class="card__content">';
		$return .= '<h2 id="' . $title_id . '" class="card__title"><a href="' . get_permalink( $post_ID ) . '"><span>';
		$return .= od_wbvb_custom_post_title( $section_title ) . '</span><span class="btn btn--arrow"></a></h2>';
		$return .= $section_meta;
		$return .= '<p>';
		$return .= $section_text;
		$return .= '</p>';
		$return .= '</div>'; // .card__content
		$return .= '</div>'; // .card
	
	    return $return;
	
	}

endif;

//========================================================================================================

/**
 * Adds extra CSS to header for background images in cards
 *
 * @since 4.1.3
 *
 */
function ictu_gctheme_card_append_header_css() {

    global $post;

	wp_enqueue_style(
		ID_BLOGBERICHTEN_CSS,
		WBVB_THEMEFOLDER . '/css/blogberichten.css?v=' . CHILD_THEME_VERSION
	);

    $header_css				= '';
    $acfid					= get_the_id();
    $gerelateerdecontent	= get_field('gerelateerde_content_toevoegen', $acfid);

    if ($gerelateerdecontent == 'ja') {

        $related_items = get_field('content_block_items');

        // loop through the rows of data
        foreach ($related_items as $post):

            setup_postdata($post);

            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');

            if ($image[0]) {
                $header_css .= "#related_" . $post->ID . " .card__image { ";
                $header_css .= "background-image: url('" . $image[0] . "'); ";
                $header_css .= "} ";
            }


        endforeach;

        wp_reset_postdata();

    }

    if ($header_css) {
        wp_add_inline_style(ID_BLOGBERICHTEN_CSS, $header_css);
    }

}

//========================================================================================================

//========================================================================================================

/**
 * Add ACF field definitions for 'overzichtspagina_inleiding'
 */

if ( function_exists( 'acf_add_local_field_group' ) ) :

	// this means the ACF plugin is active and we can add new field definitions

	//--------------------------------------------------------------------------------------------
	// instellingen voor paginatemplate page_template_overzichtspagina
	acf_add_local_field_group(array(
		'key' => 'group_5e18684eebb2a',
		'title' => 'Items op overzichtspagina',
		'fields' => array(
			array(
				'key' => 'field_5e18970ac3dd0',
				'label' => 'Inleiding',
				'name' => 'overzichtspagina_inleiding',
				'type' => 'textarea',
				'instructions' => 'deze tekst wordt getoond onder de titel in het groene vlak',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_5e1868f51b16a',
				'label' => 'Wil je alle items (i.e. tips, vaardigheden) tonen op deze pagina?',
				'name' => 'overzichtspagina_showall_or_select',
				'type' => 'radio',
				'instructions' => '<a href="/wp-admin/themes.php?page=instellingen">Via de instellingen-pagina</a> kun je deze pagina als een overzichtspagina aanwijzen voor een contenttype. Op basis van deze keuze weet de pagina welke items getoond moeten worden.<br>Als deze pagina niet als de overzichtspagina voor een contenttype is ingesteld worden alle vaardigheden getoond.<br>De instellingen-pagina vind je via:<br>[admin] > Weergave > Theme-instelling.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'showall' => 'Ja, toon alle items',
					'showsome' => 'Nee, laat mij de items selecteren',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'showall',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5e1869949274f',
				'label' => 'Kies items',
				'name' => 'overzichtspagina_kies_items',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5e1868f51b16a',
							'operator' => '==',
							'value' => 'showsome',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => GC_ALLOWED,
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page_template_overzichtspagina.php',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));


		
endif;

//========================================================================================================
