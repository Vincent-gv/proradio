<?php
/**
 * 
 * Template part for displaying products
 *
 * @package WordPress
 * @subpackage proradio
 * @subpackage WooCommerce
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_template_part( 'woocommerce/content-product', $name = null );