<?php

///
// * Gebruiker Centraal - includes/components/home_template_teasers.php
// * ----------------------------------------------------------------------------------
// * Component #home_template_teasers on homepage for inclusie & beeldbank
// * ----------------------------------------------------------------------------------
// * @package gebruiker-centraal
// * @author  Paul van Buuren
// * @license GPL-2.0+
// * @since   4.1.4
// * @version 4.1.4
// * @desc.   Moved section home_template_teasers functions and styling from inlusie plugin to theme.
// * @link    https://github.com/ICTU/gebruiker-centraal-wordpress-theme
///




//========================================================================================================

if ( !function_exists( 'ictu_gctheme_frontend_home_template_teasers' ) ) :


	/**
	 * Display a set of links to related content or a set of links to external sites
	 *
	 * This function either returns an array with links, or returns an HTML string, or echoes HTML string.
	 * Can return 2 type of blocks:
	 * 1. block with items for 'gerelateerde_content_toevoegen'. This is a block with content from the local site.
	 * 2. block with items for 'handige_links_toevoegen'. This is a block with links to externas sites.
	 *
	 * @since 4.1.4
	 *
	 * @param object $post The post object
	 *
	 */

	function ictu_gctheme_frontend_home_template_teasers( $post = [] ) {
	
	    global $post;
	
	    if (function_exists('get_field')) {
	
	        $home_teasers = get_field('home_template_teasers', $post->ID);
	
	        if (have_rows('home_template_teasers')):
	
	            echo '<div id="home_template_teasers">';
	
				$columncounter = 'grid--col-2';
				$countcount = count( $home_teasers );
			
				if ( $countcount < 2  ) {
					$columncounter = 'grid--col-1';
				}
				elseif ( $countcount === 4 ) {
					$columncounter = 'grid--col-2';
				}
				elseif ( $countcount > 2  ) {
					$columncounter = 'grid--col-3';
				}
	
	
	            echo '<div class="grid ' . $columncounter . '">';
	
	
	            // loop through the rows of data
	            while (have_rows('home_template_teasers')) : the_row();
	
	                $section_title = get_sub_field('home_template_teaser_title');
	                $section_text = get_sub_field('home_template_teaser_text');
	                $section_link = get_sub_field('home_template_teaser_link');
	                $title_id = sanitize_title($section_title);
	
	                echo '<section aria-labelledby="' . $title_id . '" class="card no-image">';
	                echo '<h2 id="' . $title_id . '">' . $section_title . '</h2>';
	                echo $section_text;
	                if ($section_link) {
	                    echo '<p class="home_template_teaser_link"><a href="' . $section_link['url'] . '" class="cta">' . $section_link['title'] . '</a></p>';
	                }
	                echo '</section>';
	
	            endwhile;
	            echo '</div>';
	            echo '</div>';
	
	        endif;
	
	    }
	}


endif;

//========================================================================================================
