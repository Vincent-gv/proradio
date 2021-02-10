<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(!function_exists('members_register_type')){
	add_action('init', 'members_register_type');  
	function members_register_type() {

		/**
	  	 * Custom post type
	  	 * ======================================================*/
		$labels = array(
			'name' 						=> esc_html__( "Team Members","proradio" ),
			'singular_name' 			=> esc_html__( "Team member","proradio" ),
			'add_new' 					=> esc_html__('Add new',"proradio" ),
			'add_new_item' 				=> esc_html__('Add new team member',"proradio" ),
			'edit_item' 				=> esc_html__('Edit member',"proradio" ),
			'new_item' 					=> esc_html__('New member',"proradio" ),
			'all_items'					=> esc_html__('All team members',"proradio" ),
			'view_item' 				=> esc_html__('View team member',"proradio" ),
			'search_items' 				=> esc_html__('Search team member',"proradio" ),
			'not_found' 				=>  esc_html__('No member found',"proradio" ),
			'not_found_in_trash' 		=> esc_html__('No members found in Trash', "proradio" ),
			'parent_item_colon' 		=> '',
			'menu_name' 				=> esc_html__('Team members',"proradio" ),
		);
		$args = array(
			'public' 					=> true,
			'publicly_queryable' 		=> true,
			'show_ui' 					=> true, 
			'member_in_menu' 			=> true,
			'query_var' 				=> true,
			'has_archive' 				=> true,
			'hierarchical' 				=> false,
			'page-attributes' 			=> true,
			'show_in_nav_menus' 		=> true,
			'show_in_admin_bar' 		=> true,
			'show_in_menu' 				=> true,
			'menu_position' 			=> 30,
			'labels' 					=> $labels,
			'capability_type' 			=> 'page',
			'menu_icon' 				=> 'dashicons-businessman',
			'rewrite' 					=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_members', 'members') ) ),
			'supports' 					=> array('title', 'thumbnail','page-attributes','editor', 'revisions'  ),
			'show_in_rest' 				=> true,
    		'rest_base' 				=> 'members',
		); 
	    if(function_exists('proradio_core_posttype')){
	    	proradio_core_posttype( "members" , $args );
	    }

		/**
	  	 * Custom taxonomy
	  	 * ======================================================*/
		$labels = array(
		    'name' 						=> esc_html__( 'Member type',"proradio" ),
		    'singular_name' 			=> esc_html__( 'Type',"proradio" ),
		    'search_items' 				=> esc_html__( 'Search by type',"proradio" ),
		    'popular_items' 			=> esc_html__( 'Popular member types',"proradio" ),
		    'all_items' 				=> esc_html__( 'All members',"proradio" ),
		    'edit_item' 				=> esc_html__( 'Edit type',"proradio" ), 
		    'update_item' 				=> esc_html__( 'Update type',"proradio" ),
		    'add_new_item' 				=> esc_html__( 'Add new type',"proradio" ),
		    'new_item_name'			 	=> esc_html__( 'New type Name',"proradio" ),
		    'separate_items_with_commas'=> esc_html__( 'Separate types with commas',"proradio" ),
		    'add_or_remove_items' 		=> esc_html__( 'Add or remove types',"proradio" ),
		    'choose_from_most_used' 	=> esc_html__( 'Choose from the most used types',"proradio" ),
		    'menu_name' 				=> esc_html__( 'Member types',"proradio" ),
		    'parent_item' 				=> null,
		    'parent_item_colon' 		=> null,
	  	); 
		$args = array(
		    'hierarchical' 				=> true,
		    'labels' 					=> $labels,
		    'show_ui' 					=> true,
		    'update_count_callback' 	=> '_update_post_term_count',
		    'query_var' 				=> true,
		    'rewrite' 					=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_membertype', 'membertype') ) ),
		);
		if(function_exists('proradio_core_custom_taxonomy')){
			proradio_core_custom_taxonomy('membertype','members', $args	);
		}
		


		/**
	  	 * Custom meta fields
	  	 * ======================================================*/

		$fields = array(
			array(
				'label' => esc_html__('Short bio (no HTML)',"proradio" ),
				'id'    => 'member_incipit',
				'type'  => 'textarea'
				)
			,array(
				'label' => esc_html__('Professional role',"proradio" ),
				'id'    => 'member_role',
				'type'  => 'text'
				)
			,array(
				'label' => esc_html__('Itunes link',"proradio" ),
				'id'    => 'QT_itunes',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Instagram link',"proradio" ),
				'id'    => 'QT_instagram',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Linkedin link',"proradio" ),
				'id'    => 'QT_linkedin',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Facebook link',"proradio" ),
				'id'    => 'QT_facebook',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Twitter link',"proradio" ),
				'id'    => 'QT_twitter',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Pinterest link',"proradio" ),
				'id'    => 'QT_pinterest',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Vimeo link',"proradio" ),
				'id'    => 'QT_vimeo',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Wordpress link',"proradio" ),
				'id'    => 'QT_wordpress',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Youtube link',"proradio" ),
				'id'    => 'QT_youtube',
				'type'  => 'text'
				)
		   	,array(
				'label' => esc_html__('Soundcloud link',"proradio" ),
				'id'    => 'QT_soundcloud',
				'type'  => 'text'
				)
		   	 ,array(
				'label' => esc_html__('Mixcloud link',"proradio" ),
				'id'    => 'QT_mixcloud',
				'type'  => 'text'
				),
			array(
				'label' => esc_html__('Spotify','proradio' ),
				'id'    => 'QT_spotify',
				'type'  => 'text'
			)
		   	 ,array( // Repeatable & Sortable Text inputs
				'label'	=> esc_attr__('Associated shows',"proradio"), // <label>
				'desc'	=> esc_attr__('Manually pick shows to display in the member page',"proradio"), // description
				'id'	=> 'members_show_pick', // field id and name
				'type'	=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' => 'meta_box_santitize_boolean',
					'title' => 'sanitize_text_field',
					'desc' => 'wp_kses_data'
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					array(
						'label' => esc_html__("Choose a show","proradio"),
						'id'	=> 'membershow', // field id and name
						'type' => 'post_chosen',
						'posttype' => 'shows'
					)
				)
			)
		);
		if(class_exists('Custom_Add_Meta_Box')) {
			$members_meta_box = new Custom_Add_Meta_Box( 'memberss_customtab',  esc_html__('Member details', "proradio"), $fields, 'members', true );
		}

		/**
		 * Custom header bg
		 */
		if(function_exists('proradio_customtype_bg')){
			proradio_customtype_bg('members');
		}
	}
}