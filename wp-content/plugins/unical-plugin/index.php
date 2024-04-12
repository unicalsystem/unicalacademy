<?php
/**
* Plugin Name: Unical-Plugin
* Plugin URI: https://www.unical.in/
* Description: This is the First test Plugin
* Version: 1.0
* Author: Shiva Shankar
* Author URI: https://www.unical.in/
**/

function modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">Click to Read!</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );




