<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */


if( is_active_sidebar( 'proradio-event-sidebar' ) ){
	?>
	<div id="proradio-sidebar" role="complementary" class="proradio-sidebar proradio-sidebar__main proradio-sidebar__rgt">
		<ul class="proradio-row">
			<?php dynamic_sidebar( 'proradio-event-sidebar' ); ?>
		</ul>
	</div>
	<?php 
}