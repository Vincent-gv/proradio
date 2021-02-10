<?php
/**
 * @package proradio
 * @version 1.0.0
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<ul class="proradio-itemmetas proradio-itemmetas__reaktions">
	<li><?php echo proradio_do_shortcode('[proradio_reaktions-views-raw]' ); ?></li>
	<li><?php echo proradio_do_shortcode('[proradio_reaktions-commentscount-raw]' ); ?></li>
	<li><?php echo proradio_do_shortcode('[proradio_reaktions-loveit-raw]' ); ?></li>
</ul>