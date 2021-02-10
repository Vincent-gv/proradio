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
global $post;
$classes = array( 'proradio-post','proradio-post__card','proradio-post__card--video','proradio-darkbg proradio-negative' );
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__thumb') ); } ?>
	</div>
	<div class="proradio-post__headercont">
		<?php 
		if( get_the_term_list( $post->ID, 'vdl_filters', '', ', ', '') ){?>
			<p class="proradio-meta proradio-small">
			<span class="proradio-p-catsext"><i class="material-icons">label</i><?php proradio_postcategories( 1, 'vdl_filters' ); ?></span>
			</p>
		<?php } ?>
		<div class="proradio-post__card__cap">
			<h3 class="proradio-post__title proradio-cutme-t-3 proradio-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
	</div>
</article>