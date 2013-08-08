<?php
/*
* CHILD THEME FUNCTIONS (SITEWIDE)
*
* Child Theme Name: HTML5 Base Theme for Genesis 2.0
* Author: Stewart Chamberlain
* Url: http://stewartchamberlain.com/
*
* Add any functions here that you wish to use sitewide.
*/


// Change favicon location 
function sc_custom_favicon_location( $favicon_url ) {
	return get_bloginfo(' stylesheet_directory' ).'/images/favicon.png';
}


// Change the footer credits
function sc_footer_cred( $sc_ft ) {
    $sc_ft = '&copy; ' . date("Y") . ' ' . get_bloginfo("name") .' &middot; Base Theme By <a href="http://stewartchamberlain.com">Stewart Chamberlain</a> Powered By Genesis Famework</span>.';
    return $sc_ft;
}


/*
* Custom Breadcrumbs
*
* We've added a clearfix on the breadcrumbs container, but you
* can go even more in-depth and change the text for each argument.
*/

function sc_breadcrumb_args( $args ) {
    $args['home'] = 'Home';                                    // home text
    $args['sep'] = ' &raquo; ';                                // the seperator between links
    $args['list_sep'] = ', ';                                  // Genesis 1.5 and later
    $args['prefix'] = '<div class="breadcrumb clearfix">';     // the breadcrumbs container
 	$args['suffix'] = '</div>';
    $args['heirarchial_attachments'] = true;                   // Genesis 1.5 and later
    $args['heirarchial_categories'] = true;                    // Genesis 1.5 and later
    $args['display'] = true;
    $args['labels']['prefix'] = '';
    $args['labels']['author'] = 'Archives for ';               // the author archives
    $args['labels']['category'] = 'Archives for ';             // the category archives (Genesis 1.6 and later)
    $args['labels']['tag'] = 'Archives for ';                  // the tag archives
    $args['labels']['date'] = 'Archives for ';                 // the date archives
    $args['labels']['search'] = 'Search for ';                 // the search archives
    $args['labels']['tax'] = 'Archives for ';                  // taxonomy archives
    $args['labels']['post_type'] = 'Archives for ';            // custom post type archives
    $args['labels']['404'] = 'Not found: ';                    // 404 breadcrumbs       (Genesis 1.5 and later)
    return $args;
}

?>