<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Prepare query for functions
*/

/**
 * 1. Query preparation
 * ================================================
 * If offset is set, paged is ignored (https://codex.wordpress.org/Class_Reference/WP_Query)
 * so we are preparing the query with correct paged number, but it is not affecting the results now
 * instead we also make a custom offset adding offset parameter with page * results number
 */
if (intval($paged) > 1){
	$offset = intval($offset) + ( intval( $items_per_page) * intval( $paged ) );
}
$args = array(
	'tax_filter' => false,
	'post_type' 			=>  $post_type,
	'posts_per_page' 		=> (int)$items_per_page,
	'post_status' 			=> 'publish',
	'paged' 				=> $paged,
	'suppress_filters' 		=> false,
	'offset' 				=> (int)$offset,
	'ignore_sticky_posts' 	=> 1,
	'orderby' 				=> trim( esc_attr($orderby) ),
	'order' 				=> trim( esc_attr($order) ),
	'meta_key'				=> $meta_key,
	'post__not_in'			=> explode(',', trim($exclude) ),
);
// ========== TAXONOMY FILTERING =================
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
// ========== QUERY BY ID =================
if( $include_by_id ){
	$idarr = explode(",",$include_by_id);
	if(count($idarr) > 0){
		$quantity = count($idarr);
		$args = array(
			'post__in'=> $idarr,
			'post_type' =>  'any',
			'orderby' => 'post__in',
			'posts_per_page' => intval($quantity),
			'ignore_sticky_posts' => 1
		);  
	}
}

// ========== CUSTOM QUERY =================
if( $custom_query ){
	$args = array();
	parse_str( $custom_query, $args );
	$args['ignore_sticky_posts']= 1;
	$args['suppress_filters']	= false;
	$args['paged']				= $paged;
	$args['offset'] 			= (int)$offset;
	if( $style !== 'all' ){
		$args['posts_per_page'] = (int)$items_per_page;
	}
}

/**
 * Pagination support for load more
 */
// Have pagination?
$query_offset = $offset;
if( isset( $_GET ) && isset(  $list_id ) ){
	if( isset( $_GET[ $list_id ] ) ){
		$query_offset = intval( $offset ) + ( ( intval( $_GET[ $list_id ] ) - 1) * intval( $items_per_page ) );
		if ($query_offset) {
			$args[ 'offset'] =  esc_attr( intval( $query_offset ) );
			$args[ 'posts_per_page'] = $items_per_page;
			
		}
	}
}