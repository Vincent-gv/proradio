<?php

add_action('init', 'proradio_podcast_register_type');  
if(!function_exists('proradio_podcast_register_type')){
function proradio_podcast_register_type() {
	$labelspodcast = array(
		'name' 					=> esc_html__("Podcast","proradio"),
		'singular_name' 		=> esc_html__("Podcast","proradio"),
		'add_new' 				=> esc_html__("Add new","proradio"),
		'add_new_item' 			=> esc_html__("Add new podcast","proradio"),
		'edit_item' 			=> esc_html__("Edit podcast","proradio"),
		'new_item' 				=> esc_html__("New podcast","proradio"),
		'all_items' 			=> esc_html__("All podcasts","proradio"),
		'view_item' 			=> esc_html__("View podcast","proradio"),
		'search_items'	 		=> esc_html__("Search podcast","proradio"),
		'not_found' 			=> esc_html__("No podcasts found","proradio"),
		'not_found_in_trash' 	=> esc_html__("No podcasts found in trash","proradio"),
		'menu_name' 			=> esc_html__("Podcasts","proradio")
	);
	$args = array(
		'labels' 					=> $labelspodcast,
		'public' 					=> true,
		'publicly_queryable' 		=> true,
		'show_ui' 					=> true, 
		'show_in_menu' 				=> true, 
		'query_var' 				=> true,
		'rewrite' 					=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_podcast', 'podcast') ) ),
		'capability_type' 			=> 'page',
		'has_archive' 				=> true,
		'hierarchical' 				=> false,
		'menu_position' 			=> 30,
		'page-attributes' 			=> true,
		'show_in_nav_menus' 		=> true,
		'show_in_admin_bar' 		=> true,
		'show_in_menu' 				=> true,
		 'menu_icon' 				=> 'dashicons-megaphone',
		'supports' 					=> array('title', 'thumbnail','editor' ),
		'show_in_rest' 				=> true,
    	'rest_base' 				=> 'podcast',
	); 
	if(function_exists('proradio_core_posttype')){
		proradio_core_posttype( "podcast" , $args );
	}

	/* ============= create custom taxonomy for the podcasts ==========================*/
	$labels = array(
		'name'					=> esc_html__( 'Podcast filters',"proradio" ),
		'singular_name'			=> esc_html__( 'Filter',"proradio" ),
		'search_items' 			=>  esc_html__( 'Search by filter',"proradio" ),
		'popular_items' 		=> esc_html__( 'Popular filters',"proradio" ),
		'all_items' 			=> esc_html__( 'All Podcasts',"proradio" ),
		'parent_item' 			=> null,
		'parent_item_colon' 	=> null,
		'edit_item'				=> esc_html__( 'Edit Filter',"proradio" ), 
		'update_item' 			=> esc_html__( 'Update Filter',"proradio" ),
		'add_new_item' 			=> esc_html__( 'Add New Filter',"proradio" ),
		'new_item_name' 		=> esc_html__( 'New Filter Name',"proradio" ),
		'separate_items_with_commas' => esc_html__( 'Separate Filters with commas',"proradio" ),
		'add_or_remove_items' 	=> esc_html__( 'Add or remove Filters',"proradio" ),
		'choose_from_most_used' => esc_html__( 'Choose from the most used Filters',"proradio" ),
		'menu_name' 			=> esc_html__( 'Filters',"proradio" ),
	); 
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_podcastfilter', 'podcastfilter') ) ),
		'show_in_rest'          => true,
    	'rest_base'             => 'podcastfilter',
	);
	if(function_exists('proradio_core_custom_taxonomy')){
		proradio_core_custom_taxonomy('podcastfilter','podcast', $args );
	}
}}


$podcast_tab_custom = array(
	array(
		'label' => esc_html__( 'Artist Name', "proradio" ),
		'id'    => '_podcast_artist',
		'type'  => 'text'
	),
	array(
		'label' => esc_html__( 'Date', "proradio" ),
		'id'    => '_podcast_date',
		'type'  => 'date'
	),
	'_podcast_resourceurl' => array(
		'label' => esc_html__( 'Mixcloud, Soundcloud, Spotify or MP3 url.', "proradio" ),
		'desc'	=> esc_html__( 'Check the manual for the correct URL of external services.','kentha' ), // description
		'id' => '_podcast_resourceurl',
		'type' => 'file',
	),
	'enclosure' => array(
		'label' => esc_html__( 'Enclosure', "proradio" ),
		'desc'	=> esc_html__( 'Specify the URL for your podcast RSS field. You can copy here the MP3 url','kentha' ), // description
		'id' => 'enclosure',
		'type' => 'text',
	),
);


if (class_exists('Custom_Add_Meta_Box')){
	$podcast_tab_custom_box = new Custom_Add_Meta_Box( 'podcast_customtab', esc_html__('Podcast details', "proradio"), $podcast_tab_custom, 'podcast', true );
}
