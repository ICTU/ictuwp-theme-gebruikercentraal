<?php

///
// * Gebruiker Centraal - includes/components/home_template_stappen.php
// * ----------------------------------------------------------------------------------
// * Component #home_template_teasers on homepage for inclusie & beeldbank
// * ----------------------------------------------------------------------------------
// * @package gebruiker-centraal
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @since   4.1.5
// * @version 4.1.5
// * @desc.   Functionality for home -> stappen moved to theme.
// * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

if ( !function_exists( 'ictu_gctheme_home_template_stappen' ) ) :


	/**
	 * Display a set of links to related content or a set of links to external sites
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 * Can return 2 type of blocks:
	 * 1. block with items for 'gerelateerde_content_toevoegen'. This is a block with content from the local site.
	 * 2. block with items for 'handige_links_toevoegen'. This is a block with links to externas sites.
	 *
	 * @since 4.1.5
	 *
	 * @param object $post The post object
	 *
	 */

	function ictu_gctheme_home_template_stappen( $post = [], $bgimage = '' ) {

		global $post;
	
		if ( ! $bgimage ) {
			$bgimage = ICTU_GC_BEELDBANK_IMAGES . 'stappenplan-bg-fullscreen.svg';
		}
		
	    if (function_exists('get_field')) {
			
			$home_inleiding		= get_field('home_template_inleiding', $post->ID);
	        $home_stappen 		= get_field('home_template_stappen', $post->ID);
	        $poster				= get_field('home_template_poster', $post->ID);
	        $poster_linktekst 	= get_field('home_template_poster_linktekst', $post->ID);
	
	        echo '<div class="region region--intro">' .
	          '<div id="entry__intro">' .
	          '<h1 class="entry-title">' . get_the_title() . '</h1>';
	
	
	        if ($home_inleiding) {
	            echo $home_inleiding;
	        }
	
	        if ($poster && $poster_linktekst) {
	            echo '<a href="' . $poster['url'] . '" class="btn btn--download">' . $poster_linktekst . '</a>';
	        }
	
	        echo '</div>'; // Einde Intro
	
	        if ($home_stappen):
	
	            $section_title 	= _x('Stappen', 'titel op home-pagina', 'ictu-gc-posttypes-inclusie');
	            $title_id 		= sanitize_title($section_title . '-' . $post->ID);
	            $stepcounter 	= 0;
	
	            echo '<div aria-labelledby="' . $title_id . '" class="stepchart">';
	            echo '<h2 id="' . $title_id . '" class="visuallyhidden">' . $section_title . '</h2>';
	
	            echo '<div class="stepchart__bg">' .
	              '<img src="' . $bgimage . '" alt="">' .
	              '</div>';
	
	            echo '<ol class="stepchart__items" role="tablist">';
	
	            foreach ($home_stappen as $stap):
	
	                $stepcounter++;
	
	                if (get_field('stap_verkorte_titel', $stap->ID)) {
	                    $titel = get_field('stap_verkorte_titel', $stap->ID);
	                }
	                else {
	                    $titel = get_the_title($stap->ID);
	                }
	
	                $class = 'deel';
	                if (get_field('stap_icon', $stap->ID)) {
	                    $class = get_field('stap_icon', $stap->ID);
	                }
	
	
	                if (get_field('stap_inleiding', $stap->ID)) {
	                    $inleiding	= get_field('stap_inleiding', $stap->ID);
	                }
	                else {
	                    $stap_post	= get_post($stap->ID);
	                    $content 	= $stap_post->post_content;
	                    $inleiding 	= apply_filters('the_content', $content);
	                }
	
	                $xtraclass 		= ' hidden';
	                $title_id 		= sanitize_title(get_the_title($stap->ID) . '-' . $stepcounter);
	                $steptitle 		= sprintf(_x('%s. %s', 'Label stappen', 'ictu-gc-posttypes-inclusie'), $stepcounter, $titel);
	                $readmore 		= sprintf(_x('%s <span class="visuallyhidden">over %s</span>', 'home lees meer', 'ictu-gc-posttypes-inclusie'), _x('Lees meer', 'home lees meer', 'ictu-gc-posttypes-inclusie'), get_the_title($stap->ID));
	
	
	                echo '<li class="stepchart__item">';

	                // SVG sprites a
	                echo '<button class="stepchart__button btn btn--stepchart ' . $class . '" aria-selected="false" role="tab">' .
                        '<svg class="btn__icon icon icon--stepchart" focusable="false">' .
                          '<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="'. get_stylesheet_directory_uri()  .'/images/svg/stepchart/defs/svg/sprite.defs.svg#'. $class. '"></use> '.
                      '</svg> '.
	                  '<span class="btn__text">' . $steptitle . '</span>' .
	                  '</button>';
	
	                echo '<section class="stepchart__description" aria-hidden="true" aria-labelledby="' . $title_id . '" role="tabpanel">' .
	                  '<button type="button" class="btn btn--close" data-trigger="action-popover-close">Sluit</button>' .
	                  '<h3 id="' . $title_id . '" class="stepchart__title">' . get_the_title($stap->ID) . '</h3>' .
	                  '<div class="description">' . $inleiding . '</div>' .
	                  '<a href="' . get_permalink($stap->ID) . '" class="cta">' . $readmore . '</a>' .
	                  '</section>';
	
	                echo '</li>';
	
	            endforeach;
	
	            echo '</ol>';
	            echo '</div>';
	
	        endif;
	
	
	        echo '</div>'; // region--intro, lekker herbruikbaar!
	
	        echo '</div>'; // Section content-top
	
	
	    }	
	}


