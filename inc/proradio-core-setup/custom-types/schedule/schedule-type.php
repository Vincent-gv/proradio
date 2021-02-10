<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if(!function_exists('proradio_schedule_register_type')){
	add_action('init', 'proradio_schedule_register_type');  
	function proradio_schedule_register_type() {
		$labelsschedule = array(
			'name' => esc_html__("Schedule","proradio"),
	        'singular_name' => esc_html__("Schedule","proradio"),
	        'add_new' => esc_html__("Add new","proradio"),
	        'add_new_item' => esc_html__("Add new schedule","proradio"),
	        'edit_item' => esc_html__("Edit schedule","proradio"),
	        'new_item' => esc_html__("New schedule","proradio"),
	        'all_items' => esc_html__("All schedules","proradio"),
	        'view_item' => esc_html__("View schedule","proradio"),
	        'search_items' => esc_html__("Search schedule","proradio"),
	        'not_found' => esc_html__("No schedule found","proradio"),
	        'not_found_in_trash' => esc_html__("No schedule found in trash","proradio"),
	        'menu_name' => esc_html__("Schedule","proradio")
		);
		$args = array(
			'labels' => $labelsschedule,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' 	=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_schedule', 'schedule') ) ),
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 50,
			'page-attributes' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_menu' => true,
			'menu_icon' =>   'dashicons-clipboard',
			'supports' => array('title','page-attributes', 'thumbnail'),
			'show_in_rest' 				=> true,
    		'rest_base' 				=> 'schedule',
		); 
		if(function_exists('proradio_core_posttype')){
	    	proradio_core_posttype( "schedule" , $args );
	    }

	    /* ============= create custom taxonomy  ==========================*/
		$labels = array(
		    'name' => esc_html__( 'Schedule filter',"proradio"),
		    'singular_name' => esc_html__( 'Schedule filter',"proradio"),
		    'search_items' =>  esc_html__( 'Search by schedule filter',"proradio" ),
		    'popular_items' => esc_html__( 'Popular filters',"proradio" ),
		    'all_items' => esc_html__( 'All schedule filters',"proradio" ),
		    'parent_item' => null,
		    'parent_item_colon' => null,
		    'edit_item' => esc_html__( 'Edit schedule filter',"proradio" ), 
		    'update_item' => esc_html__( 'Update schedule filter',"proradio" ),
		    'add_new_item' => esc_html__( 'Add schedule filter',"proradio" ),
		    'new_item_name' => esc_html__( 'New schedule filter',"proradio" ),
		    'separate_items_with_commas' => esc_html__( 'Separate schedule filters with comma',"proradio" ),
		    'add_or_remove_items' => esc_html__( 'Add or remove schedule filters',"proradio" ),
		    'choose_from_most_used' => esc_html__( 'Choose from the most used schedule filters',"proradio" ),
		    'menu_name' => esc_html__( 'Schedule filter',"proradio" ),
		); 

		$args = array(
			    'hierarchical' => true,
			    'labels' => $labels,
			    'show_ui' => true,
			    'update_count_callback' => '_update_post_term_count',
			    'query_var' => true,
			    'rewrite' => array( 'slug' => 'schedulefilter' ),
			    'show_in_rest'          => true,
    			'rest_base'             => 'schedulefilter',

		);
	    if(function_exists('proradio_core_custom_taxonomy')){
			proradio_core_custom_taxonomy('schedulefilter','schedule',$args	);
		} 
	

		/*
		*
		*	Meta boxes ===========================================================================
		*
		*	======================================================================================
		*/

		$week_schedule = array(
			array(
				'label' => 'Week of the month',
				'description' => 'Use to display this schedule only on the following week',
				'id'    => 'month_week',
				'type'  => 'checkbox_group',
				'options' => array( 
			   		array('label'=> esc_html__("1st Week","proradio"), 'value' => '1'),
			   		array('label'=> esc_html__("2nd Week","proradio"), 'value' => '2'),
			  		array('label'=> esc_html__("3rd Week","proradio"), 'value' => '3'),
			   		array('label'=> esc_html__("4th Week","proradio"), 'value' => '4'),
			   		array('label'=> esc_html__("5th Week","proradio"), 'value' => '5')
			   )
			)
		);	

		$fields = array(
		    array(
				'label' => esc_html__('Happens only on a specific day (optional)',"proradio"),
				'description' => esc_html__('Used to identify the current show',"proradio"),
				'id'    => 'specific_day',
				'type'  => 'date'
				),
		    array(
				'label' => 'Day of the week (Recursive)',
				'description' => 'Used to identify the current show',
				'id'    => 'week_day',
				'type'  => 'checkbox_group',
				'options' => array( 
		           array('label'=> esc_html__("Monday","proradio"), 'value' => 'mon'),
		           array('label'=> esc_html__("Tuesday","proradio"), 'value' => 'tue'),
		           array('label'=> esc_html__("Wednesday","proradio"), 'value' => 'wed'),
		           array('label'=> esc_html__("Thursday","proradio"), 'value' => 'thu'),
		           array('label'=> esc_html__("Friday","proradio"), 'value' => 'fri'),
		           array('label'=> esc_html__("Saturday","proradio"), 'value' => 'sat'),
		           array('label'=> esc_html__("Sunday","proradio"), 'value' => 'sun')
		           )
				),
			array( // Repeatable & Sortable Text inputs
				'label'	=> esc_html__('Shows',"proradio"), // <label>
				'desc'	=> esc_html__('Add here the shows',"proradio"), // description
				'id'	=> 'track_repeatable', // field id and name
				'type'	=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'featured' => 'meta_box_santitize_boolean',
					'title' => 'sanitize_text_field',
					'desc' => 'wp_kses_data'
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					'show_id' => array(
						'label' => esc_html__('Show',"proradio"),
						'id' => 'show_id',
						'posttype' => 'shows',
						'type' => 'post_chosen'
					),
					'show_time' => array(
						'label' => esc_html__('Time (HH:MM)',"proradio"),
						'id' => 'show_time',
						'type' => 'time'
					)
					,'show_end' => array(
						'label' => esc_html__('Time end (HH:MM)',"proradio"),
						'id' => 'show_time_end',
						'type' => 'time'
					)
				)
			)
		);
		if(get_theme_mod('QT_monthly_schedule', '0' )){
			$fields = array_merge($week_schedule,$fields);
		}
		if (class_exists('Custom_Add_Meta_Box')) {
			$sample_box = new Custom_Add_Meta_Box( 'schedule_shows', esc_html__('Schedule shows','proradio'), $fields, 'schedule', true );
		}

		/**
		 * Custom header bg
		 */
		if(function_exists('proradio_customtype_bg')){
			proradio_customtype_bg('schedule');
		}


	}






	/**
	 * ======================================================
	 * Item pagination amount
	 * ------------------------------------------------------
	 * Customize number of posts depending on the archive post type
	 * ======================================================
	 */

	if(!function_exists('proradio_schedule_query_order')){
		add_action( 'pre_get_posts', 'proradio_schedule_query_order', 1, 999 );
		function proradio_schedule_query_order( $query ) {
			if($query->is_main_query() && !is_admin()){
				if ( $query->is_post_type_archive('proradio_schedule')
					|| $query->is_post_type_archive('schedule')
					|| $query->is_tax('proradio_scheduletype')
					|| $query->is_tax('schedulefilter')
				) {
					$query->set( 'meta_key', 'proradio_date' );
					$query->set( 'orderby', 'meta_value' );
					$query->set( 'order', 'ASC' );
					if ( get_theme_mod ( 'proradio_schedules_hideold', 0 ) == '1'){
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

}

