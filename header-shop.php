<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header();
$classes = array('proradio-pagecontent', 'proradio-master__woocommerce');
if ( is_shop() || is_tax( 'product_cat' )  || is_tax( 'product_tag' ) ){
	$layout = get_theme_mod( 'proradio_woocommerce_design', 'fullpage' );

} else {
	$layout = get_theme_mod( 'proradio_woocommerce_design_single', 'fullpage' );
	/**
	 * Check for meta fields override
	 */
	$proradio_post_template = get_post_meta(get_the_ID(),  'proradio_post_template' , true);
	if($proradio_post_template){
		$layout = $proradio_post_template;
	}	
	$classes[] = 'product';
}
$classes = implode(' ', $classes);


?>

	<div id="proradio-pagecontent" <?php post_class( $classes ); ?>>
	<?php 
	/**
	 * ======================================================
	 * Page header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-shop' );
	?>
	<div id="proradio-woocommerce-section" class="proradio-section proradio-bg">
		<div class="proradio-container">
			<div class="proradio-row">