<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

/**
 * ======================================================
 * This file adds the background image to archive headers.
 * ------------------------------------------------------
 * There are 3 cases:
 * ------------------------------------------------------
 * - Category image
 * - Page featured (for archive templates)
 * - Default customizer picture
 * ======================================================
 */

$header_image = false;

/**
 * ======================================================
 * 1. CUSTOMIZER FEATURED IMAGE
 * ------------------------------------------------------
 * Get the featured image from the customizer
 * ======================================================
 */
if( function_exists('proradio_core_active') ){
	$proradio_header_bgimg = get_theme_mod('proradio_header_bgimg', false);
	if ( $proradio_header_bgimg ){
		$header_image = wp_get_attachment_image_src( $proradio_header_bgimg, 'full' );
	}
}



if( false !== $header_image ){
	$img = $header_image; 
	$proradio_header_parallax = get_theme_mod( 'proradio_header_parallax' );
	if($proradio_header_parallax){
		?>
		<div class="proradio-bgimg proradio-bgimg__parallax proradio-greyscale <?php 
			if( get_theme_mod( 'proradio_header_duotone', '0' ) ){ ?> proradio-duotone <?php 
			} ?>" data-proradio-parallax>
			<img data-stellar-ratio="0.9" src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'proradio'); ?>">
		</div>
		<?php
	} else {
		?>
		<div class="proradio-bgimg <?php 
			if( get_theme_mod( 'proradio_header_greyscale', '1' ) ){ ?> proradio-greyscale <?php }
			if( get_theme_mod( 'proradio_header_duotone', '0' ) ){ ?> proradio-duotone <?php 
			} ?>">
			<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'proradio'); ?>">
		</div>
		<?php
	}
	
}


/**
 * ======================================================
 * Background tone color
 * ======================================================
 */
?> 
<div class="proradio-grad-layer"></div>
<?php


/**
 * ======================================================
 * Background tone color
 * ======================================================
 */
?>
	<div class="proradio-dark-layer"></div>
<?php


/**
 * ======================================================
 * Waves
 * ======================================================
 */
if( get_theme_mod('proradio_header_waves') ){
	$optional_color =  get_theme_mod( 'proradio_accent', '#ff0062' );
	?>
	<div class="proradio-waterwave proradio-waterwave--l1">
	  	<canvas class="proradio-waterwave__canvas" data-waterwave-color="<?php echo esc_attr( $optional_color ); ?>" data-waterwave-speed="0.3"></canvas>
	</div>
	<?php  
	$optional_color = get_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_background', '#f9f9f9' ) ) ;
	?>
	<div class="proradio-waterwave proradio-waterwave--l2">
	  	<canvas class="proradio-waterwave__canvas" data-waterwave-color="<?php echo esc_attr( $optional_color ); ?>" data-waterwave-speed="0.5"></canvas>
	</div>
	<?php
}
