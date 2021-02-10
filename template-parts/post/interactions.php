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

?>
<span><?php echo proradio_do_shortcode('[proradio_reaktions-views-raw]' ); ?></span>
<span><?php echo proradio_do_shortcode('[proradio_reaktions-commentscount-raw]' ); ?></span>
<span><?php echo proradio_do_shortcode('[proradio_reaktions-loveit-raw]' ); ?></span>
<span><?php echo proradio_do_shortcode('[proradio_reaktions-sharebox-fp class="" label="'.esc_attr__('Share', 'proradio').'" btnclass="proradio-btn proradio-btn__r" id="'.get_the_id().'" url="'.esc_attr( get_the_permalink() ).'" ]' ); ?></span>