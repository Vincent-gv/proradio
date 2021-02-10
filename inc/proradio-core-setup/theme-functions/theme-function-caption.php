<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * caption
 *
 * Example:
 * [qt-caption title="My Title" size="xs|s|m|l|xl" alignment="center|left"]
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}




if(!function_exists( 'proradio_template_caption' )){
	function proradio_template_caption( $atts = array() ){

		ob_start();
	
		extract( shortcode_atts( array(
			'title' => false,
			'negative' => false,
			'cssclass' => '',
			'size' => 'm',
			'alignment' => 'left',
			'anim' => false
		), $atts ) );

		// Output start
		
		$classes = array(  
			$cssclass,
			'proradio-caption__'.$size
		);

		switch ( $size ){
			case 'xs':
				$tag = 'h6';
				break;
			case 's':
				$tag = 'h5';
				break;
			case 'l':
				$tag = 'h3';
				break;
			case 'xl':
				$tag = 'h2';
				break;
			case 'xxl':
				$tag = 'h2';
				break;
			case 'xxxl':
				$tag = 'h2';
				$classes[] = 'proradio-h1';
				break;
			case 'm':
			default:
				$tag = 'h4';
		}

		if($negative){
			$classes[] = 'proradio-caption--neg';
		}
		if($alignment == 'alignright') {
			$classes[] = 'alignright';
		}
		if($alignment == 'alignleft') {
			$classes[] = 'alignleft';
		}

		if($alignment == 'center') {
			$classes[] = 'center proradio-center proradio-caption__c';
		}

		if( $anim ){
			$classes[] = 'proradio-anim';
		}

		//Use mb_substr to get the first character.
		$firstChar = mb_substr($title, 0, 1, "UTF-8");
		?>
		<div>
			<?php if ( $alignment == 'aligncenter' ) { ?><div class="aligncenter"> <?php } 
				echo '<'.esc_attr( $tag ).'  class="proradio-element-caption proradio-caption ' . esc_attr( implode( ' ', $classes ) ) . ' ' . ( ( $alignment == 'aligncenter' ) ? 'proradio-caption__c' : '' ) . ' " data-qtwaypoints-offset="30" data-qtwaypoints>' ;
				?>
				<span><?php echo esc_html($title); ?></span>
				<?php 
				echo '</' . esc_attr( $tag ) . '>';
			if ( $alignment == 'aligncenter' ) { ?></div><?php } ?>
		</div>
		<?php 
		// Output end
		$output = ob_get_clean();
		return $output;
		
	}


	// Set TTG Core shortcode functionality
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-caption","proradio_template_caption");
	}





	/**
	 * ========================================================
	 * ONAIR2 COMPATIBILITY
	 * ========================================================
	 */
	if(!function_exists( 'proradio_template_caption_med' )){
		function proradio_template_caption_med( $atts = array() ){
			extract( shortcode_atts( array(
				'title' => '',
				'class' => '',
			), $atts ) );
			return do_shortcode('[qt-caption title="'.$title.'" size="l" anim="1" cssclass="'.$class.'" alignment="center"]');
		}
		if(function_exists('proradio_core_custom_shortcode')) {
			proradio_core_custom_shortcode("qt-caption-med","proradio_template_caption_med");
		}
	}


	if(!function_exists( 'proradio_template_caption_small' )){
		function proradio_template_caption_small( $atts = array() ){
			extract( shortcode_atts( array(
				'title' => '',
				'size'	=> 's',
				'anim'	=> '1',
				'class' => '',
			), $atts ) );
			return do_shortcode('[qt-caption title="'.$title.'" size="s" anim="1" cssclass="'.$class.'"]');
		}
		if(function_exists('proradio_core_custom_shortcode')) {
			proradio_core_custom_shortcode("qt-caption-small","proradio_template_caption_small");
		}
	}




	/**
	 *  Visual Composer integration
	 * 
	 * Apply the same array settings to multiple shortcodes for retro compatibility
	 */

	if(!function_exists('proradio_template_caption_vc_settings')){
		function proradio_template_caption_vc_settings( $base, $title, $category ) {
			$settings = array(
				"name" => $title, //esc_html__( "Caption", "proradio" ),
				"base" => $base, // "qt-caption",
				"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/caption.png' ),
				"category" => $category, //esc_html__( "Theme shortcodes", "proradio"),
				"params" => array(

				array(
				   "type" 			=> "textfield",
				   "heading" 		=> esc_html__( "Text", "proradio" ),
				   "param_name" 	=> "title",
				   'admin_label' 	=> true
				),
				array(
				   "type" 			=> "checkbox",
				   "heading" 		=> esc_html__( "Animation", "proradio" ),
				   "param_name" 	=> "anim",
				),
				array(
					"type" 			=> "dropdown",
					"heading" 		=> esc_html__( "Size", "proradio" ),
					"param_name"	=> "size",
					'admin_label' 	=> true,
					'std' 			=> 'm',
					'value' 		=> array(
							esc_html__( "XS", 'proradio' )		=> "xs",
							esc_html__( "S", 'proradio' ) 		=> "s",
							esc_html__( "M", 'proradio' ) 		=> "m",
							esc_html__( "L", 'proradio' ) 		=> "l", 
							esc_html__( "XL", 'proradio' ) 		=> 'xl',
							esc_html__( "XXL", 'proradio' ) 	=> 'xxl'
						),
					"description" 	=> esc_html__( "Button size", "proradio" )
				),
				array(
					"type" 			=> "dropdown",
					"heading" 		=> esc_html__( "Alignment", "proradio" ),
					"param_name"	=> "alignment",
					'admin_label' 	=> true,
					'std' 			=> 'left',
					'value' 		=> array(
							esc_html__("Left",'proradio') 		=> "left",
							esc_html__("Center",'proradio') 	=> "aligncenter",
						),
				),
				array(
				   "type" 			=> "textfield",
				   "heading" 		=> esc_html__( "Class", "proradio" ),
				   "param_name" 	=> "cssclass",
				   'value' 			=> '',
				   'description' 	=> esc_html__( "Add an extra class for CSS styling", "proradio" )
				)
				)
			);
			return $settings;
		}
	}




	if(!function_exists('proradio_template_caption_vc')){
		add_action( 'vc_before_init', 'proradio_template_caption_vc' );
		function proradio_template_caption_vc() {
		  	vc_map( 
		  		proradio_template_caption_vc_settings( 
		  			"qt-caption", 
		  			esc_html__( "Caption", "proradio" ),
		  			esc_html__( "Theme shortcodes", "proradio")
		  		)
		  	);
		  	vc_map( 
		  		proradio_template_caption_vc_settings( 
		  			"qt-caption-med", 
		  			esc_html__( "Caption medium [deprecated: use Caption]", "proradio" ),
		  			"Deprecated"
		  		)
		  	);
		  	vc_map( 
		  		proradio_template_caption_vc_settings( 
		  			"qt-caption-small", 
		  			esc_html__( "Caption small [deprecated: use Caption]", "proradio" ),
		  			"Deprecated"
		  		)
		  	);
		}
	}
}
