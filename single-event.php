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
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single__nosidebar proradio-paper">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
		get_template_part( 'template-parts/pageheader/pageheader-event' ); 
		?>
		<div class="proradio-maincontent">
			<div class="proradio-section proradio-paper">
				<div class="proradio-container">
					<div class="proradio-row proradio-stickycont">
						<div id="proradio-content" class="proradio-col proradio-s12 proradio-m12 proradio-l8">
							<div class="proradio-entrycontent">
								
								<?php 

								/**
								 * ======================================================
								 * Contents
								 * ======================================================
								 */								
								the_content(); 

								/**
								 * ======================================================
								 * Details table
								 * ======================================================
								 */
								get_template_part( 'template-parts/single/part-event-table' ); 

								/**
								 * ======================================================
								 * Footer with share and rating
								 * ======================================================
								 */
								if( get_theme_mod( 'reaktions_in_events', 1 ) ){
									get_template_part( 'template-parts/single/part-content-footer' ); 
								}

								?>
							</div>
						</div>
						<div id="proradio-sidebarcontainer" class="proradio-col proradio-s12 proradio-m12 proradio-l4 proradio-stickycol">
							<div id="proradio-sidebar" role="complementary" class="proradio-sidebar proradio-sidebar__main proradio-sidebar__rgt">
								<ul class="proradio-row">
									
									<?php  

									/**
									 * ======================================================
									 * Add to calendar
									 * ======================================================
									 */
									get_template_part( 'template-parts/single/part-event-googlecalendar' );
									

									/**
									 * ======================================================
									 * Purchase links
									 * ======================================================
									 */
									get_template_part( 'template-parts/single/part-event-buylinks' ); 
								

									/**
									 * ======================================================
									 * Extra widgets
									 * ======================================================
									 */
									if( is_active_sidebar( 'proradio-event-sidebar' ) ){
										dynamic_sidebar( 'proradio-event-sidebar' ); 
									}

									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		/**
		 * Related
		 */
		if( get_theme_mod( 'related_event' )){
			get_template_part( 'template-parts/single/part-related-event' ); 
		}
		?>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();