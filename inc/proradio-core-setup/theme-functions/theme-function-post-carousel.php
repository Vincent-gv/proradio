<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 *
 * Example:
 * [qt-post-carousel post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists( 'proradio_template_post_carousel' )){
	function proradio_template_post_carousel( $atts = array() ){

	
		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			
			'id' => false, // Legacy parameter for retro compatibility 
			'quantity' => false, // Legacy parameter for retro compatibility 
			'posttype' => false, // Legacy parameter for retro compatibility 
			'category' => false, // Legacy parameter for retro compatibility 
			'itemsperrow' => false,

			// Query parameters
			'post_type' 			=> 'post',
			'include_by_id'			=> false,
			'custom_query'			=> false,
			'tax_filter'			=> false,
			'items_per_page'		=> '9',
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'meta_key'				=> false,
			'offset'				=> 0,
			'exclude'				=> '',
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
			'el_class'				=> '',
			'grid_id'				=> false // required for compatibility with WPBakery Page Builder
		

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
		if ( $posttype ) {
			$post_type = $posttype;
		}
		if( $id ){
			$include_by_id = $id;
		}
		if ($quantity) {
			$items_per_page = $quantity;
		}
		// END OF RETRO COMPATIBILITY
		// ================================================

		$paged = 1;

		include 'helpers/query-prep.php';

		$wp_query = new WP_Query( $args );

		// Max results value, used in pagination
		$max = $wp_query->max_num_pages;
		

		switch($post_type){
			case "proradio_testimonial":
				$item_template = 'post-proradio_testimonial';
				break;
			case "chart":
				$item_template = 'post-chart';
				break;
			case "members":
				$item_template = 'post-members';
				break;
			case "product":
				$item_template = 'post-product';
				break;
			case "podcast":
				$item_template = 'post-podcast';
				break;
			case "event":
				$item_template = 'post-event--card';
				break;
			case "shows":
				$item_template = 'post-proradio_shows';
				break;
			case "place":
				$item_template = 'post-place';
				break;
			default:
				$item_template = 'post-vertical';
		}

		ob_start();
		if ( $wp_query->have_posts() ) : 
			$number = $wp_query->post_count;
			
			$container_classes = array('proradio-owl-carousel-container');
			?>

			<div id="<?php echo esc_attr($grid_id); ?>" class="<?php echo esc_attr( implode(' ', $container_classes)); ?>">
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
								get_template_part ( 'template-parts/post/'.$item_template );
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
		proradio_core_custom_shortcode("qt-post-carousel","proradio_template_post_carousel");
	}


	/**
	 *  Visual Composer integration
	 */
	add_action( 'vc_before_init', 'proradio_template_post_carousel_vc' );
	if(!function_exists('proradio_template_post_carousel_vc')){
		function proradio_template_post_carousel_vc() {
	  		vc_map( 
	  			array(
					"name" => esc_html__( "Post carousel", "proradio" ),
					"base" => "qt-post-carousel",
					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-carousel.png' ),
					"category" => esc_html__( "Theme shortcodes", "proradio"),
					"params" => array_merge(
						array(
							array(
								"group" 	=> esc_html__( "Data Settings", "proradio" ),
								'type' => 'dropdown',
								'heading' => esc_html__( 'Post type', 'proradio' ),
								'param_name' => 'post_type',
								'value' => array(
									esc_html__( "Post", 'proradio' )		=> "post",
									esc_html__( "Podcast", 'proradio' )		=> "podcast",
									esc_html__( "Event", 'proradio' )		=> "event",
									esc_html__( "Shows", 'proradio' )		=> "shows",
									esc_html__( "Place", 'proradio' )		=> "place",
									esc_html__( "Team member", 'proradio' )	=> "members",
									esc_html__( "Product", 'proradio' )		=> "product",
								),
								'std' => 'post',
								'admin_label' => true,
								'edit_field_class' => 'vc_col-sm-7',
							),
						),
						proradio_vc_query_fields($items_per_page_std = 9),
						proradio_carousel_design_fields()
					)
				)
	  		);
		}
	}



	/**
	 * ========================================================
	 * OnAir2 COMPATIBILITY
	 * ========================================================
	 */
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-slideshow-carousel","proradio_template_post_carousel");
	}


	/**
	 *  Visual Composer integration
	 */
	add_action( 'vc_before_init', 'proradio_vc_carousel_short' );
	if(!function_exists('proradio_vc_carousel_short')){
	function proradio_vc_carousel_short() {
	  vc_map( array(
	     "name" => esc_html__( "Post Carousel - legacy [deprecated: use Post Carousel]", "proradio" ),
	     "base" => "qt-slideshow-carousel",
	     "icon" => get_template_directory_uri(). '/img/vc/carousel.png',
	     "description" => esc_html__( "Carousel of posts on 3 columns", "proradio" ),
	     "category" => esc_html__( "Deprecated", "proradio"),
	     "params" => array(
	     	array(
	           "type" => "textfield",
	           "heading" => esc_html__( "ID, comma separated list (123,345,7638)", "proradio" ),
	           "description" => esc_html__( "Display only the contents with these IDs. All other parameters will be ignored.", "vlogger" ),
	           "param_name" => "id",
	           'value' => ''
	        ),
	      	array(
	           "type" => "dropdown",
	           "heading" => esc_html__( "Quantity", "proradio" ),
	           "param_name" => "quantity",
	           'value' => array("6", "9", "12", "15"),
	           "description" => esc_html__( "Number of posts to display", "proradio" )
	        ),
	        array(
	           "type" => "textfield",
	           "heading" => esc_html__( "Filter by category (slug)", "proradio" ),
	           "description" => esc_html__("Insert the slug of a category to filter the results","proradio"),
	           "param_name" => "category"
	        ),
			array(
			   "type" => "textfield",
			   "heading" => esc_html__( "Offset (number)", "proradio" ),
			   "description" => esc_html__("Number of posts to skip in the database query","proradio"),
			   "param_name" => "offset"
			),
			array(
			   "type" => "dropdown",
			   "heading" => esc_html__( "Order by", "proradio" ),
			   "param_name" => "orderby",
			   'value' => array(__("Default", "proradio")=>"",
			   					__("Publish date", "proradio")=>"date",
			   					// __("Menu order", "proradio")=>"menu_order",
			   					__("Random", "proradio")=>"rand"
			   					),
			   "description" => esc_html__( "Change the order of the posts", "proradio" )
			)
	     )
	  ) );
	}}
}