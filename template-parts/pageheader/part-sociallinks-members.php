<?php
/**
 * Social links
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * =================================
 * Social
 * =================================
 */
ob_start();
$post_metas = get_post_meta( $post->ID );
$social = array('itunes','instagram','linkedin','lastfm','facebook','twitter','pinterest','vimeo','wordpress','youtube','soundcloud','mixcloud','spotify');
foreach( $social as $s ){

	$meta_val = 'QT_'.$s; // "QT_" -> only team members
	
	if( array_key_exists( $meta_val, $post_metas ) ){
		$link = $post_metas[ $meta_val ][0];
		if( $link && $link!== ''){
			$i = 'qt-socicon-'.$s;
			?><a href="<?php echo esc_attr( $link ); ?>" class="noembed" target="_blank"><i class="<?php echo esc_attr( $i ); ?>"></i></a><?php
		}
	}
	
}
$icons = ob_get_clean();
if( $icons ){
	?>
	<div class="proradio-post__social">
		<?php echo wp_kses_post( $icons ); ?>
	</div>
	<?php 
}
