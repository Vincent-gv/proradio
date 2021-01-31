<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts
 *
 * Example:
 * [qt-post-grid post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'proradio_template_post_grid' )){
	function proradio_template_post_grid( $atts = array() ){

		

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(

			'posttype' => false, // Legacy parameter for retro compatibility 
			'category' => false, // Legacy parameter for retro compatibility
			'itemsperrow' => false, // Legacy parameter for retro compatibility
			'quantity' => false, // Legacy parameter for retro compatibility

			// Design
			'cols_l'				=> '3',// cols desktop default
			'cols_m'				=> '2',// cols tablet default

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
			'hideold' 				=> false,

			'exclude'				=> '',
			'e_loadmore'			=> false,

			// Global parameters
			'el_id'					=>  'qt-post-grid-'.get_the_ID(), // 
			'el_class'				=> '',
			'grid_id'				=> false // required for compatibility with WPBakery Page Builder
		

		), $atts ) );


		$list_id = md5( serialize($atts) );
		
		// ================================================
		// RETRO COMPATIBILITY

		/**
		 * Convert category into tax_filter
		 * @var  $category [string] category slug
		 */
		if ($category && 'all' !== $category && $tax_filter == false) {
			$tax_filter = 'category:'.$category;
		}

		// If an old post type parameter different from post was stored, let's use it
		if ($posttype) {
			$post_type = $posttype;
		}

		if( $itemsperrow ){
			$cols_m = $cols_l = $itemsperrow;
		}

		if ($quantity) {
			$items_per_page = $quantity;
		}
		// END OF RETRO COMPATIBILITY
		// ================================================


		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);

		$paged = 1;

		include 'helpers/query-prep.php';

		/**
		 * Optionally hide old events
		 */
		if($hideold){
			$args['meta_query'] = array(
				array(
					'key' => 'proradio_date',
					'value' => date('Y-m-d'),
					'compare' => '>=',
					'type' => 'date'
				 )
			);
		}

		
		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;



		switch($post_type){
			case "proradio_testimonial":
				$item_template = 'post-proradio_testimonial';
				break;
			case "members":
				$item_template = 'post-members';
				break;
			case "chart":
				$item_template = 'post-chart';
				break;
			case "product":
				$item_template = 'post-product';
				break;
			case "podcast":
				$item_template = 'post-podcast';
				break;
			case "event":
				$item_template = 'post-event--card';
				break;
			case "shows":
				$item_template = 'post-proradio_shows';
				break;
			case "place":
				$item_template = 'post-place';
				break;
			case "qtvideo":
				$item_template = 'post-qtvideo';
				break;
			default:
				$item_template = 'post-vertical';
		}


		ob_start();
		if ( $wp_query->have_posts() ) : 

			?>
			<div id="<?php echo esc_attr( $grid_id ); ?>" class="proradio-container proradio-post-grid">
				<div id="<?php echo esc_attr( $list_id ); ?>" class="proradio-row">
					<?php  
					/**
					 * Loop
					 */
					
					// Width
						
					$class_l = 12 / intval($cols_l);
					$class_m = 12 / intval($cols_m);
					
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						?>
						<div class="proradio-col proradio-col__post proradio-s12 proradio-m<?php echo esc_attr( $class_m ); ?> proradio-l<?php echo esc_attr( $class_l ); ?>">
							<?php  
							$post = $wp_query->post;
							setup_postdata( $post );
							get_template_part ( 'template-parts/post/'.$item_template );
							wp_reset_postdata();
							?>
						</div>
						<?php 
					endwhile; 
					include 'helpers/loadmore.php';
					?>
				</div>
			</div>
			<?php
		endif; 
		wp_reset_postdata();
		return ob_get_clean();
	}
}


// Set TTG Core shortcode functionality
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-post-grid","proradio_template_post_grid");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_template_post_grid_vc' );
if(!function_exists('proradio_template_post_grid_vc')){
	function proradio_template_post_grid_vc() {
  		vc_map( 
  			array(
				"name" 			=> esc_html__( "Post grid", "proradio" ),
				"base" 			=> "qt-post-grid",
				"icon" 			=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-grid.png' ),
				"description" 	=> esc_html__( "Grid of items", "proradio" ),
				"category" 		=> esc_html__( "Theme shortcodes", "proradio"),
				"params" 		=> array_merge(
					array(
						array(
							"group" 		=> esc_html__( "Data Settings", "proradio" ),
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Post type', 'proradio' ),
							'param_name' 	=> 'post_type',
							'value' 		=> array(
								esc_html__( "Post", 'proradio' )			=> "post",
								esc_html__( "Podcast", 'proradio' )			=> "podcast",
								esc_html__( "Event", 'proradio' )	=> "event",
								esc_html__( "Shows", 'proradio' )	=> "shows",
								esc_html__( "Place", 'proradio' )	=> "place",
								esc_html__( "Team member", 'proradio' )	=> "members",
								esc_html__( "Product", 'proradio' )		=> "product",
							),
							'std' 			=> 'post',
							'admin_label' 	=> true,
							'edit_field_class' => 'vc_col-sm-7',
						),
						array(
							"group" 	=> esc_html__( "Grid design", "proradio" ),
							"type" 		=> "dropdown",
							"heading" 	=> esc_html__( "Columns desktop", "proradio" ),
							"param_name"=> "cols_l",
							'std'		=> '3',
							'value' 	=> array( 
									esc_html__( '1', 'proradio' )	=> '1',
									esc_html__( '2', 'proradio' )	=> '2',
									esc_html__( '3', 'proradio' )	=> '3',
									esc_html__( '4', 'proradio' )	=> '4',
								)			
							),
						array(
							"group" 	=> esc_html__( "Grid design", "proradio" ),
							"type" 		=> "dropdown",
							"heading" 	=> esc_html__( "Columns medium screen", "proradio" ),
							"param_name"=> "cols_m",
							'std'		=> '2',
							'value' 	=> array( 
									esc_html__( '1', 'proradio' )	=> '1',
									esc_html__( '2', 'proradio' )	=> '2',
									esc_html__( '3', 'proradio' )	=> '3',
								)			
							),
					),
					proradio_vc_query_fields($items_per_page_std = 9)
				)
			)
  		);
	}
}