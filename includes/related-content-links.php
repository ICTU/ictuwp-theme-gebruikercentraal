<?php

///
// * Gebruiker Centraal - related-content-links.php
// * ----------------------------------------------------------------------------------
// * Functies voor het tonen van gerelateerde content en gerelateerde (externe) links.
// *
// * Deze functies worden gebruikt in het GC theme en in plugins.
// * - ictu-gc-posttypes-brieven-beelden
// * - ictu-gc-posttypes-inclusie
// * ----------------------------------------------------------------------------------
// * @package gebruiker-centraal
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @version 4.1.3
// * @since   4.1.1
// * @desc.   Copied styling for .cards and various subsets from inclusie to gc-theme.
// * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

if ( !function_exists( 'ictu_gctheme_frontend_general_get_related_content' ) ) :


	/**
	 * Display a set of links to related content or a set of links to external sites
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 * Can return 2 type of blocks:
	 * 1. block with items for 'gerelateerde_content_toevoegen'. This is a block with content from the local site.
	 * 2. block with items for 'handige_links_toevoegen'. This is a block with links to externas sites.
	 *
	 * @since 4.1.1
	 *
	 * @param array $args Argument for what to do: echo or return links or return HTML string.
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 * @return string $return HTML string with related links (if $args['echo'] => FALSE).
	 */
 	
    function ictu_gctheme_frontend_general_get_related_content( $args = [] ) {

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

			// interne links
            $gerelateerdecontent = get_field( 'gerelateerde_content_toevoegen', get_the_id() );

            if ( 'ja' === $gerelateerdecontent ) {

                $section_title	= get_field( 'content_block_title', $post->ID );
                $title_id 		= sanitize_title( $section_title . '-title' );
                $related_items	= get_field( 'content_block_items' );

                if ( $args['getmenu'] ) {
	                // return only links ( ID + name )
                    $menuarray[$title_id] = $section_title;
                }
                else {

					$columncounter  = 'col-2';
					$countcount     = count( $related_items );
				
					if ( $countcount < 2  ) {
						$columncounter = 'col-1';
					}
					elseif ( $countcount === 4 ) {
						$columncounter = 'col-2';
					}
					elseif ( $countcount > 2  ) {
						$columncounter = 'col-3';
					}

//$columncounter = 'col-2';

                    
					$return .= '<section aria-labelledby="' . $title_id . '" class="section section--related section--related-content ' . $columncounter . '">';

                    $return .= '<div class="l-section-top">';
                    $return .= '<h2 id="' . $title_id . '" class="section__title">' . $section_title . '</h2>';
                    $return .= '</div>'; // class="wrap";

                    $return .= '<div class="l-section-content">';
                    $return .= '<div class="grid grid--' . $columncounter . '">';

                }

                // loop through the rows of data
                foreach ( $related_items as $post ):

					setup_postdata( $post );
					
					$theid          = $post->ID;
					$section_title	= get_the_title( $theid );
					$section_text   = get_the_excerpt( $theid );
					$section_link   = get_sub_field( 'home_template_teaser_link' );
					$title_id       = sanitize_title( $section_title );
					$block_id       = sanitize_title( 'related_' . $theid );

                    if ( $args['getmenu'] ) {
                        $menuarray[$title_id] = $section_title;
                    }
                    else {

						$imageplaceholder = '';
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
						
						if ( $image[0] ) {
							$imageplaceholder = '<div class="card__image"></div>';
						}
						
						$return .= '<div class="card card--featured-image" id="' . $block_id . '">';
						$return .= $imageplaceholder;
						$return .= '<div class="card__content">';
						$return .= '<h3 id="' . $title_id . '" class="card__title"><a class="arrow-link" href="' . get_permalink( $theid ) . '">';
						$return .= '<span class="arrow-link__text">'. $section_title . '</span><span class="arrow-link__icon"></span></a></h3>';
						$return .= '<p>';
						$return .= $section_text;
						$return .= '</p>';
						$return .= '</div>'; // .card__content
						$return .= '</div>'; // .card

                    }

                endforeach;

                wp_reset_postdata();

                if ( !$args['getmenu'] ) {

                    $return .= '</div></div>'; // class="grid ' . $columncounter . '">';
                    $return .= '</section>';

                }

            }
            else {
				// nothing
            }

			// externe links
            $handigelinks = get_field( 'handige_links_toevoegen', $post->ID );

            if ( 'ja' === $handigelinks ) {

                $section_title  = get_field( 'links_block_title', $post->ID );
                $title_id       = sanitize_title( $section_title . '-title' );

                if ( $args['getmenu'] ) {
                    $menuarray[$title_id] = $section_title;
                }
                else {
					$return .= '<section  aria-labelledby="' . $title_id . '" class="section section--related section--related-links">';
                    $return .= '<div class="l-section-top">';
					$return .= '<h2 id="' . $title_id . '" class="section__title">' . $section_title . '</h2>';
					// If needed intro can be added here
					$return .= '</div>'; // End section top


					$return .= '<div class="l-section-content">'; // Start section content

                    $links_block_items = get_field( 'links_block_items' );

                    if ( $links_block_items ):

                        $return .= '<ul class="item-list">';

						while ( have_rows( 'links_block_items' ) ): the_row();
							
							$item_url           = get_sub_field( 'links_block_item_url' );
							$item_linktext      = get_sub_field( 'links_block_item_linktext' );
							$item_description   = get_sub_field( 'links_block_item_description' );

                            $return .= '<li class="item-list__item">';
                            $return .= '<a href="' . esc_url( $item_url ) . '" class="link link--linklist">';
                            $return .= sanitize_text_field( $item_linktext ) . '</a>';

                            if ( $item_description ) {
                                $return .= '<p class="item-list__description">' . sanitize_text_field( $item_description ) . '</p>';
                            }

                            $return .= '</li>';

                        endwhile;

                        $return .= '</ul>';

                    endif;

                    $return .= '</div>'; //  class="l-section-contentcontent";
                    $return .= '</section>'; // .section--related-links

                }

            }
            else {
				// nothing
            }
        } // if ( function_exists( 'get_field' ) )
        else {
            $return = 'Activeer ACF plugin';
        }

        if ( $args['getmenu'] ) {
            return $menuarray;
        }
        elseif ( $args['echo'] ) {
            echo $return;
        }
        else {
            return $return;
        }

    }

