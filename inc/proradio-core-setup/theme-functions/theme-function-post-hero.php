<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Post Hero
 *
 * Example:
 * [qt-post-hero  post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'proradio_template_post_hero' )){
	function proradio_template_post_hero( $atts = array() ){
		
		ob_start();
		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			// Query parameters
			'proradio_post_excerpt'=> '1',
			'post_type' 			=> 'post',
			'include_by_id'			=> false,
			'custom_query'			=> false,
			'tax_filter'			=> false,
			'items_per_page'		=> 5,
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,
			'exclude'				=> '',
			'e_loadmore'			=> false,
			// Global parameters
			'el_id'					=>  'qt-post-grid-'.get_the_ID(), // 
			'el_class'				=> '',
			'grid_id'				=> false // required for compatibility with WPBakery Page Builder
		), $atts ) );

		$list_id = md5( serialize($atts) );
		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);
		$paged = 1;
		include 'helpers/query-prep.php';
		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );
		/**
		 * Loop start
		 */
		if ( $wp_query->have_posts() ) : 

			switch($post_type){
				case "show":
					$item_template = 'template-parts/post/post-hero--show';
					break;
				case "members":
					$item_template = 'template-parts/post/post-hero--members';
					break;
				default:
					$item_template = 'template-parts/post/post-hero';
			}
			?>
			<div id="<?php echo esc_attr( $list_id ); ?>" class="proradio-sc-archive-posthero">
				<?php  
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post = $wp_query->post;
					setup_postdata( $post );
					set_query_var('proradio_post_excerpt', $proradio_post_excerpt );
					get_template_part( $item_template );
					wp_reset_postdata();
				endwhile; 
			include 'helpers/loadmore.php';
			?></div><?php  
		endif;
		$output = ob_get_clean();
		return $output;
	}
}


// Set TTG Core shortcode functionality
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-post-hero","proradio_template_post_hero");
}



/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_template_post_hero_vc' );
if(!function_exists('proradio_template_post_hero_vc')){
	function proradio_template_post_hero_vc() {
		$params = proradio_vc_query_fields($items_per_page_std = 1);
  		vc_map( 
  			array(
				"name" => esc_html__( "Post hero", "proradio" ),
				"base" => "qt-post-hero",
				"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-hero.png' ),
				"description" => esc_html__( "Post hero", "proradio" ),
				"category" => esc_html__( "Theme shortcodes", "proradio"),
				"params" => array_merge(
					$params
				)
			)
  		);
	}
}