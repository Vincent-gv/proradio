<?php  

/**
 * ===================================================================
 * Output a json version of the schedule json
 * ===================================================================
 */

if(!function_exists('proradio_extract_schedule_days_rest')){
	function proradio_extract_schedule_days_rest( $data ){
		$schedule = proradio_extract_schedule_days();
		if ( empty( $schedule ) || !is_array($schedule)) {
			return null;
		}
		return $schedule;
	}
}


add_action( 'rest_api_init', function () {
  register_rest_route( 'proradio/v1', '/schedule/', array(
    'methods' => 'GET',
    'callback' => 'proradio_extract_schedule_days_rest',
  ) );
} );