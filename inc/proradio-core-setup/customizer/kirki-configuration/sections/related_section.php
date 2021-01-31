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

/* = Related contents section
=============================================*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_post',
	'label'       => esc_html__( 'Post', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));
// chart
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_chart',
	'label'       => esc_html__( 'Chart', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));
// events
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_event',
	'label'       => esc_html__( 'Event', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));

// members
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_members',
	'label'       => esc_html__( 'Member', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));
// places
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_place',
	'label'       => esc_html__( 'Place', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));
// podcast
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_podcast',
	'label'       => esc_html__( 'Podcast', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));

// video
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_video',
	'label'       => esc_html__( 'Video', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));
// Show
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'related_show',
	'label'       => esc_html__( 'Show', "proradio" ),
	'section'     => 'proradio_related_section',
	'priority'    => 10,
));
