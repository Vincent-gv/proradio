<?php
/**
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

$classes = array( 'proradio-post', 'proradio-post__event', 'proradio-darkbg proradio-negative' );
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__event__i') ); } ?>
	</div>
	<div class="proradio-post__event__c">
		<h4 class="proradio-post__event__d proradio-capfont">
			<span><?php echo esc_html( $day ); ?></span>
			<span><?php echo esc_html( $monthyear ); ?></span>
		</h4>
		<div class="proradio-post__event__t">
			
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
			
			<h2 class="proradio-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php
			$proradio_artists = get_post_meta($post->ID, 'proradio_artists',true);
			if ($proradio_artists && $proradio_artists !== ''){
				?>
				<p class="proradio-capfont proradio-h5">
					<a href="<?php the_permalink(); ?>"><?php echo esc_html( $proradio_artists );?></a>
				</p>
				<?php  
			}
			?>
			
		</div>
		<div class="proradio-post__event__b">
			<a href="<?php the_permalink( ); ?>" class="proradio-btn"><?php esc_html_e("More info", "proradio"); ?></a>
		</div>
	</div>
</article>