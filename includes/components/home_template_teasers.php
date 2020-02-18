<?php

///
// * Gebruiker Centraal - includes/components/home_template_teasers.php
// * ----------------------------------------------------------------------------------
// * Component #home_template_teasers on homepage for inclusie & beeldbank
// * ----------------------------------------------------------------------------------
// * @package gebruiker-centraal
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @since   4.1.4
// * @version 4.1.5
// * @desc.   Functionality for home -> stappen moved to theme.
// * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

if ( !function_exists( 'ictu_gctheme_home_template_teasers' ) ) :


	/**
	 * Display a set of links to related content or a set of links to external sites
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 * Can return 2 type of blocks:
	 * 1. block with items for 'gerelateerde_content_toevoegen'. This is a block with content from the local site.
	 * 2. block with items for 'handige_links_toevoegen'. This is a block with links to externas sites.
	 *
	 * @since 4.1.4
	 *
	 * @param object $post The post object
	 *
	 */

	function ictu_gctheme_home_template_teasers( $post = [] ) {
	
	    global $post;
	
	    if (function_exists('get_field')) {
	
	        $home_teasers = get_field('home_template_teasers', $post->ID);
	
	        if (have_rows('home_template_teasers')):
	
	            echo '<div id="home_template_teasers">';
	
				$columncounter = 'grid--col-2';
				$countcount = count( $home_teasers );
			
				if ( $countcount < 2  ) {
					$columncounter = 'grid--col-1';
				}
				elseif ( $countcount === 4 ) {
					$columncounter = 'grid--col-2';
				}
				elseif ( $countcount > 2  ) {
					$columncounter = 'grid--col-3';
				}
	
	
	            echo '<div class="grid ' . $columncounter . '">';
	
	
	            // loop through the rows of data
	            while (have_rows('home_template_teasers')) : the_row();
	
	                $section_title = get_sub_field('home_template_teaser_title');
	                $section_text = get_sub_field('home_template_teaser_text');
	                $section_link = get_sub_field('home_template_teaser_link');
	                $title_id = sanitize_title($section_title);
	
	                echo '<section aria-labelledby="' . $title_id . '" class="text-block">';
	                echo '<h2 id="' . $title_id . '" class="text-block__title">' . $section_title . '</h2>';
	                echo $section_text;

	                if ($section_link) {
	                    echo '<a class="btn btn--primary" href="' . $section_link['url'] . '">' . $section_link['title'] . '</a>';
	                }
	                echo '</section>';
	
	            endwhile;
	            echo '</div>';
	            echo '</div>';
	
	        endif;
	
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
	// instellingen voor paginatemplate page_template_overzichtspagina

	acf_add_local_field_group(array(
		'key' => 'group_5c91ff4e9f37c',
		'title' => '02 - Homepage template: teasers',
		'fields' => array(
			array(
				'key' => 'field_5c91ff4eb3ace',
				'label' => 'Doelgroepen',
				'name' => 'home_template_teasers',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_5c91ff4ebb071',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_5c91ff4ebb071',
						'label' => 'Titel',
						'name' => 'home_template_teaser_title',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5c91ff4ebb07a',
						'label' => 'Korte beschrijving',
						'name' => 'home_template_teaser_text',
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
						'toolbar' => 'basic',
						'media_upload' => 0,
						'delay' => 0,
					),
					array(
						'key' => 'field_5c92023852c87',
						'label' => 'Link',
						'name' => 'home_template_teaser_link',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
				),
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
