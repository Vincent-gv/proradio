<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * ======================================================
 * THEME VERSION
 * ------------------------------------------------------
 * Theme version definition to prevent caching of old files
 * ======================================================
 */
if(!function_exists('proradio_theme_version')){
function proradio_theme_version(){
	$my_theme = wp_get_theme( );
	if( is_child_theme() ){
		$my_theme = $my_theme->parent();
	}
	return $my_theme->get( 'Version' );
}}