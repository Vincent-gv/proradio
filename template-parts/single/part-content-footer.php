<?php
/**
 * Footer for post content in single posts
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
if( function_exists( 'proradio_reaktions_social' ) || function_exists( 'proradio_reaktions_rating' )  || function_exists( 'qtmplayer_downloadlink' ) ){
	?>
	<div class="proradio-entrycontent__footer">
		<div class="proradio-entrycontent__share">
			<?php 
			if( function_exists( 'proradio_reaktions_social' ) ){
				echo proradio_reaktions_social('proradio-btn');
			}
			?>
		</div>
		<div class="proradio-entrycontent__rating">
			<?php
			if( function_exists( 'proradio_reaktions_rating' ) ){
				echo proradio_reaktions_rating();
			}
			?>
		</div>
	</div>
	<?php  
}