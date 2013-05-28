<?php
/*
* CHILD SETUP FUNCTIONS
*
* Child Theme Name: HTML5 Base Theme for Genesis 2.0
* Author: Stewart Chamberlain
* Url: http://stewartchamberlain.com/
*
* Don't delete or edit this file unless you know
* what you're doing. If you mess something up in
* here, you'll break the theme.
*/


/************* SCRIPTS & ENQEUEING *************/


// loading modernizr and jquery, and reply script
function sc_scripts_and_styles() {

    // modernizr
    wp_register_script( 'sc-modernizr', get_stylesheet_directory_uri() . '/js/modernizr.custom.min.js', array(), '2.6.2', false );
	
	// jquery
	add_action( 'wp_enqueue_scripts', 'google_jquery_enqueue', 11 );

	// register our stylesheet
	wp_register_style( 'sc-stylesheet', get_stylesheet_directory_uri() . '/style.css', array(), '', 'all' );
	
    // ie-only style sheet
    wp_register_style( 'sc-ie-only', get_stylesheet_directory_uri() . '/css/ie.css', array(), '' );

    // adding scripts file in the footer
    wp_register_script( 'sc-js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true );

    // now let's enqueue the scripts and styles into the wp_head function.
    wp_enqueue_script( 'sc-modernizr' );
	wp_enqueue_style( 'sc-stylesheet' );
    wp_enqueue_style( 'sc-ie-only' );
	wp_enqueue_script( 'sc-js' );
	
	// Enqueue jQuery from Google CDN. Uses the currently registered WordPress jQuery version.
function google_jquery_enqueue() { 
	
	// Probably not necessary if called with the 'wp_enqueue_scripts' action.
	if (is_admin()) return; 
	global $wp_scripts; 
	
	// Change  this flag to have the CDN script triggered by wp_footer instead of wp_head.
	$cdn_script_in_footer = false;
	   
	//Register jQuery from Google CDN.
	if (is_a( $wp_scripts, 'WP_Scripts' ) && isset($wp_scripts->registered['jquery'])) {
		   
		// The WordPress jQuery version. 
		$registered_jquery_version = $wp_scripts -> registered[jquery] -> ver;
		if($registered_jquery_version) {
			  
			// The jQuery Google CDN URL. Makes a check for HTTP on top of SSL/TLS (HTTPS) to make sure the URL is correct.
			$google_jquery_url = ( $_SERVER['SERVER_PORT'] == 443 ? "https" : "http") . 
			"://ajax.googleapis.com/ajax/libs/jquery/$registered_jquery_version/jquery.min.js";
	 
			// Get the HTTP header response for the this URL, and check that its ok. If ok, include jQuery from Google CDN. 
			if(200 === wp_remote_retrieve_response_code(wp_remote_head( $google_jquery_url ))) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', $google_jquery_url , false, null, $cdn_script_in_footer );
			}
		}
	}
	/* 
	Enqueue jQuery from Google if available. Fall back to the local WordPress default.
	If the local WordPress jQuery is called, it will get included in the header no 
	matter what the $cdn_script_in_footer flag is set to.
	*/
	wp_enqueue_script( 'jquery' ); 
}

    // deregister the superfish scripts
    wp_deregister_script( 'superfish' );
    wp_deregister_script( 'superfish-args' );

} /* end scripts and styles function */

// Adding the conditional wrapper around ie stylesheet
// Source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function sc_ie_conditional( $tag, $handle ) {
    if ( 'sc-ie-only' == $handle )
        $tag = '<!--[if lte IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
    return $tag;
}


/************* CLEANING UP WORDPRESS *************/


//Remove p tags form around images
function sc_filter_ptags_on_images($content){
   return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

// Remove WP version from RSS
function sc_rss_version() { return ''; }

// Remove recent comment widget styles
function sc_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
   	remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// Remove CSS from recent comments widget
function sc_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] )) {
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ));
  	}
}

// Remove CSS from gallery
function sc_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

// Remove version number from css and js
function _remove_script_version( $src ){
    if ( preg_match("(\?ver=)", $src )){
	$parts = explode( '?', $src );
	return $parts[0];
	}else{
	return $src;
	}
}

/************* OTHER SETUP FUNCTIONS *************/

/*
Fix for, if you name your child theme something that already exists in the
wordpress repo, then you may get an alert offering a "theme update"
for a theme that's not even yours.

credit: Mark Jaquith
http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
*/
function sc_dont_update( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}

?>