endif;

//========================================================================================================

/**
 * Add ACF field definitions for 'home_template_teasers'
 *
 */

if ( function_exists( 'acf_add_local_field_group' ) ) :

	// this means the ACF plugin is active and we can add new field definitions

	//--------------------------------------------------------------------------------------------
	// velden voor home template
	acf_add_local_field_group(array(
		'key' => 'group_5c90e063ca578',
		'title' => '01 - Homepage template: inleiding, stappen',
		'fields' => array(
			array(
				'key' => 'field_5c90fd5fe0a58',
				'label' => 'Inleiding op homepage',
				'name' => 'home_template_inleiding',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 0,
			),
			array(
				'key' => 'field_5c90e0739fa4b',
				'label' => 'Stappen',
				'name' => 'home_template_stappen',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'stap',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'taxonomy',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'object',
			),
			array(
				'key' => 'field_5c90e096cca0a',
				'label' => 'Doelgroepen',
				'name' => 'home_template_doelgroepen',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_5c9104bff7ade',
						'label' => 'Kies doelgroep',
						'name' => 'home_template_doelgroepen_doelgroep',
						'type' => 'post_object',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => array(
							0 => ICTU_GC_CPT_DOELGROEP,
						),
						'taxonomy' => '',
						'allow_null' => 1,
						'multiple' => 0,
						'return_format' => 'object',
						'ui' => 1,
					),
					array(
						'key' => 'field_5c910507f7adf',
						'label' => 'Kies citaat',
						'name' => 'home_template_doelgroepen_citaat',
						'type' => 'post_object',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => array(
							0 => 'citaat',
						),
						'taxonomy' => '',
						'allow_null' => 1,
						'multiple' => 0,
						'return_format' => 'object',
						'ui' => 1,
					),
				),
			),
			array(
				'key' => 'field_5ccfec39e2de3',
				'label' => 'home_template_poster',
				'name' => 'home_template_poster',
				'type' => 'file',
				'instructions' => 'Upload de PDF voor de poster',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5ccfeccee8a61',
				'label' => 'home_template_poster_linktekst',
				'name' => 'home_template_poster_linktekst',
				'type' => 'text',
				'instructions' => 'Dit is de tekst op de downloadknop als je een PDF met de poster hebt toegevoegd.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Download de poster',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'home-inclusie.php',
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
