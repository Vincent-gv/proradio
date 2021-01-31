<?php
/*
Package: proradio
*/
if (!function_exists('proradio_short_gallery')){
function proradio_short_gallery($atts){
	extract( shortcode_atts( array(
		'images'    => false,
		'gallery'    => false,
		'thumbsize' => 'thumbnail',
		'linksize'  => 'large'
	), $atts ) );

	
	ob_start();

	if(is_array($atts)){
		if(array_key_exists("images", $atts)){
			$images = explode(',', $images);
		}
		// Alternative: gallery from Elementor
		if( $gallery ){
			if( count($gallery) > 0 ){
				$images = [];
				foreach( $gallery as $photo ){
					$images[] = $photo['id'];
				}
			}
		}
	}
	
	if(count($images) > 0){ 
		?>
			<div class="proradio-gallery proradio-s<?php echo esc_attr($thumbsize); ?>">
				<?php
					foreach($images as $image){
						$thumb = wp_get_attachment_image_src($image, $thumbsize); 
						$link  = wp_get_attachment_image_src($image, $linksize);
						$thumb = $thumb[0];
						$link  = $link[0];
						?>
						<a href="<?php echo esc_url( $link ); ?>" class="proradio-gallery__item">
							<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($image)); ?>">
						</a>
						<?php
					}
				?>
			</div>
		<?php  
	}
	return ob_get_clean();
}}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode('qt-gallery', 'proradio_short_gallery' );
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_short_gallery_vc' );
if(!function_exists('proradio_short_gallery_vc')){
	function proradio_short_gallery_vc() {
	  vc_map( array(
		 "name" 	=> esc_html__( "Gallery", "proradio" ),
		 "base" 	=> "qt-gallery",
		 "icon" 	=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/gallery.png' ),
		 "category" => esc_html__( "Theme shortcodes", "proradio"),
		 "params" 	=> array(
			array(
				"type" 			=> "attach_images",
				"heading" 		=> esc_html__( "Images", "proradio" ),
				"param_name" 	=> "images"
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Image size", "proradio" ),
				"param_name" 	=> "thumbsize",
				"std" 			=> 'm',
				'value' 		=> array(
					esc_html__( "Squared small", "proradio")	=> 'proradio-squared-s',
					esc_html__( "Squared medium", "proradio")	=> 'proradio-squared-m',
					esc_html__( "Thumbnail", "proradio")		=> 'thumbnail',
					esc_html__( "Medium", "proradio")			=> 'medium',
					esc_html__( "Large", "proradio")			=> 'large',
				),
			),
			array(
				"type" 			=> "dropdown",
				"heading" 		=> esc_html__( "Linked image size", "proradio" ),
				"param_name" 	=> "linksize",
				"std" 			=> "large",
				'value' 		=> array(
					esc_html__( "Medium", "proradio")			=> 'medium',
					esc_html__( "Large", "proradio")			=> 'large',
					esc_html__( "Full", "proradio")				=> 'full'
				),
			)		
		 )
	  ) );
	}
}
