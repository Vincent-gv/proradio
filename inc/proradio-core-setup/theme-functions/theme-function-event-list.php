<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 **/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists('proradio_events_shortcode')) {
	function proradio_events_shortcode($atts){

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'countdown' 	=> false,
			'include_by_id' => false,
			'id' 			=> false,
			'items_per_page'=> 3,
			'hideold' 		=> false,
			'tax_filter' 	=> false,
			'category' 		=> false,
			'orderby' 		=> 'date',
			'offset' 		=> 0,
			'e_loadmore'	=> false,
			
		), $atts ) );

		$list_id = md5( serialize($atts) );


		$offset = (int)$offset;
		if(!is_numeric($offset)) {
			$offset = 0;
		}



		/**
		 *  Query for my content
		 */
		$args = array(
			'post_type' =>  'event',
			'posts_per_page' => $items_per_page,
			'post_status' => 'publish',
			'paged' => 1,
			'suppress_filters' => false,
			'offset' => esc_attr($offset),
			'ignore_sticky_posts' => 1
		);

		/**
		 * Add category parameters to query if any is set
		 */
		
		// retro compatibility for page builder
		if (false !== $category && 'all' !== $category) {
			$args[ 'tax_query'] = array(
					array(
					'taxonomy' => 'eventtype',
					'field' => 'slug',
					'terms' => array(esc_attr($category)),
					'operator'=> 'IN' //Or 'AND' or 'NOT IN'
				)
			);
		}

		if( $tax_filter  ){
			$tax_filter_array = explode(',', trim($tax_filter) );
			$tax_atts = array();
			$tax_query = array(
				'relation' => 'AND'
			);
			foreach( $tax_filter_array as $var => $val){
				$tax = explode(':', $val);
				if( array_key_exists(1, $tax)){
					$tax_atts[ trim( $tax[0] ) ] [] = trim( $tax[1] );
				}
			}
			foreach( $tax_atts as $taxname => $termslist ){
				$tax_query[] = array(
					'taxonomy' 	=> trim( $taxname ),
					'field' 	=> 'slug',
					'terms'		=> $termslist,
					'operator'	=> 'IN'
				);
			}
			$args[ 'tax_query'] = $tax_query;
		}



		/**
		 * Query parameters for events only
		 */
		
		$args['orderby'] = 'meta_value';
		$args['order']   = 'ASC';
		$args['meta_key'] = 'proradio_date';


		/**
		 * Optionally hide old events
		 */
		if($hideold){
			$args['meta_query'] = array(
				array(
					'key' => 'proradio_date',
					'value' => date('Y-m-d'),
					'compare' => '>=',
					'type' => 'date'
				 )
			);
		}


		/**
		 * Alternative: query by ID only
		 */
		// Retro-compatibility
		if( $include_by_id ){
			$id = implode(',', $include_by_id);
		}
		if($id){
			$idarr = explode(",",$id);
			if(count($idarr) > 0){
				$quantity = count($idarr);
				$args = array(
					'post__in'=> $idarr,
					'post_type' =>  'event',
					'orderby' => 'post__in',
					'posts_per_page' => -1,
					'ignore_sticky_posts' => 1
				);  
			}
		}
		

		/**
		 * Pagination support for load more
		 */
		// Have pagination?
		$query_offset = $offset;
		if( isset( $_GET ) ){
			if( isset( $_GET[ $list_id ] ) ){
				$query_offset = $offset + ( ( intval( $_GET[ $list_id ] ) - 1) * intval( $items_per_page ) );
				if ($query_offset) {
					$args[ 'offset'] =  esc_attr( intval( $query_offset ) );
				}
			}
		}

		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );
		/**
		 * Output object start
		 */

		ob_start();


		/**
		 * Loop start
		 */
		if ( $wp_query->have_posts() ) : 
			
			?>
			<div id="<?php echo esc_attr( $list_id ); ?>" class="proradio-container proradio-events-list">
				<?php  
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post = $wp_query->post;
					setup_postdata( $post );
					set_query_var( "countdown", $countdown );
					get_template_part( 'template-parts/post/post-event' );
					remove_query_arg( 'countdown');
				endwhile;
				include 'helpers/loadmore.php';
				?>
			</div>
			<?php

		else: 
			esc_html_e("Sorry, there is nothing for the moment.", "proradio"); ?>
		<?php  
		endif; 
		wp_reset_postdata();

		/**
		 * Loop end
		 */
		
		return ob_get_clean();
	}


	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-events","proradio_events_shortcode");
	}


	/**
	 *  Visual Composer integration
	 */

	if(!function_exists('proradio_events_shortcode_vc')){
		add_action( 'vc_before_init', 'proradio_events_shortcode_vc' );
		function proradio_events_shortcode_vc() {
		  vc_map( array(
			 "name" 		=> esc_html__( "Events list", "proradio" ),
			 "base" 		=> "qt-events",
			 "icon" 		=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/events.png' ),
			 "description" 	=> esc_html__( "List of events", "proradio" ),
			 "category" 	=> esc_html__( "Theme shortcodes", "proradio"),
			 "params" 		=> array(
				array(
				   "type" 			=> "checkbox",
				   "heading" 		=> esc_html__( "Hide old events", "proradio" ),
				   "param_name" 	=> "hideold",
				   'value' 			=> false
				),
				array(
				   "type" 			=> "textfield",
				   "heading" 		=> esc_html__( "ID, comma separated list (123,345,7638)", "proradio" ),
				   "description" 	=> esc_html__( "Display only the contents with these IDs. All other parameters will be ignored.", "proradio" ),
				   "param_name" 	=> "id",
				   'value' 			=> ''
				),
				array(
				   "type" 			=> "textfield",
				   "heading" 		=> esc_html__( "Quantity", "proradio" ),
				   "param_name" 	=> "quantity",
				   "description" 	=> esc_html__( "Number of items to display", "proradio" )
				),
				array(
				   "type" 			=> "textfield",
				   "heading" 		=> esc_html__( "Filter by event type (slug)", "proradio" ),
				   "description" 	=> esc_html__( "Instert the slug of the event type to filter the results","proradio"),
				   "param_name" 	=> "category"
				),
				array(
				   "type" 			=> "textfield",
				   "heading" 		=> esc_html__( "Offset (number)", "proradio" ),
				   "description" 	=> esc_html__( "Number of items to skip in the database query","proradio"),
				   "param_name" 	=> "offset"
				)
			 )
		  ) );
		}
	}
}

		



