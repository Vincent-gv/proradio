<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
/**
 * ======================================================
 * Get current page. 
 * ------------------------------------------------------
 * Role: Fix for using archives as home page
 * ======================================================
 */
if(!function_exists('proradio_get_paged')){
function proradio_get_paged() {
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {  $paged = 1; }
	return intval($paged);
}}
