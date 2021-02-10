<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts
 *
 * Example:
 * [qt-place-grid post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists( 'proradio_template_places_grid' )){
	function proradio_template_places_grid( $atts = array() ){

	
		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			// Design
			'cols_l'				=> '3',// cols desktop default
			'cols_m'				=> '2',// cols tablet default
			// Query parameters
			'post_type' 			=> 'place',
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
			'el_id'					=>  'qt-place-grid-'.get_the_ID(), // 
			'el_class'				=> '',
			'grid_id'				=> false // required for compatibility with WPBakery Page Builder
		), $atts ) );


		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);

		$paged = 1;

		ob_start();

		include 'helpers/query-prep.php';

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
			case "product":
				$item_template = 'post-product';
				break;
			default:
				$item_template = 'post-vertical';
		}


		
		if ( $wp_query->have_posts() ) : 

			?>
			<div id="<?php echo esc_attr( $grid_id ); ?>" class="proradio-container proradio-place-grid">
				<div class="proradio-row">
					<?php  
						
					$class_l = 12 / intval($cols_l);
					$class_m = 12 / intval($cols_m);
					
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
							setup_postdata( $post );
							?>
							<div class="proradio-col proradio-col__post proradio-s12 proradio-m<?php echo esc_attr( $class_m ); ?> proradio-l<?php echo esc_attr( $class_l ); ?>">
								<?php  
								get_template_part ( 'template-parts/post/post-place' );
								?>
							</div>
							<?php wp_reset_postdata(); ?>
					<?php endwhile; ?>
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
	proradio_core_custom_shortcode("qt-place-grid","proradio_template_places_grid");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_template_places_grid_vc' );
