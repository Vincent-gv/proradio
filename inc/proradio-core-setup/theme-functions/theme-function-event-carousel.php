<?php
/*
Package: proradio
Description: Carousel of events based on slideshow carousel shortcode
Version: 1.9.9
Author: ProRadio
Author URI: http://proradio.com
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * ====================================================================================
 *
 *	EVENTS SHORTCODE
 *
 * ====================================================================================
 */


if(!function_exists('proradio_eventscarousel_short')) {
	function proradio_eventscarousel_short($atts){
		
		extract( shortcode_atts( array(
			'quantity' => 6,
			'category' => false,			
		), $atts ) );
		ob_start();
		if ($category && 'all' !== $category) {
			$category = 'eventtype:'.$category;
		}
		echo do_shortcode('[qt-post-carousel posttype="event" tax_filter="'.esc_attr($category).'" items_per_page="'.esc_attr($quantity).'"]' );
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-slideshow-eventcarousel","proradio_eventscarousel_short");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_vc_eventcarousel_short' );
if(!function_exists('proradio_vc_eventcarousel_short')){
function proradio_vc_eventcarousel_short() {
	vc_map( array(
		 "name" => esc_html__( "Events carousel [deprecated: use Post Carousel", "proradio" ),
		 "base" => "qt-slideshow-eventcarousel",
		"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-carousel.png' ),
		 "description" => esc_html__( "Replace this with the Post Carousel widget", "proradio" ),
		 "category" => esc_html__( "Theme shortcodes", "proradio"),
		 "params" => array(
				array(
					 "type" => "dropdown",
					 "heading" => esc_html__( "Quantity", "proradio" ),
					 "param_name" => "quantity",
					 'value' => array("6", "9", "12", "15"),
					 "description" => esc_html__( "Number of posts to display", "proradio" )
				),
				array(
					 "type" => "textfield",
					 "heading" => esc_html__( "Filter by eventtype (slug)", "proradio" ),
					 "description" => esc_html__("Insert the slug of an eventtype to filter the results","proradio"),
					 "param_name" => "category"
				),
			 
		 )
	) );
}}



