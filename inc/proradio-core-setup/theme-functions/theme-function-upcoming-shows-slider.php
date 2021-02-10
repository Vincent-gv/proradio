<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.5.3
 *
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists( 'proradio_upcoming_shows_slider' )){
	function proradio_upcoming_shows_slider( $atts = array() ){
		
		extract( shortcode_atts( array(
				
			// Global parameters
			'el_class'				=> '',
			
			'schedulefilter' => '',
			'quantity' => 5,

			// Carousel parameters
			'pause_on_hover'		=> 'true',
			'loop'					=> 'true',
			'nav'					=> 'true',
			'dots'					=> 'true',
			'stage_padding'			=> '0',
			'autoplay_timeout'		=> '6000',
			'fullheight'			=> false,
			'fullwidth'				=> false,
		), $atts ) );

		$grid_id = 'proradio-showslider-'.get_the_ID().'-'.md5( serialize($atts) );
		$el_id = 'proradio-showslider-c-'.get_the_ID().'-'.md5( serialize($atts) );

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
		$data_extraction 	= proradio_extract_schedule_days( $schedulefilter, $return_only_today );

		if(!$data_extraction){ 
			return esc_html__( 'No schedules selected', 'proradio' ); 
		}
		if( 0 == count(  $data_extraction[ 'posts' ] )){
			return esc_html__( 'No schedules selected', 'proradio' );
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
		if( $quantity > 8 ){
			$quantity = 8;
		}

		/**
		 * SLIDER RENDER
		 */

		$number = count( $shows );

		ob_start();

		// Debug output: what day and time is it?
		// echo '<div class="proradio_todayclass" style="color: red;font-size: 32px;">TODAY IS: '.get_the_title($current_day_id).' '.$current_day_id.' - '.$now.'</div>';


		$avoid_duplicated_show = 0;
		if ($number  > 0 ): 
		
			$container_classes = array('proradio-slider', 'proradio-slider-owl');

			if( $fullheight ){
				$container_classes[] = 'proradio-slider--fullheight';
			}
			if( $fullwidth ){
				$container_classes[] = 'proradio-slider--fullwidth';
			}
			$container_classes =  implode(' ', $container_classes);

			set_query_var( 'currentshow', false );
			?>

			<div id="<?php echo esc_attr($grid_id); ?>" class="<?php echo esc_attr( $container_classes ); ?>" data-proradio-autorefresh>
				<div id="<?php echo esc_attr($el_id); ?>" class="proradio-owl-carousel owl-carousel owl-theme proradio-owl-theme" data-items="1"data-items_tablet="1" data-items_mobile="1" data-items_mobile_hori="1" data-gap="0" data-pause_on_hover="<?php  echo esc_attr($pause_on_hover); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-center="true" data-stage_padding="0" data-nav="<?php echo esc_attr($nav); ?>" data-dots="<?php echo esc_attr($dots); ?>" data-autoplay_timeout="<?php 	echo esc_attr($autoplay_timeout); ?>" data-amount="<?php echo esc_attr( $number ); ?>">
					<?php
					$counter = 0;
					$avoid_duplicated_show = 0;
					$is_first_show_of_the_day = true;
					foreach( $schedules as $schedule ){
						$show_index = 0;
						$shows = $schedule->shows;
						$post_title = $schedule->post_title;
						set_query_var( 'scheduleday_is_active',0 );
						if( $schedule->ID == $current_day_id  ){
							set_query_var( 'scheduleday_is_active', 1 );
						}

						

						foreach( $shows as $show ){
							if( $counter < $quantity ){
								remove_query_arg('event');
								$show['day'] = $post_title;
								$show_id = $show['show_id'][0];
								$show_time =$show['show_time'];
								$show_time_end =$show['show_time_end'];
								if($show_time_end == "00:00"){
									$show_time_end = "24:00";
								}
								set_query_var( 'event', $show );
								$print = 0;
								if( $counter < $quantity ){
									global $post;
									// extract all shows today
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
									if( $print && $avoid_duplicated_show != $current_show_hash){
										$post = get_post($show_id); 
										if(is_object($post)):
											setup_postdata($post);
											$show['day'] = $post_title;
											?>
											<div class="proradio-item">
												<div class="proradio-itemcontainer">
													<?php get_template_part( 'template-parts/slider/slider__item--show' ); ?>
												</div>
											</div>
											<?php
											$avoid_duplicated_show = $current_show_hash;
											$counter = $counter+1;
										endif;
									}
								}
							}
							$is_first_show_of_the_day = false;
						}
						set_query_var( 'event', false);
						remove_query_arg('event');
						
					}
					$counter = 0;
					?>
				</div>
			</div>
			<?php
		else: 
			esc_html_e("Sorry, there is nothing for the moment.", "proradio");
		endif;
		remove_query_arg('scheduleday_is_active');
		// wp_reset_postdata(); // 2020-10-06 removed causing loop in footer
		return ob_get_clean();
	}

	// Set TTG Core shortcode functionality
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-showslider","proradio_upcoming_shows_slider");
	}

	/**
	 *  Visual Composer integration
	 */
	if(!function_exists('proradio_upcoming_shows_slider_vc')){
		add_action( 'vc_before_init', 'proradio_upcoming_shows_slider_vc' );
		function proradio_upcoming_shows_slider_vc() {
			vc_map( 
				array(
					"name" => esc_html__( "Radio shows slider", "proradio" ),
					"base" => "qt-showslider",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-slider.png' ),
					"category" => esc_html__( "Theme shortcodes", "proradio"),
					"params" => array_merge(
						proradio_slider_design_fields(),
						array(
							array(
								"type" => "textfield",
								"heading" => esc_html__( "Quantity", "proradio" ),
								"param_name" => "quantity",
								'description' => esc_html__( "Maximum", "proradio" ).' '.'8',
								'std' => 5,
							),
							array(
								"type" => "textfield",
								"heading" => esc_html__( "Filter by 'schedulefilter' taxonomy", "proradio" ),
								"description" => esc_html__("Insert the slug of a schedulefilter taxonomy for multi-radio websites","proradio"),
								"param_name" => "schedulefilter"
							),
						)
					)
				)
			);
		}
	}
}