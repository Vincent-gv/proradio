<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$author = get_post_meta( $post->ID, 'proradio_author', true );
$role = get_post_meta( $post->ID, 'member_role', true );
$classes = array( 'proradio-post','proradio-post__testimonial','proradio-darkbg proradio-negative' );
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__thumb') ); } ?>
	</div>
	<div class="proradio-post__headercont">
		<div class="proradio-post__testimonial__cap">
			<div class="proradio-capdec">
				<h5 class="proradio-capfont"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $author ); ?></a></h5>
				<p class="proradio-meta proradio-small"><?php echo esc_html( $role ); ?></p>
			</div>
			<p class="proradio-intro">
				"<?php the_title(); ?>"
			</p>
		</div>
	</div>
</article>