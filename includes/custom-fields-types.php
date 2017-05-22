<?php


// Gebruiker Centraal - custom-field-types.php
// ----------------------------------------------------------------------------------
// bevat de ACF-instellingen.
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.7.7
// @desc.   Added author overview page, alignment avatars homepage.


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
    acf_add_local_field_group(array (
      'key' => 'group_56f3cd69031f7',
      'title' => 'Manifest (homepage)',
      'fields' => array (
        array (
          'key' => 'field_56f3cfe63fe1a',
          'label' => 'Link naar meer over Gebruiker Centraal',
          'name' => 'lees-meer-link',
          'type' => 'page_link',
          'instructions' => '',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array (
          ),
          'taxonomy' => array (
          ),
          'allow_null' => 0,
          'multiple' => 0,
        ),
        array (
          'key' => 'field_56f3d0033fe1b',
          'label' => 'Lees-meer-tekst',
          'name' => 'lees-meer-tekst',
          'type' => 'text',
          'instructions' => 'Dit wordt de tekst voor de lees-meer-link',
          'required' => 1,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => 'Meer over Gebruiker Centraal',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
      ),
      'location' => array (
        array (
          array (
            'param' => 'page_type',
            'operator' => '==',
            'value' => 'front_page',
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
      'description' => 'De tekst die op deze pagina invoert geldt als <em>manifest</em>. Deze wordt getoond in een afwijkende vormgeving met een doorkliklink',
    ));


    //====================================================================================================
    // Mogelijkheid om het actieteam samen te stellen 
    // via admin > weergave > Theme-instelling
  acf_add_local_field_group(array (
    'key' => 'group_56f9ba1b8e7d5',
    'title' => 'Actieteam',
    'fields' => array (

		array (
			'key' => 'field_TtPaXjcfYKXuU',
			'label' => 'Auteursoverzicht',
			'name' => 'auteursoverzichtpagina_link',
			'type' => 'page_link',
			'instructions' => 'Selecteer de pagina met het overzicht van alle auteurs. Deze pagina wordt gebruikt in de breadcrumb.',
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
			'allow_null' => 1,
			'multiple' => 0,
		),      
		array (
			'key' => 'field_5756a88c109a8',
			'label' => 'Link naar actieteampagina',
			'name' => 'actieteampagina_link',
			'type' => 'page_link',
			'instructions' => 'Selecteer de pagina met het actieteamoverzicht.',
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
			'allow_null' => 1,
			'multiple' => 0,
		),      
      array (
        'key' => 'field_56f9ba32641f5',
        'label' => 'Actieteamleden',
        'name' => 'actieteamleden',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => 'field_56f9ba50641f6',
        'min' => '',
        'max' => '',
        'layout' => 'table',
        'button_label' => 'Nieuwe regel',
        'sub_fields' => array (
          array (
            'key' => 'field_56f9ba50641f6',
            'label' => 'Actielid',
            'name' => 'actielid',
            'type' => 'user',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'role' => '',
            'allow_null' => 0,
            'multiple' => 0,
          ),
        ),
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

