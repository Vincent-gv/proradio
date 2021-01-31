<?php
/**
 * 
 * Add mark if is sticky
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

if( is_sticky()) {
	?>
	<div class="proradio-post__sticky"><span class="proradio-meta"><?php esc_html_e( 'Featured', 'proradio' ) ?></span><i class="material-icons">star</i></div>
	<?php
}