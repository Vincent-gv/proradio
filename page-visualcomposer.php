<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Template Name: Page Visual Composer
 * ONAIR2 COMPATIBILITY:
 * This template is a retrocompatibility file for OnAir2 legacy websites.
 */

get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single__fullwidth">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="proradio-maincontent proradio-bg">
			<div class="proradio-entrycontent proradio-paper">
			<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();