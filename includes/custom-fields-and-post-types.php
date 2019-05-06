<?php


// Gebruiker Centraal - custom-fields-and-post-types.php
// ----------------------------------------------------------------------------------
// bevat de ACF-instellingen.
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.15.1
// @desc.   Restyling main nav menu.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


$samenvattingverplicht = false;

//========================================================================================================


if( function_exists('register_field_group') ):


if ( $samenvattingverplicht ) {
  

    //====================================================================================================
    // samenvatting voor pagina's
    // weet niet of dit anno 2016 nog nuttig is...
    register_field_group(array (
      'key' => 'group_54e589a345840',
      'title' => 'Samenvatting',
      'fields' => array (
        array (
          'key' => 'field_54e589bb4f514',
          'label' => 'Samenvatting',
          'name' => 'samenvatting',
          'prefix' => '',
          'type' => 'textarea',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'maxlength' => '',
          'rows' => '',
          'new_lines' => 'wpautop',
          'readonly' => 0,
          'disabled' => 0,
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'artmustgrow',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
    ));
}


    //====================================================================================================
    // gerelateerde pagina's
    register_field_group(array (
      'key' => 'group_54e4c1642ddb7',
      'title' => 'Gerelateerde content',
      'fields' => array (
        array (
          'key' => 'field_54e4c1a400866',
          'label' => 'Gerelateerde content',
          'name' => 'gerelateerde_content',
          'prefix' => '',
          'type' => 'relationship',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array (
            0 => 'post',
            1 => 'page',
            2 => 'event',
          ),
          'taxonomy' => '',
          'filters' => array (
            0 => 'search',
            1 => 'post_type',
          ),
          'elements' => '',
          'max' => '',
          'return_format' => 'object',
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'page_contentpagina.php',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'artmustgrow',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
    ));

    //====================================================================================================
    // sokmetknoppen voor twitter, linkedin, het satanische facebook
    // 
    register_field_group(array (
      'key' => 'group_54e6101992f1e',
      'title' => 'Deelknoppen: aan of uit?',
      'fields' => array (
        array (
          'key' => 'field_54e610433e1d0',
          'label' => 'Social-media-dingetjes',
          'name' => 'socialmedia_icoontjes',
          'prefix' => '',
          'type' => 'radio',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array (
            SOC_MED_YES => 'Toon socialmedia-icoontjes',
            SOC_MED_NO => 'Verberg socialmedia-icoontjes',
          ),
          'other_choice' => 0,
          'save_other_choice' => 0,
          'default_value' => SOC_MED_YES,
          'layout' => 'vertical',
        ),

      ),
      'location' => array (
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'post',
          ),
        ),
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'page',
          ),
        ),
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'event',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'artmustgrow',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
    ));


    //====================================================================================================
    // extra velden voor de posts
    acf_add_local_field_group(array (
      'key' => 'group_5718e31e9bab3',
      'title' => 'Extra links',
      'fields' => array (
        array (
          'key' => 'field_5718e3433e0ca',
          'label' => 'Links',
          'name' => 'event_post_links_collection',
          'type' => 'repeater',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'collapsed' => '',
          'min' => '',
          'max' => '',
          'layout' => 'table',
          'button_label' => 'Nieuwe regel',
          'sub_fields' => array (
            array (
              'key' => 'field_5718e3563e0cb',
              'label' => 'URL',
              'name' => 'event_post_link_url',
              'type' => 'url',
              'instructions' => '',
              'required' => 1,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
            ),
            array (
              'key' => 'field_5718e37b3e0cc',
              'label' => 'Linktekst',
              'name' => 'event_post_link_linktekst',
              'type' => 'text',
              'instructions' => '',
              'required' => 1,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'maxlength' => '',
              'readonly' => 0,
              'disabled' => 0,
            ),
          ),
        ),
      ),
    	'location' => array (
    		array (
    			array (
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'post',
    			),
    		),
    		array (
    			array (
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'event',
    			),
    		),
    	),      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
    ));

    acf_add_local_field_group(array (
    	'key' => 'group_57574ddf4447d',
    	'title' => 'Bij deze post horende downloads',
    	'fields' => array (
    		array (
    			'key' => 'field_57574dea66c22',
    			'label' => 'Bestanden:',
    			'name' => 'post_downloads_collection',
    			'type' => 'repeater',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => 0,
    			'wrapper' => array (
    				'width' => '',
    				'class' => '',
    				'id' => '',
    			),
    			'collapsed' => '',
    			'min' => '',
    			'max' => '',
    			'layout' => 'table',
    			'button_label' => 'Nieuw download toevoegen',
    			'sub_fields' => array (
    				array (
    					'key' => 'field_57574e2266c23',
    					'label' => 'Titel van het bestand',
    					'name' => 'post_download_title',
    					'type' => 'text',
    					'instructions' => '',
    					'required' => 1,
    					'conditional_logic' => 0,
    					'wrapper' => array (
    						'width' => '',
    						'class' => '',
    						'id' => '',
    					),
    					'default_value' => '',
    					'placeholder' => '',
    					'prepend' => '',
    					'append' => '',
    					'maxlength' => '',
    					'readonly' => 0,
    					'disabled' => 0,
    				),
    				array (
    					'key' => 'field_57574e3866c24',
    					'label' => 'Bestand',
    					'name' => 'post_download_file',
    					'type' => 'file',
    					'instructions' => '',
    					'required' => 1,
    					'conditional_logic' => 0,
    					'wrapper' => array (
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
    				array (
    					'key' => 'field_57574ee69b4f5',
    					'label' => 'Bestandstype',
    					'name' => 'post_download_filetype',
    					'type' => 'text',
    					'instructions' => '(bijvoorbeeld PDF)',
    					'required' => '',
    					'conditional_logic' => '',
    					'wrapper' => array (
    						'width' => '',
    						'class' => '',
    						'id' => '',
    					),
    					'default_value' => '',
    					'placeholder' => '',
    					'prepend' => '',
    					'append' => '',
    					'maxlength' => '',
    					'readonly' => 0,
    					'disabled' => 0,
    				),
    			),
    		),
    	),
    	'location' => array (
    		array (
    			array (
    				'param' => 'post_type',
    				'operator' => '==',
    				'value' => 'post',
    			),
    		),
    	),
    	'menu_order' => 0,
    	'position' => 'normal',
    	'style' => 'default',
    	'label_placement' => 'top',
    	'instruction_placement' => 'label',
    	'hide_on_screen' => '',
    	'active' => 1,
    	'description' => '',
    ));
  


    //====================================================================================================
    // extra velden voor de events
    acf_add_local_field_group(array (
      'key' => 'group_Fq48wfuaZZPBK',
      'title' => 'Extra evenementinformatie: programma',
      'fields' => array (
        array (
          'key' => 'field_CsbRqNYJFb',
          'label' => 'Programmaonderdelen',
          'name' => 'programmaonderdelen',
          'type' => 'repeater',
          'instructions' => 'Hier kun je de per programma-onderdeel de tijd en beschrijving invoeren.',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'collapsed' => '',
          'min' => '',
          'max' => '',
          'layout' => 'table',
          'button_label' => 'Nieuwe regel',
          'sub_fields' => array (
            array (
              'key' => 'field_5718e3fb41d75',
              'label' => 'Tijd',
              'name' => 'programmaonderdeel_tijd',
              'type' => 'text',
              'instructions' => 'Bijvoorkeur in het formaat:<br />
    <em>10:00 - 14:00</em>
    ',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'maxlength' => '',
              'readonly' => 0,
              'disabled' => 0,
            ),
            array (
              'key' => 'field_5718e44641d76',
              'label' => 'Beschrijving',
              'name' => 'programmaonderdeel_beschrijving',
              'type' => 'textarea',
              'instructions' => 'Hier kun je de beschrijving voor het programmaonderdeel invoeren. 
    <br>Gebruik liever geen HTML.',
              'required' => 1,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'maxlength' => '',
              'rows' => '',
              'new_lines' => 'wpautop',
              'readonly' => 0,
              'disabled' => 0,
            ),
          ),
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'event',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'acf_after_title',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
    ));

    
    //====================================================================================================
    // Mogelijkheid om links naar het manifest op de homepage in te voeren
    // dit geeft een linktekst en een link naar een pagina en wordt alleen getoond bij het wijzigen van 
    // de pagina die ingesteld is als homepage

    acf_add_local_field_group(array(
    	'key' => 'group_56f3cd69031f7',
    	'title' => 'GC Home: manifestblok',
    	'fields' => array(
    		array(
    			'key' => 'field_5c94c6dfca247',
    			'label' => 'Link naar manifest toevoegen?',
    			'name' => 'link_naar_manifest_toevoegen',
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
    			'key' => 'field_56f3cfe63fe1a',
    			'label' => 'Link naar meer over Gebruiker Centraal',
    			'name' => 'lees-meer-link',
    			'type' => 'page_link',
    			'instructions' => '',
    			'required' => 0,
    			'conditional_logic' => array(
    				array(
    					array(
    						'field' => 'field_5c94c6dfca247',
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
    			'post_type' => '',
    			'taxonomy' => '',
    			'allow_null' => 0,
    			'allow_archives' => 1,
    			'multiple' => 0,
    		),
    		array(
    			'key' => 'field_56f3d0033fe1b',
    			'label' => 'lees-meer-tekst',
    			'name' => 'lees-meer-tekst',
    			'type' => 'text',
    			'instructions' => 'Dit wordt de tekst voor de lees-meer-link',
    			'required' => 0,
    			'conditional_logic' => array(
    				array(
    					array(
    						'field' => 'field_5c94c6dfca247',
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
    			'default_value' => 'Meer over Gebruiker Centraal',
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
    				'value' => 'page_home.php',
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
    	'description' => 'De tekst die op deze pagina invoert geldt als <em>manifest</em>. Deze wordt getoond in een afwijkende vormgeving met een doorkliklink',
    ));



    //====================================================================================================
    // Mogelijkheid om het actieteam samen te stellen 
    // via admin > weergave > Theme-instelling
	acf_add_local_field_group(array(
		'key' => 'group_56f9ba1b8e7d5',
		'title' => 'Theme-instellingen',
		'fields' => array(
			array(
				'key' => 'field_5acce486d19d5',
				'label' => 'Toon zoekformulier in het menu',
				'name' => 'toon_zoekformulier_in_het_menu',
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
					'ja' => 'Ja, toon zoekformulier',
					'nee' => 'Nee, verberg zoekformulier',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'ja',
				'layout' => 'vertical',
				'return_format' => 'value',
			),
			array(
				'key' => 'field_5ccfdad568178',
				'label' => 'Sta social media-deelknoppen toe op de site',
				'name' => 'toon_socialmedia_buttons_global',
				'type' => 'radio',
				'instructions' => 'Als je hier \'ja\' kiest, worden knoppen getoond om pagina\'s en berichten te delen. Per pagina of bericht kun je die dan weer uitzetten.
	Als je hier \'nee\' kiest, worden ze nergens op de site getoond.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'ja' => 'Ja, toon socialmedia-knoppen',
					'nee' => 'Nee, verberg alle socialmedia-knoppen',
				),
				'allow_custom' => 0,
				'default_value' => 'ja',
				'layout' => 'vertical',
				'toggle' => 0,
				'return_format' => 'value',
				'save_custom' => 0,
			),
			array(
				'key' => 'field_ttpaxjcfykxuu',
				'label' => 'Auteursoverzicht',
				'name' => 'auteursoverzichtpagina_link',
				'type' => 'page_link',
				'instructions' => 'Selecteer de pagina met het overzicht van alle auteurs. Deze pagina wordt gebruikt in de breadcrumb.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'allow_archives' => 1,
				'multiple' => 0,
			),
			array(
				'key' => 'field_5756a88c109a8',
				'label' => 'Link naar actieteampagina',
				'name' => 'actieteampagina_link',
				'type' => 'page_link',
				'instructions' => 'Selecteer de pagina met het actieteamoverzicht.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => '',
				'allow_null' => 0,
				'allow_archives' => 1,
				'multiple' => 0,
			),
			array(
				'key' => 'field_56f9ba32641f5',
				'label' => 'Actieteamleden',
				'name' => 'actieteamleden',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => 'field_56f9ba50641f6',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => 'Nieuwe regel',
				'sub_fields' => array(
					array(
						'key' => 'field_56f9ba50641f6',
						'label' => 'actielid',
						'name' => 'actielid',
						'type' => 'user',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'role' => '',
						'allow_null' => 0,
						'multiple' => 0,
						'return_format' => 'array',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'instellingen',
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


  
    //========================================================================================================

	  acf_add_local_field_group(array (
	    'key' => 'group_56f9c31e473af',
	    'title' => 'Auteursinfo (foto en functiebeschrijving)',
	    'fields' => array (
	      array (
	        'key' => 'field_56f9c332b8b28',
	        'label' => 'Auteursfoto',
	        'name' => 'auteursfoto',
	        'type' => 'image',
	        'instructions' => '',
	        'required' => 0,
	        'conditional_logic' => 0,
	        'wrapper' => array (
	          'width' => '',
	          'class' => '',
	          'id' => '',
	        ),
	        'return_format' => 'array',
	        'preview_size' => 'thumbnail',
	        'library' => 'all',
	        'min_width' => '',
	        'min_height' => '',
	        'min_size' => '',
	        'max_width' => '',
	        'max_height' => '',
	        'max_size' => '',
	        'mime_types' => '',
	      ),
	      array (
	        'key' => 'field_56fbcffa55f14',
	        'label' => 'Functiebeschrijving',
	        'name' => 'functiebeschrijving',
	        'type' => 'textarea',
	        'instructions' => 'Deze wordt getoond naast de naam van een actieteamlid. Beperk deze tot twee regels, of tien woorden.',
	        'required' => 0,
	        'conditional_logic' => 0,
	        'wrapper' => array (
	          'width' => '',
	          'class' => '',
	          'id' => '',
	        ),
	        'default_value' => '',
	        'placeholder' => '',
	        'maxlength' => '',
	        'rows' => 2,
	        'new_lines' => 'br',
	        'readonly' => 0,
	        'disabled' => 0,
	      ),
	      array (
	
	          'key' => 'field_5718dd1d6340d',
	          'label' => 'Publiek mailadres',
	          'name' => 'publiek_mailadres',
	          'type' => 'email',
	          'instructions' => '(optioneel) op dit adres mag deze gebruiker gemaild worden',
	          'required' => 0,
	          'conditional_logic' => 0,
	          'wrapper' => array (
	            'width' => '',
	            'class' => '',
	            'id' => '',
	          ),
	          'default_value' => '',
	          'placeholder' => '',
	          'prepend' => '',
	          'append' => '',
	
	
	      ),
	      array (
	
	          'key' => 'field_rdQRmbVD6WhuF',
	          'label' => 'Publiek telefoonnumer',
	          'name' => 'publiek_telefoonnummer',
	          'type' => 'text',
	          'instructions' => '(optioneel) op dit adres mag deze gebruiker gebeld worden',
	          'required' => 0,
	          'conditional_logic' => 0,
	          'wrapper' => array (
	            'width' => '',
	            'class' => '',
	            'id' => '',
	          ),
	          'default_value' => '',
	          'placeholder' => '',
	          'prepend' => '',
	          'append' => '',
	
	
	      ),
	    ),
	    'location' => array (
	      array (
	        array (
	          'param' => 'user_form',
	          'operator' => '==',
	          'value' => 'all',
	        ),
	      ),
	    ),
	    'menu_order' => 0,
	    'position' => 'acf_after_title',
	    'style' => 'default',
	    'label_placement' => 'top',
	    'instruction_placement' => 'label',
	    'hide_on_screen' => '',
	    'active' => 1,
	    'description' => '',
	  ));

  acf_add_local_field_group(array (
  	'key' => 'group_5746c72e50d7b',
  	'title' => 'Andere bijeenkomsten',
  	'fields' => array (
  		array (
  			'key' => 'field_5746c7b82ff80',
  			'label' => 'Toon andere bijeenkomsten?',
  			'name' => 'toon_andere_bijeenkomsten',
  			'type' => 'radio',
  			'instructions' => 'Je kunt ervoor kiezen om onder de bijeenkomsten nog een extra blok te zetten met suggestie voor andere bijeenkomsten.',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'choices' => array (
  				'ja' => 'Ja, toon suggesties voor andere bijeenkomsten',
  				SOC_MED_NO => 'Nee, toon geen suggesties',
  			),
  			'allow_null' => 0,
  			'other_choice' => 0,
  			'save_other_choice' => 0,
  			'default_value' => SOC_MED_NO,
  			'layout' => 'vertical',
  		),
  		array (
  			'key' => 'field_5746c77817ad1',
  			'label' => 'Titel',
  			'name' => 'titel',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_5746c7b82ff80',
  						'operator' => '==',
  						'value' => 'ja',
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  			'readonly' => 0,
  			'disabled' => 0,
  		),
  		array (
  			'key' => 'field_5746c73a1a305',
  			'label' => 'Inleiding',
  			'name' => 'inleiding',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_5746c7b82ff80',
  						'operator' => '==',
  						'value' => 'ja',
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  			'readonly' => 0,
  			'disabled' => 0,
  		),
  		array (
  			'key' => 'field_5746ca2e7a87e',
  			'label' => 'Bijeenkomsten',
  			'name' => 'bijeenkomsten',
  			'type' => 'repeater',
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => array (
  				array (
  					array (
  						'field' => 'field_5746c7b82ff80',
  						'operator' => '==',
  						'value' => 'ja',
  					),
  				),
  			),
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'collapsed' => '',
  			'min' => '',
  			'max' => '',
  			'layout' => 'table',
  			'button_label' => 'Nieuwe regel',
  			'sub_fields' => array (
  				array (
  					'key' => 'field_5746ca407a87f',
  					'label' => 'Naam bijeenkomst',
  					'name' => 'naam_bijeenkomst',
  					'type' => 'text',
  					'instructions' => 'Dit wordt de link-tekst voor deze bijeenkomst.',
  					'required' => 1,
  					'conditional_logic' => 0,
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'default_value' => '',
  					'placeholder' => '',
  					'prepend' => '',
  					'append' => '',
  					'maxlength' => '',
  					'readonly' => 0,
  					'disabled' => 0,
  				),
  				array (
  					'key' => 'field_5746ca667a880',
  					'label' => 'URL',
  					'name' => 'bijeenkomst_URL',
  					'type' => 'url',
  					'instructions' => '',
  					'required' => 1,
  					'conditional_logic' => 0,
  					'wrapper' => array (
  						'width' => '',
  						'class' => '',
  						'id' => '',
  					),
  					'default_value' => '',
  					'placeholder' => '',
  				),
  			),
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'page_template',
  				'operator' => '==',
  				'value' => 'page_evenementen.php',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));

endif;

//========================================================================================================



//========================================================================================================
/*
code from:
https://www.advancedcustomfields.com/resources/bidirectional-relationships/
*/  
  

if ( ! function_exists( 'bidirectional_acf_update_value' ) ) {

  function bidirectional_acf_update_value( $value, $post_id, $field  ) {
  
    if ( function_exists( 'get_field' ) ) {
  
    	// vars
    	$field_name   = $field['name'];
    	$field_key    = $field['key'];
    	$global_name  = 'is_updating_' . $field_name;
    	
    	
    	// bail early if this filter was triggered from the update_field() function called within the loop below
    	// - this prevents an inifinte loop
    	if( !empty($GLOBALS[ $global_name ]) ) return $value;
    	
    	
    	// set global variable to avoid inifite loop
    	// - could also remove_filter() then add_filter() again, but this is simpler
    	$GLOBALS[ $global_name ] = 1;
    	
    	
    	// loop over selected posts and add this $post_id
    	if( is_array($value) ) {
    	
    		foreach( $value as $post_id2 ) {
    			
    			// load existing related posts
    			$value2 = get_field($field_name, $post_id2, false);
    			
    			
    			// allow for selected posts to not contain a value
    			if( empty($value2) ) {
    				
    				$value2 = array();
    				
    			}
    			
    			
    			// bail early if the current $post_id is already found in selected post's $value2
    			if( in_array($post_id, $value2) ) continue;
    			
    			
    			// append the current $post_id to the selected post's 'related_posts' value
    			$value2[] = $post_id;
    			
    			
    			// update the selected post's value (use field's key for performance)
    			update_field($field_key, $value2, $post_id2);
    			
    		}
    	
    	}
    	
    	
    	// find posts which have been removed
    	$old_value = get_field($field_name, $post_id, false);
    	
    	if( is_array($old_value) ) {
    		
    		foreach( $old_value as $post_id2 ) {
    			
    			// bail early if this value has not been removed
    			if( is_array($value) && in_array($post_id2, $value) ) continue;
    			
    			
    			// load existing related posts
    			$value2 = get_field($field_name, $post_id2, false);
    			
    			
    			// bail early if no value
    			if( empty($value2) ) continue;
    			
    			
    			// find the position of $post_id within $value2 so we can remove it
    			$pos = array_search($post_id, $value2);
    			
    			
    			// remove
    			unset( $value2[ $pos] );
    			
    			
    			// update the un-selected post's value (use field's key for performance)
    			update_field($field_key, $value2, $post_id2);
    			
    		}
    		
    	}
    	
    	
    	// reset global varibale to allow this filter to function as per normal
    	$GLOBALS[ $global_name ] = 0;
  	
    }
  	
  	// return
    return $value;
    
  }

}

add_filter('acf/update_value/name=beelden_brieven_connectie', 'bidirectional_acf_update_value', 10, 3);


//========================================================================================================
// ADD ALL ACF FIELDS FOR klantcontact in beeld

if( function_exists('acf_add_local_field_group') ):
  
  acf_add_local_field_group(array (
  	'key' => 'group_59f1b55fe3bae',
  	'title' => 'Beelden',
  	'fields' => array (
  		array (
  			'key' => 'field_59f1b56570001',
  			'label' => 'Foto',
  			'name' => 'beeld_foto',
  			'type' => 'image',
  			'value' => NULL,
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'return_format' => 'array',
  			'preview_size' => 'blog-single-desktop',
  			'library' => 'all',
  			'min_width' => '',
  			'min_height' => '',
  			'min_size' => '',
  			'max_width' => '',
  			'max_height' => '',
  			'max_size' => '',
  			'mime_types' => '',
  		),
  		array (
  			'key' => 'field_59f1b688fff48',
  			'label' => 'Bijbehorende brieven',
  			'name' => 'beelden_brieven_connectie',
  			'type' => 'relationship',
  			'value' => NULL,
  			'instructions' => 'selecteer de brieven waarin dit beeld gebruikt wordt',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array (
  				0 => 'brief',
  			),
  			'taxonomy' => array (
  			),
  			'filters' => array (
  				0 => 'search',
  				1 => 'taxonomy',
  			),
  			'elements' => '',
  			'min' => '',
  			'max' => '',
  			'return_format' => 'object',
  		),
  		array (
  			'key' => 'field_59f1e39cbfdf1',
  			'label' => 'Manier van gebruiken',
  			'name' => 'beeld_manier_van_gebruiken',
  			'type' => 'wysiwyg',
  			'value' => NULL,
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
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
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'beeld',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));
  
  acf_add_local_field_group(array (
  	'key' => 'group_59f1c262e109c',
  	'title' => 'Brieven',
  	'fields' => array (
  		array (
  			'key' => 'field_59f1d9494a128',
  			'label' => 'Bijlage',
  			'name' => 'brief_attachment',
  			'type' => 'file',
  			'value' => NULL,
  			'instructions' => '',
  			'required' => 1,
  			'conditional_logic' => 0,
  			'wrapper' => array (
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
  		array (
  			'key' => 'field_59f1c26b183a9',
  			'label' => 'Bijbehorende beelden',
  			'name' => 'beelden_brieven_connectie',
  			'type' => 'relationship',
  			'value' => NULL,
  			'instructions' => 'Selecteer de beelden die in deze brief gebruikt worden',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array (
  				0 => 'beeld',
  			),
  			'taxonomy' => array (
  			),
  			'filters' => array (
  				0 => 'search',
  				1 => 'taxonomy',
  			),
  			'elements' => '',
  			'min' => '',
  			'max' => '',
  			'return_format' => 'object',
  		),
  		array (
  			'key' => 'field_59f6ee2ff8847',
  			'label' => 'Extra informatie',
  			'name' => 'brief_extra_info',
  			'type' => 'textarea',
  			'value' => NULL,
  			'instructions' => 'Vul hier extra informatie in, bijvoorbeeld over de context van deze brief.',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
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
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'post_type',
  				'operator' => '==',
  				'value' => 'brief',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'acf_after_title',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));

endif;

//========================================================================================================

// options page 
if( function_exists('acf_add_options_page') ):

  acf_add_local_field_group(array (
  	'key' => 'group_59a47df0c409a',
  	'title' => 'Instellingen voor brieven en beelden',
  	'fields' => array (
  		array (
  			'key' => 'field_59a47e007b104',
  			'label' => 'Overzichtspagina voor beelden',
  			'name' => 'beelden_page_overview',
  			'type' => 'post_object',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array (
  				0 => 'page',
  			),
  			'taxonomy' => array (
  			),
  			'allow_null' => 0,
  			'multiple' => 0,
  			'return_format' => 'id',
  			'ui' => 1,
  		),
  		array (
  			'key' => 'field_90a47e007b333',
  			'label' => 'Overzichtspagina voor brieven',
  			'name' => 'brief_page_overview',
  			'type' => 'post_object',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'post_type' => array (
  				0 => 'page',
  			),
  			'taxonomy' => array (
  			),
  			'allow_null' => 0,
  			'multiple' => 0,
  			'return_format' => 'id',
  			'ui' => 1,
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'options_page',
  				'operator' => '==',
  				'value' => 'instellingen',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'default',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));


endif;

//========================================================================================================
