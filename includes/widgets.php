<?php

/**
 * Gebruiker Centraal - widgets.php
 * ----------------------------------------------------------------------------------
 * Gebruiker Centraal - widgets
 * ----------------------------------------------------------------------------------
 * @package gebruiker-centraal
 * @author  Paul van Buuren
 * @license GPL-2.0+
 * @version 3.7.1
 * @desc.   actieteampagina, actieteam-widget, skiplinks, 404
 * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
 */
 

add_action( 'widgets_init', 'gc_wbvb_load_widgets' );
/**
 * Register widgets for use in the Genesis theme.
 *
 * @since 1.7.0
 */
function gc_wbvb_load_widgets() {

  register_widget( 'GC_WBVB_WIDGET_user_welcome' );

}


/**
 * Genesis User Profile widget class.
 *
 * @since 0.1.8
 *
 * @package Genesis\Widgets
 */
class GC_WBVB_WIDGET_user_welcome extends WP_Widget {

  /**
   * Holds widget settings defaults, populated in constructor.
   *
   * @var array
   */
  protected $defaults;

  /**
   * Constructor. Set the default widget options and create widget.
   */
  function __construct() {

    $this->defaults = array(
      'title'          => '',
      'nav_menu'       => '',
    );

    $widget_ops = array(
      'classname'   => 'user-welcome',
      'description' => __( 'Toont de naam van de gebruiker, bij wijze van welkomstgroet.', 'gebruikercentraal' ),
    );

    $control_ops = array(
      'id_base' => 'user-welcome',
      'width'   => 200,
      'height'  => 250,
    );

    parent::__construct( 'user-welcome', __( 'GC - hallo', 'gebruikercentraal' ), $widget_ops, $control_ops );

  }

  /**
   * Echo the widget content.
   *
   * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
   * @param array $instance The settings for the particular instance of the widget
   */
  function widget( $args, $instance ) {

    //* Merge with defaults
    $instance = wp_parse_args( (array) $instance, $this->defaults );
    $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;


    echo $args['before_widget'];

            global $current_user;
            wp_get_current_user();

      if ( ! empty( $instance['title'] ) ) {
          $titelstring = $instance['title'];
          
//                if ( $current_user->user_firstname != '' ) {
//                    $titelstring .= " " . $current_user->user_firstname;
//                }
      
        echo $args['before_title'] . apply_filters( 'widget_title', $titelstring, $instance, $this->id_base ) . $args['after_title'];
      }


            if ( $current_user->display_name != '' ) {
                echo 'Je bent ingelogd als ' . $current_user->display_name . "\n";
            }

        wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu ) );

    echo $args['after_widget'];

  }

  /**
   * Update a particular instance.
   *
   * This function should check that $new_instance is set correctly.
   * The newly calculated value of $instance should be returned.
   * If "false" is returned, the instance won't be saved/updated.
   *
   * @param array $new_instance New settings for this instance as input by the user via form()
   * @param array $old_instance Old settings for this instance
   * @return array Settings to save or bool false to cancel saving
   */
  function update( $new_instance, $old_instance ) {

    $new_instance['title']          = strip_tags( $new_instance['title'] );
    if ( ! empty( $new_instance['nav_menu'] ) ) {
      $instance['nav_menu'] = (int) $new_instance['nav_menu'];
    }

    return $new_instance;

  }

  /**
   * Echo the settings update form.
   *
   * @param array $instance Current settings
   */
  function form( $instance ) {

    //* Merge with defaults
    $instance = wp_parse_args( (array) $instance, $this->defaults );

    // Get menus
    $menus = wp_get_nav_menus();

    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'gebruikercentraal' ); ?>:</label>
      <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
      <select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
        <option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
    <?php
      foreach ( $menus as $menu ) {
        echo '<option value="' . $menu->term_id . '"'
          . selected( $nav_menu, $menu->term_id, false )
          . '>'. esc_html( $menu->name ) . '</option>';
      }
    ?>
      </select>
    </p>

    <?php

  }

}

//====
