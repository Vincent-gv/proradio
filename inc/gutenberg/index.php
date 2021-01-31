<?php  
/**
 * ======================================================
 * GUTENBERG SETTINGS
 * ------------------------------------------------------
 * add custom gutenberg styling and settings
 * ======================================================
 */



/* Register fonts
=============================================*/
if(!function_exists('proradio_admin_fonts_url')){
	function proradio_admin_fonts_url() {
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		$font_url = '';	
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'proradio' ) ) {
			$default_fonts = 'Karla:400,700|Montserrat:600,700';
			if( function_exists( 'proradio_core_active' ) ){
				/**
				 * Gather the custom families from the customizer
				 * and adds them to the Gutenberg fonts
				 */
				$custom_font_families = array(
					'proradio_typography_text',
					'proradio_typography_text_bold',
					'proradio_typography_headings',
					'proradio_typography_pagecaptions'
				);
				$fonts_to_load = array();
				foreach ( $custom_font_families as $usage ){
					$family = get_theme_mod( $usage );
					if ( isset( $family['font-family'] ) ) {
						$name = trim( $family[ 'font-family' ] );
						if ( !isset( $family[ 'variant' ] ) ) {
							$variant = '400';
						} else {
							$variant = trim( $family[ 'variant' ] );
						}
						if( array_key_exists( $name, $fonts_to_load )) {
							if ($variant !== $fonts_to_load[ $name ] ){
								$variant = $fonts_to_load[ $name ].','.$variant;
							}
						}
						$fonts_to_load[ $name ] = $variant;
					}
				}
				foreach ( $fonts_to_load as $font => $variants ){
					$default_fonts .= '|'.$font.':'.$variants;
				}
			}
			$font_url = add_query_arg( 'family', urlencode( $default_fonts ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	}
}




/** Sets up theme defaults and registers support for various WordPress features.
=============================================*/
if(!function_exists('proradio_admin_style_setup')){
	add_action( 'after_setup_theme', 'proradio_admin_style_setup' );
	function proradio_admin_style_setup() {
		add_theme_support( 'editor-styles' );
		add_editor_style( proradio_sanitize_fonturl( proradio_admin_fonts_url() ) );
		add_editor_style( '/css/fonts/google-icons/material-icons.css' );
		add_editor_style( '/inc/gutenberg/css/theme-editor-gutenberg.css' );
		if( function_exists( 'proradio_core_active' ) ){
			add_editor_style( add_query_arg('proradio-gutenberg-customizer-styles', '1', get_admin_url() . 'admin.php' ) );
		}
	}
}
