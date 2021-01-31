<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Template Name: Archive charts
*/
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
	set_query_var( 'proradio_query_var_posttype' , 'members' ); 
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
					add_filter( 'excerpt_length', 'proradio_excerpt_length_30', 999 );
					/**
					 * 
					 * Custom archive query
					 * 
					 */

					if( is_page() ){
						$is_page = true;
						/**
						 * [$args Query arguments]
						 * @var array
						 */
						$args = array(
							'post_type' 			=> 'chart',
							'post_status' 			=> 'publish',
							'suppress_filters' 		=> false,
							'ignore_sticky_posts' 	=> 1,
							'posts_per_page' 		=> 6,
							'paged' 				=> proradio_get_paged(),
							'orderby' 				=> array ('menu_order' => 'ASC', 'date' => 'DESC')
						);

						/**
						 * [$wp_query execution of the query]
						 * @var WP_Query
						 */
						$wp_query = new WP_Query( $args );
					}
					/**
					 * Loop for archive and archive page
					 */
					if( $is_page ){
						if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$post = $wp_query->post;
							setup_postdata( $post );
							?>
								<div class="proradio-col proradio-col__post proradio-s12 proradio-m4 proradio-l4">
									<?php  
									get_template_part ('template-parts/post/post-chart');
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
								<div class="proradio-col proradio-col__post proradio-s12 proradio-m4 proradio-l4">
									<?php  
									get_template_part ('template-parts/post/post-chart');
									?>
								</div>
							<?php  
						endwhile; else: ?>
							<h3><?php esc_html_e("Sorry, nothing here","proradio"); ?></h3>
						<?php endif;
					}

					add_filter( 'excerpt_length', 'proradio_excerpt_length', 999 );
					
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