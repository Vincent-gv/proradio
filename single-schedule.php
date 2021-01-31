<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		<div class="proradio-maincontent">
			<div class="proradio-section proradio-paper">
				<div class="proradio-container">
					<div class="proradio-entrycontent">
						<div class="proradio-the_content">
							<?php  
							get_template_part( 'template-parts/schedule/schedule-day' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();