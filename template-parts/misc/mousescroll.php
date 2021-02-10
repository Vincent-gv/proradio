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

if( get_theme_mod( 'mousescroll', '1' ) ){
	?>
	<div class="proradio-mscroll-container">
		<a id="proradio-scroller-cue" href="#proradio-scroller-cue" class="proradio-mscroll">
			<div class="proradio-mscroll__mouse">
				<div class="proradio-mscroll__wheel"></div>
			</div>
			<div>
				<span class="proradio-mscroll__arrows proradio-mscroll__unu"></span>
				<span class="proradio-mscroll__arrows proradio-mscroll__doi"></span>
				<span class="proradio-mscroll__arrows proradio-mscroll__trei"></span>
			</div>
		</a>
	</div>
	<?php 
}
