<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *  Redirect to Welcome Page after the theme activation
 * =============================================*/
if ( !function_exists( 'proradio_welcome_switched' ) ) {
	/**
	 * When we switch theme, we save a variable that will force
	 * redirect to the wizard on next page load
	 */
	add_action( 'after_switch_theme', 'proradio_welcome_switched', 1000 );
	function proradio_welcome_switched() {
		update_option( 'proradio_welcome_page', 'installer' );
	}
}