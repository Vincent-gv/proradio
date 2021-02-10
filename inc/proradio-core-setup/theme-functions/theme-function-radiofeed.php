<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * 
 * Theme function for custom parts:
 * DISPLAY SONG FEED LIKE SHOUTCAST OR ICECAST
 * IMPORTANT: REQUIRES QTMPLAYER PLUGIN!!
 * Managed by the javascript function in qtmplayer-radiofeed.js
 * 
 * 
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists('proradio_short_radiofeed')){
	function proradio_short_radiofeed ($atts){
		extract( shortcode_atts( array(
			'title' => 'Now playing:',
			'tag' => 'p',
			'align' => 'center',
			'class' => '',
			'marquee' => '1'
		), $atts ) );

		if(!$tag){
			$tag = 'p';
		}
		$align = 'proradio-'.$align .' align'.$align;
		ob_start();
		?>
			<?php echo '<'.esc_attr($tag); ?> class="proradio-now_on_air_text qtmplayer-feed  <?php echo esc_attr($class.' '.$align); ?>">
			<?php echo esc_html($title); ?> <span class="qtmplayer__title <?php if('1' == $marquee){ ?>proradio-marquee<?php } ?>"></span> <span class="qtmplayer__artist <?php if('1' == $marquee){ ?>proradio-marquee<?php } ?>"></span>
			<?php echo '</'.esc_attr($tag).'>'; ?>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-nowonair","proradio_short_radiofeed");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_short_radiofeed_vc' );
if(!function_exists('proradio_short_radiofeed_vc')){
function proradio_short_radiofeed_vc() {
	vc_map( array(
		 "name" => esc_html__( "Stream title feed", "proradio" ),
		 "base" => "qt-nowonair",
		 "icon" => get_template_directory_uri(). '/img/vc/radio-song-title.png',
		 "description" => esc_html__( "Display the song title if enabled in radio channel", "proradio" ),
		 "category" => esc_html__( "Theme shortcodes", "proradio"),
		 "params" => array(
			array(
				 "type" => "textfield",
				 "heading" => esc_html__( "Title", "proradio" ),
				 "param_name" => "title",
				 'value' => ''
			),	
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Container tag", "proradio" ),
				"param_name" => "tag",
				'value' => array("p", "H1","H2","H3","H4","H5","H6",),
				"description" => esc_html__( "Container style", "proradio" )
			),	
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Alignment", "proradio" ),
				"param_name" => "align",
				'value' => array("left" => 'qt-left', "center" => 'qt-center',"right" => 'qt-right'),
			),		
			array(
				"type" => "textfield",
				"heading" => esc_html__( "CSS class", "proradio" ),
				"param_name" => "class",
				'value' => ''
			),	
		 )
	) );
}}