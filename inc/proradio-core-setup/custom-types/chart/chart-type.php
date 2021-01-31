<?php
if(!function_exists('proradio_chart_register_type')){
	add_action('init', 'proradio_chart_register_type');  
	function proradio_chart_register_type() {
		$labelschart = array(
			'name' => esc_html__("Charts","proradio"),
			'singular_name' => esc_html__("Chart","proradio"),
			'add_new' => 'Add new ',
			'add_new_item' => 'Add new '.__("chart","proradio"),
			'edit_item' => 'Edit '.__("chart","proradio"),
			'new_item' => 'New '.__("chart","proradio"),
			'all_items' => 'All '.__("Charts","proradio"),
			'view_item' => 'View '.__("chart","proradio"),
			'search_items' => 'Search '.__("Charts","proradio"),
			'not_found' =>  'No '.__("Charts","proradio").' found',
			'not_found_in_trash' => 'No '.__("Charts","proradio").' found in Trash', 
			'parent_item_colon' => '',
			'menu_name' =>__("Charts","proradio")
		);
		$args = array(
			'labels' 				=> $labelschart,
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true, 
			'show_in_menu' 			=> true, 
			'query_var' 			=> true,
			'rewrite' 				=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_chart', 'chart') ) ),
			'capability_type'	 	=> 'page',
			'has_archive' 			=> true,
			'hierarchical'			=> false,
			'menu_position'			=> 30,
			'page-attributes' 		=> true,
			'show_in_nav_menus' 	=> true,
			'show_in_admin_bar' 	=> true,
			'show_in_menu' 			=> true,
			'menu_icon' 			=> 'dashicons-playlist-audio',
			'show_in_rest' 			=> true,
    		'rest_base' 			=> 'chart',
			'supports' 				=> array('title', 'thumbnail','editor' )
		); 
		if(function_exists('proradio_core_posttype')){
			proradio_core_posttype( "chart" , $args );
		}

		/* ============= create custom taxonomy for the charts ==========================*/
		 $labels = array(
			'name' => esc_html__( 'Chart categories',"proradio"),
			'singular_name' => esc_html__( 'Category',"proradio"),
			'search_items' =>  esc_html__( 'Search by category',"proradio" ),
			'popular_items' => esc_html__( 'Popular categorys',"proradio" ),
			'all_items' => esc_html__( 'All charts',"proradio" ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => esc_html__( 'Edit category',"proradio" ), 
			'update_item' => esc_html__( 'Update category',"proradio" ),
			'add_new_item' => esc_html__( 'Add New category',"proradio" ),
			'new_item_name' => esc_html__( 'New category Name',"proradio" ),
			// 'separate_items_with_commas' => esc_html__( 'Separate categories with commas',"proradio" ),
			'add_or_remove_items' => esc_html__( 'Add or remove categorys',"proradio" ),
			'choose_from_most_used' => esc_html__( 'Choose from the most used categories',"proradio" ),
			'menu_name' => esc_html__( 'Chart categories',"proradio" )
		); 
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_chartcategory', 'chartcategory') ) ),
			'show_in_rest'          => true,
    		'rest_base'             => 'chartcategory',
		);
		if(function_exists('proradio_core_custom_taxonomy')){
			proradio_core_custom_taxonomy('chartcategory', 'chart', $args	);
		}

		$fields_chart = array(
			array( 
				'label'	=> esc_html__('Chart Tracks',"proradio"),
				'desc'	=> esc_html__('Add one for each track in the chart',"proradio"),
				'id'	=> 'track_repeatable',
				'type'	=> 'repeatable', 
				'sanitizer' => array( 
					'featured' => 'meta_box_santitize_boolean',
					'title' => 'sanitize_text_field',
					'desc' => 'wp_kses_data'
				),
				'repeatable_fields' => array (
					'releasetrack_file' => array(
						'label' => esc_html__('Upload MP3 file',"proradio"),
						'desc'	=> esc_html__('Alternatively use Spotify, Soundcloud or Youtube URL',"proradio"),
						'id' 	=> 'releasetrack_scurl',
						'type' 	=> 'file'
					),
					'releasetrack_track_title' => array(
						'label' => esc_html__('Title',"proradio"),
						'id' => 'releasetrack_track_title',
						'type' => 'text'
					),
					'releasetrack_artist_name' => array(
						'label' => esc_html__('Artist/s',"proradio"),
						'id' => 'releasetrack_artist_name',
						'type' => 'text'
					),
					'releasetrack_buy_url' => array(
						'label' => esc_html__('Track Buy link',"proradio"),
						'desc'	=> esc_html__('A link to buy the single track', "proradio"),
						'id' 	=> 'releasetrack_buyurl',
						'type' 	=> 'text'
					),
					'releasetrack_img' => array(
						'label' => esc_html__('Cover',"proradio"),
						'desc'	=> esc_html__('Better 600x600', "proradio"),
						'id' => 'releasetrack_img',
						'type' => 'image'
					)
				)
			)
		);




		/**
		 * If the Chart Vote plugin is active, a new field will be added to control the voting
		 */
		if(function_exists('qt_chartvote_active')){
			$fields_chart[0]['repeatable_fields'][] = array(
				'label' => esc_html__('Track rating',"proradio"),
				'desc'	=> esc_html__('User Rating for the track',"proradio"), // description
				'id' 	=> 'releasetrack_rating',
				'type' 	=> 'number'
			);
		}
		if(class_exists("Custom_Add_Meta_Box")){
			$tracks_box = new Custom_Add_Meta_Box( 'chart_tracks', esc_html__('Chart Tracks','proradio'), $fields_chart, 'chart', true );
		}

	}

}