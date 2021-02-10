<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 *
 * Set the environment for external plugins
 */


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}



if(function_exists('proradio_core_active')){

	// Helpers
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/helpers/get-terms-array.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/helpers/vc-query-fields.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/helpers/carousel-fields.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/helpers/slider-fields.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/helpers/autocomplete.php' );

	// Functions
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-radiocard.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-button.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-category-grid.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-caption.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-herolist.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-section-caption.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-3d-header.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-spacer.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-socialicons.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-gallery.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-pricing-table.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-sponsors.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-cards.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-cards-mini.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-cards-horizontal.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-list.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-list-horizontal.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-cards.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-grid.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-carousel.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-podcast-carousel.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-hero.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-mosaic.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-slider-owl.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-post-inline.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-chart-tracklist.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-event-list.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-event-featured.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-event-carousel.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-event-countdown.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-appicons.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-radiofeed.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-onair.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-onairmini.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-schedule.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-upcoming-shows-carousel.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-upcoming-shows-slider.php' );


	if(function_exists('qtplaces_main_shortcode')){
		require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-function-places-grid.php' );
	}
}