<?php
/**
 * 
 * Add mark if is sticky
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?><p class="proradio-meta proradio-date"><i class="material-icons">today</i><?php echo get_the_date(); ?></p>