if(!function_exists('proradio_template_places_grid_vc')){
	function proradio_template_places_grid_vc() {
  		vc_map( 
  			array(
				"name" 			=> esc_html__( "Places grid", "proradio" ),
				"base" 			=> "qt-place-grid",
				"icon" 			=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-grid.png' ),
				"description" 	=> esc_html__( "List of venues", "proradio" ),
				"category" 		=> esc_html__( "Theme shortcodes", "proradio"),
				"params" 		=> array(
						array(
						   "type" 			=> "textfield",
						   'group' 			=> esc_html__( 'Data Settings', 'proradio' ),
						   "heading" 		=> esc_html__( "Places by ID", "proradio" ),
						   "description" 	=> esc_html__( "Display only the contents with these IDs. All other parameters will be ignored.", "proradio" ),
						   "param_name" 	=> "include_by_id",
						   'value' 			=> ''
						),

						array(
							'group' 				=> esc_html__( 'Data Settings', 'proradio' ),
							'type' 					=> 'textfield',
							'heading' 				=> esc_html__( 'Total items', 'proradio' ),
							'admin_label' 			=> true,
							'param_name' 			=> 'items_per_page',
							'std' 					=> 10,
							'value' 				=> 10,
							'param_holder_class' 	=> 'vc_not-for-custom',
							'description' 			=> esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'proradio' ),
							'dependency' 			=> array(
								'element' 				=> 'post_type',
								'value_not_equal_to' 	=> array(
									'ids',
									'custom',
								),
							),
						),
						// Category filtering ===================================================================================================
						array(
							'group' 		=> esc_html__( 'Data Settings', 'proradio' ),
							'type' 			=> 'autocomplete',
							'heading' 		=> esc_html__( 'Narrow data source', 'proradio' ),
							'description' 	=> esc_html__( 'Enter categories, tags, formats or custom taxonomies.', 'proradio' ),
							'param_name' 	=> 'tax_filter',
							'admin_label' 	=> true,
							'settings'		=> array( 
								'values' 		 => proradio_get_terms_array() ,
								'multiple'       => true,
								'sortable'       => true,
					      		'min_length'     => 1,
					      		'groups'         => false,  // In UI show results grouped by groups
					      		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
					      		'display_inline' => true, // In UI show results inline view),
							),
							'dependency' 	=> array(
								'element' 				=> 'post_type',
								'value_not_equal_to' 	=> array(
									'ids',
									'custom',
								),
							),
						),

						// Data settings ===================================================================================================
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Order by', 'proradio' ),
							'param_name' 	=> 'orderby',
							'group' 		=> esc_html__( 'Data Settings', 'proradio' ),
							'value' 		=> array(
								esc_html__( 'Date', 'proradio' ) 				=> 'date',
								esc_html__( 'Order by post ID', 'proradio' ) 	=> 'ID',
								esc_html__( 'Author', 'proradio' ) 			=> 'author',
								esc_html__( 'Title', 'proradio' ) 				=> 'title',
								esc_html__( 'Last modified date', 'proradio' ) => 'modified',
								esc_html__( 'Post/page parent ID', 'proradio' )=> 'parent',
								esc_html__( 'Number of comments', 'proradio' ) => 'comment_count',
								esc_html__( 'Menu order', 'proradio' ) 		=> 'menu_order',
								esc_html__( 'Meta value', 'proradio' ) 		=> 'meta_value',
								esc_html__( 'Random order', 'proradio' ) 		=> 'rand',
							),
							'description' 		=> esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required. Meta value = alphabetical order. Meta value number = numerical order.', 'proradio' ),
							'group' 			=> esc_html__( 'Data Settings', 'proradio' ),
							'param_holder_class'=> 'vc_grid-data-type-not-ids',
							'dependency' 		=> array(
								'element' 			=> 'post_type',
								'value_not_equal_to'=> array(
									'ids',
									'custom',
								),
							),
						),
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'Sort order', 'proradio' ),
							'param_name' 	=> 'order',
							'group' 		=> esc_html__( 'Data Settings', 'proradio' ),
							'value' 		=> array(
								esc_html__( 'Descending', 'proradio' ) => 'DESC',
								esc_html__( 'Ascending', 'proradio' ) => 'ASC',
							),
							'param_holder_class' => 'vc_grid-data-type-not-ids',
							'description' 	=> esc_html__( 'Select sorting order.', 'proradio' ),
							'dependency' 	=> array(
								'element' 		=> 'post_type',
								'value_not_equal_to' => array(
									'ids',
									'custom',
								),
							),
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Exclude', 'proradio' ),
							'group' 		=> esc_html__( 'Data Settings', 'proradio' ),
							'param_name' 	=> 'exclude',
							'description' 	=> esc_html__( 'Exclude posts, pages, etc. by ID.', 'proradio' ),
							'group' 		=> esc_html__( 'Data Settings', 'proradio' ),
							'dependency' 	=> array(
								'element' 			=> 'post_type',
								'value_not_equal_to'=> array(
									'ids',
									'custom',
								),
								'callback' 			=> 'vc_grid_exclude_dependency_callback',
							),
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Extra class name', 'proradio' ),
							'param_name' 	=> 'el_class',
							'description' 	=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'proradio' ),
						),
						array(
							'type' 			=> 'el_id',
							'heading' 		=> esc_html__( 'Container ID', 'proradio' ),
							'param_name' 	=> 'el_id',
							'description' 	=> sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'proradio' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
						),
						array(
							'type' 			=> 'vc_grid_id',
							'param_name' 	=> 'grid_id',
						),
						array(
							'type' 			=> 'textfield',
							'heading' 		=> esc_html__( 'Offset', 'proradio' ),
							'group' 		=> esc_html__( 'Data Settings', 'proradio' ),
							'param_name' 	=> 'offset',
							'description' 	=> esc_html__( 'Number of grid elements to displace or pass over.', 'proradio' ),
							'group' 		=> esc_html__( 'Data Settings', 'proradio' ),
							'param_holder_class' => 'vc_grid-data-type-not-ids',
							'dependency' 	=> array(
								'element' 	=> 'post_type',
								'value_not_equal_to' => array(
									'ids',
									'custom',
								),
							),
						),

						/**
						 * 
						 * Design settings
						 *
						 */
						array(
							"group" 	=> esc_html__( "Grid design", "proradio" ),
							"type" 		=> "dropdown",
							"heading" 	=> esc_html__( "Columns desktop", "proradio" ),
							"param_name"=> "cols_l",
							'std'		=> '3',
							'value' 	=> array( 
									esc_html__( '1', 'proradio' ) 	=> '1',
									esc_html__( '2', 'proradio' ) 	=> '2',
									esc_html__( '3', 'proradio' ) 	=> '3',
									esc_html__( '4', 'proradio' ) 	=> '4',
								)			
							),
						array(
							"group" 	=> esc_html__( "Grid design", "proradio" ),
							"type" 		=> "dropdown",
							"heading" 	=> esc_html__( "Columns medium screen", "proradio" ),
							"param_name"=> "cols_m",
							'std'		=> '2',
							'value' 	=> array(
									esc_html__( '1', 'proradio' ) 	=> '1',
									esc_html__( '2', 'proradio' ) 	=> '2',
									esc_html__( '3', 'proradio' ) 	=> '3',
								)			
							),
					),
				
			)
  		);
	}
}