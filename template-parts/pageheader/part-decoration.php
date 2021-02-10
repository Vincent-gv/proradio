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

if( 'default' == get_theme_mod( 'header_decor', 'none' ) ){
	?>
	<i class="proradio-decor proradio-center"></i>
	<?php 
}