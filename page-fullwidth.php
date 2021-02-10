<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Template Name: Page FullWidth
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single__fullwidth">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		<div class="proradio-maincontent proradio-bg">
			<div class="proradio-entrycontent">
			<?php the_content(); ?>
			</div>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();