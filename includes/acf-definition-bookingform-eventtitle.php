<?php

/**
 * Gebruiker Centraal - includes/acf-definition-bookingform-eventtitle.php
 * ----------------------------------------------------------------------------------
 * Bevat ACF definition voor veld waarmee je een afwijkende titel ingeeft boven
 * een inschrijfformulier van de Event Manager
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal
 */

// * @since	4.3.10

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5eb1813827032',
		'title' => 'Titel boven inschrijfformulier bij een event',
		'fields' => array(
			array(
				'key' => 'field_5eb1814862019',
				'label' => 'Titel boven inschrijfformulier',
				'name' => 'event_bookingform_title',
				'type' => 'text',
				'instructions' => 'Dit is de titel boven het inschrijfformulier',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'Schrijf je in voor dit evenement',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => 250,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
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
