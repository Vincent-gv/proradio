<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-list-horizontal post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

/**
 * 
 * Spacer
 * =============================================
 */
if(!function_exists('proradio_spacer')){
	function proradio_spacer ($atts){
		extract( shortcode_atts( array(
			'size' => 'm',
		), $atts ) );
		if($size !== 'xxs' && $size !== 'xs' && $size !== 's' && $size !== 'm' && $size !== 'l') {
			$size = 'm';
		}
		ob_start();
		?>
			<div class="proradio-spacer-<?php echo esc_attr($size); ?>"><hr></div>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-spacer","proradio_spacer");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_vc_spacer' );
if(!function_exists('proradio_vc_spacer')){
function proradio_vc_spacer() {
  vc_map( array(
     "name" => esc_html__( "Responsive spacer", "proradio" ),
     "base" => "qt-spacer",
     "icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/spacer.png' ),
     "description" => esc_html__( "Spacer", "proradio" ),
     "category" => esc_html__( "Theme shortcodes", "proradio"),
     "params" => array(
      	array(
           "type" => "dropdown",
           "heading" => esc_html__( "Size", "proradio" ),
           "param_name" => "size",
           'admin_label' => true,
           'std'  => 'm',
           'value' => array("xxs","xs", "s", "m", "l"),
           "description" => esc_html__( "Empty spacer separator based on responsive sizes", "proradio" )
        )
     )
  ) );
}}