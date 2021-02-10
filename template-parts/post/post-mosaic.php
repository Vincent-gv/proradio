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
$classes = array( 'proradio-post','proradio-post__mosaic','proradio-gradprimary proradio-negative' );
$t_size = '';
if( 1 == get_query_var( 'item_n' ) ){
	$t_size = 'proradio-h2';
}
?>
<article id="post-mosaic-<?php the_ID(); ?>" <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-duotone proradio-bgimg--full">
	<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'proradio-post__mosaic__i') ); } ?>
	</div>
	<div class="proradio-post__mosaic__c">
		<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
		<div class="proradio-post__mosaic__c__c">
			<?php get_template_part( 'template-parts/post/category' );  ?>
			<h3 class="proradio-post__title proradio-cutme-t-3 <?php echo esc_attr( $t_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
	</div>
</article>