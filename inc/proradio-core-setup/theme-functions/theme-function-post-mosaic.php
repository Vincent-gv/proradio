<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-list post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'proradio_template_post_mosaic' )){
	function proradio_template_post_mosaic( $atts = array() ){

	

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(

			// Query parameters
			'post_type' 			=> 'post',
			'include_by_id'			=> false,
			'custom_query'			=> false,
			'tax_filter'			=> false,
			'items_per_page'		=> 3,
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,

			'exclude'				=> '',

			// Global parameters
			'el_id'					=>  uniqid( 'qt-post-list-'.get_the_ID() ),
			'el_class'				=> '',
			'list_id'				=> false // required for compatibility with WPBakery Page Builder
		), $atts ) );


		$list_id = md5( serialize($atts) );
		$paged = 1;

		include 'helpers/query-prep.php';

		// This value is fixed
		$args['items_per_page'] = 3;

		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;

		ob_start();
		if ( $wp_query->have_posts() ) : 

			?>
			<div id="<?php echo esc_attr( $list_id ); ?>" class="proradio-mosaic">
				<div class="proradio-mosaic__c">
					<?php  
					/**
					 * Loop
					 */
					set_query_var( 'item_n', 1 );
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
						setup_postdata( $post );
						get_template_part ('template-parts/post/post-mosaic');
						wp_reset_postdata();
						set_query_var( 'item_n', 2 );
					endwhile; 
					?>
				</div>
			</div>
			<?php
			
		else: 
			esc_html_e("Sorry, there is nothing for the moment.", "proradio");
		endif; 
		wp_reset_postdata();
		return ob_get_clean();

		
	}
}


// Set TTG Core shortcode functionality
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-mosaic","proradio_template_post_mosaic");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_template_post_mosaic_vc' );
if(!function_exists('proradio_template_post_mosaic_vc')){
	function proradio_template_post_mosaic_vc() {
  		vc_map( 
  			array(
				"name" => esc_html__( "Post mosaic", "proradio" ),
				"base" => "qt-mosaic",
				"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/mosaic.png' ),
				"description" => esc_html__( "Full width mosaic of posts", "proradio" ),
				"category" => esc_html__( "Theme shortcodes", "proradio"),
				"params" => array_merge(
					proradio_vc_query_fields( 3 ) // NOT IN USE: ONLY FOR 3 POSTS
				)
			)
  		);
  		vc_remove_param("qt-mosaic",'items_per_page');
	}
}