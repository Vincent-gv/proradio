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
$print_date = date_i18n( get_option( 'date_format' ), strtotime(get_post_meta( $post->ID,  '_podcast_date',true )) );
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
			<p class="proradio-cats">
				<?php proradio_postcategories( 1, 'podcastfilter' ); ?>
			</p>
			<h3 class="proradio-post__title proradio-h4 proradio-cutme-t-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="proradio-meta proradio-small">
				<?php if( $print_date ){ ?><span class="proradio-date"><i class="material-icons">today</i><?php echo esc_html( $print_date ); ?></span><?php } ?>
				<?php get_template_part( 'template-parts/post/interactions' );  ?>
			</p>
		</div>
	</div>
</article>