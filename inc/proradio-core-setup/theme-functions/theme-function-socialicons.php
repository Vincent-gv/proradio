<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Social Icons
 *
 * Example:
 * [qt-socialicons text="" link="" icon="" style="" alignment="" class=""]
*/


if(!function_exists('proradio_template_socialicons_shortcode')){
	function proradio_template_socialicons_shortcode ($atts){
		extract( shortcode_atts( array(
			'text' 		=> '',
			'link' 		=> '#',
			'size' 		=> 'qt-btn-s',
			'target' 	=> '',
			'style' 	=> '',
			'alignment' => '',
			'icon' 		=> false,
			'class' 	=> ''
		), $atts ) );

		if($size === 'qt-btn-xxl') {
			$class 	= $class.' qt-big-icons';
			$size 	= 'qt-btn-xl';
		}

		ob_start();
		if ( $alignment == 'aligncenter' ) { ?><p class="aligncenter"> <?php } 
			?>
			<a href="<?php echo esc_url($link); ?>" <?php if($target == "_blank"){ ?> target="_blank" <?php } ?> class="proradio-btn proradio-short-socialicon <?php  echo esc_attr($class.' '.$style.' '.$alignment); ?> <?php if($text !='') { echo 'proradio-icon__l'; } else { echo 'proradio-btn__r'; } ?>">
			<?php if($icon){ ?><i class="qt-socicon-<?php echo esc_attr($icon); ?> qt-socialicon"></i><?php } ?><?php if($text) { ?> <span><?php echo ' '.esc_html($text); } ?></span></a>
			<?php
		if ( $alignment == 'aligncenter' ) { ?></p><?php } 
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-socialicons","proradio_template_socialicons_shortcode");
}




/* QT Socicons list [This is a configuration list used by Theme Core plugin]
=============================================*/
if(!function_exists('proradio_template_qt_socicons_array')){
function proradio_template_qt_socicons_array(){
	return array(
		'android' 			=> esc_html__( 'Android', 'proradio' ),
		'amazon' 			=> esc_html__( 'Amazon', 'proradio' ),
		'beatport' 			=> esc_html__( 'Beatport', 'proradio' ),
		'blogger' 			=> esc_html__( 'Blogger', 'proradio' ),
		'facebook' 			=> esc_html__( 'Facebook', 'proradio' ),
		'flickr' 			=> esc_html__( 'Flickr', 'proradio' ),
		'googleplus' 		=> esc_html__( 'Googleplus', 'proradio' ),
		'instagram' 		=> esc_html__( 'Instagram', 'proradio' ),
		'itunes' 			=> esc_html__( 'Itunes', 'proradio' ),
		'juno' 				=> esc_html__( 'Juno', 'proradio' ),
		'kuvo' 				=> esc_html__( 'Kuvo', 'proradio' ),
		'linkedin' 			=> esc_html__( 'Linkedin', 'proradio' ),
		'trackitdown' 		=> esc_html__( 'Trackitdown', 'proradio' ),
		'spotify' 			=> esc_html__( 'Spotify', 'proradio' ),
		'soundcloud' 		=> esc_html__( 'Soundcloud', 'proradio' ),
		'snapchat' 			=> esc_html__( 'Snapchat', 'proradio' ),
		'skype' 			=> esc_html__( 'Skype', 'proradio' ),
		'reverbnation' 		=> esc_html__( 'Reverbnation', 'proradio' ),
		'residentadvisor' 	=> esc_html__( 'Resident Advisor', 'proradio' ),
		'pinterest' 		=> esc_html__( 'Pinterest', 'proradio' ),
		'myspace' 			=> esc_html__( 'Myspace', 'proradio' ),
		'mixcloud' 			=> esc_html__( 'Mixcloud', 'proradio' ),
		'rss' 				=> esc_html__( 'RSS', 'proradio' ),
		'twitter' 			=> esc_html__( 'Twitter', 'proradio' ),
		'vimeo' 			=> esc_html__( 'Vimeo', 'proradio' ),
		'vk' 				=> esc_html__( 'VK.com', 'proradio' ),
		'youtube' 			=> esc_html__( 'YouTube', 'proradio' ),
		'whatsapp' 			=> esc_html__( 'Whatsapp', 'proradio' ),
	);
}}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_template_socialicons_shortcode_vc' );
if(!function_exists('proradio_template_socialicons_shortcode_vc')){
function proradio_template_socialicons_shortcode_vc() {
  vc_map( array(
	"name" 			=> esc_html__( "Social icons", "proradio" ),
	"base" 			=> "qt-socialicons",
	"icon" 			=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/socialicons.png' ),
	"description" 	=> esc_html__( "Add a social link", "proradio" ),
	 "category" 	=> esc_html__( "Theme shortcodes", "proradio"),
	"params" 		=> array(
			array(
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading' 		=> esc_html__( 'Text', "proradio" ),
				'param_name'	=> 'text',
			),
			array(
				'type' 			=> 'textfield',
				'value' 		=> '',
				'heading'		=> esc_html__( "Link", "proradio" ),
				'param_name'	=> 'link',
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Link target", "proradio" ),
				"param_name"	=> "target",
				'value' 		=> array( 
					esc_html__( "Same window","proradio") 	=> "",
					esc_html__( "New window","proradio") 	=> "_blank",
					)			
				),

			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Icon", "proradio" ),
				"param_name"	=> "icon",
				'value' 		=>  array_merge(
										array(''=>false),
										array_flip( proradio_template_qt_socicons_array() )
									),
				'admin_label' 	=> true,
				"description" 	=> esc_html__( "Choose social icon", "proradio" )
			),

			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Button style", "proradio" ),
				"param_name"	=> "style",
				'value' 		=> array( 
					esc_html__( "Default","proradio") 		=> "",
					esc_html__( "Primary","proradio") 		=> "proradio-btn-primary",
					esc_html__( "White","proradio") 		=> "proradio-btn__white",
					esc_html__( "Transparent","proradio") 	=> "proradio-btn__txt",
					)			
				),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Alignment", "proradio" ),
				"param_name"	=> "alignment",
				'value' 		=> array( 
					esc_html__( "Default","proradio") 	=> "",
					esc_html__( "Left","proradio") 		=> "alignleft",
					esc_html__( "Right","proradio") 	=> "alignright",
					esc_html__( "Center","proradio") 	=> "aligncenter",
					),
				"description" 	=> esc_html__( "Button style", "proradio" )
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Class", "proradio" ),
				'description' 	=> esc_html__( "Add an extra class for CSS styling", "proradio" ),
				"param_name" 	=> "class",
				'value' 		=> '',
			)
		)
  	));
}}
