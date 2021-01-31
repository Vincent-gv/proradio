<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Pricing tables
 *
 * Example:
 * Due to the serialized nature of the data for this shortcode, 
 * is not possible to use it out of page builder
*/

if(!function_exists('proradio_pricingtable')){
	function proradio_pricingtable ($atts){

		extract( shortcode_atts( array(

			// Icons (require Icons2Go plugin)
			'icontype' => false,
			'type' => false,
			'elementor_icon' => false,

			// general
			'title' 		=> false,
			'subtitle' 		=> false,
			'footertext'	=> false,
			'featured'		=> false,
			'bg'			=> false,
			'bgo'			=> false,

			// price
			'price' 		=> false,
			'cents'			=> false,
			'coin'			=> false,
			'details'		=> false,
			
			// button
			'btntext'		=> false,
			'btnlink'		=> false,
			'target'		=> '_self',

			// items
			'items' 		=> [],
			
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


		/**
		 * Unserialize the values of items using Page Builder's function vc_param_group_parse_atts
		 */
		if( count($atts['items']) > 0 ){
			if( !is_array($atts['items'][0]  ) ){
				if(function_exists('vc_param_group_parse_atts') ){
					$items = vc_param_group_parse_atts( $atts['items'] );
				}
			}
		}


		ob_start();

		?>
		<div class="proradio-pricingtable <?php if( $featured ){ ?> proradio-pricingtable__featured <?php } ?>">

			<div class="proradio-pricingtable__content proradio-card proradio-gradprimary <?php if( $featured ){ ?> proradio-gradaccent <?php } ?> proradio-negative">
				<?php  

				/**
				 * Special icon // Icons2Go plugin required
				 * ========================================= */
				if($icontype){
					?>
					<i class="proradio-gradicon proradio-pricingtable__icon t2gicons-icon <?php echo esc_attr($icontype); ?>"></i>
					<?php
				}

				/**
				 * Special icon // Icons2Go plugin required
				 * ========================================= */
				if($elementor_icon){
					?>
					<i class="proradio-gradicon proradio-pricingtable__icon  <?php echo esc_attr( $elementor_icon['value'].' '.$elementor_icon['library'] ); ?>"></i>
					<?php
				}

				/**
				 * Title and subtitle
				 * ========================================= */
				if( $title ){
					?><h4 class="proradio-capfont"><?php echo esc_html( $title ); ?></h4><?php
				}
				if( $subtitle ){
					?><h6><?php echo esc_html( $subtitle ); ?></h6><?php
				}
	 
				/**
				 * Price section
				 * ========================================= */
				if( $price ){
					?>
					<div class="proradio-pricingtable__pc">
						<?php if( $coin ){ ?><span class="proradio-pricingtable__coin"><?php echo esc_html( $coin ); ?></span><?php } ?>
						<?php if( $price ){ ?><var class="proradio-pricingtable__price"><?php echo esc_html( $price ); ?><?php if( $cents ){ ?><sup><?php echo esc_html( $cents ); ?></sup><?php if( $details ){ ?><sub class="proradio-itemmetas <?php if( $cents ){ ?>l<?php } ?>"><?php echo esc_html( $details ); ?></sub><?php } ?></var><?php } ?><?php } ?>
						
					</div>

					<?php  
				}

				/**
				 * Features
				 * ========================================= */
				if( is_array( $items ) ){
					if( count($items) > 0) {
						?>
						<ul>
							<?php  
							foreach( $items as $item ){
								if( array_key_exists( "text", $item ) ){
									if( !array_key_exists( "icon", $item ) ){
										$icon = false;
									} else {
										$icon = $item['icon'];
									}
									if( !array_key_exists( "status", $item ) ){
										$status = false;
									} else {
										$status = $item['status'];
										if($status){
											$status = 'active';
										} else {
											$status = 'inactive';
										}
									}
									?><li class="<?php echo esc_attr( $status ); ?>"><?php if( $icon ){ ?><i class="material-icons"><?php echo esc_html( $icon ); ?></i><?php } ?> <?php echo esc_html( $item["text"] ); ?></li><?php
								}
							}
							?>
						</ul>
						<?php
					}
				}
	 

				/**
				 * Button
				 * ========================================= */
				if( $btntext && $btnlink ){
					?>
					<a href="<?php echo esc_url( $btnlink ); ?>" class="proradio-btn proradio-btn-primary proradio-btn__full" target="<?php echo esc_attr( $target ); ?>"><?php echo esc_html( $btntext ); ?></a>
					<?php
				}



				/**
				 * Button
				 * ========================================= */
				if( $footertext ){
					?>
					<p class="proradio-itemmetas proradio-pricingtable__foot "><?php echo wp_kses_post( $footertext ); ?></p>
					<?php
				}


				/**
				 * Background
				 * ========================================= */
				if( $bg ){
					$image = wp_get_attachment_image_src($bg, 'full'); 
					?>
					<img class="proradio-pricingtable__bg <?php if( $bgo ){ echo 'proradio-bgo-'.esc_attr( $bgo ); } ?>" src="<?php echo esc_url($image[0]); ?>" alt="<?php esc_attr_e('Background', 'proradio'); ?>">
					<?php  
				}
				
				?>
			</div>

		</div>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-pricingtable","proradio_pricingtable");
}
/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_vc_pricingtable' );
if(!function_exists('proradio_vc_pricingtable')){
	function proradio_vc_pricingtable() {
	  	vc_map( 
	  		array(
				"name" => esc_html__( "Pricing table", "proradio" ),
				"base" => "qt-pricingtable",
				"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/pricingtable.png' ),
				"description" => esc_html__( "Create a pricing table column", "proradio" ),
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
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Subtitle", "proradio" ),
						"param_name" 	=> "subtitle",
					),
					array(
						"type" 			=> "checkbox",
						"heading" 		=> esc_html__( "Featured", "proradio" ),
						"param_name" 	=> "featured",
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Footer text", "proradio" ),
						"param_name" 	=> "footertext",
					),
					array(
						"type" 			=> "attach_image",
						"heading" 		=> esc_html__( "Background", "proradio" ),
						"param_name" 	=> "bg"
					),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Background opacity", "proradio" ),
						"param_name"	=> "bgo",
						'std'			=> false,
						'value' 		=> array( 
							esc_html__( "Full","proradio") 		=> false,
							esc_html__( "Half","proradio") 		=> "half",
							esc_html__( "Low","proradio") 		=> "low",
						)			
					),

			  		//	Price
			  		//	================================================
					array(
						'group' 		=> esc_html__( 'Price', 'proradio' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Price", "proradio" ),
						"param_name" 	=> "price",
					),
					array(
						'group' 		=> esc_html__( 'Price', 'proradio' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Price cents", "proradio" ),
						"param_name" 	=> "cents",
					),
					array(
						'group' 		=> esc_html__( 'Price', 'proradio' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Coin symbol (eg. $)", "proradio" ),
						"param_name" 	=> "coin",
					),
					array(
						'group'		 	=> esc_html__( 'Price', 'proradio' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Price details (for instance MONTHLY)", "proradio" ),
						"param_name" 	=> "details",
					),
					
					//	Button
			  		//	================================================
					array(
						'group' 		=> esc_html__( 'Button', 'proradio' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Button text", "proradio" ),
						"param_name" 	=> "btntext",
					),
					array(
						'group' 		=> esc_html__( 'Button', 'proradio' ),
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Button link", "proradio" ),
						"param_name" 	=> "btnlink",
					),
					array(
						'group' 		=> esc_html__( 'Button', 'proradio' ),
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Button target", "proradio" ),
						"param_name" 	=> "target",
						'value' 		=> array( 
							esc_html__( "Same window","proradio") 			=> "",
							esc_html__( "New window","proradio") 			=> "_blank",
						)	
					),
					
					array(
						'group' 		=> esc_html__( 'Features', 'proradio' ),
						'type' 			=> 'param_group',
						'value' 		=> '',
						'param_name' 	=> 'items',
						'params' 		=> array(
							array(
								'type' 			=> 'textfield',
								'value' 		=> '',
								'heading' 		=> esc_html__('Features item', 'proradio'),
								'param_name' 	=> 'text',
							),
							array(
								"type" 			=> "dropdown",
								"heading" 		=> esc_html__( "Icon", "proradio" ),
								"param_name"	=> "icon",
								'std'			=> false,
								'value' 		=> array( 
									esc_html__( "Default","proradio") 			=> "",
									esc_html__( "check","proradio") 			=> "check",
									esc_html__( "close","proradio") 			=> "close",
									esc_html__( "add","proradio") 				=> "add",
									esc_html__( "chevron_right","proradio") 	=> "chevron_right",
								)			
							),
							array(
								"type" 			=> "dropdown",
								"heading" 		=> esc_html__( "Status", "proradio" ),
								'description' 	=> esc_html__('Is this feature included in the plan?', 'proradio'),
								"param_name"	=> "status",
								'std'			=> '1',
								'value' 		=> array( 
									esc_html__( "Included","proradio") 			=> "1",
									esc_html__( "Not included","proradio") 		=> "0",
								)			
							),
						)
					)
		 		)
	  		) 
		);
	}



}




/**
 * T2gIcons selector
 */







/**
 * Array of icon famimlis for dropdown
 */
if( !function_exists( 'proradio_t2gicons_familieslist' ) ) {
	function proradio_t2gicons_familieslist(){
		if( !function_exists( 't2gicons_families' )) {
			return array();
		}
		$t2gicons_families = t2gicons_families();
		$icons = array();
		foreach( $t2gicons_families as $family ){
			if( get_option($family['options_name']) == '1' ) {
				$icons[ $family[ 'label' ] ] = $family[ 'options_name' ];
			}
		}
		return $icons;
	}
}

if(!function_exists('proradio_add_font_picker_pricingtable') && function_exists( 't2gicons_families' )){

	add_action( 'vc_after_init', 'proradio_add_font_picker_pricingtable', 1200 );
	function proradio_add_font_picker_pricingtable() {
		$t2gicons_families = t2gicons_families();


		// Add icon family dropdown
		vc_add_param( 
			'qt-pricingtable', 
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon library', 'proradio' ),
				'value' => proradio_t2gicons_familieslist(),
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
					'qt-pricingtable', 
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
