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
 * Google fonts
 * ------------------------------------------------------
 * Translators: If there are characters in your language that are not supported
 * by chosen font(s), translate this to 'off'. Do not translate into your own language.
 * ======================================================
 */

if(!function_exists('proradio_fonts_url')){
function proradio_fonts_url() {
	$font_url = '';
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'proradio' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Montserrat:600,700|Karla:400,700' ), "//fonts.googleapis.com/css" );
	}
	return $font_url;
}}



/**
 * ======================================================
 * CSS and Js loading
 * ------------------------------------------------------
 * Theme javascript and style inclusion
 * ======================================================
 */
if(!function_exists('proradio_styles_inclusion')){
	
	add_action( 'wp_enqueue_scripts', 'proradio_styles_inclusion', 500 );
	
	function proradio_styles_inclusion() {

		/**
		 * ===========================================================================================================
		 * CSS libraries
		 * ===========================================================================================================
		 */
		
		// Styles
		wp_enqueue_style( "qt-socicon", get_theme_file_uri( '/css/fonts/qt-socicon/styles.css' ), false, proradio_theme_version(), "all" );
		wp_enqueue_style( "material-icons", get_theme_file_uri( '/css/fonts/google-icons/material-icons.css' ), false, proradio_theme_version(), "all" );
		
		// if no customizer is active, load default fonts
		if( !function_exists( 'proradio_core_active' ) ){
			wp_enqueue_style( 'proradio-fonts', proradio_fonts_url(), array(), '1.0.0' );
			wp_enqueue_style( "proradio-typography", 	get_theme_file_uri( '/css/proradio-typography.css' ), false, proradio_theme_version(), "all" );
		}

		// Main.css
		// Optionally load a minified stylesheet
		if( '1' == get_theme_mod( 'proradio_advanced_mincss' ) ){
			wp_register_style( 'proradio-main', get_theme_file_uri( 'css/main-min.css' ) , false, proradio_theme_version(), "all" );
		} else {
			wp_register_style( 'proradio-main', get_theme_file_uri( 'css/main.css' ) , false, proradio_theme_version(), "all" );
		}
		wp_enqueue_style( 'proradio-main' );

		
		if( function_exists( 'proradio_theme_customizations' ) ){
			wp_add_inline_style( 'proradio-main', proradio_theme_customizations() );
		}

		// OWL carousel
		wp_enqueue_style( 'owl-carousel', get_theme_file_uri( 'components/owl-carousel/dist/assets/owl.carousel.min.css' , __FILE__ ), false, '2.3.2');


		// Default root stylesheet
		wp_enqueue_style( 'proradio', get_stylesheet_uri() , false, proradio_theme_version(), "all" );


		

		// Optional WooCommerce stylesheet
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'proradio-woocommerce', get_template_directory_uri().'/css/woocommerce.css', false, proradio_theme_version() , "all");
		}

		
		/**
		 * ===========================================================================================================
		 * Javascript libraries
		 * ===========================================================================================================
		 */
		$deps = array('jquery', 'masonry', 'imagesloaded');

		if( get_theme_mod( 'proradio_advanced_minjs') ){
			
			// Main script of the QTT framework
			wp_enqueue_script( 'proradio-main', get_theme_file_uri('/js/qtt-main-min.js'), $deps, proradio_theme_version(), true ); $deps[] = 'proradio-main';

		} else {
			// Modernizer
			wp_enqueue_script( 'modernizr', get_theme_file_uri( '/components/modernizr/modernizr-custom.js' ), $deps, '3.5.0', true ); $deps[] = 'modernizr';

			// Easing
			wp_enqueue_script( 'easing', get_theme_file_uri( '/components/materialize-src/js/jquery.easing.1.3.js' ), $deps, '3.5.0', true ); $deps[] = 'easing';

			// Collapsible
			wp_enqueue_script( 'collapsible', get_theme_file_uri( '/components/materialize-src/js/collapsible.js' ), $deps, '3.5.0', true ); $deps[] = 'collapsible';

			// Skip link focus fix
			wp_enqueue_script( 'skip-link-focus-fix', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), '20151215', true );

			// Owl Carousel
			wp_register_script( 'owl-carousel', get_theme_file_uri( 'components/owl-carousel/dist/owl.carousel-min.js' , __FILE__ ), array('jquery', 'masonry'),'2.3.2', true);$deps[] = 'owl-carousel';
			
			// stellar.js for parallax fx
			wp_enqueue_script( 'stellar', get_theme_file_uri( '/components/stellar/jquery.stellar.min.js' ), $deps, '0.6.2', true ); $deps[] = 'stellar';

			// sticky sidebar script
			wp_enqueue_script( 'ttg-sticky-sidebar', get_template_directory_uri().'/components/ttg-stickysidebar/min/ttg-sticky-sidebar-min.js', $deps, proradio_theme_version(), true ); $deps[] = 'ttg-sticky-sidebar';
			
			// Main script of the QTT framework
			wp_enqueue_script( 'proradio-main', get_theme_file_uri('/js/qtt-main.js'), $deps, proradio_theme_version(), true ); $deps[] = 'proradio-main';
		
		}




		$load_comment_script = true;
		if(function_exists('is_product')){
			if(is_product()){
				$load_comment_script = false;
			}
		}
		if ( $load_comment_script && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if( wp_style_is('font-awesome') ){
			wp_enqueue_style( 'font-awesome' );
		}
		foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
			if( wp_style_is('elementor-icons-fa-' . $style) ){
				wp_enqueue_style( 'elementor-icons-fa-' . $style  );
			}
		}

		
		
	}
}
