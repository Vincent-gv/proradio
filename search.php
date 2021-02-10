<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-search' ); 
	?>
	<div class="proradio-section proradio-bg">
		<div id="proradio-loop" class="proradio-container">
			<?php 
			/**
			 * Loop for archive and archive page
			 */
			add_filter( 'excerpt_length', 'proradio_excerpt_length_30', 999 );
			if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post/post-search' );
				endwhile; else: ?>
					<h3><?php esc_html_e("Sorry, nothing here","proradio"); ?></h3>
				<?php endif;
			add_filter( 'excerpt_length', 'proradio_excerpt_length', 999 );
			/**
			 * Pagination
			 */
			
			?>
			<div class="proradio-row">
				
				<div class="proradio-col proradio-s12 proradio-l7 proradio-offset-l2">
					<?php get_template_part ('template-parts/pagination/part-pagination');  ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();