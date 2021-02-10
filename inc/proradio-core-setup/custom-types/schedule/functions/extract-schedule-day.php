<?php  

/**
 * ===================================================================
 * Get week number for monthly schedule
 * ===================================================================
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if(!function_exists('proradio_week_number')){
	function proradio_week_number( $date = 'today' ) { 
	    return ceil( date( 'j', strtotime( $date ) ) / 7 );
	}
}

/**
 * ===================================================================
 * Extract list of days
 * @return  array [posts, currentID]
 * @var $schedulefilter = text flag of the parameter taxonomy
 * @var $today = if TRUE, return only current day 
 * @var $return_only_today = return only current day
 * ===================================================================
 */
if(!function_exists('proradio_extract_schedule_days')){
	
	function proradio_extract_schedule_days( $schedulefilter = false, $return_only_today = false ){
		// wp_reset_postdata();

		$args = array(
			'post_type' => 'schedule',
			'posts_per_page' => 100,
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'cache_results'  => false,
			'update_post_meta_cache' => false,
			'order'   => 'ASC'
		);

		if( false != $schedulefilter ) {
			if($schedulefilter !== ''){
				$args ['tax_query'] = array(
					array(
						'taxonomy' => 'schedulefilter',
						'field'    => 'slug',
						'terms'    => $schedulefilter
					)
				);
			}
		}

		/**
		 * ====================================================================================================
		 * adding week-of-the-month filtering if enabled
		 * ====================================================================================================
		 */

		// Tutto questo è da testare
		// 1. aggiungi opzione in customizer
		// 2. testa con monthly schedule

		// $week_num = proradio_week_number();
		// $qt_execute_week_control = get_theme_mod('QT_monthly_schedule', '0' );
		// if(get_theme_mod('QT_monthly_schedule', '0' )){
		// 	$week_num = proradio_week_number();
		// 	$args ['meta_key'] = 'month_week';
		// 	$args ['meta_value'] = $week_num;
		// 	$args['meta_compare'] = 'LIKE';
		// }
		/* =========================================== update end ===========================================*/


		$result_query = new WP_Query( $args );
		$results = $result_query->posts;

		/**
		 * ====================================================================================================
		 * Extract current day ID
		 * ====================================================================================================
		 */		
		$date = current_time("Y-m-d");
		$current_dayweek = current_time("D");
		$id_of_currentday = 0;

		foreach($results as $post){
			$schedule_date = get_post_meta($post->ID, 'specific_day', true);
			$schedule_week_day = get_post_meta($post->ID, 'week_day', true);

			// Add shows array while doing the loop
			$post->shows = get_post_meta( $post->ID, 'track_repeatable', true);
			
			if($schedule_date == $date){
				$id_of_currentday = $post->ID;
			} else {
				if(is_array($schedule_week_day) && $id_of_currentday == 0){
					foreach($schedule_week_day as $day){ // each schedule can fit multiple days
						if(strtolower($day) == strtolower($current_dayweek)){
							$id_of_currentday = $post->ID;
						}
					}
				}
			}
		}

		/**
		 * Extract all the upcoming shows from now till end of the week
		 * @return  days array starting on current day
		 */
		if( $return_only_today ){
			$current_day_index = 99999999999999;
			$found_days = 0;
			for( $n = 0; $n < count( $results ); $n++ ){
				if( $results[$n]->ID == $id_of_currentday && $n < $current_day_index ){
					$current_day_index = $n;
				}
			}
			$loop = array_merge($results, $results);
			$results =  array_slice($loop, $current_day_index, count($results));
		}
		$return = array(
			'posts' => $results,
			'current_day_id' => $id_of_currentday
		);
		return $return;
	}
}



