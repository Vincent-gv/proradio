<?php
/**
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * 
 * =========================================
 * Extract and display the related posts for a specific post type
 * =========================================
 * 
 */
$related_posttype = 'members';
$related_taxonomy = esc_attr( proradio_get_type_taxonomy( $related_posttype ) );
$related_posts_per_page = 3;


/**
 *
 *  Basic query preparation
 *  
 */
$argsList = array(
	'post_type' => $related_posttype,
	'posts_per_page' => $related_posts_per_page,
	'orderby' => array(  'menu_order' => 'ASC' , 'post_date' => 'DESC'),
	'post_status' => 'publish',
	'post__not_in'=>array(get_the_id())
);




/**
 * 
 * Execute query
 * 
 */
$the_query = new WP_Query($argsList);

?>

<!-- ======================= RELATED SECTION ======================= -->
<?php if ( $the_query->have_posts() ) :

	?>
	<div class="proradio-related proradio-primary-light proradio-section proradio-negative">
		<div class="proradio-container">

			<?php  
			if( function_exists('proradio_template_caption') ){
				echo proradio_template_caption( array( 'title' => esc_html__( 'You may also like', 'proradio'), 'alignment' => 'center', 'negative' => true, 'size' => 'm', 'anim' => 1 ) );
			}
			?>
			<hr class="proradio-spacer_m">
			<div class="proradio-row ">
				<?php 
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					$post = $the_query->post;
					setup_postdata( $post );
					?>
					<div class="proradio-col proradio-s12 proradio-m6 proradio-l4">
						<?php get_template_part ('template-parts/post/post-event--card'); ?>
					</div>
					<?php
				endwhile;
				?>
			</div>
		</div>
	</div>
<?php  endif;
wp_reset_postdata();
