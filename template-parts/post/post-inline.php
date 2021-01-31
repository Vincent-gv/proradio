<?php
/**
 * 
 * Template part for displaying posts with inline design
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
$classes = array( 'proradio-post' , 'proradio-post__inline', 'proradio-paper' );
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<?php  
	if( has_post_thumbnail()){
		?>
		<a class="proradio-thumb proradio-duotone" href="<?php the_permalink(); ?>">
			<?php 
			the_post_thumbnail( 'proradio-squared-s', array( 'class' => 'proradio-post__thumb', 'alt' => esc_attr( get_the_title() ) ) ); 
			?>
		</a>
		<?php  
	}
	?>
	<h6 class="proradio-post__title proradio-h5 proradio-cutme-t-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
</article>