<?php
/*
Plugin Name: RSS Image
Description: Simply activate this plugin to attach featured images to their respective posts in the site feed: https://example.com/feed/. One example of why this is useful is for providing an image for social media sharing through services like Dlvr.it, Hootsuite, HubSpot, etc.
Version: 0.1
Requires at least: 5.0
Author: Bryan Hadaway
Author URI: https://calmestghost.com/
License: GPL
License URI: https://www.gnu.org/licenses/gpl.html
Text Domain: rss-image
*/

if ( !defined( 'ABSPATH' ) ) {
	http_response_code( 404 );
	die();
}

add_action( 'rss2_item', 'rssi_rss_image' );
function rssi_rss_image() {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
		$thumbnail_ID = get_post_thumbnail_id( $post->ID, 'full' );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_ID, 'full' );
		echo '<media:content xmlns:media="http://search.yahoo.com/mrss/" medium="image" type="image/jpeg" url="' . esc_url( $thumbnail[0] ) . '" width="' . esc_attr( $thumbnail[1] ) . '" height="' . esc_attr( $thumbnail[2] ) . '" />';
	}
}