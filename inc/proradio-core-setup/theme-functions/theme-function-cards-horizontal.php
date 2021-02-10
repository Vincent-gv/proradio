<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Mini link cards
 * Icons requires the Icons2Go plugin
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if(!function_exists('proradio_cardshorizontal')){
	function proradio_cardshorizontal ($atts){

		extract( shortcode_atts( array(
		
			// general
			'img'			=> false,
			'bg'			=> false,
			'bgo'			=> false, // background opacity
			
			'title' 		=> false,
			'subtitle'		=> false,
			'text'			=> false,
			'btnlink'		=> false,
			'btntxt'		=> false,
			'target'		=> '_self',
			'btnstyle'		=> false,
			'layout'		=> false
		), $atts ) );

		ob_start();

		?>
		<div class="proradio-cards proradio-cards__horizontal <?php echo esc_attr( $layout ); ?>">
			<div class="proradio-cards__content proradio-card proradio-gradprimary proradio-negative">
				<div class="proradio-cards__content__c">
					<div class="proradio-row">
						<div class="proradio-col proradio-cards__horizontal__col1 proradio-m6 proradio-l6">
							<div class="proradio-cards__horizontal__pad">
								<?php  
								
								/**
								 *  subtitle
								 * ========================================= */
								if( $subtitle ){

										$caption_atts = array(
											'title' => wp_strip_all_tags( $subtitle, true ),
											'negative' => '1',
											'size' => 'xs',
											'anim' => true
										);
										echo proradio_template_caption($caption_atts);
										
								}

								/**
								 * Title
								 * ========================================= */
								if( $title ){
										?>
										<h3 class="proradio-capfont"><?php echo esc_html( $title ); ?></h3>
										<?php
								}

								/**
								 *  text
								 * ========================================= */
								if( $text ){
									?><p><?php echo esc_html( $text ); ?></p><?php
								}


								/**
								 *  text
								 * ========================================= */
								if( $btntxt && $btnlink ){
									?><a href="<?php echo esc_url( $btnlink ); ?>" class="proradio-btn proradio-btn__l <?php echo esc_attr( $btnstyle ); ?>" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html( $btntxt ); ?></a><?php
								}
								
					 			?>

					 		</div>
						</div>
						<div class="proradio-col proradio-cards__horizontal__col2 proradio-m6 proradio-l6">
							<?php 
				 			/**
							 * Header
							 * ========================================= */
							if( $img ){
								$image = wp_get_attachment_image_src($img, 'full'); 
								?>
								<div class="proradio-cards__i"><img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr( $title ); ?>"></div>
								<?php  
							}

							?>
						</div>
					</div>
		 		</div>



	 			<?php 
	 			/**
				 * Background
				 * ========================================= */
				if( $bg ){
					$image = wp_get_attachment_image_src($bg, 'full'); 
					?>
					<img class="proradio-cards__bg <?php if( $bgo ){ echo 'proradio-bgo-'.esc_attr( $bgo ); } ?>" src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background', 'proradio'); ?>">
					<?php  
				}

				?>

				<span class="proradio-hov"></span><div class="proradio-particles"></div>
				
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-cardshorizontal","proradio_cardshorizontal");
	}
	/**
	 *  Visual Composer integration
	 */
	add_action( 'vc_before_init', 'proradio_vc_cardshorizontal' );
	if(!function_exists('proradio_vc_cardshorizontal')){
		function proradio_vc_cardshorizontal() {
		  	vc_map( 
		  		array(
					"name" => esc_html__( "Card horizontal", "proradio" ),
					"base" => "qt-cardshorizontal",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/cardshorizontal.png' ),
					"category" => esc_html__( "Theme shortcodes", "proradio"),
					"params" => array(


					 	// General
					 	// ============================================
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Layout", "proradio" ),
							"param_name" 	=> "layout",
							'value' 		=> array( 
								esc_html__( "Default","proradio") 			=> "",
								esc_html__( "Invert columns","proradio") 			=> "proradio-cards__horizontal__inv",
							)	
						),
						array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Header image", "proradio" ),
							"description"	=> esc_html__( "Squared, 370px", "proradio"),
							"param_name" 	=> "img"
						),
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Subtitle", "proradio" ),
							"param_name" 	=> "subtitle",
						),
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Title", "proradio" ),
							"param_name" 	=> "title",
						),
						
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Text", "proradio" ),
							"param_name" 	=> "text",
						),
						array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Background image", "proradio" ),
							"param_name" 	=> "bg"
						),
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Background image opacity", "proradio" ),
							"param_name"	=> "bgo",
							'std'			=> false,
							'value' 		=> array( 
								esc_html__( "Full","proradio") 		=> false,
								esc_html__( "Half","proradio") 		=> "half",
								esc_html__( "Low","proradio") 		=> "low",
							)			
						),

						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Button text", "proradio" ),
							"param_name" 	=> "btntxt",
						),
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Link", "proradio" ),
							"param_name" 	=> "btnlink",
						),
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Target", "proradio" ),
							"param_name" 	=> "target",
							'value' 		=> array( 
								esc_html__( "Same window","proradio") 			=> "",
								esc_html__( "New window","proradio") 			=> "_blank",
							)	
						),
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Button style", "proradio" ),
							"param_name" 	=> "btnstyle",
							'value' 		=> array( 
								esc_html__( "Default","proradio") 			=> "",
								esc_html__( "Primary","proradio") 			=> "proradio-btn-primary",
							)	
						)
			 		)
		  		) 
			);
		}
	}
}


