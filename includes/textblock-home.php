<?php

///
// Gebruiker Centraal - textblock-home.php
// ----------------------------------------------------------------------------------
// Functies voor het tonen van 1-2 tekstblokken op een homepage
//
// Deze functies worden gebruikt in het GC theme en in plugins.
// - ictuwp-plugin-beeldbank
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.7
// @version 4.3.7
// @desc.   Spotlight-component toegevoegd; tekstblok-component voor home toegevoegd.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///


//========================================================================================================

if ( ! function_exists( 'ictu_gctheme_frontend_general_get_textblocks' ) ) :


	/**
	 * Display 1 or 2 blocks with:
	 * - a title
	 * - a short description
	 * - an image
	 * - 1-3 links
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 *
	 * @param array $args Argument for what to do: echo or return links or return HTML string.
	 *
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 * @return string $return HTML string with related links (if $args['echo'] => FALSE).
	 * @since 4.3.7
	 *
	 */

	function ictu_gctheme_frontend_general_get_textblocks( $args = [] ) {

		global $post;

		// defaults
		$menuarray = array();
		$return    = '';
		$defaults  = array(
			'ID'       => 0,
			'titletag' => 'h2',
			'getmenu'  => false,
			'echo'     => true,
		);

		// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );

		if ( function_exists( 'get_field' ) ) {

			$textblocks_active = get_field( 'textblocks_active', $post->ID );

			if ( 'ja' === $textblocks_active ):

				// count the items
				$countcount      = count( get_field( 'textblocks', $post->ID ) );
				$textblock_class = '';

				// Add class for color if value not is none
				if ( ! ( get_field( 'textblock_class', $post->ID ) === 'none' ) ) {
					$textblock_class = get_field( 'textblock_class', $post->ID );
				}

				$return = '<section class="section section--text-blocks ' . $textblock_class . ' l-item-count-' . $countcount . '">';
				$return .= '<div class="l-section-content">';

				while ( have_rows( 'textblocks' ) ): the_row();

					$textblock_title   = get_sub_field( 'textblock_title' );
					$textblock_content = get_sub_field( 'textblock_content' );
					$title_id          = sanitize_title( $textblock_title . '-title' );

					$return .= '<section aria-labelledby="' . $title_id . '" class="text-block">';
					$return .= '<' . $args['titletag'] . ' class="text-block__title">' . $textblock_title . '</' . $args['titletag'] . '>';
					$return .= $textblock_content;

					if ( have_rows( 'optional_links' ) ):
						while ( have_rows( 'optional_links' ) ): the_row();

							$link = get_sub_field( 'optional_link' );
							if ( $link ):
								$link_url    = $link['url'];
								$link_title  = $link['title'];
								$link_target = $link['target'] ? ' target="' . $link['target'] . '"' : '';
								$link_class  = get_sub_field( 'optional_link_class' );
								$return      .= '<a href="' . $link_url . '" class="btn btn--' . esc_attr( $link_class ) . '"' . esc_attr( $link_target ) . '">' . $link_title . '</a>';
							endif;

						endwhile;
					endif; //if( get_sub_field('spotlight__links') ):

					$return .= '</section>'; // .text-block

				endwhile;

				$return .= '</div>'; // .l-section-content
				$return .= '</section>'; // .text-block

			endif;

		} // if ( function_exists( 'get_field' ) )
		else {
			$return = 'Activeer ACF plugin';
		}

		if ( $args['echo'] ) {
			echo $return;
		} else {
			return $return;
		}

	}

endif;

//========================================================================================================

/**
 * Add ACF field definitions for textblock component
 *
 * This function either returns an array with links, or returns an HTML string, or echoes HTML string
 *
 */
if ( function_exists( 'acf_add_local_field_group' ) ):

	acf_add_local_field_group( array(
		'key'                   => 'group_5e8b140493a09',
		'title'                 => '03 - tekstblokken voor home',
		'fields'                => array(
			array(
				'key'               => 'field_5e96d3181de91',
				'label'             => 'Tekstblokken toevoegen?',
				'name'              => 'textblocks_active',
				'type'              => 'radio',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'ja'  => 'Ja',
					'nee' => 'Nee',
				),
				'allow_null'        => 0,
				'other_choice'      => 0,
				'default_value'     => 'nee',
				'layout'            => 'vertical',
				'return_format'     => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key'               => 'field_5e8b1a49ba053',
				'label'             => 'Tekstblok: styling',
				'name'              => 'textblock_class',
				'type'              => 'radio',
				'instructions'      => 'Welke styling wil je voor de tekstblokken?
De kleuren voor \'primary\' en \'secondary\' zijn afhankelijk van welke subsite je bewerkt.',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5e96d3181de91',
							'operator' => '==',
							'value'    => 'ja',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'none'                          => 'Standaard',
					'l-text-centered'               => 'Gecentreerd',
					'text-block--bg l-bg-white'     => 'Wit',
					'text-block--bg l-bg-primary'   => 'Primary',
					'text-block--bg l-bg-secondary' => 'Secondary',
				),
				'allow_null'        => 0,
				'other_choice'      => 0,
				'default_value'     => '',
				'layout'            => 'vertical',
				'return_format'     => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key'               => 'field_5e8b1404ab7f0',
				'label'             => 'Tekstblokken',
				'name'              => 'textblocks',
				'type'              => 'repeater',
				'instructions'      => 'Hier kun je 1-3 teksblokken toevoegen.',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_5e96d3181de91',
							'operator' => '==',
							'value'    => 'ja',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'collapsed'         => 'field_5e8af09948ad7',
				'min'               => 1,
				'max'               => 3,
				'layout'            => 'row',
				'button_label'      => 'Blok toevoegen',
				'sub_fields'        => array(
					array(
						'key'               => 'field_5e8b1404afb52',
						'label'             => 'Titel',
						'name'              => 'textblock_title',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5e8b1404afb60',
						'label'             => 'Korte tekst',
						'name'              => 'textblock_content',
						'type'              => 'wysiwyg',
						'instructions'      => '',
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'basic',
						'media_upload'      => 0,
						'delay'             => 0,
					),
					array(
						'key'               => 'field_5e8b1404afb66',
						'label'             => 'Links',
						'name'              => 'optional_links',
						'type'              => 'repeater',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'collapsed'         => 'field_5e8af29a37144',
						'min'               => 0,
						'max'               => 3,
						'layout'            => 'row',
						'button_label'      => 'Link toevoegen',
						'sub_fields'        => array(
							array(
								'key'               => 'field_5e8b1404b98d1',
								'label'             => 'Link',
								'name'              => 'optional_link',
								'type'              => 'link',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'return_format'     => 'array',
							),
							array(
								'key'               => 'field_5e8b1404b98e5',
								'label'             => 'CSS-class',
								'name'              => 'optional_link_class',
								'type'              => 'radio',
								'instructions'      => '',
								'required'          => 1,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'choices'           => array(
									'primary'  => 'primary',
									'readmore' => 'readmore',
								),
								'allow_null'        => 0,
								'other_choice'      => 0,
								'default_value'     => 'primary',
								'layout'            => 'vertical',
								'return_format'     => 'value',
								'save_other_choice' => 0,
							),
						),
					),
				),
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page_home.php',
				),
			),
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	) );

endif;

//========================================================================================================
