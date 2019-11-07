<?php


// Gebruiker Centraal - gc-footer-widget.php
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
//* banner widget
class gc_show_footer_widget extends WP_Widget {

  public function __construct() {

    $widget_ops = array(
      'classname'   => 'gc-site-footer-widget',
      'description' => __( 'Ruimte voor korte informatie over de site en een doorklik.', 'gebruikercentraal' ),
    );


    parent::__construct( 'gc_show_footer_widget', 'GC - Sitefooter', $widget_ops );
  }

     
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, 
            array( 
                'title'              => '', 
                'gc_fw_cta_link'      => '', 
                'gc_fw_korte_beschrijving'  => '', 
                'gc_fw_url_meer_info'    => '' 
                ) 
            );

        $title						= apply_filters( 'widget_title', $instance['title'] );
        $gc_fw_korte_beschrijving 	= $instance['gc_fw_korte_beschrijving'];
        $gc_fw_cta_link        		= $instance['gc_fw_cta_link'];
        $gc_fw_url_meer_info    	= $instance['gc_fw_url_meer_info'];

		if ( intval( $gc_fw_url_meer_info ) > 0 ) {
			$gc_fw_url_meer_info = get_permalink( intval( $gc_fw_url_meer_info ) );
		}


        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id('gc_fw_korte_beschrijving') ?>"><?php _e( "Korte beschrijving van de site:", 'gebruikercentraal' ) ?></label><br /><textarea cols="33" rows="4" id="<?php echo $this->get_field_id('gc_fw_korte_beschrijving'); ?>" name="<?php echo $this->get_field_name('gc_fw_korte_beschrijving'); ?>"><?php echo esc_attr($gc_fw_korte_beschrijving); ?></textarea></p>

        <p>
            <label for="<?php echo $this->get_field_id( 'gc_fw_cta_link' ); ?>"><?php _e( 'Linktekst', 'gebruikercentraal' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'gc_fw_cta_link' ); ?>" name="<?php echo $this->get_field_name( 'gc_fw_cta_link' ); ?>" type="text" value="<?php echo $gc_fw_cta_link; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'gc_fw_url_meer_info' ); ?>"><?php _e( 'Link (URL)', 'gebruikercentraal' ) ?></label>beh
            <input class="widefat" id="<?php echo $this->get_field_id( 'gc_fw_url_meer_info' ); ?>" name="<?php echo $this->get_field_name( 'gc_fw_url_meer_info' ); ?>" type="url" value="<?php echo $gc_fw_url_meer_info; ?>" />
        </p>
        
        <?php

            
    }
     
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']						= strip_tags($new_instance['title']);
        $instance['gc_fw_korte_beschrijving']	= $new_instance['gc_fw_korte_beschrijving'];
        $instance['gc_fw_url_meer_info']		= $new_instance['gc_fw_url_meer_info'];
        $instance['gc_fw_cta_link']				= $new_instance['gc_fw_cta_link'];
        return $instance;
    }
     
    function widget($args, $instance) {


        extract($args, EXTR_SKIP);

        $title                  	= empty($instance['title']) ? '' : $instance['title'] ;
        $gc_fw_korte_beschrijving	= empty($instance['gc_fw_korte_beschrijving']) ? '' : $instance['gc_fw_korte_beschrijving'] ;
        $gc_fw_url_meer_info		= empty($instance['gc_fw_url_meer_info']) ? '' : $instance['gc_fw_url_meer_info'] ;
        $gc_fw_cta_link				= $instance['gc_fw_cta_link'] ;
        $linkafter          		= '';
        $linkbefore          		= '';

        
		if ( $gc_fw_url_meer_info && $gc_fw_cta_link ) {
			
			if ( intval( $gc_fw_url_meer_info ) > 0 ) {
				$gc_fw_url_meer_info = get_permalink( intval( $gc_fw_url_meer_info ) );
			}
            
            $linkbefore         = '<p><a href="' . $gc_fw_url_meer_info. '">';
            $linkafter          = '</a></p>';
            
        }
         
         
        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;
        
        echo '<div class="banner">';
        echo '<p>' . nl2br($gc_fw_korte_beschrijving) . '</p>';
        echo $linkbefore . $gc_fw_cta_link . $linkafter;
        echo '</div>';
        echo $after_widget;
    }
}

//========================================================================================================

function gc_show_footer_widget_init() {
  return register_widget("gc_show_footer_widget");
}

add_action( 'widgets_init', 'gc_show_footer_widget_init' );

//========================================================================================================

