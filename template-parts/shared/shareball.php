<?php
/**
 * 
 * Display share button
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

if( get_option( 'proradio_reaktions_shareball', 1 ) ){
	?>
	<div class="proradio-shareball">
		<?php echo proradio_do_shortcode( '[proradio_reaktions-shareball]' ); ?>
	</div>
	<?php  
}
