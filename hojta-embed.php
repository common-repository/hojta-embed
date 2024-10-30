<?php
/*
Plugin Name: Hojta.se
Plugin URI:  https://wordpress.org/plugins/hojta-embed/
Description: Embed auction ads from hojta.se into your WordPress site. Simply copy and paste the embed url provided on hojta.se into the eordpress editor and the auction ad will be loaded automatically.
Version:     1.0
Author:      Hojta.se
Author URI:  https://www.hojta.se/
*/

/*
 * Prevent direct access to the file.
 */
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

/*
 * Hojta embed
 * Register embed handler
 */
function hojta_embed_handler( $matches, $attr, $url, $rawattr )
{
	$ad_id   = esc_attr( $matches[1] );
	$embed_code = '<script>!function(e,t,a,n,c,r,u){e._ha||(c=e._ha=function(){var currentScript=document.currentScript||function(){var t=document.getElementsByTagName("script");return t[t.length-1]}();[].splice.call(arguments,1,0,currentScript),c.callMethod?c.callMethod.apply(c,arguments):c.queue.push(arguments)},c.queue=[],r=t.createElement(a),r.async=!0,r.src=n,u=t.getElementsByTagName(a)[0],u.parentNode.insertBefore(r,u))}(window,document,"script","https://www.hojta.se/scripts/api.js");_ha(\'auction\',\'' . $ad_id . '\');</script>';

	return apply_filters( 'embed_hojta', $embed_code, $matches, $attr, $url, $rawattr );
}

function hojta_embed()
{
	wp_embed_register_handler(
		'hojta',
		'#https?://(?:www\.)?hojta.se/ad/(\d+)#i',
		'hojta_embed_handler'
	);
}
add_action( 'init', 'hojta_embed' );
