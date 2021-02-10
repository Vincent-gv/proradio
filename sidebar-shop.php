<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ){
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
}

if( is_active_sidebar( 'proradio-woocommerce-sidebar' ) && $layout !== 'fullpage' ){
	?>
	<div id="proradio-sidebarcontainer" class="proradio-col proradio-s12 proradio-m12 proradio-l4">
		<div id="proradio-sidebar-woocommerce" role="complementary" class="proradio-sidebar proradio-sidebar__shop proradio-sidebar__main proradio-sidebar__<?php echo esc_attr( $layout ) ?>">
			<ul class="proradio-row">
				<?php dynamic_sidebar( 'proradio-woocommerce-sidebar' ); ?>
			</ul>
		</div>
	</div>
	<?php 
}
