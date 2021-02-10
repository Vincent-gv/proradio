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
				
				<p class="proradio-cats">
					<?php proradio_postcategories( 1, 'genre' ); ?>
					<?php if( $current_show ){
						?><?php esc_html_e('Now on air', 'proradio'); ?><?php
					} ?>
				</p>
				<h2 class="proradio-post__title proradio-cutme-t-3" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php  
				$sub =  get_post_meta( $post->ID, 'subtitle2',true );
				if( $sub ){
					?>
					<h5 class="proradio-post__subtitle proradio-cutme-t">
						<?php echo esc_html($sub); ?>
					</h5>
					<?php 
				}
				?>

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
			</div>
		</div>
	</div>
</article>