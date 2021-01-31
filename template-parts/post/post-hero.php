<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
$classes = array('proradio-post' , 'proradio-post__hero ');
$proradio_post_excerpt = get_query_var('proradio_post_excerpt', '1' );
?>
<article id="post-hero-<?php the_ID(); ?>" <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-duotone">
			<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'proradio-post__thumb') ); } ?>
		</div>
	<div class="proradio-post__header proradio-darkbg proradio-negative">
		
		<div class="proradio-post__headercont proradio-container">
			<?php  
			get_template_part( 'template-parts/shared/actions' ); 
			?>
			<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
			<div class="proradio-post__hero__caption">
				<?php get_template_part( 'template-parts/post/category' );  ?>
				<h3 class="proradio-post__title proradio-h1 proradio-cutme-t-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php  
				if( $proradio_post_excerpt == '1'){
					?>
					<div class="proradio-excerpt">
						<p>
						<?php echo wp_kses_post( proradio_custom_shorttext( $post, 70)); ?>
						</p>
					</div>
					<?php  
				}
				?>
				<p class="proradio-meta proradio-small">
					<?php get_template_part( 'template-parts/post/metas' );  ?>
					<?php get_template_part( 'template-parts/post/interactions' );  ?>
				</p>
			</div>
		</div>
	</div>
</article>