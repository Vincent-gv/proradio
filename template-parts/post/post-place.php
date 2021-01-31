<?php
/**
 * 
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.1.5
*/

$classes = array('proradio-post','proradio-paper', 'proradio-post__ver');
if( has_post_thumbnail( ) ){
	$classes[] = 'proradio-has-thumb';
} else {
	$classes[] = 'proradio-no-thumb';
}

?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<?php 
	/**
	 * Display header if we have the thumbnail
	 */
	if( has_post_thumbnail() ){
		?>
		<div class="proradio-post__header proradio-gradprimary proradio-negative">
			<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
				<?php 
				if( has_post_thumbnail() ){
					the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__thumb') );
				}; 
				?>
			</div>
			<div class="proradio-post__headercont">
				<?php 
				// get_template_part( 'template-parts/shared/actions' ); 
				?>
			</div>
		</div>
		<?php 
	}
	?>
	<div class="proradio-post__content proradio-paper">
		<p class="proradio-meta proradio-small">
			<i class="material-icons">public</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_country', true )); ?> <i class="material-icons">location_on</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_city', true )); ?>
		</p>
		<h3 class="proradio-post__title proradio-h5 proradio-cutme-t-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php  
		/**
		 * Display excerpt if the thumbnail is missing
		 */
		if( false == has_post_thumbnail( ) ){
			add_filter( 'excerpt_length', 'proradio_excerpt_post_vertical', 999 ); ?>
			<p class="proradio-post__ex"><?php echo get_the_excerpt(); ?></p>
			<p class="proradio-post__readmore"><a href="<?php the_permalink( ); ?>" class="proradio-btn proradio-btn__s"><?php esc_html_e( 'Read more', 'proradio' ); ?></a></p>
			<?php 
			add_filter( 'excerpt_length', 'proradio_excerpt_length', 999 ); 
		}
		?>
	</div>
</article>