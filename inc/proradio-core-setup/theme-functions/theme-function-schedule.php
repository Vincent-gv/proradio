<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * display the full radio schedule
*/

if(!function_exists('proradio_showgrid')) {
	function proradio_showgrid($atts){
		
		extract( shortcode_atts( array(
			'schedulefilter' => ''
		), $atts ) );
		ob_start();
    if( !isset( $schedulefilter ) ){
      $schedulefilter = false;
    } else {
      $schedulefilter = str_replace('schedulefilter:', '', $schedulefilter);
    }
    set_query_var( 'schedulefilter', $schedulefilter );
		get_template_part('template-parts/schedule/schedule' );
    remove_query_arg( 'schedulefilter' );
		return ob_get_clean();
	}
}

if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-schedule","proradio_showgrid");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_vc_showgrid' );
if(!function_exists('proradio_vc_showgrid')){
function proradio_vc_showgrid() {
  vc_map( array(
     "name" => esc_html__( "Shows schedule", "proradio" ),
     "base" => "qt-schedule",
     "icon" => get_template_directory_uri(). '/img/qt-logo.png',
     "description" => esc_html__( "Display a hero section of the show actually playing", "proradio" ),
     "category" => esc_html__( "Theme shortcodes", "proradio"),
     "params" => array(
      	array(
           "type" => "textfield",
           "heading" => esc_html__( "Filter by 'schedulefilter' taxonomy", "proradio" ),
           "description" => esc_html__("Insert the slug of a schedulefilter taxonomy for multi-radio websites","proradio"),
           "param_name" => "schedulefilter"
        )
     )
  ) );
}}