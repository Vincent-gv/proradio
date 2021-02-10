<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $post;
$post_id = $post->ID;
$classes = array( 'proradio-post proradio-post__card proradio-post__card--radio','proradio-darkbg proradio-negative' )
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__thumb') ); } ?>
	</div>
	<div class="proradio-post__headercont">
		<div class="proradio-post__card__cap">
			<div>
				<?php  
				if(function_exists('qtmplayer_play_circle')){
					$atts = array(
						'file'=>false,
						'id' 		=> 	$post->ID,
						'classes' => 'proradio-pageheader__actions'
					);
					echo qtmplayer_play_circle( $atts );
				}
				?>
			</div>

	

			<?php  
			$logo = get_post_meta( $post_id, 'qt_radio_logo', true );
			if ($logo){ 
				$logo = wp_get_attachment_image_src($logo,'proradio-post__thumb');
				?>
				<img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr__("logo","proradio"); ?>" class="proradio-post__logo">
			<?php } else { ?>
				<h3 class="proradio-post__title proradio-cutme-t-2 proradio-h2"><a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a></h3>
			<?php } ?>

			<?php 
			$subtitle =  get_post_meta( $post_id,'qt_radio_subtitle', true );
			if( $subtitle ){ ?>
				<p class="proradio-meta proradio-small proradio-cutme-2"><?php echo esc_html( $subtitle ); ?></p>
			<?php } ?>


		</div>
	</div>
</article>