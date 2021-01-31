<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
$classes = array( 'proradio-post','proradio-post__search' );
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	
	<div class="proradio-post__content proradio-post__search__c <?php if( has_post_thumbnail()){ ?>proradio-thmb<?php } ?>">
		<p class="proradio-meta proradio-small">
			<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
		</p>
		<h3><a class="proradio-cutme-t-2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt(); ?>
	</div>
</article>