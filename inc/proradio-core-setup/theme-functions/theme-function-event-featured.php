<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Latest posts list
 *
 * Example:
 * [qt-post-list post_type="" include_by_id="1,2,3" custom_query="..." tax_filter="category:trending, post_tag:video" items_per_page="9" orderby="date" order="DESC" meta_key="name_of_key" offset="" exclude="" el_class="" el_id=""]
*/


if(!function_exists('events_featured_shortcode')) {
	function events_featured_shortcode($atts){

		/**
		 * Output object start
		 */

		ob_start();

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'tax_filter' 		=> false,
			'include_by_id' 	=> false,
			'quantity' 			=> 1,
			'hideold' 			=> false,
			'title' 			=> false,
			'countdown' 		=> false,
			'category' 			=> false,
			'orderby' 			=> 'date',
			'btntxt' 			=> esc_html__( 'Learn more', 'proradio' ),
			'offset' 			=> 0,
		), $atts ) );

		if(!is_numeric($quantity)) {
			$quantyty = 1;
		}

		$offset = (int)$offset;
		if(!is_numeric($offset)) {
			$offset = 0;
		}
		
		/**
		 *  Query for my content
		 */
		$args = array(
			'post_type' 			=>  'event',
			'posts_per_page' 		=> $quantity,
			'post_status' 			=> 'publish',
			'paged' 				=> 1,
			'suppress_filters' 		=> false,
			'offset' 				=> esc_attr($offset),
			'ignore_sticky_posts' 	=> 1
		);

		/**
		 * Add category parameters to query if any is set
		 */
		if (false !== $category && 'all' !== $category) {
			$args[ 'tax_query'] = array(
					array(
					'taxonomy' 	=> 'eventtype',
					'field' 	=> 'slug',
					'terms' 	=> array(esc_attr($category)),
					'operator'	=> 'IN'
				)
			);
		}

		/**
		 * Query parameters for events only
		 */
		
		$args['orderby'] 	= 'meta_value';
		$args['order']   	= 'ASC';
		$args['meta_key'] 	= 'proradio_date';


		/**
		 * Optionally hide old events
		 */
		if($hideold){
			$args['meta_query'] = array(
				array(
					'key' 		=> 'proradio_date',
					'value' 	=> date('Y-m-d'),
					'compare' 	=> '>=',
					'type' 		=> 'date'
				 )
			);
		}


		/**
		 * Alternative: query by ID only
		 */
		// Retro-compatibility
		// if( false !== $include_by_id ){
		// 	$id = implode(',', $include_by_id);
		// }
		if($include_by_id){
			if(!is_array( $include_by_id )){
				$idarr = explode(",",$include_by_id);
			} else {
				$idarr = $include_by_id;
			}
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
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );


		set_query_var( 'proradio_countdown', $countdown );
		set_query_var( 'proradio_btntxt', $btntxt );
		
		/**
		 * Loop start
		 */
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post = $wp_query->post;
			setup_postdata( $post );

			get_template_part( 'template-parts/post/post-event--featured' );
		endwhile;  else: 
			esc_html_e("Sorry, there is nothing for the moment.", "proradio"); ?>
		<?php  
		endif; 
		wp_reset_postdata();
		remove_query_arg( 'proradio_countdown' );
		remove_query_arg( 'proradio_btntxt' );

		/**
		 * Loop end
		 */
		
		return ob_get_clean();
	}
}

if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-event-featured","events_featured_shortcode");
}


/**
 *  Visual Composer integration
 */

if(!function_exists('events_featured_shortcode_vc')){
	add_action( 'vc_before_init', 'events_featured_shortcode_vc' );
	function events_featured_shortcode_vc() {
	  vc_map( array(
		 "name" 		=> esc_html__( "Events featured", "proradio" ),
		 "base" 		=> "qt-event-featured",
		 "icon" 		=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/events-featured.png' ),
		 "description" 	=> esc_html__( "List of events with featured design", "proradio" ),
		 "category" 	=> esc_html__( "Theme shortcodes", "proradio"),
		 "params" 		=> array(
			array(
			   "type" 			=> "checkbox",
			   "heading" 		=> esc_html__( "Hide old events", "proradio" ),
			   "param_name" 	=> "hideold",
			),
			array(
			   "type" 			=> "checkbox",
			   "heading" 		=> esc_html__( "Countdown", "proradio" ),
			   "param_name" 	=> "countdown",
			),
			array(
			   'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Event', 'proradio'),
				'param_name' 	=> 'include_by_id',
				'settings'		=> array( 
					'values' 		=> proradio_autocomplete('event') ,
					'multiple'		=> false,
					'sortable'		=> false,
	          		'min_length'	=> 1,
	          		'groups'		=> false,  
	          		'unique_values' => true,  
	          		'display_inline'=> true,
				),
				'dependency' 	=> array(
					'element' 		=> 'post_type',
					'value' 		=> array( 'ids' ),
				),
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Quantity", "proradio" ),
			   "param_name" 	=> "quantity",
			   'std'			=> '1',
			   "description" 	=> esc_html__( "Number of items to display", "proradio" )
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Button text", "proradio" ),
			   "param_name" 	=> "btntxt",
			   'std' 			=> esc_html__( 'Learn more', 'proradio' )
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Filter by event type (slug)", "proradio" ),
			   "description"	=> esc_html__( "Instert the slug of the event type to filter the results","proradio"),
			   "param_name" 	=> "category"
			),
			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__( "Offset (number)", "proradio" ),
			   "description"	=> esc_html__( "Number of items to skip in the database query","proradio"),
			   "param_name" 	=> "offset"
			)
		 )
	  ) );
	}
}


		



