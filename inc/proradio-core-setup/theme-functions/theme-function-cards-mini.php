<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Mini link cards
 * Icons requires the Icons2Go plugin
*/

if(!function_exists('proradio_cardsmini')){
	function proradio_cardsmini ($atts){

		extract( shortcode_atts( array(
			// Icons (require Icons2Go plugin)
			'icontype' => false,
			'type' => false,
			// general
			'bg'			=> false,
			'bgo'			=> false,
			'title' 		=> false,
			'btnlink'		=> false,
			'target'		=> '_self',
		), $atts ) );

		/**
		 * Icons2Go plugin attachment for special icons
		 * @var [type]
		 */
		if( function_exists( 't2gicons_families' )) {
			$t2gicons_families = t2gicons_families();
			if($icontype == false){
				if($type != false){
					if(array_key_exists($type, $atts)){
						$icontype = $atts[$type];
					} else {
						if(array_key_exists($type, $t2gicons_families)){
							$icontype = $t2gicons_families[$type]["classes"][0];
						}
					}
				}
			}
		}

		ob_start();

		?>
		<a href="<?php echo esc_attr( $btnlink ); ?>" class="proradio-cards proradio-cards__mini" target="<?php echo esc_attr( $target ); ?>">
			<div class="proradio-cards__content proradio-card proradio-gradprimary proradio-negative">
				
				<div class="proradio-cards__mini__c">
					<?php  

					/**
					 * Special icon // Icons2Go plugin required
					 * ========================================= */
					if($icontype){
						?>
						<i class="proradio-gradicon proradio-cards__icon t2gicons-icon <?php echo esc_attr($icontype); ?>"></i>
						<?php
					}

					/**
					 * Title and subtitle
					 * ========================================= */
					if( $title ){
						?><h6 class="proradio-capfont"><?php echo esc_html( $title ); ?></h6><hr class="proradio-sep proradio-stripes__accent"><?php
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
		proradio_core_custom_shortcode("qt-cardsmini","proradio_cardsmini");
	}
	/**
	 *  Visual Composer integration
	 */
	add_action( 'vc_before_init', 'proradio_vc_cardsmini' );
	if(!function_exists('proradio_vc_cardsmini')){
		function proradio_vc_cardsmini() {
		  	vc_map( 
		  		array(
					"name" => esc_html__( "Card icon", "proradio" ),
					"base" => "qt-cardsmini",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/cardsmini.png' ),
					"category" => esc_html__( "Theme shortcodes", "proradio"),
					"params" => array(
					 	// General
					 	// ============================================
						array(
							"type" 			=> "textfield",
							"heading" 		=> esc_html__( "Title", "proradio" ),
							"param_name" 	=> "title",
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




	/**
	 * 
	 * T2gIcons selector
	 * =================================================================
	 * If you install the bundled premium plugin t2g Icons you can here choose an icon
	 * from a special icon font.
	 * Strings are translated by the external plugin.
	 * 
	 */

	if( !function_exists( 'proradio_t2gicons_familieslist' ) ) {
		function proradio_t2gicons_familieslist(){
			if( !function_exists( 't2gicons_families' )) {
				return array();
			}
			$t2gicons_families = t2gicons_families(); // External plugin bundled with the theme with custom Icon Fonts
			$icons = array();
			foreach( $t2gicons_families as $family ){
				if( get_option($family['options_name']) == '1' ) {
					$icons[ $family[ 'label' ] ] = $family[ 'options_name' ]; // Strings are translated by the external plugin.
				}
			}
			return $icons;
		}
	}

	if(!function_exists('proradio_add_font_picker_cardsmini') && function_exists( 't2gicons_families' )){
		add_action( 'vc_after_init', 'proradio_add_font_picker_cardsmini', 1200 );
		function proradio_add_font_picker_cardsmini() {
			$t2gicons_families = t2gicons_families();
			// Add icon family dropdown
			vc_add_param( 
				'qt-cardsmini', 
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icon library', 'proradio' ),
					'value' => proradio_t2gicons_familieslist(), // External plugin bundled with the theme with custom Icon Fonts
					'weight' => 10,
					'admin_label' => true,
					'param_name' => 'type',
					"std"	=> '',
					'description' => esc_html__( 'Select icon library.', 'proradio' )
				)
			);
			foreach($t2gicons_families as $family){
				if(get_option($family['options_name']) == '1') {
					vc_add_param( 
						'qt-cardsmini', 
						array(
							'type' => 'iconpicker',
							'heading' => esc_html__( 'Icon', 'proradio' ),
							'param_name' => $family['options_name'],
							'value' => $family['classes'][0],
							'weight' => 1,
							'settings' => array(
								'emptyIcon' => false,
								'type' => $family['options_name'],
								'iconsPerPage' => 4000,
							),
							'dependency' => array(
								'element' => 'type',
								'value' => $family['options_name'],
							),
							'description' => esc_html__( 'Select icon from library.', 'proradio' )
						)
					);
				}
			}
		}
	}
}