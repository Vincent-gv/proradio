<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 *	TTG Core is our own plugin to create custom types, metas and options
 *	based on the specifi theme's configuration
 *
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(function_exists('proradio_core_active') ){
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/utils/header_background.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/post/post.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/page/page.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/radio/radio-type.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/shows/shows-type.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/schedule/schedule-type.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/chart/chart-type.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/member/member-type.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/podcast/podcast-type.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/sponsor/sponsor-type.php' );
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/event/event-type.php' );


	/**
	 * Request internal schedule functionalities
	 */
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/schedule/functions/extract-schedule-day.php' );
	// since 1.5.9 add rest access to schedule data
	require_once get_theme_file_path( '/inc/proradio-core-setup/custom-types/schedule/functions/extract-schedule-day-rest.php' );

	/* Customizer */
	if ( class_exists( 'Kirki' ) ) {

		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/advanced_settings.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/buttons_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/captions_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/charts_settings.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/colors_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/cta_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/events_settings.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/footer_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/header_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/layout_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/pageheader_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/related_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/secondary_header_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/social_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/typo_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/woocommerce_section.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/sections/schedule_settings.php' );
		require_once get_theme_file_path( '/inc/proradio-core-setup/customizer/kirki-configuration/configuration.php' ); 
	}

}

require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/theme-functions.php' ); 