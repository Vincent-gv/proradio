<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage kirki
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/* = Advanced section
=============================================*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_advanced_mincss',
	'label'       => esc_html__( 'Load minified styles', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'description' => esc_html__( 'Optimize loading speed by loading minified stylesheet.', "proradio" ),
	'priority'    => 10,
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_advanced_minjs',
	'label'       => esc_html__( 'Load minified javascript', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'description' => esc_html__( 'Optimize loading speed by loading minified javascript.', "proradio" ),
	'priority'    => 10,
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_js_debug',
	'label'       => esc_html__( 'Enable Javascript debug', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'description' => esc_html__( 'Display certain debug messages', "proradio" ),
	'priority'    => 10,
));

// Permalinks callback
if(!function_exists( 'proradio_sanitize_permalink' )){
	function proradio_sanitize_permalink($string){
		return sanitize_title_with_dashes( $string );
	}
}


// Permalink slugs ===============
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_chart',
	'label'       => esc_html__( 'Charts', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'chart',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_event',
	'label'       => esc_html__( 'Events', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'event',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_members',
	'label'       => esc_html__( 'Members', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'members',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_podcast',
	'label'       => esc_html__( 'Podcasts', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'podcast',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_radiochannel',
	'label'       => esc_html__( 'Radio channels', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'radiochannel',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_schedule',
	'label'       => esc_html__( 'Schedules', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'schedule',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_shows',
	'label'       => esc_html__( 'Shows', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'shows',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'qtvideo_slug',
	'label'       => esc_html__( 'Videos', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'qtvideo',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 10
));



// Custom taxonomy settings
// since 1.4.3
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_chartcategory',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Chart category', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'chartcategory',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_eventtype',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Event type', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'eventtype',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_membertype',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Member type', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'membertype',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_podcastfilter',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Podcast filter', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'podcastfilter',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_radiogenre',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Radio genre', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'radio-genre',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_showgenre',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Show genre', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'showgenre',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'slug_showgenre',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Show genre', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'showgenre',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'vdl_filters_slug',
	'label'       => esc_html__( 'Taxonomy: ', "proradio" ).' '.esc_html__( 'Video filters', "proradio" ).' '.esc_html__( 'URL permalink', "proradio" ),
	'description' => esc_html__( 'Once changed, remember to visit Settings > Permalink and save.', "proradio" ),
	'section'     => 'proradio_advanced_settings',
	'default'	  => 'filter',
	'sanitize_callback' => 'proradio_sanitize_permalink',
	'priority'    => 20
));