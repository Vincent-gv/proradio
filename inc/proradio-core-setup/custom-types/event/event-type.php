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
if(!function_exists('event_register_type')){
	add_action('init', 'event_register_type'); 
	function event_register_type() {

		/**
	  	 * Custom post type
	  	 * ======================================================*/
		$labelsevent = array(
	        'name' 						=> esc_html__( "Event","proradio"),
	        'singular_name'		 		=> esc_html__( "Event","proradio"),
	        'add_new' 					=> esc_html__( "Add new","proradio"),
	        'add_new_item' 				=> esc_html__( "Add new event","proradio"),
	        'edit_item' 				=> esc_html__( "Edit event","proradio"),
	        'new_item' 					=> esc_html__( "New event","proradio"),
	        'all_items' 				=> esc_html__( "All events","proradio"),
	        'view_item' 				=> esc_html__( "View event","proradio"),
	        'search_items' 				=> esc_html__( "Search event","proradio"),
	        'not_found' 				=> esc_html__( "No events found","proradio"),
	        'not_found_in_trash'		=> esc_html__( "No events found in trash","proradio"),
	        'menu_name' 				=> esc_html__( "Events","proradio")
	    );
	  	$args = array(
	        'public' 					=> true,
	        'publicly_queryable'		=> true,
	        'show_ui' 					=> true, 
	        'show_in_menu' 				=> true, 
	        'query_var' 				=> true,
	        'has_archive' 				=> true,
	        'hierarchical' 				=> false,
	    	'page-attributes' 			=> true,
	    	'show_in_nav_menus' 		=> true,
	    	'show_in_admin_bar' 		=> true,
	    	'show_in_menu' 				=> true,
	    	'menu_position' 			=> 30,
	    	'rewrite' 					=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_event', 'event') ) ),
	    	'labels' 					=> $labelsevent,
	        'supports' 					=> array('title','thumbnail','editor', 'excerpt'),
	        'menu_icon' 				=> 'dashicons-calendar-alt',
	    	'capability_type' 			=> 'page',
	    	'show_in_rest' 				=> true,
    		'rest_base' 				=> 'event',

	  	); 
	    if(function_exists('proradio_core_posttype')){
	    	proradio_core_posttype( "event" , $args );
	    }
	  	
	  	/**
	  	 * Custom taxonomy
	  	 * ======================================================*/
		$labels = array(
			'name' 						=> esc_html__( 'Event type',"proradio" ),
			'singular_name' 			=> esc_html__( 'Types',"proradio" ),
			'search_items' 				=> esc_html__( 'Search by genre',"proradio" ),
			'popular_items' 			=> esc_html__( 'Popular genres',"proradio" ),
			'all_items' 				=> esc_html__( 'All events',"proradio" ),
			'edit_item' 				=> esc_html__( 'Edit Type',"proradio" ), 
			'update_item' 				=> esc_html__( 'Update Type',"proradio" ),
			'add_new_item' 				=> esc_html__( 'Add New Type',"proradio" ),
			'new_item_name' 			=> esc_html__( 'New Type Name',"proradio" ),
			'separate_items_with_commas'=> esc_html__( 'Separate Types with commas',"proradio" ),
			'add_or_remove_items' 		=> esc_html__( 'Add or remove Types',"proradio" ),
			'choose_from_most_used' 	=> esc_html__( 'Choose from the most used Types',"proradio" ),
			'menu_name' 				=> esc_html__( 'Event types',"proradio" ),
			'parent_item' 				=> null,
			'parent_item_colon' 		=> null,
		);
	    $args = array(
			'hierarchical' 				=> true,
			'show_ui' 					=> true,
			'query_var' 				=> true,
			'labels' 					=> $labels,
			'update_count_callback' 	=> '_update_post_term_count',
			'rewrite' 					=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_eventtype', 'eventtype') ) ),
			'show_in_rest'          => true,
    		'rest_base'             => 'eventtype',
		);
	    if(function_exists('proradio_core_custom_taxonomy')){
			proradio_core_custom_taxonomy('eventtype','event',$args	);
		} 
		

		/**
	  	 * Custom meta fields
	  	 * ======================================================*/
	
		$event_meta_boxfields = array(
		    array(
				'label' => esc_html__('Date start', "proradio"),
				'id'    =>  'proradio_date',
				'type'  => 'date'
			),
			array(
				'label' => esc_html__('Date end', "proradio"),
				'id'    =>  'proradio_date_end',
				'type'  => 'date'
			),
			array(
				'label' => esc_html__('Time start (24h format)', "proradio"),
				'id'    => 'proradio_time',
				'type'  => 'time'
			),
			array(
				'label' => esc_html__('Time end (24h format)', "proradio"),
				'id'    => 'proradio_time_end',
				'type'  => 'time'
			),
			array(
				'label' => esc_html__('Artists', "proradio"),
				'id'    => 'proradio_artists',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('External event link', "proradio"),
				'id'    => 'proradio_link',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Add to google calendar (requires end date and time)', "proradio"),
				'id'    =>  'proradio_addtogooglecal',
				'type'  => 'checkbox'
			),
			array(
				'label' => esc_html__('Venue', "proradio"),
				'id'    =>  'proradio_location',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('City', "proradio"),
				'id'    =>  'proradio_city',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Address', "proradio"),
				'id'    => 'proradio_address',
				'type'  => 'text'
			),
			array(
				'label' => esc_html__('Phone', "proradio"),
				'id'    =>  'proradio_phone',
				'type'  => 'text'
			),
			
			array( // Repeatable & Sortable Text inputs
				'label'		=> esc_html__('Ticket Buy Links', "proradio"), // label
				'desc'		=> esc_html__('Add one for each link to external websites', "proradio"),
				'id'		=> 'proradio_buylinks', // field id and name
				'type'		=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' 	=> 'meta_box_santitize_boolean',
					'title' 	=> 'sanitize_text_field',
					'desc' 		=> 'wp_kses_data'
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					'txt' => array(
						'label' 	=> esc_html__( 'Ticket buy text', "proradio" ),
						'desc'		=> esc_html__( 'Text for the purchase button', "proradio" ),
						'id' 		=> 'txt',
						'type' 		=> 'text'
					),
					'url' => array(
						'label' 	=> esc_html__('Ticket buy link ', "proradio"),
						'desc'		=> esc_html__( 'URL of the purchase page', "proradio" ),
						'id' 		=> 'url',
						'type' 		=> 'text'
					),
					'target' => array(
						'label' 	=> esc_html__('Open in new window', "proradio"),
						'id' 		=> 'target',
						'type' 		=> 'checkbox'
					)
				)
			)  
		);
		if(class_exists("Custom_Add_Meta_Box")){
			$event_meta_box = new Custom_Add_Meta_Box( 'event_customtab', esc_html__('Event details', "proradio"), $event_meta_boxfields, 'event', true );
		}


		/**
		 * Custom header bg
		 */
		if(function_exists('proradio_customtype_bg')){
			proradio_customtype_bg('event');
		}


	}
}



/**
 * ======================================================
 * Item pagination amount
 * ------------------------------------------------------
 * Customize number of posts depending on the archive post type
 * ======================================================
 */

if(!function_exists('event_query_order')){
	add_action( 'pre_get_posts', 'event_query_order', 1, 999 );
	function event_query_order( $query ) {
		if($query->is_main_query() && !is_admin()){
			if ( $query->is_post_type_archive('event')
				 || $query->is_tax('eventtype')
			) {
				$query->set( 'meta_key', 'proradio_date' );
				$query->set( 'orderby', 'meta_value' );
				$query->set( 'order', 'ASC' );
				if ( get_theme_mod ( 'events_hideold', 0 ) == '1'){
					$query->set ( 
						'meta_query' , array (
							array (
								'key' => 'proradio_date',
								'value' => date('Y-m-d'),
								'compare' => '>=',
								'type' => 'date'
							)
						)
					);
				}
			}
		}
		return;
	}
}




if(!function_exists('proradio_enable_places')){
	add_action("after_switch_theme", "proradio_enable_places");
	function proradio_enable_places() {  
	    $optionKey='qtmaps_typeselect_event';
	    if(!get_option($optionKey)) {
	        update_option($optionKey , 1);
	    }
	}
}














