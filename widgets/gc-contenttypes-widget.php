<?php

// Gebruiker Centraal - gc-contenttypes-widget.php
// ----------------------------------------------------------------------------------
// Widget voor het tonen van allerlei soorten content.
// Gebruik deze vooral op de homepage
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 4.3.4
// @desc.   Betere checks op get_field, ofwel: is ACF-plugin actief?
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme




//========================================================================================================

add_action( 'widgets_init', 'GC_Widget_home_featuredcontent_init' );

/** ------------------------------------------------------------------------------------------------------
* Initialise this widget
*/
function GC_Widget_home_featuredcontent_init() {
	return register_widget("GC_Widget_home_featuredcontent");
}


//========================================================================================================
//* banner widget
class GC_Widget_home_featuredcontent extends WP_Widget {

	// ---------------------------------------------------------------------------------------------------

	public function __construct() {

		$widget_ops = array(
			'classname'		=> 'gc-site-home-contentwidget gc-berichten-widget',
			'description' => __( 'Show post, pages, etc in one widget', 'gebruikercentraal' ),
		);

		$control_ops = array(
			'width'   => 505,
			'height'  => 350,
		);

		parent::__construct( 'GC_Widget_home_featuredcontent', WBVB_GC_BEELDEN_HOMEWIDGET, $widget_ops, $control_ops );

	}

	// ---------------------------------------------------------------------------------------------------

    function form($instance) {

	    $instance = wp_parse_args( (array) $instance, 
	        array( 
	            'title'              		=> '',
	            ) 
	        );
	
	    $title      = apply_filters( 'widget_title', $instance['title'] );
	
	    ?>
	    <p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ) ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>

		<?php

    }

	// ---------------------------------------------------------------------------------------------------

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']      = strip_tags($new_instance['title']);
        return $instance;
    }

	// ---------------------------------------------------------------------------------------------------

    function widget($args, $instance) {

        extract($args, EXTR_SKIP);

        $title 		= empty($instance['title']) ? '' : $instance['title'] ;
		

        echo $before_widget;
		echo $before_title . $title . $after_title;
		echo $after_widget;

    }
}

//========================================================================================================

add_action( 'wp_enqueue_scripts', 'append_header_css_for_gc_beeldbank_homewidget' );


function append_header_css_for_gc_beeldbank_homewidget() {

	/**
	* appends relevant CSS for this widget to the header.
	* check if WBVB_GC_BEELDEN_HOMEWIDGET is the active widget,
	* then get the ACF values for it.
	* These ACF values are the selected posts (posts, pages, whatever)
	* that are displayed. For these posts we check if a featured
	* image is available
	*/

	global $wp_registered_widgets;    
	
	$header_css = '';

	if ( ! function_exists( 'get_field' ) ) {
		return;
	}
	else {
	
		if ( is_array( $wp_registered_widgets )  ) {
	
			foreach ( $wp_registered_widgets as $breakpoint ) {
				
				if ( WBVB_GC_BEELDEN_HOMEWIDGET == $breakpoint['name'] ) {
				
					$widget_id = $breakpoint['id'];	
	
					$posts = get_field( 'selecteer_content', 'widget_' . $widget_id );
					
					if ( $posts ) {
						
					 	// loop through the rows of data
					    foreach( $posts as $p ):
				
							$getid        	= $p->ID;
							$the_image_ID	= $widget_id . '_widget_posts_' . $getid;
				          
							if (has_post_thumbnail( $getid ) ) {
		
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'medium' );
								
								if ( $image[0] ) {
									$header_css .= '#' . $the_image_ID . " { \n";
									$header_css .= " background-image: url('" . $image[0] . "');\n";
									$header_css .= "} \n";
									$class = 'feature-image';
									$header_css .= '/* append_header_css_for_gc_beeldbank_homewidget: ' . sanitize_title( $image[0] ) . " */\n";
								}
							}
							    
					    endforeach;
			
					}
				}
			}
		}
	
		
	}
	
	if ( $header_css ) {

		wp_enqueue_style(
			ID_BLOGBERICHTEN_CSS,
			WBVB_THEMEFOLDER . '/css/blogberichten.css?v=' . CHILD_THEME_VERSION
		);
		
		wp_add_inline_style( ID_BLOGBERICHTEN_CSS, $header_css );
	}

}

