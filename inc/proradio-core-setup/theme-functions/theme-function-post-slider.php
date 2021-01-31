<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Post slider
 *
 * [qt-post-slider post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


// if(!function_exists( 'proradio_template_post_slider' )){
// 	function proradio_template_post_slider( $atts = array() ){
				
// 		ob_start();
// 		extract( shortcode_atts( array(


// 			'category' => false,
// 			'quantity' => false,


// 			// Query parameters
// 			'post_type' 			=> 'post',
// 			'include_by_id'			=> false,
// 			'custom_query'			=> false,
// 			'tax_filter'			=> false,
// 			'items_per_page'		=> '3',
// 			'orderby'				=> 'date',
// 			'order'					=> 'DESC',
// 			'meta_key'				=> false,
// 			'offset'				=> 0,
// 			'exclude'				=> '',
// 			'meta_query' => array(array('key' => '_thumbnail_id')),
// 			// Global parameters
// 			'el_id'					=>  uniqid( 'qt-post-slider-'.get_the_ID() ),
// 			'el_class'				=> '',
// 			'list_id'				=> false // required for compatibility with WPBakery Page Builder
// 		), $atts ) );

// 		$items_per_page = intval($items_per_page);
// 		if($items_per_page > 10){
// 			$items_per_page = 10;
// 		}

// 		// proradio compatibility: works if I have only old parameters
// 		if( false != $category && 'all' !== $category && false == $tax_filter){
// 			$tax_filter = 'category:'.$category;
// 		}
// 		// proradio compatibility: works if I have only old parameters
// 		if(false != $quantity && false == $items_per_page){
// 			$items_per_page = $quantity;
// 		}

// 		if(false === $list_id){
// 			$list_id = 'list'.$el_id;
// 		}
// 		$list_id = str_replace(':', '-', $list_id);

// 		$paged = 1;

// 		include 'helpers/query-prep.php';

// 		$wp_query = new WP_Query( $args );

// 		// Max results value, used in pagination
// 		$max = $wp_query->max_num_pages;

// 		ob_start();
// 		if ( $wp_query->have_posts() ) : 

// 			$all_posts = $wp_query->posts;
// 			$total = count( $all_posts );
		
// 			?>
// 			<div id="<?php echo esc_attr( $list_id ); ?>" class="proradio-slider__proradio">
// 				<div class="proradio-slider__main">
					
// 					<?php  
// 					$n = 1;
// 					foreach ($all_posts as $mypost ){
// 						?>
// 						<input type="radio" name="slides" id="slides_<?php echo esc_attr( $n ); ?>" <?php echo esc_attr( ( $n == 1 )? 'checked' : '' ) ?> />
// 						<?php 
// 						$n++;
// 					}
// 					?>
// 					<ul>
// 					<?php  
// 					/**
// 					 * Loop
// 					 */
// 					while ( $wp_query->have_posts() ) : $wp_query->the_post();
// 						$post = $wp_query->post;
// 						setup_postdata( $post );
// 						?>
// 						<li>
// 							<?php  
// 							get_template_part ('template-parts/slider/slider__item');
// 							?>
// 						</li>
// 						<?php wp_reset_postdata(); ?>
// 					<?php 
// 					endwhile; 
// 					?>
// 					 </ul>
// 					<div class="proradio-slider__arrows">
// 						<?php  
// 						$n = 1;
// 						foreach ($all_posts as $mypost ){
// 							?>
// 							<label for="slides_<?php echo esc_attr( $n ); ?>" class="<?php echo esc_attr( ( $n == 1 )? 'proradio-goto-first' : '' ). esc_attr( ( $n == $total )? 'proradio-goto-last' : '' ) ?>"></label>
// 							<?php 
// 							$n++;
// 						}
// 						?>
// 					</div>
// 					<div class="proradio-slider__nav">
// 						<div>
// 							<?php  
// 							$n = 1;
// 							foreach ($all_posts as $mypost ){
// 								?>
// 								<label for="slides_<?php echo esc_attr( $n ); ?>"></label>
// 								<?php 
// 								$n++;
// 							}
// 							?>
// 						</div>
// 					</div>
// 				</div>
// 			</div>
// 			<?php
			
// 		else: 
// 			esc_html_e("Sorry, there is nothing for the moment.", "proradio");
// 		endif; 
// 		wp_reset_postdata();
		
// 		return ob_get_clean();

// 	}



// 	// Set TTG Core shortcode functionality
// 	if(function_exists('proradio_core_custom_shortcode')) {
// 		proradio_core_custom_shortcode("qt-post-slider","proradio_template_post_slider");
// 		// proradio compaibility
// 		proradio_core_custom_shortcode("qt-slideshow","proradio_template_post_slider");
// 	}

// 	/**
// 	 *  Visual Composer integration
// 	 */
	
// 	if(!function_exists('proradio_template_post_slider_vc')){
// 		add_action( 'vc_before_init', 'proradio_template_post_slider_vc' );
// 		function proradio_template_post_slider_vc() {
// 			vc_map( 
// 				array(
// 					"name" => esc_html__( "Post slider", "proradio" ),
// 					"base" => "qt-post-slider",
// 					"icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/post-slider.png' ),
// 					"description" => esc_html__( "Responsive slideshow", "proradio" ),
// 					"category" => esc_html__( "Theme shortcodes", "proradio"),
// 					"params" => array_merge(
// 						proradio_vc_query_fields($items_per_page_std = 4)
// 					)
// 				)
// 			);
// 		}
// 	}



// 	/**
// 	 *  Visual Composer integration
// 	 */
	
// 	if(!function_exists('proradio_vc_slideshow_single')){
// 		add_action( 'vc_before_init', 'proradio_vc_slideshow_single' );
// 		function proradio_vc_slideshow_single() {
// 		  vc_map( array(
// 			 "name" => esc_html__( "Slideshow [deprecated: use Post slider]", "proradio" ),
// 			 "base" => "qt-slideshow",
// 			 "icon" => get_template_directory_uri(). '/img/vc/slider.png',
// 			 "description" => esc_html__( "Automatic slideshow of posts", "proradio" ),
// 			 "category" => esc_html__( "Deorecated", "proradio"),
// 			 "params" => array(
// 				array(
// 				   "type" => "dropdown",
// 				   "heading" => esc_html__( "Quantity", "proradio" ),
// 				   "param_name" => "quantity",
// 				   'value' => array("3", "5", "7"),
// 				   "description" => esc_html__( "Number of posts to display", "proradio" )
// 				),
// 				array(
// 				   "type" => "textfield",
// 				   "heading" => esc_html__( "Filter by category (slug)", "proradio" ),
// 				   "description" => esc_html__("Insert the slug of a category to filter the results","proradio"),
// 				   "param_name" => "category"
// 				) ,
// 				array(
// 				   "type" => "textfield",
// 				   "heading" => esc_html__( "Offset (number)", "proradio" ),
// 				   "description" => esc_html__("Number of posts to skip in the database query","proradio"),
// 				   "param_name" => "offset"
// 				),
// 			 )
// 		  ) );
// 		}
// 	}



// }