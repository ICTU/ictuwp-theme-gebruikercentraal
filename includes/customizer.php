<?php

///
// Gebruiker Centraal - customizer.php
// ----------------------------------------------------------------------------------
// Functions for the customizer: logos
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.13.1
// @desc.   Extra settings in customizer: choice of logos.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

add_action('customize_register','mytheme_customizer_options');
/*
 * Add in our custom Accent Color setting and control to be used in the Customizer in the Colors section
 *
 */
function mytheme_customizer_options( $wp_customize ) {

  $wp_customize->add_setting(
      'mytheme_accent_color', //give it an ID
      array(
          'right' => 'right', // Give it a default
      )
  );

  $wp_customize->add_control(
    'gc_wbvb_logoimage', //give it an ID
    array(
    		'type'     => 'radio',
    		'choices'  => array(
    			'left'  => '<img src="',
    			'right' => 'right',
    		),
        'section'   => 'title_tagline', //select the section for it to appear under
        'label'     => __( 'gc_wbvb_logoimage Label', 'gebruikercentraal' ),
        'settings'  => 'mytheme_accent_color', //pick the setting it applies to
      )
    );

/*

$wp_customize->add_control(
  'setting_id',
  array(
  'type' => 'date',
  'priority' => 10, // Within the section.
  'section' => 'colors', // Required, core or custom.
  'label' => __( 'Date' ),
  'description' => __( 'This is a date control with a red border.' ),
  'input_attrs' => array(
    'class' => 'my-custom-class-for-js',
    'style' => 'border: 1px solid #900',
    'placeholder' => __( 'mm/dd/yyyy' ),
  ),
  'active_callback' => 'is_front_page',
) );


  $wp_customize->add_control(
  	'gc_wbvb_customlogo',
  	array(
  		'label'    => __( 'gc_wbvb_customlogo Label', 'mytheme' ),
  		'section'  => 'title_tagline',
  		'settings' => 'your_setting_id',
  		'type'     => 'radio',
  		'choices'  => array(
  			'left'  => 'left',
  			'right' => 'right',
  		),
  	)
  )
*/
}

//========================================================================================================

add_action( 'customize_register', 'gc_wbvb_customizer_add_section' );

function gc_wbvb_customizer_add_section( $wp_customize ) {

  $id = 'gc_wbvb_customlogo_section';

  $args = array(
      'title'      => __('Visible Section Name','mytheme'),
      'priority'   => 30,
  );

//   $wp_customize->add_section($id, $args);

  // Add a footer/copyright information section.
  $wp_customize->add_section( 'footer' , array(
    'title' => __( 'Le footer', 'themename' ),
    'priority' => 105, // Before Widgets.
  ) );


}

//========================================================================================================

add_action('customize_register','gc_wbvb_customizer_options');
/*
 * Add in our custom Accent Color setting and control to be used in the Customizer in the Colors section
 *
 */
function gc_wbvb_customizer_options( $wp_customize ) {

  $wp_customize->add_setting(
        'gc_wbvb_customlogo', //give it an ID
        array(
            'default' => '#333333', // Give it a default
        )
    );

  $wp_customize->add_control(
  	'gc_wbvb_customlogo',
  	array(
  		'label'    => __( 'gc_wbvb_customlogo Label', 'mytheme' ),
  		'section'  => 'title_tagline',
  		'settings' => 'your_setting_id',
  		'type'     => 'radio',
  		'choices'  => array(
  			'left'  => 'left',
  			'right' => 'right',
  		),
  	)
  );

}

//========================================================================================================
