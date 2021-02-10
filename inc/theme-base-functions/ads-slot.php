<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
 
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Ads display

=============================================*/
if(!function_exists('proradio_ads_display')){
function proradio_ads_display($slot, $classes = ''){
	$content = get_theme_mod($slot);
	
	if( $content == '' || $content == false ){ 
		return; 
	}
	ob_start();
	?>
	<div class="proradio-adsslot <?php echo esc_attr($classes); ?>">
		<?php echo wp_kses_post( do_shortcode( $content ) ); ?>
	</div>
	<?php
	echo ob_get_clean();
}}
