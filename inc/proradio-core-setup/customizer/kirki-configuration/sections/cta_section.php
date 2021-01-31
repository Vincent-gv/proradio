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

/* = Call to action section
=============================================*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_cta_on',
	'label'       => esc_html__( 'Enable CTA button', "proradio" ),
	'section'     => 'proradio_cta_section',
	'description' => esc_html__( 'Display attractive call to action in header bar', "proradio" ),
	'priority'    => 10,
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_cta_on_mob',
	'label'       => esc_html__( 'Enable CTA button in mobile menu bar', "proradio" ),
	'section'     => 'proradio_cta_section',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_cta_text',
	'label'       => esc_html__( 'Button text (required)', "proradio" ),
	'description' => esc_html__( 'Add button to header', "proradio" ),
	'section'     => 'proradio_cta_section',
	'default'	  =>  esc_html__('Contact us', 'proradio'),
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_cta_i',
	'label'       => esc_html__( 'Icon', 'proradio' ),
	'description' => esc_html__('Google material icons', "proradio").' <a href="https://'.'pro.radio/cheatsheet/" target="_blank">'.esc_html__('View full list', "proradio").'</a>',
	'section'     => 'proradio_cta_section',
	'default'     => '',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => proradio_icon_dropdown(),
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
) );


Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_cta_action',
	'label'       => esc_html__( 'Action', 'proradio' ),
	'section'     => 'proradio_cta_section',
	'multiple'    => 0,
	'default'	=> 'link',
	'choices'     => array(
		'link'   		=> esc_attr__( 'Open link', 'proradio' ),
		'popup-player' 	=> esc_attr__( 'Popup player', 'proradio' ),
		'popup-custom' 	=> esc_attr__( 'Popup custom', 'proradio' ),
	),
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
) );

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_cta_url',
	'label'       => esc_html__( 'Link URL (required)', "proradio" ),
	'section'     => 'proradio_cta_section',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		],
		[
			'setting'  	=> 'proradio_cta_action',
			'operator' 	=> '!=',
			'value'    	=> 'popup-player',
		]
	],
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_cta_target',
	'label'       => esc_html__( 'Target _blank', "proradio" ),
	'section'     => 'proradio_cta_section',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'proradio_cta_action',
			'operator' => '!=',
			'value'    => 'popup-player',
		],
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));



/*
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_cta_popup',
	'label'       => esc_html__( 'Open in popup', "proradio" ),
	'section'     => 'proradio_cta_section',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));
*/
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_cta_popup_w',
	'label'       => esc_html__( 'Popup width', "proradio" ),
	'section'     => 'proradio_cta_section',
	'default'	  => '300',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'proradio_cta_action',
			'operator' => '==',
			'value'    => 'popup-custom',
		],
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_cta_popup_h',
	'label'       => esc_html__( 'Popup height', "proradio" ),
	'section'     => 'proradio_cta_section',
	'default'	  => '400',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'proradio_cta_action',
			'operator' => '==',
			'value'    => 'popup-custom',
		],
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_cta_class',
	'label'       => esc_html__( 'CSS Class', "proradio" ),
	'description' => esc_html__( 'Add style class to button', "proradio" ),
	'section'     => 'proradio_cta_section',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_cta_id',
	'label'       => esc_html__( 'Element ID', "proradio" ),
	'description' => esc_html__( 'ID to connect any external javascript if required', "proradio" ),
	'section'     => 'proradio_cta_section',
	'default'	  => 'proradioCta',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  	=> 'proradio_cta_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_cta_background',
	'label'       => esc_html__( 'Button background', "proradio" ),
	'section'     => 'proradio_cta_section',
	'transport'   => 'auto',
	'priority'    => 12,
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-btn-ctaheader',
			'property'      => 'background-color',
		),
	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_cta_background_h',
	'label'       => esc_html__( 'Button background hover', "proradio" ),
	'section'     => 'proradio_cta_section',
	'transport'   => 'auto',
	'priority'    => 12,
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-btn-ctaheader:hover',
			'property'      => 'background-color',
			'suffix'   => ' !important',
		),
	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_cta_colort',
	'label'       => esc_html__( 'Button text', "proradio" ),
	'section'     => 'proradio_cta_section',
	'transport'   => 'auto',
	'priority'    => 13,
	'choices'     => [
		'alpha' => false,
	],
	'output'    => array(
		array(
			'element'       => '#proradio-menu .proradio-btn-ctaheader, #proradio-overlay .proradio-btn-ctaheader',
			'property'      => 'color',
			'suffix'   => ' !important',
		),
	),
));
