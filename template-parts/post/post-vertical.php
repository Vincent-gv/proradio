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
			<div class="proradio-bgimg proradio-duotone">
				<?php 
				if( has_post_thumbnail() ){
					/**
					 * Featured image with special class for vertical
					 * @var array
					 */
					$classes = ['proradio-post__thumb'];
					$post_thumbnail_id = get_post_thumbnail_id( );
					$imgmeta = wp_get_attachment_metadata( $post_thumbnail_id );
					if ( $imgmeta[ 'height' ] > $imgmeta[ 'width' ]  ) {
						$classes[] = 'proradio-post__thumb--v';
					} else {
						$classes[] = 'proradio-post__thumb--h';
					}
					$classes = esc_attr( implode(' ', $classes ) );
					the_post_thumbnail( 'proradio-squared-m', array( 'class' => $classes ) );
				}; 
				?>
			</div>
			<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
			<?php  
			get_template_part( 'template-parts/shared/actions' ); 
			?>
		</div>
		<?php 
	}
	?>
	<div class="proradio-post__content proradio-paper">
		<?php get_template_part( 'template-parts/post/category' );  ?>
		<h3 class="proradio-post__title proradio-h4 proradio-cutme-t-4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php  
		/**
		 * Display excerpt if the thumbnail is missing
		 */
		if( false == has_post_thumbnail( ) ){
			?>
			<p class="proradio-post__ex"><?php echo wp_kses_post( proradio_custom_shorttext( $post, 50));   ?></p>
			<?php 
		}
		?>
		<p class="proradio-meta proradio-small">
			<?php get_template_part( 'template-parts/post/metas' );  ?>
			<?php get_template_part( 'template-parts/post/interactions' );  ?>
		</p>
	</div>
</article>