<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * caption
 *
*/
if(!function_exists( 'proradio_mbStringToArray' )){
function proradio_mbStringToArray ($string) {
   	mb_regex_encoding('UTF-8');
	mb_internal_encoding("UTF-8");
	$splitted = mb_split('',$string);
	return $splitted;
}}
if(!function_exists( 'proradio_template_3d_header' )){
	function proradio_template_3d_header( $atts = array(), $content = false ){


		extract( shortcode_atts( array(
			'intro' => false,
			'include_by_id' => false,
			'caption' => false,
			'bgimg' => false,
			'bgimg2'=> false,
			'class' => false,
			'subtitle' => false,
			'link'=>false,
			'radio_id' => false,
			'linktext'=>false,
			'bordercolor' => false,
			'bgcolor' => false,
			'negative' => false,
			// Effects
			'fx' => 'oslo',
			'color1' => '#dedede',
			'color2' => '#999999',
			'color3' => '#ff0000',
		), $atts ) );

		


		$id = '3dheader--'.preg_replace('/[0-9]+/', '', uniqid('proradio3d').'-'.proradio_slugify(wp_strip_all_tags($caption))); 
		$cssselector = 'proradio-'.$id;

		if( $negative ){
			$class .= ' proradio-negative';
		}
		
		// Output start
		ob_start();

		?>

		<div id="<?php echo esc_attr($id); ?>" class="proradio-3dheader <?php  echo esc_attr( $class ); ?> <?php  echo esc_attr( $cssselector ); ?>">
			<div class="proradio-3dheader__wrapper">
		
				<?php 
	 			/**
				 * bg
				 * ========================================= */
				if( $bgimg ){
					$image = wp_get_attachment_image_src($bgimg, 'full'); 
					?>
					<div class="proradio-3dheader__bg proradio-3dheader__bg--1"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background','proradio'); ?>"></div>
					<?php  
				}
				/**
				 * bg
				 * ========================================= */
				if( $bgimg2 ){
					$image = wp_get_attachment_image_src($bgimg2, 'full'); 
					?>
					<div class="proradio-3dheader__bg proradio-3dheader__bg--2"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background','proradio'); ?>"></div>
					<?php  
				}

				?>
				
				<div class="proradio-3dheader__contents">
					<div class="proradio-3dheader__contents__caption">
						<div class="proradio-section-caption proradio-section-caption--l">
							<div class="proradio-3dheader__firstlevel">
								<?php  

								/**
								 * Intro
								 */
								if( $intro ){
									if( function_exists('proradio_template_caption') ){
										echo proradio_template_caption( array( 'title' =>  $intro, 'alignment' => 'center',  'size' => 'm', 'anim' => 0, 'negative' => $negative ) );
									}
								}


								/**
								 * Caption
								 */
								if( $caption ){
									?>
									<h1  class="proradio-center proradio-3dheader__top proradio-capfont proradio-<?php echo esc_attr($id); ?> proradio-txtfx-<?php echo esc_attr($fx); ?>-container proradio-textfx-wrap ">
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
													<span class="proradio-txtfx proradio-txtfx--paris" data-qtwaypoints-offset="50" data-qtwaypoints ><span data-letters-l="<?php echo esc_html($splitted[0]); ?>" data-letters-r="<?php echo esc_html($splitted[1]); ?>"><?php echo wp_strip_all_tags($caption); ?></span></span>
													<?php
												} else {
													esc_html_e("Warning: insert at least 2 letters for this effect", 'proradio');
												}
												break;
											case "oslo": 
												$splitted = proradio_mbStringToArray( $caption );
												$style = '
												.proradio-'.$id.' .proradio-txtfx--oslo, .proradio-'.$id.' .proradio-'.$id.' .proradio-txtfx--oslo::before { color: '.esc_attr($color1).'}
												.proradio-'.$id.' .proradio-txtfx--oslo.proradio-active span  { color: '.esc_attr($color2).'}
												.proradio-'.$id.' .proradio-txtfx--oslo::before { border-color: '.esc_attr($color3).'}
												';
												?>
												<span class="proradio-txtfx proradio-txtfx--oslo" data-qtwaypoints-offset="50" data-qtwaypoints >
													<?php
													foreach($splitted as $letter){
														?><span><?php echo $letter; ?></span><?php 
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
												<span class="proradio-txtfx proradio-txtfx--ibiza" data-qtwaypoints-offset="50" data-qtwaypoints ><span  data-letters="<?php echo wp_strip_all_tags($caption); ?>"><?php echo wp_strip_all_tags($caption); ?></span></span>
												<?php
												break;
											case "newyork": 
												$style = '
												
												.proradio-'.$id.' .proradio-txtfx--newyork { color: '.esc_attr($color1).'}
												.proradio-'.$id.' .proradio-txtfx--newyork span::before { color: '.esc_attr($color2).'}
												.proradio-'.$id.' .proradio-txtfx--newyork::before { background: '.esc_attr($color3).'}
												';
												?>					
												<span class="proradio-txtfx proradio-txtfx--newyork" data-qtwaypoints-offset="50" data-qtwaypoints ><?php echo wp_strip_all_tags($caption); ?><span data-letters="<?php echo wp_strip_all_tags($caption); ?>"></span><span data-letters="<?php echo wp_strip_all_tags($caption); ?>"></span></span>
												<?php 
												break;
											case "london": 
												$style = '
												
												.proradio-'.$id.' .proradio-txtfx--london { color: '.esc_attr($color1).'}
												.proradio-'.$id.' .proradio-txtfx--london.proradio-active { color: '.esc_attr($color2).'}
												.proradio-'.$id.' .proradio-txtfx--london::before { background: '.esc_attr($color3).'}
												';
												?>
												<span class="proradio-txtfx proradio-txtfx--<?php echo esc_attr($fx); ?>" data-qtwaypoints-offset="50" data-qtwaypoints  data-letters="<?php echo wp_strip_all_tags($caption); ?>"><?php echo wp_strip_all_tags($caption); ?></span>
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
												<span class="proradio-txtfx proradio-txtfx--<?php echo esc_attr($fx); ?>" data-qtwaypoints-offset="50" data-qtwaypoints  data-letters="<?php echo wp_strip_all_tags($caption); ?>"><?php echo wp_strip_all_tags($caption); ?></span>
												<?php
												break;
										}
										?>
									</h1>
									<?php
								}

								if( $content ){
									?>
									<div class="proradio-3dheader__custom"><?php 
									echo wp_kses_post( $content );
									 ?></div>
									<?php
								}

								/**
								 * event countdown
								 */
								if( $include_by_id && shortcode_exists( 'qt-countdown' ) ){
									?><div class="proradio-3dheader__cd"><?php 
										echo do_shortcode( '[qt-countdown labels="full" size="7" align="center" include_by_id="'.$include_by_id.'" ]' );
									?></div><?php  
								}

								if( $subtitle ){
									?>
									<p class="proradio-3dheader__sb"><?php echo esc_html( $subtitle ); ?></p>
									<?php
								}
								if( $radio_id ){
									if( function_exists('qtmplayer_play_button')){
										$atts = array(
											'button_text' => $linktext,
											'file'		=> false,
											'id' 		=> $radio_id, // the post id
											'content' 	=> 'proradio-btn proradio-btn-primary',
											'classes' 	=> 'proradio-btn proradio-btn__l proradio-btn-primary', // additional classes for the play circle
										);
										echo qtmplayer_play_button( $atts );
									} else {
										echo 'Missing plutin';
									}
								} else {
									if($link && $linktext){
										?>
										<p class="proradio-spacer-xs proradio-3dheader__link">
											<a class="proradio-btn proradio-btn__l proradio-btn-primary" href="<?php echo esc_attr($link); /* We have to use esc_attr because it can be also # */ ?>"><?php echo esc_html( $linktext ); ?></a>
										</p>
										<?php
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 

		if($bordercolor){
			$style .= ' .testingsel, .proradio-'.$id.' .proradio-section-caption { border-color: '.esc_attr($bordercolor).';} ';
		}
		if($bgcolor){
			$style .= ' .proradio-'.$id.' .proradio-section-caption { background-color: '.esc_attr($bgcolor).';} ';
		}
		
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
	proradio_core_custom_shortcode("qt-3d-header","proradio_template_3d_header");
}

function proradio_template_3d_header_controls(){
	return array(
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Intro text", "proradio" ),
		   "param_name" => "intro",
		   'admin_label' => true,
		   'value' => ''
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Caption", "proradio" ),
		   "param_name" => "caption",
		   'admin_label' => true,
		   'value' => ''
		),
		array(
		   "type" => "textarea_html",
		   "heading" => esc_html__( "Free text", "proradio" ),
		   "param_name" => "content",
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Subtitle", "proradio" ),
		   "param_name" => "subtitle",
		   'value' => ''
		),

		/**
		 * Countdown
		 * =========================================
		 */
		array(
			"group" 		=> esc_html__( "Countdown", "proradio" ),
			'type' 			=> 'autocomplete',
			'heading' 		=> esc_html__( 'Event countdown', 'proradio'),
			'param_name' 	=> 'include_by_id',
			'settings'		=> array( 
				'values' 		 => proradio_autocomplete('event') ,
				'multiple'       => false,
				'sortable'       => false,
          		'min_length'     => 1,
          		'groups'         => false,  // In UI show results grouped by groups
          		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
          		'display_inline' => true, // In UI show results inline view),
			),
		),

		/**
		 * Intro
		 * =========================================
		 */
		array(
			"group" 	=> esc_html__( "Intro effect", "proradio" ),
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Color 1", "proradio" ),
		   "param_name" => "color1",
		   'std' => '#dddddd'
		),
		array(
			"group" 	=> esc_html__( "Intro effect", "proradio" ),
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Color 2", "proradio" ),
		   "param_name" => "color2",
		   'std' => '#999999'
		),
		array(
			"group" 	=> esc_html__( "Intro effect", "proradio" ),
		   "type" => "colorpicker",
		   "heading" => esc_html__( "Color 3", "proradio" ),
		   "param_name" => "color3",
		   'std' => '#ff0000'
		),
		array(
			"group" 	=> esc_html__( "Intro effect", "proradio" ),
		   "type" => "dropdown",
		   "heading" => esc_html__( "Effect", "proradio" ),
		   "param_name" => "fx",
		   'std' => 'oslo',
		   'value' => array(
		   		esc_html__( "Oslo", "proradio")		=> "oslo",
				esc_html__( "Tokyo", "proradio")	=> "tokyo",
				esc_html__( "London", "proradio")	=> "london",
				esc_html__( "Paris", "proradio")	=> "paris",
				esc_html__( "Ibiza", "proradio")	=> "ibiza",
				esc_html__( "New York", "proradio")	=> "newyork",
			),
		   "description" => esc_html__( "Choose effect style", "proradio" )
		),
		/**
		 * Background
		 * =========================================
		 */
		array(
			"group" 	=> esc_html__( "Background", "proradio" ),
			"type" 			=> "attach_image",
			"heading" 		=> esc_html__( "Background image", "proradio" ),
			"param_name" 	=> "bgimg"
		),
		array(
			"group" 	=> esc_html__( "Background", "proradio" ),
			"type" 			=> "attach_image",
			"heading" 		=> esc_html__( "Background image", "proradio" ),
			"param_name" 	=> "bgimg2"
		),

		array(
			"group" 	=> esc_html__( "Background", "proradio" ),
		   	"type" => "colorpicker",
		   	"heading" => esc_html__( "Border color", "proradio" ),
		   	"param_name" => "bordercolor"
		),
		array(
			"group" 	=> esc_html__( "Background", "proradio" ),
		   	"type" => "colorpicker",
			"heading" => esc_html__( "Background color", "proradio" ),
			"param_name" => "bgcolor"
		),

		array(
			"type" 			=> "textfield",
			"heading" 		=> esc_html__( "Class", "proradio" ),
			"param_name" 	=> "class",
			'value' 		=> '',
			'description' => esc_html__( "Add an extra class for CSS styling", "proradio" )
		),

		/**
		 * Button
		 * =========================================
		 */
		array(
			"group" 	=> esc_html__( "Button", "proradio" ),
			"type" => "autocomplete",
			"heading" => esc_html__( "Radio channel play", "proradio" ),
			"param_name" => "radio_id",
			'settings'		=> array( 
					'values' 			=> proradio_autocomplete('radiochannel') ,
					'multiple'       	=> false,
					'sortable'       	=> false,
	          		'min_length'     	=> 1,
	          		'groups'         	=> false,
	          		'unique_values'  	=> true, 
	          		'display_inline' 	=> true,
				),
			"description" => esc_html__( "Play directly a radio channel (link will be ignored)", "proradio" ),
			'dependency' => array(
				'element' => 'post_type',
				'value' => array( 'ids' ),
			),
		),
		array(
			"group" 	=> esc_html__( "Button", "proradio" ),
		   	"type" => "textfield",
		   	"heading" => esc_html__( "Link", "proradio" ),
		   	"param_name" => "link",
		),
		array(
			"group" 	=> esc_html__( "Button", "proradio" ),
		   "type" => "textfield",
		   "heading" => esc_html__( "Link text", "proradio" ),
		   "param_name" => "linktext",
		),
	 );
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_template_3d_header_vc' );
if(!function_exists('proradio_template_3d_header_vc')){
function proradio_template_3d_header_vc() {
  vc_map( array(
	 "name" => esc_html__( "3D Header", "proradio" ),
	 "base" => "qt-3d-header",
	 "icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/section-caption.png' ),
	 "category" => esc_html__( "Theme shortcodes", "proradio"),
	 "params" => proradio_template_3d_header_controls()
  ) );
}}

