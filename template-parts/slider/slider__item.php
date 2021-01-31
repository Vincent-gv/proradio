<?php
/**
 * 
 * Template part for displaying posts with Hero design (title in image)
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
ob_start();
$series = false;
if( function_exists( 'proradio_series_custom_series_name' )){
	$series = get_the_terms( $post->ID, proradio_series_custom_series_name());
}

$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}



?>
<article id="proradio-slider-post-<?php the_ID(); ?>" class="proradio-post proradio-slider__item proradio-negative">
	<div class="proradio-slider__img proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php 
		if( has_post_thumbnail( $post->ID )){
			the_post_thumbnail( 'full', array( 'class' => 'proradio-slider__i', 'alt' => esc_attr( get_the_title() ) ) );
		}
		?>
	</div>
	<div class="proradio-slider__c proradio-slider__c--post">
		<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
		<div class="proradio-container">
			<p class="proradio-cats">
				<?php proradio_postcategories( 1 ); ?>
			</p>
			<h3 class="proradio-post__title proradio-cutme-t-3 proradio-h1" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="proradio-slider__exc">
				<p class="proradio-cutme-t-3">
					<?php 
					// Custom excerpt without any shortcode or media
					echo wp_kses_post( proradio_custom_shorttext( $post, 70)); 
					?>
				</p>
			</div>
		</div>
		<?php 
		/**
		 * Action content
		 * ===============================
		 */
		?>
	</div>
		
</article>
<?php  
echo ob_get_clean();