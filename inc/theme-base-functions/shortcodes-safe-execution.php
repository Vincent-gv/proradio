<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * ======================================================
 * Shortcodes safe execution 
 * ------------------------------------------------------
 * Way to execute shortcodes in the theme checking the 
 * existence of the given argument as shortcode
 * ======================================================
 */
if(!function_exists('proradio_do_shortcode')){
function proradio_do_shortcode($shortcode){
	$shortcode_clean = str_replace(array("[","]") , '', $shortcode);
	$ar = explode(' ', $shortcode_clean);

	if(shortcode_exists( $ar[0] ) ) {
		return do_shortcode($shortcode );
	}
	return;
}}