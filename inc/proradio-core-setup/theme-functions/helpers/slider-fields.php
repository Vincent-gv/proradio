<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Carousel design fields
*/


/**
 * ===============================================================
 * CAROUSEL DESIGN FIELDS
 * ================================================================
 */

function proradio_slider_design_fields(){
	$fields = array (
		array(
			"type" 		=> "textfield",
			"group" 	=> esc_html__( "Slider settings", "proradio" ),
			"heading" 	=> esc_html__( "Autoplay timeout", "proradio" ),
			'description' => esc_html__( 'Set to 0 to disable', 'proradio' ),
			"param_name"=> "autoplay_timeout",
			'std'		=> '4000',
			'value'		=> ''
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Slider settings", "proradio" ),
			"heading" 	=> esc_html__( "Full height", "proradio" ),
			"param_name"=> "fullheight",
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Slider settings", "proradio" ),
			"heading" 	=> esc_html__( "Full width", "proradio" ),
			"param_name"=> "fullwidth",
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Slider settings", "proradio" ),
			"heading" 	=> esc_html__( "Pause on hover", "proradio" ),
			"param_name"=> "pause_on_hover",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Slider settings", "proradio" ),
			"heading" 	=> esc_html__( "Loop", "proradio" ),
			"param_name"=> "loop",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Slider settings", "proradio" ),
			"heading" 	=> esc_html__( "Nav", "proradio" ),
			"param_name"=> "nav",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Slider settings", "proradio" ),
			"heading" 	=> esc_html__( "Dots", "proradio" ),
			"param_name"=> "dots",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			'type' => 'vc_grid_id',
			'param_name' => 'grid_id',
		),
	);
	return $fields;

}

