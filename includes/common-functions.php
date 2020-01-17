<?php

///
// Gebruiker Centraal - common-functions.php
// ----------------------------------------------------------------------------------
// Gedeelde code tussen gebruiker-centraal en optimaal-digitaal
// ----------------------------------------------------------------------------------
// @package gebruiker-centraal
// @author  Paul van Buuren
// @license GPL-2.0+
// @version 3.27.10
// @desc.   Beeldbank-logo toegevoegd. Logo GC gewijzigd naar eentje met de nieuwe ava van Edo. <3 Edo!
// @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///



// Geen footer
remove_action( 'genesis_footer', 'genesis_do_footer' );

//========================================================================================================

// Add the site search form
add_action( 'genesis_header_right', 'gc_wbvb_get_search_form' );

function gc_wbvb_get_search_form( ) {

	$acfshowsearchform		= get_field('site_option_show_search_in_header', 'option');
	if ( 'nee' == $acfshowsearchform ) {
		// no search form in header
	}
	else {
		if ( is_search() || is_404() ) {
			// do nothing
		}
		else {
			echo get_search_form();
		}
	}
}

//========================================================================================================

add_filter( 'get_search_form', 'gc_wbvb_add_id_to_search_form', 21 );

function gc_wbvb_add_id_to_search_form( $form ) {

	return apply_filters( 'genesis_search_form', str_replace("<form", '<form tabindex="-1" id="' . ID_ZOEKEN . '" ', $form) );

}

//========================================================================================================

//* Customize search form input box text
add_filter( 'genesis_search_text', 'gc_wbvb_searchform_text' );

function gc_wbvb_searchform_text( $text ) {

	return esc_attr( _x( "Search...", 'search', 'gebruikercentraal' ) );

}

//========================================================================================================

//* Customize search form label
add_filter( 'genesis_search_form_label', 'gc_wbvb_searchform_label' );

function gc_wbvb_searchform_label ( $text ) {

	return esc_attr( _x( "Search within this site", 'search', 'gebruikercentraal' ) );

}

//========================================================================================================

add_filter( 'genesis_do_nav', 'gc_wbvb_append_attributes_main_nav', 10, 3 );

function gc_wbvb_append_attributes_main_nav($nav_output, $nav, $args) {

    if( 'primary' == $args['theme_location'] ) {

        $vind       = 'class="wrap"';
        $vervang    = 'tabindex="-1" id="' . ID_MAINNAV . '"';
        $hooiberg   = $nav_output;
        $nav_output = str_replace($vind, $vervang, $hooiberg);

    }

  return apply_filters( 'genesis_nav', $nav_output );

}

//========================================================================================================

/**
 * Adds "inner" id to the site-inner content/sidebar wrap element on HTML5 child themes.
 * Using inner, since Genesis uses this id when HTML5 is disabled.
 * @param  array $attributes Array of element attributes
 * @return array             Same array of element attributes with the id added
 */
function gc_wbvb_append_attributes_site_inner( $attributes ) {
    $attributes['id'] = ID_MAINCONTENT;
    $attributes['tabindex'] = "-1";
    return $attributes;
}

add_filter( 'genesis_attr_site-inner', 'gc_wbvb_append_attributes_site_inner', 15 );


//========================================================================================================

if ( !function_exists( 'showdebug' ) ) {

  function showdebug($file = '', $extra = '') {

    if ( WP_THEME_DEBUG && WP_DEBUG ) {

      $break = Explode('/', $file);
      $pfile = $break[count($break) - 1];

      echo '<hr><span class="debugmessage" title="' . $file . '">' . $pfile;
      if ( $extra ) {
        echo ' - ' . $extra;
      }
      echo '<br/>R: ' . WP_THEME_DEBUG . ' / D: ' .  WP_DEBUG;
      echo '</span>';
    }
  }

}

//========================================================================================================

function my_deregister_styles() {

    // remove the event manager style sheet
    wp_dequeue_style('events-manager');
    wp_dequeue_style('em_enqueue_styles');

    // alle contact form 7 meuk, preventief
    wp_dequeue_style('contact-form-7');
    wp_dequeue_style('contact-form-7-rtl');

    // alle Buddypress meuk
    wp_dequeue_style('bp-legacy-css');
    wp_dequeue_style('bp-mentions-css');
    wp_dequeue_style('bp-admin-bar');

    // wordpress-social-login
    wp_dequeue_style('wsl-widget');

}

