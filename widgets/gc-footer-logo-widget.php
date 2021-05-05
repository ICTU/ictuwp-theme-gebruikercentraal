<?php


// Gebruiker Centraal - gc-footer-logo-widget.php
// ----------------------------------------------------------------------------------
// Deze widget kan gebruikt worden in de footer en toont 1 of meer logo's
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.17.1
// @desc.   Widget voor logo's toegevoegd; kleine stijlverbeteringen.
// @link    https://github.com/ICTU/ictuwp-theme-gebruikercentraal



//========================================================================================================
//* banner widget
class gc_show_footer_logo_widget extends WP_Widget {

	// ---------------------------------------------------------------------------------------------------

	public function __construct() {

		$widget_ops = array(
			'classname'   => 'gc-site-footer-logowidget',
			'description' => __( 'Ruimte voor 1 of meer logo\'s plus link.', 'gebruikercentraal' ),
		);

		parent::__construct( 'gc_show_footer_logo_widget', WBVB_GC_LOGOWIDGET, $widget_ops );

	}

	// ---------------------------------------------------------------------------------------------------

    function form($instance) {

	    $instance = wp_parse_args( (array) $instance,
	        array(
	            'title'              		=> '',
	            'xtratxt'              		=> ''
	            )
	        );

	    $title                    = apply_filters( 'widget_title', $instance['title'] );
        $xtratxt    = $instance['xtratxt'];

	    ?>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ) ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Extra text', 'gebruikercentraal' ) ?><br>
	        <textarea cols="30" rows="8" id="<?php echo $this->get_field_id( 'xtratxt' ); ?>" name="<?php echo $this->get_field_name( 'xtratxt' ); ?>"><?php echo $xtratxt; ?></textarea>
	        </label>
	    </p>
		<?php

    }

	// ---------------------------------------------------------------------------------------------------

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']      = strip_tags($new_instance['title']);
        $instance['xtratxt']	= strip_tags($new_instance['xtratxt']);
        return $instance;
    }

	// ---------------------------------------------------------------------------------------------------

    function widget($args, $instance) {


        extract($args, EXTR_SKIP);

        $title 		= empty($instance['title']) ? '' : $instance['title'] ;
        $xtratxt 	= empty($instance['xtratxt']) ? '' : $instance['xtratxt'] ;

        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;

        if ( $xtratxt )
            echo '<p>' . sanitize_text_field( $xtratxt ) . '</p>';

        echo $after_widget;

    }
}

//========================================================================================================

function gc_show_footer_logo_widget_init() {
	return register_widget("gc_show_footer_logo_widget");
}

add_action( 'widgets_init', 'gc_show_footer_logo_widget_init' );

//========================================================================================================

add_filter('dynamic_sidebar_params', 'filter_for_rhswp_banner_widget');

function filter_for_rhswp_banner_widget( $params ) {

	global $rhswp_banner_widget_customcss;
	global $post;


	// get widget vars
	$widget_name  = $params[0]['widget_name'];
	$widget_id    = $params[0]['widget_id'];

	$rhswp_banner_widget_customcss = '';


	// bail early if this widget is not a Text widget
	if( $widget_name != WBVB_GC_LOGOWIDGET ) {
		return $params;
	}

	if( have_rows( 'logowidget_logos', 'widget_' . $widget_id ) ):

		$params[0]['after_title'] .= '<div class="logo-flexbox">';

	 	// loop through the rows of data
	    while ( have_rows( 'logowidget_logos', 'widget_' . $widget_id ) ) : the_row();

	        // display a sub field value
	        $logo_plaatje	= get_sub_field('logo_plaatje');
	        $logo_link 		= get_sub_field('logo_link');
	        $atag_start		= '<div class="logo-flexblock">';
	        $atag_end		= '</div>';

	        if ( $logo_link ) {
		        $atag_start		= '<div class="logo-flexblock"><a href="' . esc_url( $logo_link ) . '">';
		        $atag_end		= '</a></div>';
	        }

			$params[0]['after_title'] .= sprintf(
				'%s<img src="%s" alt="' . $logo_plaatje['alt'] . '" width="%s" height="%s">%s',
				$atag_start,
				$logo_plaatje['sizes'][BLOG_SINGLE_DESKTOP],
				$logo_plaatje['sizes'][BLOG_SINGLE_DESKTOP.'-width'],
				$logo_plaatje['sizes'][BLOG_SINGLE_DESKTOP.'-height'],
				$atag_end
			);


	    endwhile;

		$params[0]['after_title'] .= '</div>';

	endif;

	// return
	return $params;

}

//========================================================================================================



