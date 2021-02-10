<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
/**
 * Load a different template depending on the current page type.
 * For WooCommerce load a specific template, otherwise load default teplate.
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * ==========================================
 * Support functionality: 
 * Returns true if we need the WooCommerce template, false if is not.
 * ==========================================
 */
if(!function_exists('proradio_is_woocommerce_page')){
	function proradio_is_woocommerce_page(){
		/**
		 * WooCommerce active?
		 */
		if( !function_exists("is_shop") ){
			return false;
		}
		/**
		 * WooCommerce installed, perform additional checks
		 */
		if( is_shop() || is_woocommerce() || is_product_category() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ){
			return true;
		}
		// Default: is not woocommerce
		return false;
	}
}


if( true == proradio_is_woocommerce_page() ){
	get_template_part( 'template-parts/page/page', 'woocommerce' );
} else {
	get_header(); 
	?>
	<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single__nosidebar">
		<?php get_template_part( 'template-parts/page/page' ); ?>
	</div>
	<?php 
	get_footer();
}
