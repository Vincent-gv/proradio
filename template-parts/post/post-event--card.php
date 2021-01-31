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
$country = get_post_meta($post->ID, 'qt_country',true);
$classes = array( 'proradio-post proradio-post__card','proradio-post__card--event','proradio-darkbg proradio-negative' );
$print_date = date_i18n( get_option( 'date_format' ), strtotime( $date ) );
$city = get_post_meta($post->ID, 'proradio_city',true);
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__thumb') ); } ?>
	</div>
	<div class="proradio-post__headercont">
		<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
		<?php  
		get_template_part( 'template-parts/shared/actions' ); 
		?>
		<div class="proradio-post__card__cap">
			<p class="proradio-cats">
				<?php proradio_postcategories( 1, 'eventtype' ); ?>
			</p>
			<h3 class="proradio-post__title proradio-h4 proradio-cutme-t-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="proradio-meta proradio-small">
				<?php if( $city ){ ?><span class="proradio-date"><i class="material-icons">location_on</i><?php echo esc_html( $city ); ?></span><?php } ?>
				<?php get_template_part( 'template-parts/post/interactions' );  ?>
			</p>
		</div>
	</div>
</article>