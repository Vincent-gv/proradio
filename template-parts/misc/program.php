<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * 
 * Display a program for multi schedules
 * 
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$program = proradio_program_display( $post->ID , false); // no output
if( $program && $program !== ''){
	?>
	<div class="proradio-event-program proradio-spacer-m">
		<h5 class="proradio-caption proradio-caption__s"><span><?php esc_html_e( 'Program' , 'proradio' ); ?></span></h5>
		<?php  
		echo wp_kses_post( $program );
		?>
	</div>
	<hr class="proradio-spacer-m">
	<?php
}