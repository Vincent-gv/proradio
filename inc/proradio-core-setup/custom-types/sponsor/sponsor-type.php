<?php
if(!function_exists( 'proradio_sponsor_register_type' )){
	add_action('init', 'proradio_sponsor_register_type');  
	function proradio_sponsor_register_type() {
		$labels = array(
			'name' => esc_html__("Sponsor","proradio"),
			'singular_name' => esc_html__("Sponsor","proradio"),
			'add_new' => esc_html__("Add new","proradio"),
			'add_new_item' => esc_html__("Add new sponsor","proradio"),
			'edit_item' => esc_html__("Edit sponsor","proradio"),
			'new_item' => esc_html__("New sponsor","proradio"),
			'all_items' => esc_html__("All sponsors","proradio"),
			'view_item' => esc_html__("View sponsor","proradio"),
			'search_items' => esc_html__("Search sponsor","proradio"),
			'not_found' => esc_html__("No sponsors found","proradio"),
			'not_found_in_trash' => esc_html__("No sponsors found in trash","proradio"),
			'menu_name' => esc_html__("Sponsor","proradio")
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => false,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'page',
			'has_archive' => false,
			'hierarchical' => false,
			'page-attributes' => true,
			'show_ui' => true, 
			'show_in_menu' => false, 
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_menu' => true,
			'menu_icon' =>  'dashicons-forms',
			'supports' => array('title', 'thumbnail','page-attributes', 'revisions', 'editor'  ),
			'show_in_rest' 		=> true,
    		'rest_base' 		=> 'qtsponsor',

		); 
	    if(function_exists('proradio_core_posttype')){
	    	proradio_core_posttype( "qtsponsor" , $args );
	    }
	    $event_meta_boxfields = array(
			array(
				'label' => esc_html__('Link url', "proradio"),
				'id'    => 'linkurl',
				'type'  => 'text'
			)
		);
		if(class_exists("Custom_Add_Meta_Box")){
			$event_meta_box = new Custom_Add_Meta_Box( 'sponsor_customtab', esc_html__('Sponsor details', "proradio"), $event_meta_boxfields, 'qtsponsor', true );
		}

	}
}