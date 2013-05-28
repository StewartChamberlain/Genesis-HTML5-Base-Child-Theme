/*
* Child Theme Name: HTML5 Base Theme for Genesis 2.0
* Author: Stewart Chamberlain
* Url: http://stewartchamberlain.com/

This file should contain any js scripts you want to add to the site.
You can add it in the Genesis admin too, but sometimes that can
get a bit jumbled and it's tough once you have a lot going on.
Use this file to better manage your scripts.

*/

// Modernizr.load to load scripts for older browsers
Modernizr.load([
	{
    // If the browser doesn't support border-radius ()
    test : Modernizr.borderradius,
    // then load this script
    nope : []
	}

	/*
	for a list of supported Modernizr tests, view the docs:
	http://www.modernizr.com/docs/#s2
	for a full chart of what browsers support what, check out this link:
	http://www.findmebyip.com/litmus/
	*/
]);

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it so, be sure to research and find the one
    that works for you best.
    */
    
    /* getting viewport width */
    var responsive_viewport = $(window).width();
    
    /* if is below 481px */
    if (responsive_viewport < 481) {
    
    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (responsive_viewport > 481) {
        
    } /* end larger than 481px */
    
    /* if is above 768px */
    if (responsive_viewport > 768) {
    
        /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
        
    }
    
    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {
        
    }
    

	// add all your scripts here

 
}); /* end of as page load scripts */