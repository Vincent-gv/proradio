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

/* = Footer section
=============================================*/

// copyright bar
Kirki::add_field( 'proradio_config', array(
	'type'        => 'code',
	'settings'    => 'proradio_footer_text',
	'label'       => esc_html__( 'Copyright text content', "proradio" ),
	'section'     => 'proradio_footer_section',
	'choices'     => [
		'language' => 'html',
	],
	'priority'    => 10
));

// Colors
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_copy_bg',
	'label'       => esc_html__( 'Copyright bar background color', "proradio" ),
	'section'     => 'proradio_footer_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-footer__copy.proradio-primary',
			'property'      => 'background-color',
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_copy_t',
	'label'       => esc_html__( 'Copyright bar text color', "proradio" ),
	'section'     => 'proradio_footer_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-footer__copy.proradio-primary',
			'property'      => 'color',
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_copy_l',
	'label'       => esc_html__( 'Copyright bar links color', "proradio" ),
	'section'     => 'proradio_footer_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-footer__copy.proradio-primary a',
			'property'      => 'color',
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_copy_lh',
	'label'       => esc_html__( 'Copyright bar links hover color', "proradio" ),
	'section'     => 'proradio_footer_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-menubar > li:hover > a > span',
			'property'      => 'color',
		),
	),
));
