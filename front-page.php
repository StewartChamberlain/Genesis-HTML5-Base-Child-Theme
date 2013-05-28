<?php
/*
* Custom Front Page
*
* Child Theme Name: HTML5 Base Theme for Genesis 2.0
* Author: Stewart Chamberlain
* Url: http://stewartchamberlain.com/
*/
	
// Execute custom home page. If no widgets active, then loop
	add_action( 'genesis_meta', 'sc_custom_home_loop' );

function sc_custom_home_loop() {
	if ( is_active_sidebar( 'home-featured-full' ) || is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) || is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' ) || is_active_sidebar( 'home-bottom' ) ) {

	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	add_action( 'genesis_after_header', 'sc_home_do_featured' );		
	add_action( 'genesis_after_header', 'sc_home_do_middle' );
	add_action( 'genesis_after_header', 'sc_home_do_bottom' );
	}
}

// Home feature widget section
function sc_home_do_featured() {

	if ( is_active_sidebar( 'home-featured-full' ) || is_active_sidebar( 'home-featured-left' ) || is_active_sidebar( 'home-featured-right' ) ) {

		echo '<section id="home-featured" class="clearfix"><div class="wrap">';

			genesis_widget_area( 'home-featured-full', array(
				'before' => '<main class="home-featured-full">',
				'after' => '</main>',
			) );

		echo '<section id="home-featured-halves">';

			genesis_widget_area( 'home-featured-left', array(
				'before' => '<aside class="home-featured-left one-half first">',
				'after' => '</aside>',
			) );

			genesis_widget_area( 'home-featured-right', array(
				'before' => '<aside class="home-featured-right one half">',
				'after' => '</aside>',
			) );

		echo '</section><!-- end home-featured-halves --></div><!-- end wrap --></section><!-- end home-featured -->'."\n";
	}	
}


// Home middle widget section

function sc_home_do_middle() {

	if ( is_active_sidebar( 'home-middle-1' ) || is_active_sidebar( 'home-middle-2' ) || is_active_sidebar( 'home-middle-3' )  ) {								

		echo '<section id="home-middle" class="clearfix"><div class="wrap">';

			genesis_widget_area( 'home-middle-1', array(
				'before' => '<aside class="home-middle-1 widget-area">',
				'after' => '</aside>',
			) );

			genesis_widget_area( 'home-middle-2', array(
				'before' => '<aside class="home-middle-2 widget-area">',
				'after' => '</aside>',
			) );
			
			genesis_widget_area( 'home-middle-3', array(
				'before' => '<aside class="home-middle-3 widget-area">',
				'after' => '</aside>',

			) );									

		echo '</div><!-- end wrap --></section><!-- end home-middle -->'."\n";			
	}		
}




// Home bottom widget section

function sc_home_do_bottom() {

	if ( is_active_sidebar( 'home-bottom' ) ) {								

		echo '<section id="home-bottom" class="clearfix"><div class="wrap">';

			genesis_widget_area( 'home-bottom', array(
				'before' => '<aside class="home-bottom">',
			) );

		echo '</div><!-- end .wrap --></section><!-- end #home-bottom -->'."\n";
	}
}

genesis();