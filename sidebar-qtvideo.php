<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if( is_active_sidebar( 'proradio-qtvideo-sidebar' ) ){
	?>
	<div id="proradio-sidebar" role="complementary" class="proradio-sidebar proradio-sidebar__main proradio-sidebar__rgt">
		<ul class="proradio-row">
			<?php dynamic_sidebar( 'proradio-qtvideo-sidebar' ); ?>
		</ul>
	</div>
	<?php 
}