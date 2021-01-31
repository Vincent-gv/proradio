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
/* = Events settings
=============================================*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'events_hideold',
	'label'       => esc_html__( 'Hide past events', "proradio" ),
	'section'     => 'proradio_events_settings',
	'description' => esc_html__( 'In event archives and taxonomy pages, every event with past date will be hidden.', "proradio" ),
	'priority'    => 10,
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'reaktions_in_events',
	'label'       => esc_html__( 'Display sharing functions', "proradio" ),
	'section'     => 'proradio_events_settings',
	'description' => esc_html__( 'Enable sharing and voting in events pages', "proradio" ),
	'priority'    => 10,
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'timeformat_am',
	'label'       => esc_html__( 'Use 12 hours time format', "proradio" ),
	'section'     => 'proradio_events_settings',
	'priority'    => 10,
));