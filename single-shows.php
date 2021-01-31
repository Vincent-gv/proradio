<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single--shows proradio-single__nosidebar">
	<?php 
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post();
		global $post;
		$post_metas = get_post_meta( $post->ID );
		?>
		<div class="proradio-paper">
			<?php 
			/**
			 * ======================================================
			 * Page header template
			 * ======================================================
			 */
			set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
			get_template_part( 'template-parts/pageheader/pageheader-shows' ); 
			?>
		</div>
		
		<div class="proradio-maincontent proradio-bg">
			<?php
			// Timetable
			get_template_part( 'template-parts/single/show/part-single-show-table' ); 
			?>
			<div class="proradio-paper proradio-section">
				<div class="proradio-entrycontents">
					<div class="proradio-container">
						<?php  
						// Content
						the_content();
						// News
						get_template_part( 'template-parts/single/show/part-single-show-news' ); 
						// Team
						get_template_part( 'template-parts/single/show/part-single-show-members' ); 
						// Podcast
						get_template_part( 'template-parts/single/show/part-single-show-podcasts' ); 
						// Chart
						get_template_part( 'template-parts/single/show/part-single-show-chart' ); 
						// Events
						get_template_part( 'template-parts/single/show/part-single-show-events' ); 
						// Show footer
						get_template_part( 'template-parts/single/show/part-content-footer--show' ); 
						?>
					</div>
				</div>
			</div>
			
			<?php 
			// Related
			if( get_theme_mod( 'related_show' )){
				get_template_part( 'template-parts/single/part-related-show' ); 
			}
			?>
		</div>
		<?php 
		endwhile; 
	endif; 
	?>
</div>
<?php 
get_footer();