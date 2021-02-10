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
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single--radiochannel proradio-single__sidebar">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
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
			get_template_part( 'template-parts/pageheader/pageheader-radiochannel' ); 
			?>
		</div>
		<div class="proradio-maincontent proradio-bg">
			<div class="proradio- proradio-paper">
				<div class="proradio-container">
					<div class="proradio-entrycontent <?php if(isset($display_box)){ echo (!$display_box)? 'proradio-section' : ''; } ?> proradio-section">
						<?php  

						/**
						 * Contents
						 */
						the_content();

						/**
						 * Show content footer
						 */
						get_template_part( 'template-parts/single/part-content-footer--show' ); 

						?>
						<hr class="proradio-spacer-l">
					</div>
				</div>
			</div>
			<?php 
			/**
			 * Show content footer
			 */
			get_template_part( 'template-parts/single/part-sociallinks' ); 
			?>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();