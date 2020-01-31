<?php

// Gebruiker Centraal - gc-giant-banner-widget.php
// ----------------------------------------------------------------------------------
// Widget voor het tonen van allerlei soorten content.
// Gebruik deze vooral op de homepage
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.1.6
// @desc.   Separate CSS files restored. Login form slightly retouched.
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme




//========================================================================================================

add_action( 'widgets_init', 'GC_Widget_giant_banner_init' );

/** ------------------------------------------------------------------------------------------------------
* Initialise this widget
*/
function GC_Widget_giant_banner_init() {
	return register_widget("GC_Widget_giant_banner");
}


//========================================================================================================
//* banner widget
class GC_Widget_giant_banner extends WP_Widget {

	// ---------------------------------------------------------------------------------------------------

	public function __construct() {

		$widget_ops = array(
			'classname'		=> ID_GIANTBANNERWIDGET_CSS . ' banner-widget',
			'description' => __( 'Large banner, with text, link and background image', 'gebruikercentraal' ),
		);

		$control_ops = array(
			'width'   => 505,
			'height'  => 350,
		);

		parent::__construct( 'GC_Widget_giant_banner', WBVB_GC_WIDGET_GIANTBANNER, $widget_ops, $control_ops );

	}

	// ---------------------------------------------------------------------------------------------------

    function form($instance) {

	    $instance = wp_parse_args( (array) $instance, 
	        array( 
	            'title'              		=> '',
	            'giantbanner_url'           => '',
	            'giantbanner_linktext'      => '',
	            'giantbanner_text'          => '',
	            ) 
	        );
	
	    $title      			= apply_filters( 'widget_title', $instance['title'] );
	    $giantbanner_url      	= $instance['giantbanner_url'];
	    $giantbanner_text      	= $instance['giantbanner_text'];
        $giantbanner_linktext 	= empty($instance['giantbanner_linktext']) ? 'Klik hiero' : $instance['giantbanner_linktext'] ;
	    
	
	    ?>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ) ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>

	    <p>
	        <label for="<?php echo $this->get_field_id( 'giantbanner_url' ); ?>"><?php _e( 'URL', 'gebruikercentraal' ) ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'giantbanner_url' ); ?>" name="<?php echo $this->get_field_name( 'giantbanner_url' ); ?>" type="url" value="<?php echo $giantbanner_url; ?>" />
	    </p>

	    <p>
	        <label for="<?php echo $this->get_field_id( 'giantbanner_linktext' ); ?>"><?php _e( 'Link-tekst', 'gebruikercentraal' ) ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'giantbanner_linktext' ); ?>" name="<?php echo $this->get_field_name( 'giantbanner_linktext' ); ?>" type="text" value="<?php echo $giantbanner_linktext; ?>" />
	    </p>

	    <p>
	        <label for="<?php echo $this->get_field_id( 'giantbanner_text' ); ?>"><?php _e( 'Tekst', 'gebruikercentraal' ) ?></label>
	        <textarea rows="10" class="widefat" id="<?php echo $this->get_field_id( 'giantbanner_text' ); ?>" name="<?php echo $this->get_field_name( 'giantbanner_text' ); ?>"><?php echo $giantbanner_text; ?></textarea>
	    </p>

		<?php

    }

	// ---------------------------------------------------------------------------------------------------

    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title']      			= strip_tags($new_instance['title']);
        $instance['giantbanner_url']		= $new_instance['giantbanner_url'];
        $instance['giantbanner_linktext']	= $new_instance['giantbanner_linktext'];
        $instance['giantbanner_text']		= $new_instance['giantbanner_text'];

        return $instance;

    }

	// ---------------------------------------------------------------------------------------------------

    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        $title 					= empty($instance['title']) ? 'Titel' : $instance['title'] ;
        $giantbanner_url 		= empty($instance['giantbanner_url']) ? '' : $instance['giantbanner_url'] ;
        $giantbanner_linktext	= empty($instance['giantbanner_linktext']) ? 'Klik hiero' : $instance['giantbanner_linktext'] ;
        $giantbanner_text 		= empty($instance['giantbanner_text']) ? '' : $instance['giantbanner_text'] ;
		$title_id				= 'title-' . $args['widget_id'];
/*
echo '<pre>';
var_dump( $args );
echo '</pre>';
*/

        echo $before_widget;
		echo $after_title;
		echo '<section class="banner-widget_text" aria-labelledby="' . $title_id . '">';
		echo '<p id="' . $title_id . '" class="widget-title">' . $title . '</p>';
		echo '<p>' . $giantbanner_text . '</p>';
		if ( $giantbanner_url && $giantbanner_linktext ) {
			echo '<p><a href="' . $giantbanner_url . '" class="cta">' . $giantbanner_linktext . '</a></p>';
		}
		echo '</section>'; // .banner-widget_image
		echo $after_widget;

    }
}

