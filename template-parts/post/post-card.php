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
$classes = array( 'proradio-post proradio-post__card','proradio-darkbg proradio-negative' );
$size_class="proradio-h4";
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'proradio-card', array( 'class' => 'proradio-post__thumb') ); } ?>
	</div>
	<div class="proradio-post__headercont">
		<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
		<?php  
		get_template_part( 'template-parts/shared/actions' ); 
		?>
		<div class="proradio-post__card__cap">
			<?php get_template_part( 'template-parts/post/category' );  ?>
			<h3 class="proradio-post__title <?php echo esc_attr( $size_class ); ?> proradio-cutme-t-4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="proradio-meta proradio-small">
				<?php get_template_part( 'template-parts/post/metas' );  ?>
				<?php get_template_part( 'template-parts/post/interactions' );  ?>
			</p>
		</div>
	</div>
</article>