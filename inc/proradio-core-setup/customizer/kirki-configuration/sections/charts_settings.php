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
/* = Charts section
=============================================*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'chart_reorder',
	'label'       => esc_html__( 'Auto reorder by vote', "proradio" ),
	'description' => esc_attr__( 'Automatically display chart tracks based on the tracks votes', "proradio" ),
	'section'     => 'proradio_charts_settings',
	'priority'    => 0
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'chart_sidebar',
	'label'       => esc_html__( 'Display sidebar', "proradio" ),
	'section'     => 'proradio_charts_settings',
	'priority'    => 0
));