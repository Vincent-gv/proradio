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
$post_metas = get_post_meta( $post->ID );
?>
<article id="post-hero-<?php the_ID(); ?>" <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-post__header proradio-darkbg proradio-negative">
		<div class="proradio-bgimg proradio-duotone">
			<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'proradio-post__thumb') ); } ?>
		</div>
		<div class="proradio-post__headercont">
			<?php  
			get_template_part( 'template-parts/shared/actions' ); 
			?>
			<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
			<div class="proradio-post__hero__caption">
				<p class="proradio-cats">
					<?php proradio_postcategories( 1, 'membertype' ); ?>
				</p>
				<h3 class="proradio-post__title proradio-h1 proradio-cutme-t-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php

				$social_a = array('itunes','instagram','linkedin','facebook','twitter','pinterest','vimeo','wordpress','youtube');
				$socials = '';

				foreach( $social_a as $s ){
					$meta_val = 'QT_'.$s;
					if( $post_metas && array_key_exists( $meta_val, $post_metas ) ){
						$link = $post_metas[ $meta_val ][0];
						if( $link && $link!== ''){
							$i = 'qt-socicon-'.$s;
							$socials .= '<a href="'.esc_attr( $link ).'" target="_blank"><i class="'.esc_attr( $i ).'"></i></a>';
						}
					}
				}

				if($socials != ''){ 
					?>
					<p class="proradio-post__social">
						<?php echo wp_kses_post( $socials, array('a','i') ); ?>
					</p>
					<?php 
				}

				/**
				 * Bio
				 */
				if( $post_metas && array_key_exists( 'member_incipit', $post_metas ) ){
					$bio = $post_metas['member_incipit'][0];
					if( $bio != ''){
						?>
						<div class="proradio-excerpt">
							<p class="proradio-cutme-3">
							<?php echo wp_strip_all_tags( $bio, false );   ?>
							</p>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</article>