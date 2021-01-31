<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

if(!function_exists('proradio_sanitize_content')){
	function proradio_sanitize_content($content) {
		return wp_kses_post( $content );
	}
}