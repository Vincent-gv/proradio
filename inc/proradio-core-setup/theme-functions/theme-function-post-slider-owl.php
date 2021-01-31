<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 *
*/


if(!function_exists( 'proradio_posts_slider_owl' )){
	function proradio_posts_slider_owl( $atts = array() ){
		extract( shortcode_atts( array(

			'id' => false, // Legacy parameter for retro compatibility 
			'quantity' => false, // Legacy parameter for retro compatibility 
			'posttype' => false, // Legacy parameter for retro compatibility 
			'category' => false, // Legacy parameter for retro compatibility 

			// Global parameters
			'el_id'					=> 'qt-post-carousel-'.uniqid( get_the_ID() ),
			'el_class'				=> '',
			'grid_id'				=> false, // required for compatibility with WPBakery Page Builder

			// Query parameters
			'post_type' 			=> 'post',
			'include_by_id'			=> false,
			'custom_query'			=> false,
			'tax_filter'			=> false,
			'items_per_page'		=> 5,
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,
			'exclude'				=> '',

			// Carousel parameters
			'pause_on_hover'		=> 'true',
			'loop'					=> 'true',
			'nav'					=> 'true',
			'dots'					=> 'true',
			'stage_padding'			=> '0',
			'autoplay_timeout'		=> '6000',
			'fullheight'			=> false,
			'fullwidth'			=> false,

		), $atts ) );

		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);




		// ================================================
		// RETRO COMPATIBILITY

		/**
		 * Convert category into tax_filter
		 * @var  $category [string] category slug
		 */
		if ($category && 'all' !== $category && $tax_filter == false) {
			$tax_filter = 'category:'.$category;
		}

		// If an old post type parameter different from post was stored, let's use it
		if ( $posttype && $post_type == 'post' ) {
			$post_type = $posttype;
		}
		if( $id && !$include_by_id ){
			$include_by_id = $id;
		}
		if ( $quantity && $items_per_page == '9' ) {
			$items_per_page = $quantity;
		}
		// END OF RETRO COMPATIBILITY
		// ================================================

		$paged = 1;

		include 'helpers/query-prep.php';

		/**
		 * 
		 * ========================================
		 * Events query parameters
		 * ========================================
		 * * Order by date
		 * * Hide old if enabled in customizer
		 * ========================================
		 * 
		 */
		if($post_type == 'event'){

			$args['orderby'] 	= 'meta_value';
			$args['order']   	= 'ASC';
			$args['meta_key'] 	= 'proradio_date';

			// Hide old?
			if(get_theme_mod( 'events_hideold', 0 ) == '1'){
				$args['meta_query'] = array(
					array(
						'key' 		=> 'proradio_date',
						'value' 	=> date('Y-m-d'),
						'compare' 	=> '>=',
						'type' 		=> 'date'
					 )
				);
			}
		}

		ob_start();

		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;
		
		switch($post_type){
			case "shows":
				$item_template = 'slider__item--show';
				break;
			default:
				$item_template = 'slider__item';
		}


		if ( $wp_query->have_posts() ) : 
			$number = $wp_query->post_count;
			$container_classes = array('proradio-slider', 'proradio-slider-owl');
			if( $fullheight ){
				$container_classes[] = 'proradio-slider--fullheight';
			}
			if( $fullwidth ){
				$container_classes[] = 'proradio-slider--fullwidth';
			}
			$container_classes =  implode(' ', $container_classes);
			?>

			<div id="<?php echo esc_attr($grid_id); ?>" class="<?php echo esc_attr( $container_classes ); ?>">
				<div id="<?php echo esc_attr($el_id); ?>" class="proradio-owl-carousel owl-carousel owl-theme proradio-owl-theme" data-items="1"data-items_tablet="1" data-items_mobile="1" data-items_mobile_hori="1" data-gap="0" data-pause_on_hover="<?php  echo esc_attr($pause_on_hover); ?>" data-loop="<?php echo esc_attr($loop); ?>" data-center="true" data-stage_padding="0" data-nav="<?php echo esc_attr($nav); ?>" data-dots="<?php echo esc_attr($dots); ?>" data-autoplay_timeout="<?php 	echo esc_attr($autoplay_timeout); ?>" data-amount="<?php echo esc_attr( $number ); ?>">
					<?php  
					/**
					 * Loop
					 */
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
						setup_postdata( $post );

						?>
						<div class="proradio-item">
							<div class="proradio-itemcontainer">
								<?php
								get_template_part ( 'template-parts/slider/'.$item_template );
								?>
							</div>
						</div>
						<?php
					endwhile;
					?>
				</div>
			</div>
			<?php

		else: 
			esc_html_e("Sorry, there is nothing for the moment.", "proradio");
		endif; 


		wp_reset_postdata();
		return ob_get_clean();
	}

	// Set TTG Core shortcode functionality
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-slideshow","proradio_posts_slider_owl");
	}

	/**
	 *  Visual Composer integration
	 */
	if(!function_exists('proradio_posts_slider_owl_vc')){
		add_action( 'vc_before_init', 'proradio_posts_slider_owl_vc' );
		function proradio_posts_slider_owl_vc() {
			vc_map( 
				array(
					"name" => esc_html__( "Post Slideshow", "proradio" ),
					"base" => "qt-slideshow",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-slider.png' ),
					"category" => esc_html__( "Theme shortcodes", "proradio"),
					"params" => array_merge(
						proradio_slider_design_fields(),
						proradio_vc_query_fields($items_per_page_std = 5)

					)
				)
			);
		}
	}
}