<?php 
/*
* Single Post Template
*
* Child Theme Name: HTML5 Base Theme for Genesis 2.0
* Author: Stewart Chamberlain
* Url: http://stewartchamberlain.com/
*
* This is where all your single post functions
* need to go, anything specfic to a single post.
*/


/************* CUSTOMIZE THE POST INFO *************/

// Remove the post info function and/or reposition
//remove_action( 'genesis_entry_header', 'genesis_post_info' );
//add_action( 'genesis_entry_header', 'genesis_post_info', 2 );

// Customize the post info function
//add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
$post_info = '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';
return $post_info;
}

/************* CUSTOMIZE THE POST META *************/

// Remove the post meta function and/or reposition 
//remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
//add_action( 'genesis_entry_header', 'genesis_post_meta' );

// Customize the post meta function 
//add_filter( 'genesis_post_meta', 'post_meta_filter' );
function post_meta_filter($post_meta) {
$post_meta = '[post_categories before="Filed Under: "] [post_tags before="Tagged: "]';
return $post_meta;
}


/************* OTHER POST FUNCTIONS *************/

// Add post navigation *note HTML5 Support needs to be on in functions.php*
add_action( 'genesis_after_entry_content', 'genesis_prev_next_post_nav', 5 );


genesis();