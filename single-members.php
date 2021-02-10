<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.4.5
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
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
			get_template_part( 'template-parts/pageheader/pageheader-members' ); 
			?>
		</div>
		<div class="proradio-maincontent proradio-bg">
			<div class="proradio-section proradio-paper">
				<div class="proradio-container">
					<div class="proradio-entrycontent">
					<?php 

					/**
					 * @since 1.4.5
					 * Related shows for team members
					 */
					get_template_part( 'template-parts/single/part-members-shows' ); 

					
					/**
					 * Editor content
					 */
					the_content();


					/**
					 * Post footer with share
					 */
					get_template_part( 'template-parts/single/part-content-footer' );


					/**
					 * Taxonomy output
					 */
					$tags = proradio_postcategories( 20, 'membertype', false );
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
			</div>
		</div>
		<?php 
		/**
		 * Related
		 */
		if( get_theme_mod( 'related_members' )){
			get_template_part( 'template-parts/single/part-related-members' ); 
		}
		?>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();