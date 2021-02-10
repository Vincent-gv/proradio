<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * app icons
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists('proradio_appicons')){
	function proradio_appicons ($atts){
		extract( shortcode_atts( array(
			'app_android' => false,
			'app_iphone' => false,
			'app_blackberry' => false,
			'app_itunes' => false,
			'app_winphone' => false,
			'app_winamp' => false,
			'app_tunein' => false,
			'app_mediaplayer' => false
		), $atts ) );
		ob_start();

		$icons = array(
			'app_android',
			'app_iphone',
			'app_blackberry',
			'app_itunes',
			'app_winphone',
			'app_winamp',
			'app_tunein',
			'app_mediaplayer'
		)
		?>
			<p class="proradio-center proradio-appicons aligncenter">
			<?php 
			foreach ($icons as $i){
				if($atts[ $i ] && $atts[ $i ] !== '') {
					echo '<a href="'.esc_url( $atts[ $i ] ).'" class="proradio-btn proradio-btn-primary proradio-btn-l proradio-appicon"><span class="proradio-'.esc_attr( $i ).'"></span></a>';
				}
			}  
			?>
			</p>
		<?php
		return ob_get_clean();
	}
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-appicons","proradio_appicons");
	}


	/**
	 *  Visual Composer integration
	 */

	if(!function_exists('proradio_vc_appicons')){
		add_action( 'vc_before_init', 'proradio_vc_appicons' );
		function proradio_vc_appicons() {
			vc_map( array(
				 "name" => esc_html__( "App Icons", "proradio" ),
				 "base" => "qt-appicons",
				 "icon" => get_template_directory_uri(). '/img/vc/radio-app-icons.png',
				 "description" => esc_html__( "Create links to external players", "proradio" ),
				 "category" => esc_html__( "Theme shortcodes", "proradio"),
				 "params" => array(

						array(
							 "type" => "textfield",
							 "heading" => esc_html__( "Android", "proradio" ),
							 "param_name" => "app_android",
						),
						array(
							 "type" => "textfield",
							 "heading" => esc_html__( "iPhone", "proradio" ),
							 "param_name" => "app_iphone",
						),
						array(
							 "type" => "textfield",
							 "heading" => esc_html__( "Blackberry", "proradio" ),
							 "param_name" => "app_blackberry",
						),
						array(
							 "type" => "textfield",
							 "heading" => esc_html__( "iTunes", "proradio" ),
							 "param_name" => "app_itunes",
						),
						array(
							 "type" => "textfield",
							 "heading" => esc_html__( "Windows Phone", "proradio" ),
							 "param_name" => "app_winphone",
						),
						array(
							 "type" => "textfield",
							 "heading" => esc_html__( "Media Player", "proradio" ),
							 "param_name" => "app_mediaplayer",
						),
						array(
							 "type" => "textfield",
							 "heading" => esc_html__( "Winamp", "proradio" ),
							 "param_name" => "app_winamp",
						),
						 array(
							 "type" => "textfield",
							 "heading" => esc_html__( "Tunein", "proradio" ),
							 "param_name" => "app_tunein",
						),
						
				 )
			) );
		}
	}
}