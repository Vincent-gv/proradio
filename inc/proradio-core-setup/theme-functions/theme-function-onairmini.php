<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Mini widget to display current radio show from the database
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if(!function_exists('proradio_onairmini')) {
	function proradio_onairmini($atts){
		
		extract( shortcode_atts( array(
			'schedulefilter' => false
		), $atts ) );

		$grid_id = 'proradio-showslider-'.get_the_ID().'-'.md5( serialize($atts) );

		/**
		 * Data extraction
		 * @var $schedulefilter = text flag of the parameter taxonomy
		 * @var $today = return only current day
		 */
		if( !isset( $schedulefilter ) ){
			$schedulefilter = false;
		}
		$return_only_today = true;
		$data_extraction 	= proradio_extract_schedule_days( $schedulefilter, $return_only_today ); // $schedulefilter, $today []

		if(!$data_extraction){ 
			return esc_html__( 'No schedules selected', 'proradio' ); 
		}
		if( 0 == count(  $data_extraction[ 'posts' ] )){
			return esc_html__( 'No schedules selected', 'proradio' );
		}
		
		$schedules 		= $data_extraction[ 'posts' ];
		$current_day_id = $data_extraction[ 'current_day_id' ];

		// Today's shows
		$shows 			= $schedules[0]->shows;
		

		if( !is_array($shows) ){
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		if( 0 == count($shows) ){
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		$now = current_time("H:i");
		$found = false;
		$time_format = get_theme_mod('QT_timing_settings', '12');
		ob_start();
		foreach( $shows as $show ){
			$show_id = $show['show_id'][0];
			$show_time =$show['show_time'];
			$show_time_end =$show['show_time_end'];
			if($show_time_end == "00:00"){
				$show_time_end = "24:00";
			}

			// cross midnight shows fix
			// @since 1.5.3
			$show_time_end_comparison = $show_time_end;
			if($show_time_end < $show_time){
				$show_time_end_comparison   = "24:00";
			}
			if( $now < $show_time_end_comparison && $found == false ){
				$found = true;
				$title = get_the_title( $show_id );
				$show_time_d = $show_time;
				$show_time_end_d = $show_time_end;
				// 12 hours format
				if( $time_format == '12' ){
					$show_time_d = date("g:i a", strtotime( $show_time_d ) );
					$show_time_end_d = date("g:i a", strtotime( $show_time_end_d ) );
				}
				?>
				<div id="<?php echo esc_attr($grid_id); ?>" class="proradio-nowonairmini" data-proradio-autorefresh>
					<a href="<?php echo get_the_permalink( $show_id ); ?>">
						<?php if (has_post_thumbnail( $show_id )){ ?>
						<img src="<?php echo get_the_post_thumbnail_url( $show_id, 'thumbnail' ); ?>" alt="<?php echo esc_attr( get_the_title( $show_id ) ); ?>">
						<?php } ?>
						<h3><?php echo get_the_title( $show_id ); ?></h3>
						<h5><?php echo esc_html( $show_time_d ); ?> <i class="dripicons-arrow-thin-right"></i> <?php echo esc_html( $show_time_end_d ); ?></h5>	
					</a>
				</div>
				<?php
			}
		}

		// titolo, link, thumb, start, stop
		wp_reset_postdata();
		return ob_get_clean();
	}

	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-onairmini","proradio_onairmini");
	}

	/**
	 *  Visual Composer integration
	 */
	
	if(!function_exists('proradio_vc_onairmini')){
		add_action( 'vc_before_init', 'proradio_vc_onairmini' );
		function proradio_vc_onairmini() {
		  vc_map( array(
			 "name" => esc_html__( "Show on air MINI", "proradio" ),
			 "base" => "qt-onairmini",
			 "icon" => get_template_directory_uri(). '/img/vc/radio-show-on-air-mini.png',
			 "description" => esc_html__( "Compact version of the OnAir show", "proradio" ),
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