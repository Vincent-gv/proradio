<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

$post_metas = get_post_meta( $post->ID );
$classes = array( 'proradio-post','proradio-post__card','proradio-post__card--members','proradio-darkbg','proradio-negative' );
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
				<?php proradio_postcategories( 1, 'membertype' ); ?>
			</p>
			<h3 class="proradio-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
			?>

			<?php  
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
</article>