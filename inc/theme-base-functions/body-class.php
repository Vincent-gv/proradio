<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.1.8
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/* Add theme body class
=============================================*/
	
if ( ! function_exists( 'proradio_body_class' ) ) {
	add_filter('body_class', 'proradio_body_class');
	function proradio_body_class($classes){
		$classes[] = 'proradio-body';
		$classes[] = 'proradio-unscrolled';

		
		if( get_theme_mod( 'proradio_js_debug') ){
			$classes[] = 'proradio-jsdebug';
		}
		
		if( get_theme_mod( 'proradio_header_transp') ){
			$classes[] = 'proradio-menu-transp';
		} else {
			$classes[] = 'proradio-menu-opaque';
		}


		if( get_theme_mod('proradio_header_sticky') ){
			$classes[] = 'proradio-menu-stick';
		} else {
			$classes[] = 'proradio-menu-scroll';
		}

		/**
		 * 
		 * =====================================
		 * Override global transparency for custom page options
		 * =====================================
		 * 
		 */
		if( is_single() || is_page() || is_singular() ){
			$custom_opacity = get_post_meta( get_the_ID(), 'proradio_menu_opacity', true ); 
			$key_to_remove = false;
			switch( $custom_opacity ){
				case 'proradio-menu-transp':
					$classes[] = 'proradio-menu-transp';
					$key_to_remove = array_search('proradio-menu-opaque', $classes);
					break;
				case 'proradio-menu-opaque':
					$classes[] = 'proradio-menu-opaque';
					$key_to_remove = array_search('proradio-menu-transp', $classes);
					break;
			}
			if( $key_to_remove !== null ) {
				unset( $classes[ $key_to_remove ] );
			}
		} 


		return $classes;
	}
}