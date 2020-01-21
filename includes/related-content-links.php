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
// * @version 3.31.1
// * @since	3.31.1
// * @desc.   Functies en definities voor 'related_content' verplaatst van inclusie-plugin naar GC-theme.
// * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

if (!function_exists('ictu_gc_frontend_general_get_related_content' )) :


	/**
	 * Display a set of links to related content or a set of links to external sites
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 * Can return 2 type of blocks:
	 * 1. block with items for 'gerelateerde_content_toevoegen'. This is a block with content from the local site.
	 * 2. block with items for 'handige_links_toevoegen'. This is a block with links to externas sites.
	 *
	 * @since 3.31.1
	 *
	 * @param array $args Argument for what to do: echo or return links or return HTML string.
	 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
	 * @return string $return HTML string with related links (if $args['echo'] => FALSE).
	 */
 	
    function ictu_gc_frontend_general_get_related_content($args = []) {

        global $post;

        $defaults = [
          'ID' => 0,
          'titletag' => 'h2',
          'getmenu' => FALSE,
          'echo' => TRUE,
        ];

        // Parse incoming $args into an array and merge it with $defaults
        $args = wp_parse_args($args, $defaults);

        $menuarray = [];
        $return = '';

        if (function_exists('get_field' )) {

			// interne links
            $gerelateerdecontent = get_field('gerelateerde_content_toevoegen', get_the_id());

            if ($gerelateerdecontent == 'ja' ) {

                $section_title = get_field( 'content_block_title', $post->ID);
                $title_id = sanitize_title($section_title . '-title' );
                $related_items = get_field( 'content_block_items' );

                if ($args['getmenu']) {
	                // return only links (ID + name)
                    $menuarray[$title_id] = $section_title;
                }
                else {

					$columncounter = 'col-2';
					$countcount = count( $related_items );
				
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
                    $return .= '<div class="wrap-outer">';
                    $return .= '<div class="wrap">';
                    $return .= '<h2 id="' . $title_id . '" class="section__title">' . $section_title . '</h2>';
                    $return .= '</div>'; // class="wrap";
                    $return .= '</div>'; // class="wrap-outer";

                    $return .= '<div class="grid grid--' . $columncounter . '">';

                }

                // loop through the rows of data
                foreach ($related_items as $post):

                    setup_postdata($post);

                    $theid = $post->ID;

                    $section_title	= get_the_title($theid);
                    $section_text	= get_the_excerpt($theid);
                    $section_link	= get_sub_field( 'home_template_teaser_link' );
                    $title_id		= sanitize_title($section_title);
                    $block_id		= sanitize_title( 'related_' . $theid);

                    if ($args['getmenu']) {
                        $menuarray[$title_id] = $section_title;
                    }
                    else {

						$imageplaceholder = '';
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large' );
						
						if ($image[0]) {
							$imageplaceholder = '<div class="card__image"></div>';
						}
						
						$return .= '<div class="card card--featured-image" id="' . $block_id . '">';
						$return .= $imageplaceholder;
						$return .= '<div class="card__content">';
						$return .= '<h3 id="' . $title_id . '" class="card__title"><a href="' . get_permalink( $theid ) . '"><span>';
						$return .= $section_title . '</span><span class="btn btn--arrow"></a></h3>';
						$return .= '<p>';
						$return .= $section_text;
						$return .= '</p>';
						$return .= '</div>'; // .card__content
						$return .= '</div>'; // .card

                    }

                endforeach;

                wp_reset_postdata();

                if (!$args['getmenu']) {

                    $return .= '</div>'; // class="grid ' . $columncounter . '">';
                    $return .= '</section>';

                }

            }
            else {
				// nothing
            }

			// externe links
            $handigelinks = get_field( 'handige_links_toevoegen', $post->ID);

            if ($handigelinks == 'ja' ) {

                $section_title = get_field( 'links_block_title', $post->ID);
                $title_id = sanitize_title($section_title . '-title' );

                if ($args['getmenu']) {
                    $menuarray[$title_id] = $section_title;
                }
                else {
					$return .= '<section  aria-labelledby="' . $title_id . '" class="section section--related section--related-links">';
                    $return .= '<div class="wrap">';
					$return .= '<h2 id="' . $title_id . '" class="section__title">' . $section_title . '</h2>';

                    $links_block_items = get_field( 'links_block_items' );

                    if ($links_block_items):

                        while (have_rows( 'links_block_items' )): the_row();

                            $links_block_item_url = get_sub_field( 'links_block_item_url' );
                            $links_block_item_linktext = get_sub_field('links_block_item_linktext' );
                            $links_block_item_description = get_sub_field('links_block_item_description' );

                            $return .= '<div> <h3><a href="' . esc_url($links_block_item_url) . '">' . sanitize_text_field($links_block_item_linktext) . '</a></h3>';

                            if ($links_block_item_description) {
                                $return .= '<p>' . sanitize_text_field($links_block_item_description) . '</p>';
                            }

                            $return .= '</div>';

                        endwhile;

                    endif;

                    $return .= '</div>'; //  class="wrap";
                    $return .= '</section>'; // .section--related-links

                }

            }
            else {
				// nothing
            }
        } // if (function_exists('get_field'))
        else {
            $return = 'Activeer ACF plugin';
        }

        if ($args['getmenu']) {
            return $menuarray;
        }
        elseif ($args['echo']) {
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
 * @since 3.31.1
 * @global string ICTU_GC_CPT_DOELGROEP Custom Post Type for doelgroep ('doelgroep', see functions.php). 
 * @global string ICTU_GC_CPT_STAP Custom Post Type for stap ('stap', see functions.php). 
 *
 * @param array $args Argument for what to do: echo or return links or return HTML string.
 * @return array $menuarray Array with links and link text (if $args['getmenu'] => TRUE).
 * @return string $return HTML string with related links (if $args['echo'] => FALSE).
 */

if ( function_exists('acf_add_local_field_group' ) ) :

	// this means the ACF plugin is active and we can add new field definitions

	acf_add_local_field_group(array(
		'key' => 'group_5c8f9ba967736',
		'title' => 'Stap en pagina\'s: gerelateerde content',
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
				'post_type' => array(
					0 => 'post',
					1 => 'page',
					2 => ICTU_GC_CPT_DOELGROEP,
					3 => ICTU_GC_CPT_STAP,
				),
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
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'stap',
				),
			),
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
