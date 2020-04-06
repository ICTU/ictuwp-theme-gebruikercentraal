<?php

///
// Gebruiker Centraal - spotlight.php
// ----------------------------------------------------------------------------------
// Functies voor het tonen van 1 of 2 spotlight-blokken
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

if ( !function_exists( 'ictu_gctheme_frontend_general_get_spotlight' ) ) :


	/**
	 * Display 1 or 2 blocks with:
	 * - a title
	 * - a short description
	 * - an image
	 * - 1-3 links
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 *
	 * @since 4.3.7
	 *
	 * @param array $args Argument for what to do: echo or return links or return HTML string.
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 * @return string $return HTML string with related links (if $args['echo'] => FALSE).
	 */
 	
    function ictu_gctheme_frontend_general_get_spotlight( $args = [] ) {

        global $post;

        // defaults
		$menuarray  = array();
		$return     = '';
		$defaults   = array(
	          'ID' => 0,
	          'titletag' => 'h2',
	          'getmenu' => FALSE,
	          'echo' => TRUE,
	        );

        // Parse incoming $args into an array and merge it with $defaults
        $args		= wp_parse_args( $args, $defaults );


        if ( function_exists( 'get_field' ) ) {


	        $handigelinks = get_field( 'spotlight_blokken', $post->ID );

	        if( $handigelinks ):

	            // count the items
				$columncounter = 'l-item-count-2';
	            $countcount     = count( $handigelinks );

	            if ( $countcount < 2  ) {
		            $columncounter = 'l-item-count-1';
	            }


	            $return = '<div class="section section--spotlight">';
	            $return .= '<div class="l-spotlight-wrapper ' . $columncounter . '">';

	            while ( have_rows( 'spotlight_blokken' ) ): the_row();

		            $spotlight_titel    = get_sub_field( 'spotlight_titel' );
		            $spotlight__image   = get_sub_field( 'spotlight__image' );
		            $spotlight__content = get_sub_field( 'spotlight__content' );


		            $return .= '<div class="spotlight">';
					if ( $spotlight__image ) {

						$url    = $spotlight__image['url'];
						$alt    = $spotlight__image['alt'];
						$title  = $spotlight__image['title'];
						$size   = 'large';
						$thumb  = $spotlight__image['sizes'][ $size ];
//						$width  = $spotlight__image['sizes'][ $size . '-width' ];
//						$height = $spotlight__image['sizes'][ $size . '-height' ];

						if ( ! $alt ) {
							if ( $title ) {
								$alt = $title;
							}
						}

						$return .= '<figure class="spotlight__image" ><img src = "' . $thumb . '" alt = "'  . $alt . '" ></figure >';
					}

		            $return .= '<div class="spotlight__content">';
		            $return .= '<' . $args['titletag'] . '>' . $spotlight_titel . '</' . $args['titletag'] . '>';
		            $return .= '<p>';
		            $return .= $spotlight__content;
		            $return .= '</p>';

		            if( have_rows('spotlight__links') ):
			            while ( have_rows( 'spotlight__links' ) ): the_row();

				            $link = get_sub_field('spotlight__link');
				            if( $link ):
					            $link_url       = $link['url'];
					            $link_title     = $link['title'];
					            $link_target    = $link['target'] ? ' target="' . $link['target'] . '"' : '';
					            $link_class   = get_sub_field( 'spotlight__link_class' );
					            $return .= '<a href="' . $link_url . '" class="btn btn--' . esc_attr( $link_class ) . '"' . esc_attr( $link_target ) . '">' . $link_title . '</a>';
				            endif;

			            endwhile;
		            endif; //if( get_sub_field('spotlight__links') ):

		            $return .= '</div>'; // .spotlight__content
		            $return .= '</div>'; // .spotlight

	            endwhile;

		        $return .= '</div>'; // .section section--spotlight
		        $return .= '</div>'; // .l-spotlight-wrapper

	        endif;

        } // if ( function_exists( 'get_field' ) )
        else {
            $return = 'Activeer ACF plugin';
        }

		if ( $args['echo'] ) {
            echo $return;
        }
        else {
            return $return;
        }

    }

endif;

//========================================================================================================

/**
 * Add ACF field definitions for spotlight component
 *
 * This function either returns an array with links, or returns an HTML string, or echoes HTML string
 *
 */

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5e8af08f196b2',
		'title' => 'Spotlight component',
		'fields' => array(
			array(
				'key' => 'field_5e8af1d837142',
				'label' => 'Spotlight-blokken',
				'name' => 'spotlight_blokken',
				'type' => 'repeater',
				'instructions' => 'Hier kun je 1 of 2 spotlight-blokken toevoegen.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_5e8af09948ad7',
				'min' => 1,
				'max' => 2,
				'layout' => 'row',
				'button_label' => 'Blok toevoegen',
				'sub_fields' => array(
					array(
						'key' => 'field_5e8af09948ad7',
						'label' => 'Titel',
						'name' => 'spotlight_titel',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
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
						'key' => 'field_5e8af0f604b78',
						'label' => 'Afbeelding',
						'name' => 'spotlight__image',
						'type' => 'image',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5e8af1186bba9',
						'label' => 'Korte tekst',
						'name' => 'spotlight__content',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 1,
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
						'key' => 'field_5e8af23037143',
						'label' => 'Links',
						'name' => 'spotlight__links',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => 'field_5e8af29a37144',
						'min' => 0,
						'max' => 3,
						'layout' => 'row',
						'button_label' => 'Link toevoegen',
						'sub_fields' => array(
							array(
								'key' => 'field_5e8af29a37144',
								'label' => 'Link',
								'name' => 'spotlight__link',
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
							array(
								'key' => 'field_5e8af2e445b46',
								'label' => 'CSS-class',
								'name' => 'spotlight__link_class',
								'type' => 'radio',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'choices' => array(
									'primary' => 'primary',
									'readmore' => 'readmore',
								),
								'allow_null' => 0,
								'other_choice' => 0,
								'default_value' => 'primary',
								'layout' => 'vertical',
								'return_format' => 'value',
								'save_other_choice' => 0,
							),
						),
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

endif;

//========================================================================================================
