<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Template Name: Archive place
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header();
$paged = proradio_get_paged();
$is_page = false;
?>
<div id="proradio-pagecontent" class="proradio-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	set_query_var( 'proradio_query_var_posttype' , 'place' ); 
	get_template_part( 'template-parts/pageheader/pageheader-archive' ); 
	remove_query_arg( 'proradio_query_var_posttype' ); 

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
				<div id="proradio-loop" class="proradio-row">
					<?php 
					/**
					 * Loop for archive and archive page
					 */
					if( is_page() ){

						$is_page = true;
						/**
						 * [$args Query arguments]
						 * @var array
						 */
						$args = array(
							'post_type' 		=> 'place',
							'post_status' 		=> 'publish',
							'posts_per_page' 	=> 9,
							'suppress_filters' 	=> false,
							'paged' 			=> proradio_get_paged(),
							'orderby' 			=>  array ('menu_order' => 'ASC', 'postname' => 'ASC'),
							'order'   			=> 'ASC',
							'suppress_filters' 	=> false,
						);

						/**
						 * [$wp_query execution of the query]
						 * @var WP_Query
						 */
						$wp_query = new WP_Query( $args );
					} 
					if( $is_page ){
						
						if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$post = $wp_query->post;
							setup_postdata( $post );
							?>
								<div class="proradio-col proradio-col__post proradio-col__post proradio-s12 proradio-m6 proradio-l4">
									<?php  
									get_template_part ('template-parts/post/post-place');
									?>
								</div>
							<?php  
							
						endwhile; 

						/**
						 * Pagination
						 */
						get_template_part ('template-parts/pagination/part-pagination'); 
						wp_reset_postdata();

						else: ?>
							<h3><?php esc_html_e("Sorry, there are no places yet.","proradio"); ?></h3>
						<?php 
						endif;
						
					} else {
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							?>
								<div class="proradio-col proradio-col__post proradio-col__post proradio-s12 proradio-m6 proradio-l4">
									<?php  
									get_template_part ('template-parts/post/post-place');
									?>
								</div>
							<?php  
						endwhile; 
						/**
						 * Pagination
						 */
						get_template_part ('template-parts/pagination/part-pagination'); 
						else: ?>
							<h3><?php esc_html_e("Sorry, there are no places yet.","proradio"); ?></h3>
						<?php endif;
					}

					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
get_footer();