endif;

//========================================================================================================

/**
 * Add ACF field definitions for 
 *
 * This function either returns an array with links, or returns an HTML string, or echoes HTML string
 *
 * @since	  4.1.1
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

    //====================================================================================================
    // ACF definition for 'gerelateerde_content_toevoegen'
    // 
	// not all CPTs are active on every site; so on some sites adding GC_BEELDBANK_BRIEF_CPT
	// is not useful. But this function is called before the posttypes are actually registered.
	//  ¯\_(ツ)_/¯
	// TODO

	$related_locations = array(
			array( 
				array( 
					'param' => 'post_type',
					'operator' => '==',
					'value' => ICTU_GC_CPT_STAP,
				 ),
			 ),
			array( 
				array( 
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				 ),
			 ),
			array( 
				array( 
					'param' => 'post_type',
					'operator' => '==',
					'value' => ICTU_GC_CPT_DOELGROEP,
				 ),
			 ),
			array( 
				array( 
					'param' => 'post_type',
					'operator' => '==',
					'value' => GC_BEELDBANK_BRIEF_CPT,
				 ),
			 ),
			array( 
				array( 
					'param' => 'post_type',
					'operator' => '==',
					'value' => GC_BEELDBANK_BEELD_CPT,
				 ),
			 ),
			array( 
				array( 
					'param' => 'post_type',
					'operator' => '==',
					'value' => ICTU_GC_CPT_VAARDIGHEDEN,
				 ),
			 ),
		 );	

    //====================================================================================================
    // ACF definition for 'handige_links_toevoegen'
    // 
	acf_add_local_field_group( array( 
		'key' => 'group_5c8f9ba967736',
		'title' => '03 - Gerelateerde content (GC-theme, inclusie, beeldbank)',
		'fields' => array( 
			array( 
				'key' => 'field_5c8fe203a8435',
				'label' => 'Gerelateerde content toevoegen?',
				'name' => 'gerelateerde_content_toevoegen',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array( 
					'width' => '',
					'class' => '',
					'id' => '',
				 ),
				'choices' => array( 
					'ja' => 'Ja',
					'nee' => 'Nee',
				 ),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'nee',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			 ),
			array( 
				'key' => 'field_5c8fd404bd765',
				'label' => 'Titel',
				'name' => 'content_block_title',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array( 
					array( 
						array( 
							'field' => 'field_5c8fe203a8435',
							'operator' => '==',
							'value' => 'ja',
						 ),
					 ),
				 ),
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
				'key' => 'field_5c8fd42e15a23',
				'label' => 'Items',
				'name' => 'content_block_items',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array( 
					array( 
						array( 
							'field' => 'field_5c8fe203a8435',
							'operator' => '==',
							'value' => 'ja',
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
		'location' => $related_locations,
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	 ) );


    //====================================================================================================
    // ACF definition for 'handige_links_toevoegen'
    // 
	acf_add_local_field_group( array(
		'key' => 'group_5c8fdeebf0c34',
		'title' => '03 - Gerelateerde externe links (GC-theme, inclusie, beeldbank)',
		'fields' => array(
			array(
				'key' => 'field_5c8fe142c5418',
				'label' => 'Handige links toevoegen?',
				'name' => 'handige_links_toevoegen',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'ja' => 'Ja',
					'nee' => 'Nee',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'nee',
				'layout' => 'vertical',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5c8fdeec07d4b',
				'label' => 'Titel',
				'name' => 'links_block_title',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c8fe142c5418',
							'operator' => '==',
							'value' => 'ja',
						),
					),
				),
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
				'key' => 'field_5c8fdeec07d58',
				'label' => 'Links',
				'name' => 'links_block_items',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5c8fe142c5418',
							'operator' => '==',
							'value' => 'ja',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 1,
				'max' => 0,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_5c8fdf2a0c1a1',
						'label' => 'URL',
						'name' => 'links_block_item_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '30',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5c8fe1000c1a2',
						'label' => 'Link-tekst',
						'name' => 'links_block_item_linktext',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '30',
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
						'key' => 'field_5c8fe10d0c1a3',
						'label' => 'Beschrijving',
						'name' => 'links_block_item_description',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '40',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'new_lines' => '',
					),
				),
			),
		),
		'location' => $related_locations,
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
