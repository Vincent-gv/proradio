<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

get_header('shop'); 
?>
	<div class="proradio-maincontent">
		<div class="proradio-entrycontent">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
<?php 
get_footer('shop');