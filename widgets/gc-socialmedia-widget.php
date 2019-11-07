<?php


// Gebruiker Centraal - gc-socialmedia-widget.php
// ----------------------------------------------------------------------------------
// Deze widget kan gebruikt worden in de footer
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.10.1
// @desc.   Bugfixes voor get_field, create_function en 404-pagina.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme


//========================================================================================================

function gc_show_socmed_widget_init() {
  return register_widget("CZO_Socialmedia_widget");
}

add_action( 'widgets_init', 'gc_show_socmed_widget_init' );

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

		$this->widgetclassname  = 'social-media-widget';
  	

		$this->defaults = array(
			'title'                   => '',
		);

		$widget_ops = array(
			'classname'   => $this->widgetclassname . ' sharing',
			'description' => __( 'Social media-kanalen in een widget', 'czoflex' ),
		);

		$control_ops = array(
			'id_base' => $this->widgetclassname,
			'width'   => 505,
			'height'  => 350,
		);

		parent::__construct( $this->widgetclassname, RHSWP_WIDGET_BANNER, $widget_ops, $control_ops );
//		parent::__construct( 'rhswp_banner_widget', RHSWP_WIDGET_BANNER, $widget_ops );

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

        if ( $title ) {
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

add_filter('dynamic_sidebar_params', 'gc_wbvb_widget_socmed_links');

function gc_wbvb_widget_socmed_links( $params ) {
	
	global $post;
	
	// get widget vars
	$widget_name  = $params[0]['widget_name'];
	$widget_id    = $params[0]['widget_id'];

	// bail early if this widget is not a Text widget
	if( $widget_name != RHSWP_WIDGET_BANNER ) {
		return $params;
	}
/*
echo '<pre>';
var_dump( $params );
echo '</pre>';

ray(2) {
  [0]=>
  array(10) {
    ["name"]=>
    string(17) "Home-widget links"
    ["id"]=>
    string(21) "widgetarea-home-links"
    ["description"]=>
    string(60) "Hier kun je de widgets plaatsen voor events en blogberichten"
    ["class"]=>
    string(0) ""
    ["before_widget"]=>
    string(122) "
"
    ["before_title"]=>
    string(37) "
"
    ["after_title"]=>
    string(6) "

"
    ["widget_id"]=>
    string(21) "social-media-widget-3"
    ["widget_name"]=>
    string(26) "GC - social media accounts"
  }
  [1]=>
  array(1) {
    ["number"]=>
    int(3)
  }
}
*/
	
	$widget_links = '';
	
	
	if( have_rows( 'socmed_widget_links', 'widget_' . $widget_id ) ): 
	
		$widget_links = '<ul class="social-media">';
	
		while( have_rows( 'socmed_widget_links', 'widget_' . $widget_id ) ): the_row(); 
	
			// vars
			$socmed_widget_type			= get_sub_field('socmed_widget_type');
			$socmed_widget_url			= get_sub_field('socmed_widget_url');
			$socmed_widget_linktekst	= get_sub_field('socmed_widget_linktekst');
			
			if ( $socmed_widget_url && $socmed_widget_linktekst ) {
	
				$widget_links .= '<li>';
				$widget_links .= '<a class="' . $socmed_widget_type . '" href="' . urlencode( $socmed_widget_url ) . '">' . sanitize_text_field( $socmed_widget_linktekst ) . '</a>';
				$widget_links .= '</a></li>';
				
			}
	
		endwhile; 
	
		$widget_links .= '</ul>';
	
	
	endif;
	
	$params[0]['after_title'] .= $widget_links;

	// return
	return $params;

}

//========================================================================================================


