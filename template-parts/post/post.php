<?php
/**
 * 
 * Template part for displaying posts default style
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

$classes = array('proradio-post', 'proradio-paper', 'proradio-post__std');
if( has_post_thumbnail( ) ){
	$classes[] = 'proradio-has-thumb';
}
$size_class="proradio-h2";
if( is_sticky() ){
	$classes[] = 'proradio-primary proradio-negative';
	$size_class="proradio-h1";
}
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<?php 
	if( has_post_thumbnail() ){
		?>
		<div class="proradio-post__header proradio-primary-light  proradio-negative">
			<div class="proradio-bgimg proradio-duotone">
				<?php  
				/**
				 * Featured image with special class for vertical
				 * @var array
				 */
				$classes = ['proradio-post__holder'];
				$post_thumbnail_id = get_post_thumbnail_id( );
				$imgmeta = wp_get_attachment_metadata( $post_thumbnail_id );
				if ( $imgmeta[ 'height' ] > $imgmeta[ 'width' ]  ) {
					$classes[] = 'proradio-post__thumb--v';
				} else {
					$classes[] = 'proradio-post__thumb--h';
				}
				$classes = esc_attr( implode(' ', $classes ) );
				the_post_thumbnail( 'large', array( 'class' => $classes ) );
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
	<div class="proradio-post__content">
		<?php get_template_part( 'template-parts/post/category' );  ?>
		<h3 class="proradio-post__title <?php echo esc_attr( $size_class ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="proradio-excerpt">
			<p class="proradio-cutme-3">
			<?php echo wp_kses_post( proradio_custom_shorttext( $post, 70));   ?>
			</p>
		</div>
		<p class="proradio-meta proradio-small">
			<?php get_template_part( 'template-parts/post/metas' );  ?>
			<?php get_template_part( 'template-parts/post/interactions' );  ?>
		</p>
	</div>
</article>