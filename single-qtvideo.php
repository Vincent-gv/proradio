<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.4.3
 * changelog
 * 1.4.3 Added sidebar 
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header(); 

// Customizer sidebar settings
$hassidebar =  is_active_sidebar( 'proradio-video-sidebar' );

if( $hassidebar ){
	$post_class = 'proradio-pagecontent proradio-single proradio-single__sidebar proradio-paper';
} else {
	$post_class = 'proradio-pagecontent proradio-single proradio-single__nosidebar proradio-paper';
}

// $post_class = 'proradio-pagecontent proradio-single proradio-single__nosidebar proradio-paper';
?>

<div id="proradio-pagecontent" class=" <?php echo esc_attr( $post_class ); ?>">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
		get_template_part( 'template-parts/pageheader/pageheader-qtvideo' ); 
		?>
		<div class="proradio-maincontent">
				<div id="proradio-content">
					<div class="proradio-entrycontent">
				        <div class="proradio-section proradio-paper">
						<?php  
						if( $hassidebar ) {
							get_template_part( 'template-parts/single/single-qtvideo-sidebar' );
						} else {
							get_template_part( 'template-parts/single/single-qtvideo-full' );
						}
						?>
					</div>
				</div>
			</div>
			<?php 
			/**
			 * Related
			 */
			if( get_theme_mod( 'related_video' )){
				get_template_part( 'template-parts/single/part-related-qtvideo' ); 
			}
			?>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();