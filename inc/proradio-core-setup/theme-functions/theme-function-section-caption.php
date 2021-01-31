<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * caption
 *
 * Example:
 * [qt-section-caption title="My Title" size="xs|s|m|l|xl" alignment="center|left"]
*/


if(!function_exists( 'proradio_template_section_caption' )){
	function proradio_template_section_caption( $atts = array() ){
		extract( shortcode_atts( array(
			'intro' => false,
			'caption' => false,
			'negative' => false, // intro
			'subtitle' => false,
			'size'=>'m',
			// Effects
			'fx' => 'oslo',
			'color1' => '#dedede',
			'color2' => '#999',
			'color3' => '#f00',
			'class' => false,
		), $atts ) );

		if(!$caption){
			return;
		}

		$id = preg_replace('/[0-9]+/', '', uniqid('proradiotabs').'-'.proradio_slugify(esc_html($caption))); 

		$class = $class . ' proradio-section-caption--'.$size;

		// Output start
		ob_start();
		?>

		<div class="proradio-section-caption <?php  echo esc_attr( $class ); ?>">

			<?php  

			if( $intro ){
				$caption_atts = array(
					'title' => wp_strip_all_tags( $intro, true ),
					'negative' => $negative,
					'alignment' => 'center',
					'anim' => true
				);
				echo proradio_template_caption($caption_atts);
				?>
				<hr class="proradio-spacer-s">
				<?php
			}

			if( $caption ){
				?>
				<h2 id="<?php echo esc_attr($id); ?>" class="proradio-center proradio-capfont proradio-<?php echo esc_attr($id); ?> proradio-txtfx-<?php echo esc_attr($fx); ?>-container proradio-textfx-wrap ">
					<?php  
					switch($fx){
						case "paris": 
							$style = '
							.proradio-'.$id.' .proradio-txtfx--paris { color: '.esc_attr($color1).'}
							.proradio-'.$id.' .proradio-txtfx--paris span::before, .proradio-'.$id.' .proradio-txtfx--paris span::after { color: '.esc_attr($color2).'}
							.proradio-'.$id.' .proradio-txtfx--paris::before, .proradio-'.$id.' .proradio-txtfx--paris::after { background: '.esc_attr($color3).'}
							';
							$length = strlen($caption);
							if ($length > 2){
								$splitted = str_split($caption, round($length / 2));
								?>
								<span class="proradio-txtfx proradio-txtfx--paris" data-qtwaypoints-offset="50" data-qtwaypoints ><span data-letters-l="<?php echo esc_html($splitted[0]); ?>" data-letters-r="<?php echo esc_html($splitted[1]); ?>"><?php echo esc_html($caption); ?></span></span>
								<?php
							} else {
								esc_html_e("Warning: insert at least 2 letters for this effect", 'proradio');
							}
							break;
						case "oslo": 
							$length = strlen($caption);
							$splitted = str_split($caption, 1);
							$style = '
							.proradio-'.$id.' .proradio-txtfx--oslo, .proradio-'.$id.' .proradio-'.$id.' .proradio-txtfx--oslo::before { color: '.esc_attr($color1).'}
							.proradio-'.$id.' .proradio-txtfx--oslo.proradio-active span  { color: '.esc_attr($color2).'}
							.proradio-'.$id.' .proradio-txtfx--oslo::before { border-color: '.esc_attr($color3).'}
							';
							?>
							<span class="proradio-txtfx proradio-txtfx--oslo" data-qtwaypoints-offset="50" data-qtwaypoints >
								<?php
								foreach($splitted as $letter){
									?><span><?php echo esc_html($letter); ?></span><?php 
								}
								?>
							</span>
							<?php
							break;
						case "ibiza": 
							$style = '
							.proradio-'.$id.' .proradio-txtfx--ibiza, .proradio-'.$id.' .proradio-txtfx--ibiza.proradio-active { color: '.esc_attr($color1).'}
							.proradio-'.$id.' .proradio-txtfx--ibiza span::before { color: '.esc_attr($color2).'}
							.proradio-'.$id.' .proradio-txtfx--ibiza::after { background: '.esc_attr($color3).'}
							';
							?>
							<span class="proradio-txtfx proradio-txtfx--ibiza" data-qtwaypoints-offset="50" data-qtwaypoints ><span  data-letters="<?php echo esc_html($caption); ?>"><?php echo esc_html($caption); ?></span></span>
							<?php
							break;
						case "newyork": 
							$style = '
							.proradio-'.$id.' .proradio-txtfx--newyork { color: '.esc_attr($color1).'}
							.proradio-'.$id.' .proradio-txtfx--newyork span::before { color: '.esc_attr($color2).'}
							.proradio-'.$id.' .proradio-txtfx--newyork::before { background: '.esc_attr($color3).'}
							';
							?>					
							<span class="proradio-txtfx proradio-txtfx--newyork" data-qtwaypoints-offset="50" data-qtwaypoints ><?php echo esc_html($caption); ?><span data-letters="<?php echo esc_html($caption); ?>"></span><span data-letters="<?php echo esc_html($caption); ?>"></span></span>
							<?php 
							break;
						case "london": 
							$style = '
							.proradio-'.$id.' .proradio-txtfx--london { color: '.esc_attr($color1).'}
							.proradio-'.$id.' .proradio-txtfx--london.proradio-active { color: '.esc_attr($color2).'}
							.proradio-'.$id.' .proradio-txtfx--london::before { background: '.esc_attr($color3).'}
							';
							?>
							<span class="proradio-txtfx proradio-txtfx--<?php echo esc_attr($fx); ?>" data-qtwaypoints-offset="50" data-qtwaypoints  data-letters="<?php echo esc_html($caption); ?>"><?php echo esc_html($caption); ?></span>
							<?php
							break;
						case "tokyo":
						default:
							$style = '
							 .proradio-'.$id.' .proradio-txtfx--tokyo { color: '.esc_attr($color1).'}
							.proradio-'.$id.' , .proradio-'.$id.' .proradio-txtfx--tokyo::before { color: '.esc_attr($color2).'}
							.proradio-'.$id.' .proradio-txtfx--tokyo::after { background: '.esc_attr($color3).'}
							';
							?>
							<span class="proradio-txtfx proradio-txtfx--<?php echo esc_attr($fx); ?>" data-qtwaypoints-offset="50" data-qtwaypoints  data-letters="<?php echo esc_html($caption); ?>"><?php echo esc_html($caption); ?></span>
							<?php
							break;
					}
					?>
				</h2>
				<?php
			}

			if( $subtitle ){
				?>
				<p><?php echo esc_html( $subtitle ); ?></p>
				<?php
			}
			?>
		</div>
		<?php 

		/**
		 * This one part will prepare the custom styles for javascript to add them to the head
		 */
		?>
		<div data-proradio-customstyles="<?php echo wp_strip_all_tags( $style ); ?>"></div>
		<?php 

		// Output end
		$output = ob_get_clean();
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-section-caption","proradio_template_section_caption");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_template_section_caption_vc' );
if(!function_exists('proradio_template_section_caption_vc')){
function proradio_template_section_caption_vc() {
  vc_map( array(
	 "name" 			=> esc_html__( "Section caption", "proradio" ),
	 "base" 			=> "qt-section-caption",
	 "icon" 			=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/section-caption.png' ),
	 "description" 		=> esc_html__( "3 Lines caption with intro text", "proradio" ),
	 "category" 		=> esc_html__( "Theme shortcodes", "proradio"),
	 "params" 			=> array(
		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Intro text", "proradio" ),
		   "param_name" 	=> "intro",
		   'admin_label' 	=> true,
		   'value' 			=> ''
		),
		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Caption", "proradio" ),
		   "param_name" 	=> "caption",
		   'admin_label' 	=> true,
		   'value' 			=> ''
		),
		array(
		   "type" 			=> "dropdown",
		   "heading" 		=> esc_html__( "Size", "proradio" ),
		   "description" 	=> esc_html__( "Choose effect style", "proradio" ),
		   "param_name" 	=> "size",
		   "std" 			=> "default",
		   'value' 			=> array(
				esc_html__( "Default", "proradio")		=> "m",
				esc_html__( "Large", "proradio")		=> "l",		
				esc_html__( "Extra large", "proradio")	=> "xl",		
			),
		),
		array(
		   "type" 			=> "textfield",
		   "heading" 		=> esc_html__( "Subtitle", "proradio" ),
		   "param_name" 	=> "subtitle",
		   'value' 			=> ''
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "proradio" ),
			"type" 			=> "colorpicker",
			"heading" 		=> esc_html__( "Color 1", "proradio" ),
			"param_name" 	=> "color1"
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "proradio" ),
			"type" 			=> "colorpicker",
			"heading" 		=> esc_html__( "Color 2", "proradio" ),
			"param_name" 	=> "color2"
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "proradio" ),
		   "type" 			=> "colorpicker",
		   "heading" 		=> esc_html__( "Color 3", "proradio" ),
		   "param_name" 	=> "color3"
		),
		array(
			"group" 		=> esc_html__( "Intro effect", "proradio" ),
		   "type" 			=> "dropdown",
		   "heading" 		=> esc_html__( "Effect style", "proradio" ),
		   "param_name" 	=> "fx",
		   "std" 			=> "oslo",
		   'value' 			=> array(
		   		esc_html__( "Oslo", "proradio")		=> "oslo",
				esc_html__( "Tokyo", "proradio")	=> "tokyo",
				esc_html__( "London", "proradio")	=> "london",
				esc_html__( "Paris", "proradio")	=> "paris",
				esc_html__( "Ibiza", "proradio")	=> "ibiza",
				esc_html__( "New York", "proradio")	=> "newyork",
				
			),
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Class", "proradio" ),
			"param_name" 	=> "class",
			'value' 		=> '',
			'description' 	=> esc_html__( "Add an extra class for CSS styling", "proradio" )
		)
	 )
  ) );
}}

