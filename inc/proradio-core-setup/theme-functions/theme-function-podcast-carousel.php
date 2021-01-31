<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 **/

/**
 * ====================================================================================
 *
 *	PODCAST SHORTCODE
 * 	from OnAir2 compatibility
 * 
 * 	Based on post-carousel
 *
 * ====================================================================================
 */


if(!function_exists('proradio_podcastcarousel_short')) {
	function proradio_podcastcarousel_short($atts){
		ob_start();
		extract( shortcode_atts( array(
			'quantity' => 6,
			'category' => false,
			'orderby' => false
			
		), $atts ) );
		echo do_shortcode('[qt-slideshow-carousel posttype="podcast" category="'.esc_attr($category).'" orderby="'.esc_attr($orderby).'" quantity="'.esc_attr($quantity).'"]' );
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-slideshow-podcastcarousel","proradio_podcastcarousel_short");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_vc_podcastcarousel_short' );
if(!function_exists('proradio_vc_podcastcarousel_short')){
function proradio_vc_podcastcarousel_short() {
  vc_map( array(
     "name" => esc_html__( "Podcast Carousel", "proradio" ),
     "base" => "qt-slideshow-podcastcarousel",
     "icon" => get_template_directory_uri(). '/img/qt-logo.png',
     "description" => esc_html__( "Carousel of podcasts on 3 columns", "proradio" ),
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
           "heading" => esc_html__( "Filter by category (slug)", "proradio" ),
           "description" => esc_html__("Insert the slug of a category to filter the results","proradio"),
           "param_name" => "category"
        ),
        array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Order by", "proradio" ),
		   "param_name" => "orderby",
		   'value' => array(__("Default", "proradio")=>"",
		   					__("Publish date", "proradio")=>"date",
		   					// __("Menu order", "proradio")=>"menu_order",
		   					__("Random", "proradio")=>"rand"
		   					),
		   "description" => esc_html__( "Change the order of the podcasts", "proradio" )
		)
     )
  ) );
}}

