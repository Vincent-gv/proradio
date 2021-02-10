<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * 
 * */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if(!function_exists( 'proradio_upcoming_shows_carousel' )){
	function proradio_upcoming_shows_carousel( $atts = array() ){



		extract( shortcode_atts( array(
			// Global parameters
			'schedulefilter' => '',
			'quantity' => 9,
			
			// Carousel parameters
			'items_per_row_desktop'	=> '3',
			'gap'					=> '15',
			'pause_on_hover'		=> 'true',
			'center'				=> false,
			'nav'					=> 'true',
			'dots'					=> 'true',
			'stage_padding'			=> '0',
			'autoplay_timeout'		=> '4000',
			'items_per_row_tablet'	=> '3',
			'items_per_row_mobile'	=> '1',
			'el_class'				=> '',
		), $atts ) );

		$grid_id = md5( serialize($atts) );

		$grid_id = 'proradio-upcomingcarousel-'.md5( serialize($atts) );
		$el_id = 'proradio-upcomingcarousel-c-'.md5( serialize($atts) );

		/**
		 * Data extraction
		 * @var $schedulefilter = text flag of the parameter taxonomy
		 * @var $today = return only current day
		 */
		$schedulefilter = ( isset( $schedulefilter ) )? str_replace('schedulefilter:', '', $schedulefilter) : false;
		$return_only_today = true;
		$data_extraction 	= proradio_extract_schedule_days( $schedulefilter, $return_only_today ); 
		

		if(!$data_extraction){ 
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		if( 0 == count(  $data_extraction[ 'posts' ] )){
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		$schedules 		= $data_extraction[ 'posts' ];
		$current_day_id = $data_extraction[ 'current_day_id' ];


		// Today's shows
		$shows = $schedules[0]->shows;
		if( !is_array($shows) ){
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		if( 0 == count($shows) ){
			return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
		}
		
		$now = current_time("H:i");
		$found = false;
		$time_format = get_theme_mod('QT_timing_settings', '12');
		
		// Security limit
		if( $quantity > 12 ){
			$quantity = 12;
		}


		ob_start();


		$container_classes = array('proradio-owl-carousel-container');
		$counteritems = 0;

		wp_reset_postdata();

		?>
		<div id="<?php echo esc_attr($grid_id); ?>" class="<?php echo esc_attr( implode(' ', $container_classes)); ?>" data-proradio-autorefresh>
			<div id="<?php echo esc_attr($el_id); ?>" class="proradio-owl-carousel owl-carousel owl-theme proradio-owl-theme" data-items="<?php echo esc_attr($items_per_row_desktop); ?>"data-items_tablet="<?php echo esc_attr($items_per_row_tablet); ?>"data-items_mobile="<?php echo esc_attr($items_per_row_mobile); ?>"data-items_mobile_hori="2"data-gap="<?php echo esc_attr($gap); ?>"data-pause_on_hover="<?php  echo esc_attr($pause_on_hover); ?>" data-loop="true" data-center="<?php echo esc_attr( $center ); ?>" data-stage_padding="<?php echo esc_attr($stage_padding); ?>" data-nav="<?php echo esc_attr($nav); ?>" data-dots="<?php echo esc_attr($dots); ?>" data-autoplay_timeout="<?php 	echo esc_attr($autoplay_timeout); ?>" data-amount="<?php echo esc_attr( $items_per_row_desktop ); ?>">
				<?php
				
				$counter = 0;
				$avoid_duplicated_show = 0;
				foreach( $schedules as $schedule ){
					global $post;
					if( $counter < $quantity ){
						$shows = $schedule->shows;
						$post_title = $schedule->post_title;
						foreach( $shows as $show ){
							if( $counter < $quantity ){
								$print = false;
								remove_query_arg('event');
								$show['day'] = $post_title;
								$show_time = $show['show_time'];
								$show_time_end = $show['show_time_end'];
								$show_id = $show['show_id'][0];
								if($show_time_end == "00:00"){
									$show_time_end = "24:00";
								}
								// current day: use time comparison
							

								if( $schedule->ID == $current_day_id  ){
									// cross midnight shows fix
									// @since 1.5.3
									$show_time_end_comparison = $show_time_end;
									if( $show_time_end < $show_time && $now > $show_time){
										$show_time_end_comparison   = "24:00";
									}
									if( $now < $show_time_end_comparison ){
										$print = 1;
									}
								} else {
									$print = 1;
								}

								$current_show_hash = $show_id.$show_time.$show_time_end;

								
								if($print && $avoid_duplicated_show != $current_show_hash){
									$post = get_post($show_id); 
									if( is_object($post) ):
										set_query_var( 'event', $show );
										setup_postdata($post);
										?>
										<div class="proradio-item">
											<div class="proradio-itemcontainer">
												<?php get_template_part( 'template-parts/post/post-proradio_shows' );?>
											</div>
										</div>
										<?php
										
										$avoid_duplicated_show = $current_show_hash;
										$counter = $counter + 1;
									endif;
								}
							}
						}
						set_query_var( 'event', false);
						remove_query_arg('event');
					}
				}
				$counter = 0;
				?>
			</div>
		</div>
		<?php
		
		// wp_reset_postdata(); // 2020-10-06 removed causing loop in footer
		
		return ob_get_clean();
	}



	// Set TTG Core shortcode functionality
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-upcoming","proradio_upcoming_shows_carousel");
	}


	/**
	 *  Visual Composer integration
	 */
	add_action( 'vc_before_init', 'proradio_upcoming_shows_carousel_vc' );
	if(!function_exists('proradio_upcoming_shows_carousel_vc')){
		function proradio_upcoming_shows_carousel_vc() {
			vc_map( 
				array(
					"name" => esc_html__( "Upcoming shows carousel", "proradio" ),
					"base" => "qt-upcoming",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-carousel.png' ),
					"category" => esc_html__( "Theme shortcodes", "proradio"),
					"params" => array_merge(
						array(
							array(
								"type" => "textfield",
								"heading" => esc_html__( "Quantity", "proradio" ),
								"param_name" => "quantity",
								'description' => esc_html__( "Maximum", "proradio" ).' '.'8',
								'std' => 9,
							),
							array(
								"type" => "textfield",
							   "heading" => esc_html__( "Filter by 'schedulefilter' taxonomy", "proradio" ),
							   "description" => esc_html__("Insert the slug of a schedulefilter taxonomy for multi-radio websites","proradio"),
							   "param_name" => "schedulefilter"
							),
						),
						proradio_carousel_design_fields()
					)
				)
			);
		}
	}
}