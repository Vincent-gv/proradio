<?php  
/*
Package: proradio
Description: Sponsors shortcode
*/

/**
 * 
 * Sponsors
 * =============================================
 */
if(!function_exists('proradio_sponsors_shortcode')){
	function proradio_sponsors_shortcode ($atts){
		extract( shortcode_atts( array(
			// Carousel parameters
			'items_per_row_desktop'	=> '3',
			'gap'					=> '15',
			'pause_on_hover'		=> 'true',
			'loop'					=> 'true',
			'center'				=> 'true',
			'nav'					=> 'true',
			'dots'					=> 'true',
			'stage_padding'			=> '0',
			'autoplay_timeout'		=> '4000',
			//tablet
			'items_per_row_tablet'	=> '2',
			//mobile
			'items_per_row_mobile'	=> '1',
			// Global parameters
			'el_id'					=> 'qt-post-carousel-'.uniqid( get_the_ID() ),
			'grid_id'				=> false, // required for compatibility with WPBakery Page Builder
			'fx' => false,
			'class' => ''
		), $atts ) );

		
		if(false === $grid_id){
			$grid_id = 'grid'.$el_id;
		}
		$grid_id = str_replace(':', '-', $grid_id);

		$paged = 1;

		ob_start();
		
		/**
		 * [$args Query arguments]
		 * @var array
		 */
		$args = array(
			'post_type' => 'qtsponsor',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'orderby' => array ( 'menu_order' => 'ASC', 'date' => 'DESC'),
			'suppress_filters' => false,
			'paged' => 1
		);
		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );
		$number = $wp_query->post_count;

		if ( $wp_query->have_posts() ) : 
			?>
			<div id="<?php echo esc_attr($grid_id); ?>" class="proradio-owl-sponsorcarousel <?php echo esc_attr( $class ); ?>">
					<div id="<?php echo esc_attr($el_id); ?>" class="proradio-owl-carousel owl-carousel owl-theme proradio-owl-theme" 
					data-items="<?php 				echo esc_attr($items_per_row_desktop); ?>"
					data-items_tablet="<?php 		echo esc_attr($items_per_row_tablet); ?>"
					data-items_mobile="<?php 		echo esc_attr($items_per_row_mobile); ?>"
					data-items_mobile_hori="2"
					data-gap="<?php 				echo esc_attr($gap); ?>"
					data-pause_on_hover="<?php 		echo esc_attr($pause_on_hover); ?>"
					data-loop="<?php 				echo esc_attr($loop); ?>" 
					data-center="<?php 				echo esc_attr($center); ?>" 
					data-stage_padding="<?php 		echo esc_attr($stage_padding); ?>"
					data-nav="<?php 				echo esc_attr($nav); ?>"
					data-dots="<?php 				echo esc_attr($dots); ?>" 
					data-autoplay_timeout="<?php 	echo esc_attr($autoplay_timeout); ?>" 
					data-amount="<?php echo esc_attr( $number ); ?>">
						<?php  
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$post = $wp_query->post;
							setup_postdata( $post );
							if (has_post_thumbnail()){ 
							?>
								<div class="proradio-item">
									<div class="proradio-itemcontainer">
										<a href="<?php echo esc_attr(get_post_meta(get_the_ID(), "linkurl", true)); ?>" target="_blank" rel="nofollow" class="qt-sponsor" >
											 <?php the_post_thumbnail( 'proradio-medium',  array( 'title' => get_the_title(), 'alt' => get_the_title() ) ); ?>
										</a>
									</div>
								</div>
								<?php 
							} 
						endwhile; 
						wp_reset_postdata();
						?>            
					</div>
				</div>
			<?php
		endif;
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-sponsors","proradio_sponsors_shortcode");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_vc_sponsors_shortcode' );
if(!function_exists('proradio_vc_sponsors_shortcode')){
	function proradio_vc_sponsors_shortcode() {
	  vc_map( array(
		"name" => esc_html__( "Sponsor carousel", "proradio" ),
		"base" => "qt-sponsors",
		"icon" => get_template_directory_uri(). '/img/qt-logo.png',
		"description" => esc_html__( "Add a sponsors carousel", "proradio" ),
		"category" => esc_html__( "Theme shortcodes", "proradio"),
		"params" => 
			array_merge( 
				proradio_carousel_design_fields(),
					array(
						array(
							'type' => 'textfield',
							'value' => '',
							'heading' => esc_attr__('CSS Class', 'proradio'),
							'param_name' => 'class',
						),
					)
				)
			)
		);
	}
}
