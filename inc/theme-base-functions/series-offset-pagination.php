<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * ======================================================
 * Modify series archives to skip one post and fix offset
 * to display latest post of the serie with a custom fashion
 * https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
 * ======================================================
 */
if(!function_exists( 'proradio_series_query_offset' )) {
	// add_action('pre_get_posts', 'proradio_series_query_offset', 1 );
	function proradio_series_query_offset(&$query) {
		
		

		$seriesname = 'qtserie';
		if(function_exists('proradio_series_custom_series_name')) {
			$seriesname = proradio_series_custom_series_name(); 
		}

		//Before anything else, make sure this is the right query...
		if(!$query->is_main_query() || is_admin() || !$query->is_tax( $seriesname )){
			return;
		}

		$offset = 1;
		$ppp = 9; // Overriding get_option('posts_per_page') for this theme
		if ( $query->is_paged ) {
			$page_offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );
			$query->set('offset', $page_offset );
		}
		else {
			$query->set('offset',$offset);
		}
	}
}
if(!function_exists( 'proradio_series_adjust_offset_pagination' )) {
	function proradio_series_adjust_offset_pagination($found_posts, $query) {
		$seriesname = 'qtserie';
		if(function_exists('proradio_series_custom_series_name')) {
			$seriesname = proradio_series_custom_series_name();
		}
		if(!$query->is_main_query() || is_admin() || !$query->is_tax( $seriesname )){
			return;
		}
		$offset = 1;
		return $found_posts - $offset;
	}
}
