<?php
/**
 * 
 * Display the post interactions on top of the header image
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/


$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
$share = false;
?>
<div class="proradio-actions__cont">
	<div class="proradio-actions">
		<?php
		get_template_part( 'template-parts/shared/action-icon' ); 
		?>
		<span class="proradio-actions__a1"><?php echo proradio_do_shortcode('[proradio_reaktions-sharebox-fp class="" label="'.esc_attr__('Share', 'proradio').'" btnclass="proradio-btn  proradio-btn__r" id="'.esc_attr( get_the_id() ).'" url="'.esc_attr( get_the_permalink() ).'"]' ); ?></span>
		<span class="proradio-actions__a2"><?php echo proradio_do_shortcode('[proradio_reaktions-loveit-raw]' ); ?></span>
	</div>
</div>


