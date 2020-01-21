<?php

///
// * Gebruiker Centraal - includes/components/cards.php
// * ----------------------------------------------------------------------------------
// * Functies voor het tonen van cards
// * ----------------------------------------------------------------------------------
// * @package gebruiker-centraal
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @version 4.1.3
// * @since   4.1.3
// * @desc.   Moved card backend functions and page_template_overzichtspagina from inlusie plugin to theme.
// * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

if ( !function_exists( 'ictu_gc_general_item_card' ) ) :


	/**
	 * Display a set of links to related content or a set of links to external sites
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 * Can return 2 type of blocks:
	 * 1. block with items for 'gerelateerde_content_toevoegen'. This is a block with content from the local site.
	 * 2. block with items for 'handige_links_toevoegen'. This is a block with links to externas sites.
	 *
	 * @since 4.1.3
	 *
	 * @param array $args Argument for what to do: echo or return links or return HTML string.
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 * @return string $return HTML string with related links (if $args['echo'] => FALSE).
	 */

    function ictu_gc_general_item_card( $vaardigheid = [] ) {

        if (is_object($vaardigheid)) {
            $post_ID = $vaardigheid->ID;
        }
        elseif ($doelgroep > 0) {
            $post_ID = $vaardigheid;
        }
        else {
            return;
        }

        $section_title = get_the_title($post_ID);
        $section_text = get_the_excerpt($post_ID);
        $section_link = get_sub_field('home_template_teaser_link');
        $title_id = sanitize_title($section_title);

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

if ( !function_exists( 'ictu_gc_doelgroep_card' ) ) :


	/**
	 * Display a set of links to related content or a set of links to external sites
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 * Can return 2 type of blocks:
	 * 1. block with items for 'gerelateerde_content_toevoegen'. This is a block with content from the local site.
	 * 2. block with items for 'handige_links_toevoegen'. This is a block with links to externas sites.
	 *
	 * @since 4.1.3
	 *
	 * @param array $args Argument for what to do: echo or return links or return HTML string.
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 * @return string $return HTML string with related links (if $args['echo'] => FALSE).
	 */

	function ictu_gc_doelgroep_card( $doelgroep, $citaat) {
	
	    if (is_object($citaat) && 'WP_Post' == get_class($citaat)) {
	        $citaat_post = get_post($citaat->ID);
	        $citaat_auteur = sanitize_text_field(get_field('citaat_auteur', $citaat->ID));
	        $content = '&ldquo;' . $citaat_post->post_content . '&rdquo;';
	    }
	    else {
	        if ($citaat[0]->post_content) {
	            $content = '&ldquo;' . $citaat[0]->post_content . '&rdquo;';
	            $citaat_auteur = sanitize_text_field(get_field('citaat_auteur', $citaat[0]->ID));
	        }
	        else {
	            return '';
	        }
	    }
	
	    $content = apply_filters('the_content', $content);
	
	    if (is_object($doelgroep)) {
	        $doelgroep_ID = $doelgroep->ID;
	    }
	    elseif ($doelgroep > 0) {
	        $doelgroep_ID = $doelgroep;
	    }
	    else {
	        return;
	    }
	
	    $posttype = get_post_type($doelgroep_ID);
	    $title_id = sanitize_title('title-' . $posttype . '-' . $doelgroep_ID);
	    $section_id = sanitize_title('section-' . $posttype . '-' . $doelgroep_ID);
	    $doelgroeppoppetje = 'poppetje-1';
	    $cardtitle = esc_html(get_the_title($doelgroep->ID));
	
	    // wat extra afbreekmogelijkheden toevoegen in de titel
	    $cardtitle = str_replace("laaggeletterden", "laag&shy;geletterden", $cardtitle);
	    $cardtitle = str_replace("gebruikssituaties", "gebruiks&shy;situaties", $cardtitle);
	
	
	    if (get_field('doelgroep_avatar', $doelgroep_ID)) {
	        $doelgroeppoppetje = get_field('doelgroep_avatar', $doelgroep_ID);
	    }
	
	    $return = '<section aria-labelledby="' . $title_id . '" class="card card--doelgroep ' . $doelgroeppoppetje . '" id="' . $section_id . '">';
	    $return .= '<div class="card__image"></div>';
	    $return .= '<div class="card__content">';
	    $return .=
	      '<h2 class="card__title" id="' . $title_id . '">' .
	      '<a href="' . get_permalink($doelgroep->ID) . '">' .
	      '<span>' . _x('Ontwerpen voor', 'Home section doelgroep', 'ictu-gc-posttypes-inclusie') . ' </span>' .
	      '<span>' . $cardtitle . '</span>' .
	      '<span class="btn btn--arrow"></span>' .
	      '</a></h2>';
	    $return .= '<div class="tegeltje">' . $content . '<p><strong>' . $citaat_auteur . '</strong></p></div>';
	    $return .= '</div>';
	    $return .= '</section>';
	
	    return $return;
	
	}

endif;

//========================================================================================================

/**
 * Register frontend styles
 */
function ictu_gc_append_header_css_theme() {

    global $post;

	wp_enqueue_style(
		ID_BLOGBERICHTEN_CSS,
		WBVB_THEMEFOLDER . '/blogberichten.css?v=' . CHILD_THEME_VERSION
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
 * Add ACF field definitions for 
 *
 * This function either returns an array with links, or returns an HTML string, or echoes HTML string
 *
 * @since	  4.1.3
 * @global string ICTU_GC_CPT_DOELGROEP Custom Post Type for doelgroep ('doelgroep', see functions.php). 
 * @global string ICTU_GC_CPT_STAP Custom Post Type for stap ('stap', see functions.php). 
 * @global string GC_BEELDBANK_BEELD_CPT Custom Post Type for beeld ('beeld', see functions.php). 
 * @global string GC_BEELDBANK_BRIEF_CPT Custom Post Type for brief ('brief', see functions.php). 
 *
 * @param array $args Argument for what to do: echo or return links or return HTML string.
 * @return array $menuarray Array with links and link text ( if $args['getmenu'] => TRUE ).
 * @return string $return HTML string with related links ( if $args['echo'] => FALSE ).
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