add_action( 'wp_enqueue_scripts', 'my_deregister_styles', 100 );

//========================================================================================================

function my_login_logo() {

    if ( in_array( $_SERVER['PHP_SELF'], array( '/wp-login.php', '/wp-register.php' ) ) ){
      wp_enqueue_style( 'google-font-montserrat', '//fonts.googleapis.com/css?family=Montserrat', array(), CHILD_THEME_VERSION );
      wp_enqueue_style( 'login-form', get_stylesheet_directory_uri() . '/css/login-form.css', array(), CHILD_THEME_VERSION );
    }
}

add_action( 'login_enqueue_scripts', 'my_login_logo' );


//========================================================================================================
/* image sizes
*/

function add_defer_to_javascripts( $url )
{
    if ( is_admin() ) {
        return $url;
    }
    else {

        $huidigeurl = $_SERVER['REQUEST_URI'];

        if ( ( strpos( $huidigeurl, "group-avatar" ) > 0 )
                || ( strpos( $huidigeurl, "customize.php" ) > 0 )
                || ( strpos( $huidigeurl, "change-avatar" ) > 0 )  ){
            // vuige hack om te voorkomen dat ik buddypress moet herschrijven.
            // dit gaat om het croppen van een plaatje voor een ava.
            // zie: <buddypress>/bp-core/bp-core-cssjs.php
            // add_action( 'wp_head', 'bp_core_add_cropper_inline_js' );

            // geen defer toevoegen als we een avatar uploaden, dus:
            return $url;

        }
        else {
            if ( // comment the following line out add 'defer' to all scripts
                FALSE === strpos( $url, 'jquery.js' ) or
                FALSE === strpos( $url, '.js' )
            )
            { // not our file
                return $url;
            }

            return "$url' defer='defer";


        }
    }


}

//add_filter( 'clean_url', 'add_defer_to_javascripts', 11, 1 );



//========================================================================================================
/*
Changing Genesis H1 Post Titles to H2
https://gist.github.com/nairnwebdesign/8157035
*/

//add_filter( 'genesis_post_title_output', 'ac_post_title_output', 15 );

function ac_post_title_output( $title ) {
//    if ( is_home() || is_archive() )

    if ( is_search() || is_archive() ) {
        $title = sprintf( '<h3><a href="' . get_permalink() . '">%s</a></h3>', apply_filters( 'genesis_post_title_text',get_the_title() ) );
    }
    else {
        $title = sprintf( '<h1><a href="' . get_permalink() . '">%s</a></h1>', apply_filters( 'genesis_post_title_text',get_the_title() ) );
    }
    return $title;
}


//========================================================================================================

/*
 * Modifying TinyMCE editor to remove unused items.
*/

function admin_set_tinymce_options( $settings ) {
    $settings['theme_advanced_blockformats']  = 'p,h2,h3,h4,h5,h6,q,hr';
    $settings['theme_advanced_disable']       = 'underline,spellchecker,forecolor,justifyfull';
    $settings['theme_advanced_buttons2_add']  = 'styleselect';

    // ============

    $settings['toolbar1'] = 'italic,|,bullist,numlist,blockquote,|,link,unlink,|,spellchecker,|,formatselect,styleselect,paste,removeformat,cleanup,|,undo,redo,hr,fullscreen';
    $settings['toolbar2'] = '';
//    $settings['block_formats'] = 'Tussenkop niveau 2=h2;Tussenkop niveau 3=h3;Tussenkop niveau 4=h4;Paragraaf=p;Citaat=q';
//    $settings['block_formats'] = 'Header H2 =h2;Header H3=h3;Header H4=h4;Paragraph=p;Quote=q';

    $settings['style_formats'] = '[
            {title: "Streamer", block: "aside", classes: "pullquote"},
            {title: "Infoblok", block: "div", classes: "infoblock"},
            {title: "Call To Action (primair)", block: "div", classes: "call-to-action"},
            {title: "Call To Action (50% breed)", block: "div", classes: "call-to-action floatright"},
            {title: "Call To Action (secundair)", block: "div", classes: "call-to-action secondary"},
    ]';

//        {title: "Interviewvraag", inline: "i", classes: "interview"}

    return $settings;
}

add_filter('tiny_mce_before_init', 'admin_set_tinymce_options');

//========================================================================================================

/**
 *  Remove the h1 tag from the WordPress editor.
 *
 *  @param   array  $settings  The array of editor settings
 *  @return  array             The modified edit settings
 */
