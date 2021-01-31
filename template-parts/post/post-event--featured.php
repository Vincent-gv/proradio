<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

$date = get_post_meta($post->ID, 'proradio_date',true);
$day = '';
$monthyear = '';
if($date && $date != ''){
	$day = date( "d", strtotime( $date ));
	$monthyear=esc_attr(date_i18n("M Y",strtotime($date)));
}



$classes = array('proradio-post' , 'proradio-post__hero','proradio-post__event-feat');
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
			<div class="proradio-bigdate">
			<?php  
			if( $monthyear ){
				?>
				<h4 class="proradio-post__event__d proradio-capfont">
					<span><?php echo esc_html( $day ); ?></span>
					<span><?php echo esc_html( $monthyear ); ?></span>
				</h4>
				<?php
			}
			?>
			</div>


			<div class="proradio-post__hero__caption">


				<?php
				/**
				 * Location details
				 * @var string
				 */
				$string = '';
				$location = get_post_meta($post->ID, 'proradio_location',true);
				if ($location && $location !== ''){
					$string .= esc_html( $location );
				}
				$city = get_post_meta($post->ID, 'proradio_city',true);
				if ($city && $city !== ''){
					if( $location ){ $string .= ' — '; }
					$string .= esc_html( $city );
				}
				if( $string != ''){
					?><p class="proradio-meta proradio-small"><?php echo esc_html( $string ); ?></p><?php
				}
				?>
				<h3 class="proradio-post__title proradio-h1 proradio-cutme-t-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php
				/**
				 * Event artists
				 */
				$proradio_artists = get_post_meta($post->ID, 'proradio_artists',true);
				if ($proradio_artists && $proradio_artists !== ''){
					?>
					<p class="proradio-capfont proradio-h5">
						<a href="<?php the_permalink(); ?>"><?php echo esc_html( $proradio_artists );?></a>
					</p>
					<?php  
				}
				?>

				<?php  
				$excerpt = proradio_custom_shorttext( $post, 70);
				if ( $excerpt !== ''){
					?>
					<div class="proradio-excerpt">
						<p>
						<?php echo wp_kses_post( $excerpt );   ?>
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