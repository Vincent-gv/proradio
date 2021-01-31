<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single__nosidebar">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="proradio-paper">
			<?php 
			/**
			 * ======================================================
			 * Page header template
			 * ======================================================
			 */
			set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
			get_template_part( 'template-parts/pageheader/pageheader-chart' ); 
			?>
		</div>
		<div class="proradio-maincontent proradio-bg">
			<div class="proradio-section proradio-paper">
				<div class="proradio-container">
					<?php  
					$has_sidebar = get_theme_mod('chart_sidebar');
					$column_classes = 'proradio-s12 proradio-m12 proradio-l12';
					if($has_sidebar){
						$column_classes = 'proradio-s12 proradio-m12 proradio-l8';
					}
					?>
					<div class="proradio-row proradio-stickycont">
						<div class="proradio-col <?php echo esc_attr( $column_classes ); ?>">
							<div class="proradio-featuredcontent">
								<?php
								if(shortcode_exists( 'qt-chart' )){
									echo do_shortcode('[qt-chart id="'.($post->ID).'"]' );
								}
								?>
							</div>
							<div class="proradio-entrycontent">
								<?php 
								/**
								 * Editor content
								 */
								the_content();
								/**
								 * Taxonomy output
								 */
								$tags = proradio_postcategories( 20, 'chartcategory', false );
								if( $tags ){
									?>
									<hr class="proradio-spacer-s">
									<p class="proradio-tags">
									<?php echo wp_kses_post( $tags ); ?>
									</p>
									<?php 
								}
								?>
							</div>
						</div>
						<?php  
						if($has_sidebar){ 
							?>
							<div id="proradio-sidebarcontainer" class="proradio-col proradio-s12 proradio-m12 proradio-l4 proradio-stickycol">
								<?php get_sidebar(); ?>
							</div>
							<?php  
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php 
		/**
		 * Related
		 */
		if( get_theme_mod( 'related_chart' )){
			get_template_part( 'template-parts/single/part-related-chart' ); 
		}
		?>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();