<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

if(!function_exists( 'proradio_shows_register_type' )){
	add_action('init', 'proradio_shows_register_type');  
	function proradio_shows_register_type() {
		$labelsshow = array(
			'name' => esc_html__("Shows","proradio"),
			'singular_name' => esc_html__("Shows","proradio"),
			'add_new' => esc_html__("Add new","proradio"),
			'add_new_item' => esc_html__("Add new show","proradio"),
			'edit_item' => esc_html__("Edit show","proradio"),
			'new_item' => esc_html__("New show","proradio"),
			'all_items' => esc_html__("All shows","proradio"),
			'view_item' => esc_html__("View show","proradio"),
			'search_items' => esc_html__("Search show","proradio"),
			'not_found' => esc_html__("No shows found","proradio"),
			'not_found_in_trash' => esc_html__("No shows found in trash","proradio"),
			'menu_name' => esc_html__("Shows","proradio")
		);
		$args = array(
			'labels' => $labelsshow,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 50,
			'page-attributes' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_menu' => true,
			'rewrite'  => array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_shows', 'shows') ) ),
			'show_in_rest' => true,
			'menu_icon' =>  'dashicons-pressthis',
			'supports' => array('title', 'thumbnail','editor', 'excerpt', 'revisions', 'page-attributes'   ),
			'show_in_rest' 				=> true,
    		'rest_base' 				=> 'shows',
		); 
		 if(function_exists('proradio_core_posttype')){
	    	proradio_core_posttype( "shows" , $args );
	    }

		/* ============= create custom taxonomy for the shows ==========================*/
		$labels = array(
			'name' => esc_html__( 'Genres',"proradio" ),
			'singular_name' => esc_html__( 'Genre',"proradio" ),
			'search_items' =>  esc_html__( 'Search by genre',"proradio" ),
			'popular_items' => esc_html__( 'Popular genres',"proradio" ),
			'all_items' => esc_html__( 'All shows',"proradio" ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => esc_html__( 'Edit genre',"proradio" ), 
			'update_item' => esc_html__( 'Update genre',"proradio" ),
			'add_new_item' => esc_html__( 'Add New genre',"proradio" ),
			'new_item_name' => esc_html__( 'New genre Name',"proradio" ),
			'separate_items_with_commas' => esc_html__( 'Separate genres with commas',"proradio" ),
			'add_or_remove_items' => esc_html__( 'Add or remove genres',"proradio" ),
			'choose_from_most_used' => esc_html__( 'Choose from the most used genres',"proradio" ),
			'menu_name' => esc_html__( 'Genres',"proradio" )
		); 
		$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'show_in_rest' => true,
			'rewrite'  => array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_showgenre', 'showgenre') ) ),
			'show_in_rest'          => true,
    		'rest_base'             => 'genre',
		);
		if(function_exists('proradio_core_custom_taxonomy')){
			proradio_core_custom_taxonomy('genre','shows',$args	);
		} 
	}
}

/*
*
*	Meta boxes ===========================================================================
*
*	======================================================================================
*/
if(!function_exists( 'proradio_shows_capabilities' )){
	add_action('wp_loaded', 'proradio_shows_capabilities');  
	function proradio_shows_capabilities(){
		$fields = array(
			array(
				'label' =>  esc_html__('Subtitle',"proradio"),
				'description' => esc_html__('Used in the parallax header',"proradio"),
				'id'    => 'subtitle2',
				'type'  => 'text'
				)
			, array(
				'label' => esc_html__('Payoff',"proradio"),
				'description' => esc_html__('Used in parallax header',"proradio"),
				'id'    => 'subtitle',
				'type'  => 'text'
				)
		  
		    , array(
				'label' => esc_html__('Short show description',"proradio"),
				'description' => esc_html__('Plain text displayed in the schedule',"proradio"),
				'id'    => 'show_incipit',
				'type'  => 'textarea'
				)
		    , array(
				'label' => esc_html__('Podcast archive',"proradio"),
				'description' => esc_html__('Choose a podcast category to display in the show page',"proradio"),
				'id'    => 'show_podcastfilter',
				'taxtype' => 'podcastfilter',
				'type'  => 'tax_select_disassociated'
				)
		    , array(
				'label' => esc_html__('News archive',"proradio"),
				'description' => esc_html__('Choose a podcast category to display in the show page',"proradio"),
				'id'    => 'show_category',
				'taxtype' => 'category',
				'type'  => 'tax_select_disassociated'
				)
		    , array(
				'label' => esc_html__('Latest chart',"proradio"),
				'description' => esc_html__('Choose a chart category',"proradio"),
				'id'    => 'show_chartcategory',
				'taxtype' => 'chartcategory',
				'type'  => 'tax_select_disassociated'
				)
		    , array(
				'label' => esc_html__('Events archive',"proradio"),
				'description' => esc_html__('Choose a event category to display in the show page',"proradio"),
				'id'    => 'show_eventslist',
				'taxtype' => 'eventtype',
				'type'  => 'tax_select_disassociated'
				)
		    ,array( // Repeatable & Sortable Text inputs
				'label'	=> esc_html__('Associated team members',"proradio"), // <label>
				'desc'	=> esc_html__('Manually pick associated team members',"proradio"), // description
				'id'	=> 'show_members_pick', // field id and name
				'type'	=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' => 'meta_box_santitize_boolean',
					'title' => 'sanitize_text_field',
					'desc' => 'wp_kses_data'
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					array(
						'label' => esc_html__("Choose a member","proradio"),
						'id'	=> 'showmember', // field id and name
						'type' => 'post_chosen',
						'posttype' => 'members'
					)
				)
			)
		);
		if(class_exists("Custom_Add_Meta_Box")){
			$proradio_showmetas = new Custom_Add_Meta_Box( 'proradio_showmetas', esc_html__('Social details', "proradio"), $fields, 'shows', true );
		}
	
		$fields2 = array(
			array(
				'label' =>  esc_html__('Facebook','proradio' ),
				'id'    => 'facebook',
				'type'  => 'text'
			),
			array(
				'label' =>  esc_html__('Instagram','proradio' ),
				'id'    => 'instagram',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Itunes','proradio' ),
				'id'    => 'itunes',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('LastFM','proradio' ),
				'id'    => 'lastfm',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Linkedin','proradio' ),
				'id'    => 'linkedin',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Mixcloud','proradio' ),
				'id'    => 'mixcloud',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Pinterest','proradio' ),
				'id'    => 'pinterest',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Soundcloud','proradio' ),
				'id'    => 'soundcloud',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Twitter','proradio' ),
				'id'    => 'twitter',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Youtube','proradio' ),
				'id'    => 'youtube',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Spotify','proradio' ),
				'id'    => 'spotify',
				'type'  => 'text'
			)
		);
		if(class_exists("Custom_Add_Meta_Box")){
			$proradio_showsocials = new Custom_Add_Meta_Box( 'proradio_showsocials', esc_html__('Social network pages', "proradio"), $fields2, 'shows', true );
		}
	}
}