function remove_h1_from_editor( $settings ) {
  $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
  return $settings;
}


add_filter('tiny_mce_before_init', 'remove_h1_from_editor');

//========================================================================================================

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
  //is there a user to check?
  global $user;
  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
    //check for admins
    if ( in_array( 'administrator', $user->roles ) ) {
      // redirect them to the default place
      return $redirect_to;
    } else {
      return home_url();
    }
  } else {
    return $redirect_to;
  }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
//========================================================================================================


add_filter( 'genesis_after', 'write_analytics_code', 999 );

function write_analytics_code() {


  if ( 'gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] || 'www.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] ) {

        echo '<!-- Piwik -->
            <script type="text/javascript">
              var _paq = _paq || [];
              _paq.push(["setDoNotTrack", true]);
              _paq.push(["enableLinkTracking"]);
              _paq.push([\'setLinkTrackingTimer\', 750]);
              _paq.push(["trackPageView"]);
              (function() {
                var u=(("https:" == document.location.protocol) ? "https" :
            "http") + "://statistiek.rijksoverheid.nl/piwik/";
                _paq.push(["setTrackerUrl", u+"piwik.php"]);
                _paq.push(["setSiteId", "219"]);
                var d=document, g=d.createElement("script"),
            s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
                g.defer=true; g.async=true; g.src=u+"piwik.js";
            s.parentNode.insertBefore(g,s);
              })();
            </script>
            <!-- End Piwik Code -->';
    }
  elseif ( 'optimaaldigitaal.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] || 'www.optimaaldigitaal.nl' == $_SERVER["HTTP_HOST"]  || 'optimaaldigitaal.nl' == $_SERVER["HTTP_HOST"] ) {
        echo '<!-- Piwik -->
      <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push([\'trackPageView\']);
      _paq.push([\'enableLinkTracking\']);
      (function() {
      var u="//statistiek.rijksoverheid.nl/piwik/";
      _paq.push([\'setTrackerUrl\', u+\'/js/tracker.php\']);
      _paq.push([\'setSiteId\', 519]);
      var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];
      g.type=\'text/javascript\'; g.async=true; g.defer=true; g.src=u+\'piwik.js\'; s.parentNode.insertBefore(g,s);
      })();
      </script>
      <noscript><p><img src="//statistiek.rijksoverheid.nl/piwik//js/tracker.php?idsite=519" style="border:0;" alt="" /></p></noscript>
      <!-- End Piwik Code -->​​';
    }
    else {
        if ( WP_DEBUG ) {
          echo '<!-- Geen Piwik: ' . $_SERVER["HTTP_HOST"] . '-->';
        }
    }
}


//========================================================================================================

/**
 * Default Category Title
 *
 * @author Bill Erickson
 * @url http://www.billerickson.net/default-category-and-tag-titles
 *
 * @param string $headline
 * @param object $term
 * @return string $headline
 */
function gc_wbvb_default_category_title( $headline, $term ) {
  if( ( is_category() || is_tag() || is_tax() ) && empty( $headline ) )
    $headline = $term->name;

  return $headline;
}
add_filter( 'genesis_term_meta_headline', 'gc_wbvb_default_category_title', 10, 2 );


//========================================================================================================

//
/**
 * Get post excerpt by ID
 *
 * @url http://fullrefresh.com/2013/08/02/getting-a-wp-post-excerpt-outside-the-loop-updated/
 *
 * @param string $post_id
 * @param int $excerpt_length
 * @param bool $line_breaks
 * @return string $the_excerpt
 */

function gc_wbvb_excerpt_by_id($post_id, $excerpt_length = 35, $line_breaks = TRUE){

    //Gets post ID
    $the_post = get_post($post_id);

    //Gets post_excerpt or post_content to be used as a basis for the excerpt
    $type           = get_post_type( $post_id );

    if ( 'post' == $type ) {
        $the_excerpt    = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content;
    }
    else if ( 'page' == $type ) {

        $the_excerpt    = $the_post->post_content;
    }


    $the_excerpt    = apply_filters('the_excerpt', $the_excerpt);
    $the_excerpt    = $line_breaks ? strip_tags(strip_shortcodes($the_excerpt), '<p><br>') : strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words          = explode(' ', $the_excerpt, $excerpt_length + 1);
    if ( count($words) > $excerpt_length ) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
        $the_excerpt = $line_breaks ? $the_excerpt . '</p>' : $the_excerpt;
    endif;

    $the_excerpt = trim($the_excerpt);

    return $the_excerpt;
}

//========================================================================================================
function gc_wbvb_related_content( $thepost ) {

    $type = get_post_type( $thepost->ID );

    if ( 'post' == $type ) {
        $samenvatting = gc_wbvb_excerpt_by_id( $thepost->ID );
    }
    else if ( 'event' == $type ) {
        $samenvatting = gc_wbvb_excerpt_by_id( $thepost->ID );
    }
    else if ( 'page' == $type ) {
        $samenvatting = get_field( 'samenvatting', $thepost->ID );
        if ( empty( $samenvatting ) ) {
            $samenvatting = gc_wbvb_excerpt_by_id( $thepost->ID );
        }
    }
    ?>
    <section class="<?php echo $type; ?>">
        <a href="<?php echo get_permalink( $thepost->ID ); ?>">
            <h3><?php echo get_the_title( $thepost->ID ); ?></h3>
            <?php
            if ( ! empty( $samenvatting ) ) {
                echo  wpautop( $samenvatting );
            }
            ?>
            <div class="read-more"><span><?php echo __( "Read more", 'gebruikercentraal' ) ?></span></div>
        </a>
    </section>

<?php


}

//========================================================================================================

function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','remove_comment_fields');

//========================================================================================================

add_filter( 'genesis_title_comments', 'sp_genesis_title_comments' );
function sp_genesis_title_comments() {
  $title = '<h2>' . _x('Comments','comment title', 'gebruikercentraal') . '</h2>';
  return $title;
}
//========================================================================================================

add_filter('cancel_comment_reply_link', 'gc_wbvb_remove_cancel_reply_link', 10, 3);

function gc_wbvb_remove_cancel_reply_link($formatted_link, $link, $text){
    return '';
}

//========================================================================================================

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'sp_remove_comment_form_allowed_tags' );

function sp_remove_comment_form_allowed_tags( $defaults ) {

  $commenter  = wp_get_current_commenter();
  $req        = get_option( 'require_name_email' );
  $aria_req   = ( $req ? ' required aria-required="true"' : '' );

  $defaults['title_reply'] = __('Join the discussion','gebruikercentraal');

  $defaults['comment_field']          = '<p class="comment-form-comment"><label for="comment">' . _x( 'Your reply', 'reactieformulier', 'gebruikercentraal' ) .    '</label><textarea id="comment" name="comment" cols="45" rows="8"' . $aria_req . '>' .    '</textarea></p>';

  $defaults['fields'] = array(

        'author' =>
            '<p class="comment author"><label for="author">' . _x( 'Your name', 'reactieformulier', 'gebruikercentraal' ) . '</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30"' . $aria_req . ' /></p>',

        'email' =>
            '<p class="comment email"><label for="email">' . _x( 'Email address', 'reactieformulier', 'gebruikercentraal' ) . '</label> ' .
            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30"' . $aria_req . ' /></p>'
        );

  $defaults['must_log_in']            = '';
  $defaults['comment_notes_after']    = '';
  $defaults['comment_notes_before']   = '';
  $defaults['label_submit']           = __('Reply','gebruikercentraal');

  return $defaults;

}


//========================================================================================================


function disable_bar_search() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('search');
}
add_action( 'wp_before_admin_bar_render', 'disable_bar_search' );

//========================================================================================================

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function be_remove_genesis_page_templates( $page_templates ) {

//    echo '<pre>';
//    var_dump($page_templates);
//    echo '</pre>';

  unset( $page_templates['page_archive.php'] );
  unset( $page_templates['page_blog.php'] );
  unset( $page_templates['404.php'] );
  return $page_templates;
}

add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );


//========================================================================================================
// HT: http://joshuadnelson.com/code/remove-genesis-entry-title-link/
add_filter( 'genesis_post_title_output', 'jdn_custom_post_title' );
function jdn_custom_post_title( $title ) {


  if( get_post_type( get_the_ID() ) == 'post' && ( !is_single() ) ) {
    $post_title = get_the_title( get_the_ID() );
    $title = '<h2 class="entry-title" itemprop="headline">' . $post_title . '</h2>';
  }

  return $title;

}

//========================================================================================================

add_filter( 'genesis_comment_list_args', 'child_comment_list_args' );
/**
 * Change Avatar size.
 *
 * @author Greg Rickaby
 */
function child_comment_list_args( $args ) {
  return array( 'type' => 'comment', 'avatar_size' => 42, 'callback' => 'genesis_comment_callback' );
}
//========================================================================================================

//* Remove the post image (requires HTML5 theme support)

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//========================================================================================================
//* Display a custom Gravatar
add_filter( 'avatar_defaults', 'gc_shared_gravatar' );

//========================================================================================================

if ( !function_exists( 'gc_shared_gravatar' ) ) {

  function gc_shared_gravatar ($avatar) {

    $custom_avatar = WBVB_THEMEFOLDER . '/images/gravatar.png';
    $avatar[$custom_avatar] = "Custom Gravatar";
    return $avatar;

  }

}

//========================================================================================================
/** Conditional html element classes */
//remove_action( 'genesis_doctype', 'genesis_do_doctype' );
//add_action( 'genesis_doctype', 'gc_wbvb_set_doctype' );
function gc_wbvb_set_doctype() {
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html class="ie6" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <?php
}





//========================================================================================================

//* Password reset activation E-mail -> Body
add_filter( 'retrieve_password_message', 'gc_shared_retrieve_password_message', 10, 2 );

//========================================================================================================

if ( !function_exists( 'gc_shared_retrieve_password_message' ) ) {

  function gc_shared_retrieve_password_message( $message, $key ){

    $user_data = '';
    $blog_title       = get_bloginfo( 'name' );

    // If no value is posted, return false
    if( ! isset( $_POST['user_login'] )  ){
      return '';
    }

    // Fetch user information from user_login
    if ( strpos( $_POST['user_login'], '@' ) ) {
      $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
    }
    else {
      $login = trim($_POST['user_login']);
      $user_data = get_user_by('login', $login);
    }

    if( ! $user_data  ){
      return '';
    }

    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $hostname  = network_site_url();

    // Setting up message for retrieve password
    $message = _x( "Hallo,", 'begroeting inlogmail', 'gebruikercentraal' );
    $message .= "\n\n";
    $message .= _x( "We kregen via de website het verzoek om een nieuw wachtwoord te sturen voor het account met de inlognaam:", 'inlogmail', 'gebruikercentraal' );
    $message .= "\n" . $user_login;
    $message .= "\n\n";
    $message .= _x( "Om je wachtwoord opnieuw in te stellen, klik je op deze link:", 'inlogmail', 'gebruikercentraal' );
    $message .= "\n";
    $message .= site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
    $message .= "\n";

    $message .= _x( "Deze link is maar 1 keer te gebruiken.", 'inlogmail', 'gebruikercentraal' );
    $message .= "\n";
    $message .= _x( "Als je geen nieuw wachtwoord wilt, hoef je niets te doen.", 'inlogmail', 'gebruikercentraal' );
    $message .= "\n";
    $message .= "\n";

    $message .= _x( "Met vriendelijke groet,", 'afsluiting inlogmail', 'gebruikercentraal' );
    $message .= "\n";
    $message .=  _x( "het Gebruiker Centraal-team", 'afsluiting inlogmail', 'gebruikercentraal' );
    $message .= "\n";

    // Return completed message for retrieve password
    return $message;

  }

}

//========================================================================================================

function gc_shared_add_debug_css() {

  if ( WP_THEME_DEBUG && WP_DEBUG ) {

    wp_enqueue_style( 'debug-header-check', WBVB_THEMEFOLDER . '/css/header.css', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( 'debug-css', WBVB_THEMEFOLDER . '/css/revenge.css', array(), CHILD_THEME_VERSION );

  }

}

//========================================================================================================

//* Add class to .site-header
add_filter('genesis_attr_title-area', 'gc_add_siteclass');

function gc_add_siteclass($attributes) {
	$class 		= "gebruikercentraal";

	if ( 'conference.gebruikercentraal.co.uk' == $_SERVER["HTTP_HOST"] || 'accept.conference.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] || 'conference.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] ) {
		$class 		= "gebruikercentraal";
	} elseif ( 'rotterdammer.gebruikercentraal.co.uk' == $_SERVER["HTTP_HOST"] || 'accept.rotterdammer.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] || 'rotterdammer.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] ) {
		$class = "rotterdammercentraal";
	} elseif ( 'inclusie.gebruikercentraal.co.uk' == $_SERVER["HTTP_HOST"] || 'accept.inclusie.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] || 'inclusie.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] ) {
		$class = "inclusie";
	} elseif ( 'beeldbank.gebruikercentraal.co.uk' == $_SERVER["HTTP_HOST"] || 'accept.beeldbank.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] || 'beeldbank.gebruikercentraal.nl' == $_SERVER["HTTP_HOST"] ) {
		$class = "beeldbank";
	}
//		$class = "rotterdammercentraal";
//		$class = "inclusie";
//		$class = "gebruikercentraal";


	if ( isset( $attributes['class'] ) ) {
		$attributes['class'] .= ' ' . $class;
	}
	else {
		$attributes['class'] = $class;
	}

	return $attributes;

}


//========================================================================================================

//* Add class to .site-heade
//add_filter('genesis_attr_site-footer', 'gc_add_attribute_role_contentinfo');

function gc_add_attribute_role_contentinfo($attributes) {
	$attributes['role'] .= 'contentinfo';
	return $attributes;
}

//========================================================================================================

add_action( 'wp_enqueue_scripts', 'gc_shared_add_menu_script' );

function gc_shared_add_menu_script() {

	if ( ! is_admin() ) {

	  wp_enqueue_script( 'gc-shared-menu', WBVB_THEMEFOLDER . '/js/gc-main-min.js', '', '', true );


		$params = array(
			'showmenu'	=> _x( 'Show menu', 'Screen reader text for menu', 'gebruikercentraal' ),
			'closemenu'	=> _x( 'Close menu', 'Screen reader text for menu', 'gebruikercentraal' ),
			'menuname'	=> _x( 'Menu', 'Screen reader text for menu', 'gebruikercentraal' ),
		);

		wp_localize_script( 'gc-shared-menu', 'menustrings', $params );

	}

}

//========================================================================================================

function gc_shared_add_class_to_header( $attributes ) {

	$attributes['class'] .= ' js-header';
	return $attributes;

}

//========================================================================================================

//add_filter( 'genesis_attr_nav-primary', 'gc_shared_add_class_to_menu' );

function gc_shared_add_class_to_menu( $attributes ) {

	$attributes['class'] .= ' js-menu';
	return $attributes;

}

//========================================================================================================

function gc_shared_add_wrap_class($attributes) {

	$attributes['class'] .= ' wrap';
	return $attributes;

}

//========================================================================================================

function gc_shared_add_id_to_search_form( $form ) {

  $form = str_replace("<form", '<form tabindex="-1" id="' . ID_ZOEKEN . '" ', $form);

  // remove the submit button
  $tag_regex = "/<input[^>]*\btype=\"submit\"[^>]*>/i";
  $form = preg_replace( $tag_regex, '<button id="search-submit" class="searchSubmit" name="search-submit" type="submit" title="' . _x( 'Zoeken', 'label zoekknop', 'gebruikercentraal' ) . '">' . _x( 'Zoeken', 'label zoekknop', 'gebruikercentraal' ) . '</button>', $form );

  return apply_filters( 'genesis_search_form', $form );

}

//========================================================================================================
// ervoor zorgen dat specifieke Optimaal Digitaal-termen op de juiste manier afgebroken kunnen worden

if (!function_exists('od_wbvb_custom_post_title')) {
	
	function od_wbvb_custom_post_title( $title ) {
	
		$pattern      = '/erantwoordelijkh/i'; // verantwoordelijkheid
		$replacement  = 'erant&shy;woorde&shy;lijkh';
		$title        = preg_replace( $pattern, $replacement, $title );  
		
		$pattern      = '/emeenscha/i'; // gemeenschappelijk,  gemeenschap
		$replacement  = 'emeen&shy;scha';
		$title        = preg_replace( $pattern, $replacement, $title );  
		
		$pattern      = '/ersoonsge/i'; // persoonsgegevens
		$replacement  = 'ersoons&shy;ge';
		$title        = preg_replace( $pattern, $replacement, $title );  
		
		$pattern      = '/informatiev/i'; // informatieveiligheid
		$replacement  = 'informatie&shy;v';
		$title        = preg_replace( $pattern, $replacement, $title );  
		
		$pattern      = '/ortermijnd/i'; // kortetermijndenken
		$replacement  = 'ortermijn&shy;d';
		$title        = preg_replace( $pattern, $replacement, $title );  
		
		$pattern      = '/ebruiksvrien/i';
		$replacement  = 'ebruiks&shy;vrien';
		$title        = preg_replace( $pattern, $replacement, $title );  
		
		return $title;
	
	}
	
}

//========================================================================================================


//========================================================================================================