//========================================================================================================

add_filter('dynamic_sidebar_params', 'filter_for_gc_beeldbank_homewidget');

function filter_for_gc_beeldbank_homewidget( $params ) {

	/**
	* returns a modified list of parameters ('after_title') for this widget
	* this 'after_title' contains the selected posts (posts, pages, whatever)
	* for this widget
	*/

	global $custom_css;
	global $post;

	// get widget vars
	$widget_name  	= $params[0]['widget_name'];
	$widget_id    	= $params[0]['widget_id'];
	$countertje		= 0;
	$custom_css 	= '';

	// bail early if this widget is not a Text widget
	if( $widget_name != WBVB_GC_BEELDEN_HOMEWIDGET ) {
		return $params;
	}

	$posts = get_field( 'selecteer_content', 'widget_' . $widget_id );
	
	if( $posts ):

		$params[0]['after_title'] .= '<div class="bg-color">';
			
	 	// loop through the rows of data
	    foreach( $posts as $p ):

			// do loop stuff
			$countertje++;
			$getid        	= $p->ID;
			$permalink    	= get_permalink( $getid );
			$publishdate  	= get_the_date( $getid );
			$the_image_ID	= $widget_id . '_widget_posts_' . $getid;
			$datebadge		= '';
			$theexcerpt		= '';
			
			$params[0]['after_title'] .= '<section class="entry" itemid="' . $permalink . '" itemscope itemtype="http://schema.org/SocialMediaPosting">';
			$params[0]['after_title'] .= '<a href="' . $permalink . '" itemprop="url">';
          
			$class = 'feature-image noimage';
          
			if (has_post_thumbnail( $getid ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $getid ), 'medium' );
				
				if ( $image[0] ) {
					$class = 'feature-image';
				}
			}
				
			if ( date("Y") == get_the_date( 'Y' ) ) {
				$jaar =  '';
			}
			else {
				$jaar =  '<span class="jaar">' . get_the_date( 'Y' ) . '</span>';
			}
			
			if ( 'post' === get_post_type( $getid ) ) {
				$datebadge = '<span class="date-badge" itemprop="datePublished" content="' . $publishdate . '"><span class="dag">' . get_the_date( 'd' ) . '</span> <span class="maand">' . get_the_date( 'M' ) . '</span>' . $jaar . '</span>';
			}

			if ( 
				( 'page' === get_post_type( $getid ) ) ||
				( GC_BEELDBANK_BRIEF_CPT === get_post_type( $getid ) ) ||
				( GC_BEELDBANK_BEELD_CPT === get_post_type( $getid ) ) ||
				( 'post' === get_post_type( $getid ) )
			) {
				$theexcerpt 	= '<div class="excerpt">' . get_the_excerpt( $getid ) . '</div>';
			}


			$params[0]['after_title'] .= '<div id="' . $the_image_ID . '" class="' . $class . '">&nbsp;</div>';
			$params[0]['after_title'] .= '<div class="bloginfo">';
			$params[0]['after_title'] .= '<header>' . $datebadge;        
			$params[0]['after_title'] .= '<h3 class="entry-title" itemprop="headline">' . get_the_title( $getid ) . '</h3></header>';
			$params[0]['after_title'] .= $theexcerpt;
			$params[0]['after_title'] .= '</div>';
			$params[0]['after_title'] .= '</a>';
			$params[0]['after_title'] .= '</section>'; 
	
	    endforeach;

		$params[0]['after_title'] .= '</div>';
	
	endif;

	// return
	return $params;

}

//========================================================================================================

