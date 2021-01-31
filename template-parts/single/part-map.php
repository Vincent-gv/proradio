<?php
/**
 * Single map display
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * 
 * Handled by Javascript.
 * Requires the QT places plugin and a valid js api key for google maps.
*/

$qt_coord = get_post_meta($post->ID, 'qt_coord', true);
if( $qt_coord ){
	if( function_exists( 'proradio_slugify' ) ){
		$slug =  'proradiomap-single-'.proradio_slugify( $qt_coord );
	} else {
		$slug = 'proradiomap-single-mymap';
	}
	?>
		<div id="<?php echo esc_attr( $slug ); ?>" class="proradio-map-single" data-proradio-mapcoord="<?php echo esc_attr( $qt_coord ); ?>">
			
		</div>
	<?php  
}