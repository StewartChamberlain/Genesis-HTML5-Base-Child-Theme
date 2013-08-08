<?php
/*
* Child Theme Name: HTML5 Base Theme for Genesis 2.0
* Author: Stewart Chamberlain
* Url: http://stewartchamberlain.com/
*/

/************* REGISTER CHILD THEME (You can Change This) *************/

define( 'CHILD_THEME_NAME', 'HTML5 Base Theme for Genesis 2.0' );
define( 'CHILD_THEME_URL', 'http://stewartchamberlain.com/' );


/************* THEME SETUP TIME *************/


// Activate the child theme
add_action('genesis_setup','sc_theme_setup', 15);

// we're putting all our core stuff in this function.
function sc_theme_setup() {

	// Clean up wordpress and genesis and add things like our stylesheets and javascript libraries.
	include_once( CHILD_DIR . '/lib/child_setup.php'); // Required Do Not Delete.
 
	// Holds all our base child functions
	include_once( CHILD_DIR . '/lib/child_theme_functions.php');

	// Holds all our admin functions
	include_once( CHILD_DIR . '/lib/admin_functions.php'); 

	// Don't update theme (it's custom right? so you don't need updates)
	add_filter( 'http_request_args', 'sc_dont_update', 5, 2 );


/************* THEME SUPPORT *************/
	
	// Turn On HTML5 Markup @since GENESIS 2.0 final
	add_theme_support( 'html5' );
	
	// Add structural support
	//add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );
	
	// adding custom background support
	//add_theme_support( 'custom-background' );
	
	// adding support for post format images
	//add_theme_support( 'genesis-post-format-images' );

	// adding custom header support (change width if you change the width of the container)
	//add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 90 ) );
	
	// Menus
	add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menu', 'secondary' => 'Secondary Navigation Menu' ) );
	
	// Reposition the navigation
	//remove_action( 'genesis_after_header', 'genesis_do_nav' );
	//remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	
	//add_action( 'genesis_header', 'genesis_do_nav' );	
	//add_action( 'genesis_footer', 'genesis_do_subnav' );
	
	
/************* UNREGISTER LAYOUTS AND WIDGETS *************/	

	//genesis_unregister_layout( 'content-sidebar' );
	//genesis_unregister_layout( 'sidebar-content' );
	//genesis_unregister_layout( 'content-sidebar-sidebar' );
	//genesis_unregister_layout( 'sidebar-sidebar-content' );
	//genesis_unregister_layout( 'sidebar-content-sidebar' );
	//genesis_unregister_layout( 'full-width-content' );
	
	// Remove Genesis Widgets 
	add_action( 'widgets_init', 'sc_remove_genesis_widgets', 20 ); // To remove specfic widgets see "/lib/admin_functions.php"
	

/************* <HEAD> ELEMENTS *************/

	// remove default stylesheet
	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	
	// enqueue base scripts and styles
	add_action('wp_enqueue_scripts', 'sc_scripts_and_styles', 999); // See "/lib/child_theme_setup.php"
	
	// ie conditional wrapper
	add_filter( 'style_loader_tag', 'sc_ie_conditional', 10, 2 );
	
	// Add viewport meta tag for mobile browsers @since GENESIS 2.0
	add_theme_support( 'genesis-responsive-viewport' );

	// Change favicon location 
	add_filter( 'genesis_pre_load_favicon', 'sc_custom_favicon_location' );
	
	
/************* CLEANING <HEAD> *************/
	
	// Remove rsd link
	remove_action( 'wp_head', 'rsd_link' );                    
	// Remove Windows Live Writer
	remove_action( 'wp_head', 'wlwmanifest_link' );                       
	// Remove index link
	remove_action( 'wp_head', 'index_rel_link' );                         
	// Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
	// Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
	// Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
	// Remove WP version
	remove_action( 'wp_head', 'wp_generator' );  
	// Remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'sc_remove_wp_widget_recent_comments_style', 1 );
	// Clean up comment styles in the head
	add_action('wp_head', 'sc_remove_recent_comments_style', 1 );
	// Remove version number from js and css
	if (!is_admin() || !is_admin_bar_showing()){
	add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
	}	


/************* CHILD THEME IMAGE SIZES *************/
/* 
	* To add more sizes, simply copy a line from below and change the dimensions & name.
	  As long as you upload a "featured image" as large as the biggest set width or height,
	  all the other sizes will be auto-cropped.
		
	* To call a different size, simply change the text inside the thumbnail function.
		
	* For example, to call the 225 x 225 sized image, we would use the function:
	  <?php the_post_thumbnail( 'sc_medium_img' ); ?>
		
	* You can change the names and dimensions to whatever you like.
*/

	//add_image_size( 'sc_large_img', 620, 240, TRUE );
	//add_image_size( 'sc_medium_img', 225, 225, TRUE );
	//add_image_size( 'sc_small_img', 45, 45, TRUE );
	

/*************CONTENT AREA *************/

	// Remove p around images
	add_filter( 'the_content', 'sc_filter_ptags_on_images' );
	// Clean up gallery output in wp
	add_filter( 'gallery_style', 'sc_gallery_style' );


/************* SIDEBARS AND WIDGETS *************/

	// Remove Sidebars
	//unregister_sidebar( 'header-right' );
	//unregister_sidebar( 'sidebar' );
	//unregister_sidebar( 'sidebar-alt' );

	// Home page widgets
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-full',
		'name'			=> __( 'Home Featured Full', 'html5basetheme' ),
		'description'	=> __( 'This is the featured section if you want full width.', 'html5basetheme' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-left',
		'name'			=> __( 'Home Featured Left', 'html5basetheme' ),
		'description'	=> __( 'This is the featured section left side.', 'html5basetheme' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-featured-right',
		'name'			=> __( 'Home Featured Right', 'html5basetheme' ),
		'description'	=> __( 'This is the featured section right side.', 'html5basetheme' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-1',
		'name'			=> __( 'Home Middle 1', 'html5basetheme' ),
		'description'	=> __( 'This is the home middle left section.', 'html5basetheme' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-2',
		'name'			=> __( 'Home Middle 2', 'html5basetheme' ),
		'description'	=> __( 'This is the home middle center section.', 'html5basetheme' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-middle-3',
		'name'			=> __( 'Home Middle 3', 'html5basetheme' ),
		'description'	=> __( 'This is the home middle right section.', 'html5basetheme' ),
	) );
	genesis_register_sidebar( array(
		'id'			=> 'home-bottom',
		'name'			=> __( 'Home Bottom', 'html5basetheme' ),
		'description'	=> __( 'This is the home bottom section.', 'html5basetheme' ),
	) );


/************* FOOTER AREA *************/

	// custom back to top text
	add_filter( 'genesis_footer_backtotop_text', 'sc_backtotop_text' );
	// footer credit & attribution text
	add_filter( 'genesis_footer_creds_text', 'sc_footer_cred' );

	/*
	if you want to add widgets to your footer, you can use this function
	*/
	add_theme_support( 'genesis-footer-widgets', 3 );


} /* DO NOT DELETE (YOUR CHILD THEME WILL IMPLODE!) */


?>