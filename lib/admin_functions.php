<?php
/*
* ADMIN FUNCTIONS
*
* Child Theme Name: HTML5 Base Theme for Genesis 2.0
* Author: Stewart Chamberlain
* Url: http://stewartchamberlain.com/
*
* This file handles the admin area and functions.
* You can use this file to make changes to the
* dashboard.
*/


/************* GENESIS WIDGETS *****************/

// Remove Genesis widgets
function sc_remove_genesis_widgets() {
    unregister_widget( 'Genesis_eNews_Updates' );
    unregister_widget( 'Genesis_Featured_Page' );
	unregister_widget( 'Genesis_Featured_Post' );
	unregister_widget( 'Genesis_Latest_Tweets_Widget' );
	unregister_widget( 'Genesis_Menu_Pages_Widget' );
    unregister_widget( 'Genesis_User_Profile_Widget' );
    unregister_widget( 'Genesis_Widget_Menu_Categories' );
	   
}


/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function sc_disable_dashboard_widgets() {
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget
	//remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );  // Quick Press Widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         // Wordpress Blog
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       // Other Wordpress News

}

// removing the dashboard widgets
add_action('admin_menu', 'sc_disable_dashboard_widgets');


/************* CUSTOM DASHBOARD WIDGETS *****************/

// Below is an example dashboard widget feel free to change 
// RSS Dashboard Widget
function sc_rss_dashboard_widget() {
	if( function_exists( 'fetch_feed' )) {
		include_once( ABSPATH . WPINC . '/feed.php' );               // include the required file
		$feed = fetch_feed('http://stewartchamberlain.com/feed/rss/');        // specify the source feed
		$limit = $feed->get_item_quantity ( 7 );                      // specify number of items
		$items = $feed->get_items( 0, $limit );                      // create an array of items
	}
	if ( $limit == 0 ) echo '<div>The RSS Feed is either empty or unavailable.</div>';   // fallback message
	else foreach ( $items as $item ) : ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_date( 'j F Y @ g:i a' ); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr( $item->get_description(), 0, 200 ); ?>
	</p>
	<?php endforeach;
}

// calling all custom dashboard widgets
function sc_custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'sc_rss_dashboard_widget', 'Recently on StewartChamberlain.com', 'sc_rss_dashboard_widget' );
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}

// adding any custom widgets
add_action( 'wp_dashboard_setup', 'sc_custom_dashboard_widgets' );


/************* CUSTOM LOGIN PAGE *****************/

// calling our own login css so you can style it
function sc_login_css() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_stylesheet_directory_uri() . '/css/login.css'; ?>" type="text/css" media="all" />
<?php }

// changing the logo link from wordpress.org to your site
function sc_login_url() { return get_bloginfo( 'url' ); }

// changing the alt text on the logo to show your site name
function sc_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
//add_action( 'login_enqueue_scripts', 'sc_login_css' );
//add_filter( 'login_headerurl', 'sc_login_url' );
//add_filter( 'login_headertitle', 'sc_login_title' );


/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer
function sc_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://yoursite.com" target="_blank">Your Site Name</a></span>. Built using <a href="http://studiopress.com" target="_blank">sc for the Genesis Framework</a>.';
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'sc_custom_admin_footer' );
