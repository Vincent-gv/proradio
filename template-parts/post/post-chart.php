<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/


$classes = array('proradio-post','proradio-paper', 'proradio-post__ver', 'proradio-post__ver--chart');
if( has_post_thumbnail( ) ){
	$classes[] = 'proradio-has-thumb';
} else {
	$classes[] = 'proradio-no-thumb';
}

?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<?php 
	/**
	 * Display header if we have the thumbnail
	 */
	if( has_post_thumbnail() ){
		?>
		<div class="proradio-post__header proradio-gradprimary proradio-negative">
			<div class="proradio-bgimg proradio-duotone">
				<?php
				the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__thumb--s') );
				?>
			</div>
			<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
			<?php  
			get_template_part( 'template-parts/shared/actions' ); 
			?>
		</div>
		<?php 
	}
	?>
	<div class="proradio-post__content proradio-paper">
		<p class="proradio-cats">
			<?php proradio_postcategories( 1, 'chartcategory' ); ?>
		</p>
		<h3 class="proradio-post__title proradio-h4 proradio-cutme-t"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php  
		/**
		 * Display excerpt if the thumbnail is missing
		 */
		if( false == has_post_thumbnail( ) ){
			?>
			<p class="proradio-post__ex"><?php echo wp_kses_post( proradio_custom_shorttext( $post, 50));   ?></p>
			<?php 
		}
		?>
		<p class="proradio-meta proradio-small">
			<?php get_template_part( 'template-parts/post/metas' );  ?>
			<?php get_template_part( 'template-parts/post/interactions' );  ?>
		</p>
	</div>
</article>