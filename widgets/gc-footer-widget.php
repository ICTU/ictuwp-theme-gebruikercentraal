<?php


// Gebruiker Centraal - gc-footer-widget.php
// ----------------------------------------------------------------------------------
// Deze widget kan gebruikt worden in de footer
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.7.7
// @desc.   Added author overview page, alignment avatars homepage.
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

        $title                    = apply_filters( 'widget_title', $instance['title'] );
        $gc_fw_cta_link        = $instance['gc_fw_cta_link'];
        $gc_fw_korte_beschrijving  = $instance['gc_fw_korte_beschrijving'];
        $gc_fw_url_meer_info    = $instance['gc_fw_url_meer_info'];


        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'gc_fw_cta_link' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'gc_fw_cta_link' ); ?>" name="<?php echo $this->get_field_name( 'gc_fw_cta_link' ); ?>" type="text" value="<?php echo $gc_fw_cta_link; ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id('gc_fw_korte_beschrijving') . '">' . __( "Korte beschrijving van de site:", 'gebruikercentraal' ) ?><br /><textarea cols="33" rows="4" id="<?php echo $this->get_field_id('gc_fw_korte_beschrijving'); ?>" name="<?php echo $this->get_field_name('gc_fw_korte_beschrijving'); ?>"><?php echo attribute_escape($gc_fw_korte_beschrijving); ?></textarea></label><br />

        <label for="<?php echo $this->get_field_id('gc_fw_url_meer_info') . '">' . __( "Linkt naar pagina:", 'gebruikercentraal' ) ?><br />
        <?php
            $args = array(
                'depth'            => 0,
                'child_of'         => 0,
                'selected'         => attribute_escape($gc_fw_url_meer_info),
                'echo'             => 1,
                'name'             => $this->get_field_name('gc_fw_url_meer_info')
            );
            
            wp_dropdown_pages( $args );
            
            echo '</label></p>';


            
    }
     
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title']          = strip_tags($new_instance['title']);
        $instance['gc_fw_cta_link']         = empty( $new_instance['gc_fw_cta_link'] ) ? __( "Meer over Gebruiker Centraal", 'gebruikercentraal' ) : $new_instance['gc_fw_cta_link'];
        $instance['gc_fw_korte_beschrijving']  = empty( $new_instance['gc_fw_korte_beschrijving'] ) ? '' : $new_instance['gc_fw_korte_beschrijving'];
        $instance['gc_fw_url_meer_info']       = empty( $new_instance['gc_fw_url_meer_info'] ) ? '' : $new_instance['gc_fw_url_meer_info'];
        return $instance;
    }
     
    function widget($args, $instance) {


        extract($args, EXTR_SKIP);

        $title                  = empty($instance['title']) ? '' : $instance['title'] ;
        $gc_fw_korte_beschrijving    = empty($instance['gc_fw_korte_beschrijving']) ? '' : $instance['gc_fw_korte_beschrijving'] ;
        $gc_fw_url_meer_info           = empty($instance['gc_fw_url_meer_info']) ? '' : $instance['gc_fw_url_meer_info'] ;
        $gc_fw_cta_link             = empty($instance['gc_fw_cta_link']) ? __( "Meer over Gebruiker Centraal", 'gebruikercentraal' ) : $instance['gc_fw_cta_link'] ;
        $linkafter          = '';

        
        if ( $gc_fw_url_meer_info )
        {
            $gc_fw_url_meer_info  = get_permalink($gc_fw_url_meer_info);
            $linkbefore         = '<a href="' . $gc_fw_url_meer_info. '">';
//            $linkbefore          .= $gc_fw_cta_link;
            $linkafter          = '</a>';
        }
         
         
        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;
        
        echo '<div class="banner">';
        echo '<p>' . nl2br($gc_fw_korte_beschrijving) . '</p>';
        echo '<p>' . $linkbefore . $gc_fw_cta_link . $linkafter . '</p>';
        echo '</div>';
        echo $after_widget;
    }
 
}


add_action( 'widgets_init', create_function('', 'return register_widget("gc_show_footer_widget");') );

//========================================================================================================

//define( 'ID_BLOGBERICHTEN_CSS', 'blogberichtencss' );

function gc_wbvb_add_css2() {


}

