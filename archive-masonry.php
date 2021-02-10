<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Template Name: Blog masonry
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header(); 
$paged = proradio_get_paged();
?>
<div id="proradio-pagecontent" class="proradio-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/pageheader-archive' ); 
	?>
	
	<div class="proradio-maincontent proradio-bg">
		<?php 
		/**
		 *
		 *  This template can be used also as page template.
		 *  In this case we show the page content only if is a page and is page 1
		 * 
		 */
		get_template_part( 'template-parts/pageheader/customcontent' ); 
		?>
		<div class="proradio-section">
			<div class="proradio-container">
				<div id="proradio-loop" class="proradio-loop proradio-row qt-masonry">
					<?php 

					$template = 'vertical-masonry';

					/**
					 * Loop for archive and archive page
					 */
					if( is_page() ){
						/**
						 * [$args Query arguments]
						 * @var array
						 */
						$args = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'suppress_filters' => false,
							'ignore_sticky_posts' => 1,
							'posts_per_page' => 9,
							'paged' => $paged
						);
						/**
						 * [$wp_query execution of the query]
						 * @var WP_Query
						 */
						$wp_query = new WP_Query( $args );
						if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$post = $wp_query->post;
							setup_postdata( $post );
							?>
								<div class="proradio-loop__item proradio-col proradio-col__post proradio-col__post proradio-s12 proradio-m6 proradio-l4 qt-ms-item">
									<?php  
									get_template_part ('template-parts/post/post', $template);
									?>
								</div>
							<?php  
						endwhile; else: ?>
							<h3><?php esc_html_e("Sorry, nothing here","proradio"); ?></h3>
						<?php endif;
						wp_reset_postdata();
					} else {
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							?>
								<div class="proradio-loop__item proradio-col proradio-col__post proradio-col__post proradio-s12 proradio-m6 proradio-l4 qt-ms-item">
									<?php  
									get_template_part ('template-parts/post/post', $template);
									?>
								</div>
							<?php  
						endwhile; else: ?>
							<h3><?php esc_html_e("Sorry, nothing here","proradio"); ?></h3>
						<?php endif;
					}
					/**
					 * Pagination
					 */
					get_template_part ('template-parts/pagination/part-pagination'); 
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();