//========================================================================================================

add_action( 'wp_enqueue_scripts', 'append_header_css_for_gc_giant_banner_widget' );


function append_header_css_for_gc_giant_banner_widget() {

	/**
	* appends relevant CSS for this widget to the header.
	* check if WBVB_GC_WIDGET_GIANTBANNER is the active widget,
	* then get the ACF values for it.
	* These ACF values are the selected posts (posts, pages, whatever)
	* that are displayed. For these posts we check if a featured
	* image is available
	*/

	global $post;    
	global $wp_registered_widgets;    

//	$header_css = "";
	$header_css = "/* JOEHOE */ \n\n";
	
	if ( is_array( $wp_registered_widgets )  ) {

		foreach ( $wp_registered_widgets as $breakpoint ) {
			
			if ( WBVB_GC_WIDGET_GIANTBANNER == $breakpoint['name'] ) {
			
				$widget_id 			= $breakpoint['id'];	
				$image 				= get_field( 'giantbanner_bg_image', 'widget_' . $widget_id ); 
				$image_alignment	= get_field( 'giantbanner_bg_image_alignment', 'widget_' . $widget_id );
				
				if( !empty( $image ) ) {

					if ( 'left' === $image_alignment ||  'right' === $image_alignment ) {
						$header_css .= "\n #" . $widget_id . " .banner-widget_image { \n";
						$header_css .= " background-image: url('" . $image['url'] . "');\n";
						$header_css .= "} \n";
					}
					else {
						$header_css .= "\n #" . $widget_id . " { \n";
						$header_css .= " background-image: url('" . $image['url'] . "');\n";
						$header_css .= "} \n";
					}
					
					
					$header_css .= '/* URL: ' . sanitize_title( $image['url'] ) . "  \n";
					$header_css .= ' $widget_id: ' . $widget_id . "  \n";
					$header_css .= ' $image_alignment: ' . $image_alignment . "  \n";
					
					$header_css .= "  breakpoint['id']: " . $breakpoint['id'] . " */\n";
					
				}
			}
		}
	}
	
	if ( $header_css ) {

		wp_enqueue_style(
			ID_GIANTBANNERWIDGET_CSS,
			WBVB_THEMEFOLDER . '/css/widget-giant-banner.css'
		);
		
		wp_add_inline_style( ID_GIANTBANNERWIDGET_CSS, $header_css );
	}

}

//========================================================================================================

add_filter('dynamic_sidebar_params', 'filter_for_gc_giant_banner_widget');

function filter_for_gc_giant_banner_widget( $params ) {

	/**
	* returns a modified list of parameters ('after_title') for this widget
	* this 'after_title' contains the selected posts (posts, pages, whatever)
	* for this widget
	*/

	global $post;

	// get widget vars
	$widget_name  	= $params[0]['widget_name'];
	$widget_id    	= $params[0]['widget_id'];

	// bail early if this widget is not a Text widget
	if( $widget_name != WBVB_GC_WIDGET_GIANTBANNER ) {
		return $params;
	}

	$image 				= get_field( 'giantbanner_bg_image', 'widget_' . $widget_id ); 
	$image_alignment	= get_field( 'giantbanner_bg_image_alignment', 'widget_' . $widget_id );

	if( !empty( $image ) ) {

/*
echo '<pre>';
var_dump( $image );
echo '</pre>';
*/

		

		$params[0]['before_widget'] = '<div id="' . $widget_id . '" class="banner-widget ' . $image_alignment . '">';
		$params[0]['after_widget'] = '</div>'; // .banner-widget
		
		$imagetext = '&nbsp;';

		if ( $image['alt'] ) {
			$imagetext = '<span class="visuallyhidden">' . $image['alt'] . '</span> ';
		}

		if ( 'left' === $image_alignment ||  'right' === $image_alignment ) {
			$params[0]['after_title'] = '<div class="banner-widget_image">' . $imagetext . '</div>';
		}
	
	}
	else {
		$params[0]['before_widget'] = '<div id="' . $widget_id . '" class="banner-widget no-image">';
		$params[0]['after_widget'] = '</div>'; // .banner-widget
	}

	// return
	return $params;

}

//========================================================================================================

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e0de262438aa',
	'title' => 'Banner widget',
	'fields' => array(
		array(
			'key' => 'field_5e0de26b7dc1c',
			'label' => 'Image',
			'name' => 'giantbanner_bg_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
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
			'key' => 'field_5e0de2967dc1d',
			'label' => 'Uitlijning',
			'name' => 'giantbanner_bg_image_alignment',
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
				'left' => 'Links uitgelijnd',
				'right' => 'Rechts uitgelijnd',
				'fullwidth' => 'Gehele breedte (achtergrond)',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => '',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'widget',
				'operator' => '==',
				'value' => 'gc_widget_giant_banner',
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


