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

$play_label = get_theme_mod( 'proradio_play_label');
$classes = ['proradio-btn','proradio-btn--playmenu','proradio-btn__r'];
if( $play_label ){
	$classes[] = 'proradio-icon-l';
} else {
	$classes[] = 'proradio-btn__r';
}
$classes = implode(' ',$classes);
?> 
<a class="<?php echo esc_attr( $classes ); ?>" data-qtmplayer-playbtn><i class='material-icons'>play_arrow</i><?php echo esc_html( $play_label ); ?></a> 
