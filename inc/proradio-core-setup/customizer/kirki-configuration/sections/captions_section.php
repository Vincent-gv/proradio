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

/* = Captions section
=============================================*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'caption_bg',
	'label'       => esc_html__( 'Caption background', "proradio" ),
	'section'     => 'proradio_captions_section',
	'default'	  => '#1c1c1c',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-caption::before',
			'property'      => 'border-color',
		),
		array(
			'element'       => '.proradio-caption span::after',
			'property'      => 'background-color',
		),
		array(
			'element'       => '.proradio-caption.proradio-caption--neg span',
			'property'      => 'color',
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'caption_text',
	'label'       => esc_html__( 'Caption text', "proradio" ),
	'section'     => 'proradio_captions_section',
	'default'	  => '#ffffff',
	'priority'    => 0,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-caption span',
			'property'      => 'color',
		),
		array(
			'element'       => '.proradio-caption.proradio-caption--neg::before',
			'property'      => 'border-color',
		),
		array(
			'element'       => '.proradio-caption.proradio-caption--neg span::after',
			'property'      => 'background-color',
		),
	),
));