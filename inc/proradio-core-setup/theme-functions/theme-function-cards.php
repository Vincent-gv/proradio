<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Mini link cards
 * Icons requires the Icons2Go plugin
*/

if(!function_exists('proradio_cards')){
	function proradio_cards ($atts){
		extract( shortcode_atts( array(
			// general
			'img'			=> false,
			'bg'			=> false,
			'bgo'			=> false,
			'featured'		=> false,
			'title' 		=> false,
			'subtitle'		=> false,
			'btnlink'		=> false,
			'btntxt'		=> false,
			'format'		=> 'def',
			'order'			=> false,
			'btnstyle'		=> false,
			'target'		=> '_self',
		), $atts ) );


		ob_start();

		?>
		<a href="<?php echo esc_attr( $btnlink ); ?>" class="proradio-cards  <?php 
			if( $format ){ echo esc_attr( 'proradio-cards__'.$format ); echo ' '; }
			if( $featured ){ echo 'proradio-cards__featured' ; echo ' '; } 
			if( $order == 'text-image' ){ echo 'proradio-cards__inv' ; echo ' '; } 
			?>" target="<?php echo esc_attr( $target ); ?>">
			<div class="proradio-cards__content proradio-card proradio-gradprimary proradio-negative  <?php if( $featured ){ ?> proradio-gradaccent <?php } ?>">

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

				<div class="proradio-cards__content__c">
					<?php  
					
					/**
					 * Title
					 * ========================================= */
					if( $title ){
						?><h4 class="proradio-capfont"><?php echo esc_html( $title ); ?></h4><?php
					}

					/**
					 *  subtitle
					 * ========================================= */
					if( $subtitle ){
						?><p class="proradio-small"><?php echo esc_html( $subtitle ); ?></p><?php
					}


					if( $btntxt ){
						?><span class="proradio-btn proradio-btn__bold proradio-btn__s <?php echo esc_attr( $btnstyle ); ?>"><?php echo esc_html( $btntxt ); ?></span><?php
					} else {
						?><hr class="proradio-sep"><?php  
					}
					
		 			?>

		 			
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
		</a>
		<?php
		return ob_get_clean();
	}

	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-cards","proradio_cards");
	}
	/**
	 *  Visual Composer integration
	 */
	add_action( 'vc_before_init', 'proradio_vc_cards' );
	if(!function_exists('proradio_vc_cards')){
		function proradio_vc_cards() {
		  	vc_map( 
		  		array(
					"name" => esc_html__( "Cards with link", "proradio" ),
					"base" => "qt-cards",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/cards.png' ),
					"category" => esc_html__( "Theme shortcodes", "proradio"),
					"params" => array(
					 	// General
					 	// ============================================
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Format", "proradio" ),
							"param_name"	=> "format",
							'std'			=> false,
							'value' 		=> array( 
								esc_html__( "Default","proradio") 		=> 'def',
								esc_html__( "Long","proradio") 	=> "sky",
							)			
						),
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Order", "proradio" ),
							"param_name"	=> "order",
							'std'			=> false,
							'value' 		=> array( 
								esc_html__( "Image + Text","proradio") 		=> false,
								esc_html__( "Text + Image","proradio") 		=> "text-image",
							),
							'dependency' 	=> array(
								'element' 		=> 'format',
								'value' 		=> 'sky',
							),		
						),
						array(
							"type" 			=> "checkbox",
							"heading" 		=> esc_html__( "Featured", "proradio" ),
							"param_name" 	=> "featured",
						),
						array(
							"type" 			=> "attach_image",
							"heading" 		=> esc_html__( "Header image", "proradio" ),
							"description"	=> esc_html__( "Squared, 370px", "proradio"),
							"param_name" 	=> "img"
						),
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Title", "proradio" ),
							"param_name" 	=> "title",
						),
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Subtitle", "proradio" ),
							"param_name" 	=> "subtitle",
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
							"heading" 		=> esc_html__( "Link", "proradio" ),
							"param_name" 	=> "btnlink",
						),
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Button text", "proradio" ),
							"description"	=> esc_html__( "Optional", "proradio"),
							"param_name" 	=> "btntxt",
						),
						array(
							"type" 			=> "dropdown",
							"heading" 		=> esc_html__( "Target", "proradio" ),
							"param_name" 	=> "target",
							'value' 		=> array( 
								esc_html__( "Same window","proradio") 			=> "",
								esc_html__( "New window","proradio") 			=> "_blank",
							)	
						)
			 		)
		  		) 
			);
		}
	}
}

