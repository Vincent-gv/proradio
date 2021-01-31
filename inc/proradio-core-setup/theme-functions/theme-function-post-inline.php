<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-inline post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'proradio_template_post_inline' )){
	function proradio_template_post_inline( $atts = array() ){

		ob_start();

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
			'items_per_page'		=> 5,
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,
			'exclude'				=> '',
			'e_loadmore'			=> false,
			// Global parameters
			'el_id'					=>  uniqid( 'qt-post-inline-'.get_the_ID() ),
			'el_class'				=> '',
			'list_id'				=> false // required for compatibility with WPBakery Page Builder
		), $atts ) );


		$list_id = md5( serialize($atts) );
		$paged = 1;
		include 'helpers/query-prep.php';
		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;

		
		if ( $wp_query->have_posts() ) : 

			?>
			<div id="<?php echo esc_attr( $list_id ); ?>" class="proradio-post-inline-horizontal">
				<?php  
				/**
				 * Loop
				 */
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post = $wp_query->post;
					setup_postdata( $post );
					get_template_part ('template-parts/post/post-inline');
					wp_reset_postdata();
				endwhile; 
				include 'helpers/loadmore.php';
				?>
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
	proradio_core_custom_shortcode("qt-post-inline","proradio_template_post_inline");
}


/**
 *  Visual Composer integration
 */
if(!function_exists('proradio_template_post_inline_vc')){
	add_action( 'vc_before_init', 'proradio_template_post_inline_vc' );
	function proradio_template_post_inline_vc() {
  		vc_map( 
  			array(
				"name" => esc_html__( "Post list - inline", "proradio" ),
				"base" => "qt-post-inline",
				"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-inline.png' ),
				"description" => esc_html__( "List of posts with classic design", "proradio" ),
				"category" => esc_html__( "Theme shortcodes", "proradio"),
				"params" => array_merge(
					proradio_vc_query_fields()
				)
			)
  		);
	}
}




/**
 * ========================================================
 * ONAIR2 COMPATIBILITY
 * ========================================================
 */
if(!function_exists('proradio_template_post_inline_legacy')){
	function proradio_template_post_inline_legacy( $atts = array() ){
		extract( shortcode_atts( array(

				// Query parameters
				'post_type' 			=> 'post',
				'include_by_id'			=> false,
				'custom_query'			=> false,
				'tax_filter'			=> false,
				'items_per_page'		=> '9',
				'orderby'				=> 'date',
				'order'					=> 'DESC',
				'meta_key'				=> false,
				'offset'				=> 0,
				'exclude'				=> '',
				// Global parameters
				'el_id'					=>  uniqid( 'qt-post-inline-'.get_the_ID() ),
				'el_class'				=> '',
				'list_id'				=> false,


				'posttype' => 'post',
				'category' => false,
				'category_exclude' => false,
				'offset' => 0,
				'orderby' => false,
				'order' => false,
				'quantity' => 4
		), $atts ) );

		/**
		 * Convert category into tax_filter
		 * @var  $category [string] category slug
		 */
		if ($category && 'all' !== $category && $tax_filter == false) {
			$tax_filter = 'category:'.$category;
		}

		return do_shortcode('[qt-post-inline post_type="post" offset="'.$offset.'" items_per_page="'.$quantity.'" tax_filter="'.$tax_filter.'"]');
	}
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-post-list","proradio_template_post_inline_legacy");
	}

	/**
	 *  Visual Composer integration
	 */
	
	if(!function_exists('proradio_template_post_inline_legacy_vc')){
		add_action( 'vc_before_init', 'proradio_template_post_inline_legacy_vc' );
		function proradio_template_post_inline_legacy_vc() {
	  		vc_map( 
	  			array(
					"name" => esc_html__( "Post list [deprecated: use Post list - inline]", "proradio" ),
					"base" => "qt-post-list",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-inline.png' ),
					"description" => esc_html__( "List of posts with classic design", "proradio" ),
					"category" => esc_html__( "Deprecated", "proradio"),
					"params" => array_merge(
						proradio_vc_query_fields($items_per_page_std = 5)
					)
				)
	  		);
		}
	}
}