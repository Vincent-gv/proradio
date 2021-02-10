<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage Player
 * @version 1.5.4
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$playercontainer_class = 'proradio-playercontainer--regular';
if(function_exists('qtmplayer_is_in_popup')){
	if( qtmplayer_is_in_popup() ){
		$playercontainer_class = 'proradio-playercontainer--popup';
	} 
}
?>
<div id="proradio-playercontainer" class="proradio-playercontainer proradio-playercontainer--footer <?php echo esc_attr( $playercontainer_class ); ?>">
	<?php
	if(function_exists('qtmplayer_interface')){ 
		qtmplayer_interface(); 
	} 
	?>
</div>