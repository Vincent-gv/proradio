<?php
/**
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 *
 * Template part for displaying posts with horizontal design for desktop
*/

$classes = array('proradio-post','proradio-paper', 'proradio-post__hor');
if( has_post_thumbnail( ) ){
	$classes[] = 'proradio-has-thumb';
} else {
	$classes[] = 'proradio-no-thumb';
}
$classes = implode(' ', $classes);


add_filter( 'excerpt_length', 'proradio_excerpt_length_30', 999 );
?>
<article <?php post_class( esc_attr($classes) ); ?> data-qtwaypoints>
	<?php 
	if( has_post_thumbnail() ){
		?>
		<div class="proradio-post__header proradio-primary-light proradio-negative">
			<div class="proradio-bgimg proradio-duotone">
				<?php 

				if( has_post_thumbnail( ) ){ 
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
				}
				?>

			</div>

			<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
			<?php  
			get_template_part( 'template-parts/shared/actions' ); 
			?>
				
		</div>
		<div class="proradio-post__content">
			<?php get_template_part( 'template-parts/post/category' );  ?>
			<h3 class="proradio-post__title proradio-cutme-t-4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="proradio-excerpt">
				<p>
				<?php echo wp_kses_post( proradio_custom_shorttext( $post, 70));   ?>
				</p>
			</div>
			<p class="proradio-meta proradio-small">
				<?php get_template_part( 'template-parts/post/metas' );  ?>
				<?php get_template_part( 'template-parts/post/interactions' );  ?>
			</p>
		</div>
	<?php 
	} else {
		add_filter( 'excerpt_length', 'proradio_excerpt_length_40', 999 );
		
		?>
		<div class="proradio-post__content">
			<?php get_template_part( 'template-parts/post/category' );  ?>
			<h3 class="proradio-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="proradio-excerpt">
				<p>
				<?php echo wp_kses_post( proradio_custom_shorttext( $post, 80));   ?>
				</p>
			</div>
			<p class="proradio-meta proradio-small">
				<?php get_template_part( 'template-parts/post/metas' );  ?>
				<?php get_template_part( 'template-parts/post/interactions' );  ?>
			</p>
		</div>
		<?php
	}
	?>
</article>
<?php 
add_filter( 'excerpt_length', 'proradio_excerpt_length', 999 );