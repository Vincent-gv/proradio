<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Template Name: Archive events
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
$paged = proradio_get_paged();
$is_page = false;
set_query_var( 'countdown', 'yes' );
?>
<div id="proradio-pagecontent" class="proradio-pagecontent">
	<?php 
	/**
	 * ======================================================
	 * Archive header template
	 * ======================================================
	 */
	set_query_var( 'proradio_query_var_posttype' , 'event' ); 
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
			<div id="proradio-loop" class="proradio-container">
				<?php 
				if( is_page() ){
					$is_page = true;
					/**
					 * [$args Query arguments]
					 * @var array
					 */
					$args = array(
						'post_type' 		=> 'event',
						'post_status' 		=> 'publish',
						'posts_per_page' 	=> 6,
						'suppress_filters' 	=> false,
						'paged' 			=> proradio_get_paged(),
						'orderby' 			=> 'meta_value',
						'order'   			=> 'ASC',
						'meta_key' 			=> 'proradio_date',
						'suppress_filters' 	=> false,
					);
					/**
					 *  For events we reorder by date and eventually hide past events
					 */
					if(get_theme_mod( 'events_hideold', 0 ) == '1'){
						$args['meta_query'] = array(
							array(
								'key' 		=> 'proradio_date',
								'value' 	=> date('Y-m-d'),
								'compare' 	=> '>=',
								'type' 		=> 'date'
							 )
						);
					}
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
						get_template_part ('template-parts/post/post-event');
					endwhile; 

					/**
					 * Pagination
					 */
					get_template_part ('template-parts/pagination/part-pagination'); 
					wp_reset_postdata();

					else: ?>
						<h3><?php esc_html_e( "Sorry, there are no planned events at the moment.","proradio" ); ?></h3>
					<?php 
					endif;
					
				} else {
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/post/post-event', get_post_format() );
					endwhile; 
					/**
					 * Pagination
					 */
					get_template_part ('template-parts/pagination/part-pagination'); 
					else: ?>
						<h3><?php esc_html_e( "Sorry, there are no planned events at the moment.","proradio"); ?></h3>
					<?php endif;
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php 
remove_query_arg( 'countdown' );
get_footer();