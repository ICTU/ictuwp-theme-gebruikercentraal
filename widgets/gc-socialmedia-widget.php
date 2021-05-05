<?php


// Gebruiker Centraal - gc-socialmedia-widget.php
// ----------------------------------------------------------------------------------
// Deze widget kan gebruikt worden in de footer
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.27.9
// @desc.   Bugfix social media widget, div styling fixes.
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal

//========================================================================================================

add_action( 'widgets_init', 'gc_show_socmed_widget_init' );

add_filter('dynamic_sidebar_params', 'gc_wbvb_widget_socmed_add_acf_links');

//========================================================================================================

function gc_show_socmed_widget_init() {
  return register_widget("CZO_Socialmedia_widget");
}

//========================================================================================================


/**
 * CZO_Socialmedia_widget widget class.
 *
 * @since 1.1.7
 *
 * @package czoflex
 */
class CZO_Socialmedia_widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	protected $widgetclassname;

  //------------------------------------------------------------------------------------------------------

	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 1.1.7
	 */
	public function __construct() {

		// set up ACF fields
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5dc3d4a1b1d8a',
				'title' => 'Social media accounts',
				'fields' => array(
					array(
						'key' => 'field_5dc3d52a82945',
						'label' => 'Voeg links toe',
						'name' => 'socmed_widget_links',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => 'field_5dc3d5ae82948',
						'min' => 0,
						'max' => 0,
						'layout' => 'row',
						'button_label' => 'Profiel toevoegen',
						'sub_fields' => array(
							array(
								'key' => 'field_5dc3d56882947',
								'label' => 'Type',
								'name' => 'socmed_widget_type',
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
									'twitter' => 'Twitter',
									'linkedin' => 'LinkedIn',
									'slack' => 'Slack',
									'instagram' => 'Instagram',
									'youtube' => 'Youtube',
									'facebook' => 'Facebook',
									'email' => 'Email',
									'website' => 'Other website',
								),
								'allow_null' => 0,
								'other_choice' => 0,
								'default_value' => 'twitter',
								'layout' => 'vertical',
								'return_format' => 'value',
								'save_other_choice' => 0,
							),
							array(
								'key' => 'field_5dc3d54d82946',
								'label' => 'URL',
								'name' => 'socmed_widget_url',
								'type' => 'text',
								'instructions' => 'use mailto:, http://, https://',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
							),
							array(
								'key' => 'field_5dc3d5ae82948',
								'label' => 'Linktekst',
								'name' => 'socmed_widget_linktekst',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => 'Volg ons',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => '',
							),
						),
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'widget',
							'operator' => '==',
							'value' => GCWBVB_WIDGET_SOKMET_ID,
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'left',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

		endif;

		$this->defaults = array(
			'title'			=> '',
		);

		$widget_ops = array(
			'classname'		=> GCWBVB_WIDGET_SOKMET_ID . ' sharing',
			'description'	=> __( 'Social media-kanalen in een widget (' . GCWBVB_WIDGET_SOKMET_ID . ')', 'czoflex' ),
		);

		$control_ops = array(
			'id_base'		=> GCWBVB_WIDGET_SOKMET_ID,
			'width'			=> 505,
//			'height'		=> 350,
		);

		parent::__construct( GCWBVB_WIDGET_SOKMET_ID, GCWBVB_WIDGET_SOKMET_NAME, $widget_ops, $control_ops );

	}

  //------------------------------------------------------------------------------------------------------

	/**
	 * Echo the widget content.
	 *
	 * @since 1.1.7
	 *
	 * @global WP_Query $wp_query               Query object.
	 * @global int      $more
	 *
	 * @param array $args     Display arguments including `before_title`, `after_title`,
	 *                        `before_widget`, and `after_widget`.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {

        extract($args, EXTR_SKIP);

        $title                  	= empty($instance['title']) ? '' : $instance['title'] ;

        if ( $after_title ) {
	        echo $before_widget;
            echo $before_title . $title . $after_title;
	        echo $after_widget;
        }

	}

  //------------------------------------------------------------------------------------------------------

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @since 1.1.7
	 *
	 * @param array $new_instance New settings for this instance as input by the user via `form()`.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {

		$new_instance['title']      = wp_strip_all_tags( $new_instance['title'] );

		return $new_instance;

	}

  //------------------------------------------------------------------------------------------------------

	/**
	 * Echo the settings update form.
	 *
	 * @since 1.1.7
	 *
	 * @param array $instance Current settings.
	 * @return void
	 */
	public function form( $instance ) {

		// Merge with defaults.
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'czoflex' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>


		<?php

	}

}

//========================================================================================================

function gc_wbvb_widget_socmed_add_acf_links( $params ) {

	global $post;

	// get widget vars
	$widget_name  	= $params[0]['widget_name'];
	$widget_id    	= $params[0]['widget_id'];
	$widget_links	= '';

	// bail early if this widget is not a Text widget
	if( $widget_name != GCWBVB_WIDGET_SOKMET_NAME ) {
		return $params;
	}

	if( have_rows( 'socmed_widget_links', 'widget_' . $widget_id ) ):

		$widget_links = '<ul class="social-media">';

		while( have_rows( 'socmed_widget_links', 'widget_' . $widget_id ) ): the_row();

			// vars
			$socmed_widget_type			= get_sub_field('socmed_widget_type');
			$socmed_widget_url			= get_sub_field('socmed_widget_url');
			$socmed_widget_linktekst	= get_sub_field('socmed_widget_linktekst');

			if ( $socmed_widget_url && $socmed_widget_linktekst ) {

				$widget_links .= '<li>';
				$widget_links .= '<a class="' . $socmed_widget_type . '" href="' . $socmed_widget_url . '">' . sanitize_text_field( $socmed_widget_linktekst ) . '</a>';
				$widget_links .= '</a></li>';

			}

		endwhile;

		$widget_links .= '</ul>';

		$params[0]['after_title'] .= $widget_links;

	else:

		$params[0]['after_title'] = 'grumpy cat';

	endif;

	// return
	return $params;

}

//========================================================================================================


