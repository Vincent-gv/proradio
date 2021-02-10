<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.5.3
 * Mini widget to display current radio show from the database
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if(!function_exists('proradio_onair')) {
	function proradio_onair($atts){
		
		extract( shortcode_atts( array(
			'schedulefilter' => false
		), $atts ) );


		$grid_id = 'proradio-onair-'.get_the_ID().'-'.md5( serialize($atts) );

		/**
		 * Data extraction
		 * @var $schedulefilter = text flag of the parameter taxonomy
		 * @var $today = return only current day
		 */
		if( !isset( $schedulefilter ) ){
			$schedulefilter = false;
		} else {
			$schedulefilter = str_replace('schedulefilter:', '', $schedulefilter);
		}
		$return_only_today = true;
		$data_extraction 	= proradio_extract_schedule_days( $schedulefilter, $return_only_today ); // $schedulefilter, $today []

		if(!$data_extraction){ 
			return esc_html__( 'No results', 'proradio' ); 
		}
		if( 0 == count(  $data_extraction[ 'posts' ] )){
			return esc_html__( 'No results', 'proradio' );
		}
		
		$schedules 		= $data_extraction[ 'posts' ];
		$current_day_id = $data_extraction[ 'current_day_id' ];

		// Today's shows
		$shows 			= $schedules[0]->shows;
		$post_title = $schedules[0]->post_title;
		
		if( !is_array($shows) ){
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		if( 0 == count($shows) ){
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		$now = current_time("H:i");
		$found = false;
		$time_format = get_theme_mod('QT_timing_settings', '12');
		$quantity = 1;
		$counter = 0;
		ob_start();
	

		foreach( $shows as $show ){
			remove_query_arg('event');
			$show['day'] = $post_title;
			$show_id = $show['show_id'][0];
			$show_time =$show['show_time'];
			$show_time_end =$show['show_time_end'];
			if($show_time_end == "00:00"){
				$show_time_end = "24:00";
			}
			set_query_var( 'event', $show );
			set_query_var( 'currentshow', true );
			global $post;

			// cross midnight shows fix
			// @since 1.5.3
			$show_time_end_comparison = $show_time_end;
			if( $show_time_end < $show_time && $now > $show_time){
				$show_time_end_comparison   = "24:00";
			}
			if( $now < $show_time_end_comparison && $counter < $quantity ){
				$post = get_post($show_id); 
				if(is_object($post)):
					$counter = $counter + 1;
					$show['day'] = $post_title;
					
					setup_postdata($post);
					?>
					<div id="<?php echo esc_attr($grid_id); ?>" class="active" data-proradio-autorefresh>
						<div class="proradio-item">
							<div class="proradio-itemcontainer">
								<?php 
								get_template_part( 'template-parts/slider/slider__item--show' );
								?>
							</div>
						</div>
					</div>
					<?php
					wp_reset_postdata();
				endif;
			}
			set_query_var( 'event', false);
			remove_query_arg('event');

		}

		// titolo, link, thumb, start, stop
		wp_reset_postdata();
		return ob_get_clean();
	}

	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-onair","proradio_onair");
	}

	/**
	 *  Visual Composer integration
	 */
	
	if(!function_exists('proradio_vc_onair')){
		add_action( 'vc_before_init', 'proradio_vc_onair' );
		function proradio_vc_onair() {
		  vc_map( array(
			 "name" => esc_html__( "Show on air", "proradio" ),
			 "base" => "qt-onair",
			 "icon" => get_template_directory_uri(). '/img/vc/radio-show-on-air-mini.png',
			 "description" => esc_html__( "Display the current show on air", "proradio" ),
			 "category" => esc_html__( "Theme shortcodes", "proradio"),
			 "params" => array(
				array(
				   "type" => "textfield",
				   "heading" => esc_html__( "Filter by 'schedulefilter' taxonomy", "proradio" ),
				   "description" => esc_html__("Insert the slug of a schedulefilter taxonomy for multi-radio websites","proradio"),
				   "param_name" => "schedulefilter"
				)
			 )
		  ) );
		}
	}
}