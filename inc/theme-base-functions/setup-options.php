<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * ======================================================
 * Thumbnails
 * ------------------------------------------------------
 * Change default thumbnails sizes 
 * ======================================================
 */
if (!function_exists( 'proradio_setup_options' )){
	add_action( 'after_switch_theme', 'proradio_setup_options' );
	function proradio_setup_options () {
		update_option( 'medium_size_w', 770 );
		update_option( 'medium_size_h', 770 );
		update_option( 'large_size_w', 1170 );
		update_option( 'large_size_h', 1170 );
	}
}