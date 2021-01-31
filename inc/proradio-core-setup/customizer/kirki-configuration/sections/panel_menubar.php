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

/* = Secondary Header
=============================================*/

Kirki::add_field( 'proradio_config', array(
	'type'        => 'toggle',
	'settings'    => 'proradio_sec_head_on',
	'label'       => esc_html__( 'Enable secondary header', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'description' => esc_html__( 'Add header bar for optional menu and social icons', "proradio" ),
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_sos_cta_i',
	'label'       => esc_html__( 'Icon', 'proradio' ),
	'description' => esc_html__('Google material icons', "proradio").' <a href="//'.'proradio.xyz/cheatsheet/" target="_blank">See list</a>',
	'section'     => 'proradio_secondary_header_section',
	'multiple'    => 0,
	'choices'     => proradio_icon_dropdown(),
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		]
	],
) );

Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_customtext_type',
	'label'       => esc_html__( 'Custom text type', 'proradio' ),
	'section'     => 'proradio_secondary_header_section',
	'multiple'    => 0,
	'default'	=> 'text',
	'choices'     => array(
		'text'   		=> esc_attr__( 'Text', 'proradio' ),
		'song' 			=> esc_attr__( 'Current song', 'proradio' ),
	),
	'active_callback' => [
		[
			'setting'  	=> 'proradio_sec_head_on',
			'operator' 	=> '==',
			'value'    	=> true,
		]
	],
) );


Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_sos_cta_text1',
	'label'       => esc_html__( 'Call to action primary text', "proradio" ),
	'description' => esc_html__( 'Prominent part of text', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'proradio_customtext_type',
			'operator' => '==',
			'value'    => 'text',
		]
	],
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_sos_cta_text2',
	'label'       => esc_html__( 'Call to action secondary text', "proradio" ),
	'description' => esc_html__( 'Secondary part of the text', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'proradio_customtext_type',
			'operator' => '==',
			'value'    => 'text',
		]
	],
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_sos_cta_l',
	'label'       => esc_html__( 'Link', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'proradio_customtext_type',
			'operator' => '==',
			'value'    => 'text',
		]
	],
));

if(!function_exists('proradio_customizer_dropdown_event')){
	function proradio_customizer_dropdown_event(){
		$posts = Kirki_Helper::get_posts( array( 'posts_per_page' => -1,'post_type' => 'event' ) );
		$posts[0] =  esc_html__('Chose', 'proradio');
		ksort($posts);
		return $posts;
	}
}
Kirki::add_field( 'theme_config_id', [
	'type'        => 'select',
	'settings'    => 'proradio_ctaevent',
	'label'       => esc_html__( 'Countdown to an event', 'proradio' ),
	'description' => esc_html__( 'Display a countdown to a specific event date', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'choices' 	  =>  proradio_customizer_dropdown_event(),
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'proradio_customtext_type',
			'operator' => '==',
			'value'    => 'text',
		]
	],
] );
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'show_ms',
	'label'       => esc_html__( 'Display milliseconds', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'proradio_customtext_type',
			'operator' => '==',
			'value'    => 'text',
		]
	],
));



// Header colors
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_secondary_bg',
	'label'       => esc_html__( 'Secondary menu background color', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'transport'		=> 'refresh',
	'priority'    => 110,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-secondaryhead.proradio-primary',
			'property'      => 'background-color',
		),
	),
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		]
	],

));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_secondary_t',
	'label'       => esc_html__( 'Secondary menu text color', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'priority'    => 110,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-secondaryhead.proradio-primary',
			'property'      => 'color',
		),
	),
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		]
	],
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_secondary_l',
	'label'       => esc_html__( 'Secondary menu links color', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'priority'    => 110,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-secondaryhead.proradio-primary a',
			'property'      => 'color',
		),
	),
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		]
	],
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_secondary_lh',
	'label'       => esc_html__( 'Secondary menu links hover color', "proradio" ),
	'section'     => 'proradio_secondary_header_section',
	'priority'    => 110,
	'output'    => array(
		array(
			'element'       => '.proradio-secondaryhead.proradio-primary a:hover, .proradio-secondaryhead.proradio-primary .proradio-menubar > li:hover > a > span',
			'property'      => 'color',
		),
	),
	'active_callback' => [
		[
			'setting'  => 'proradio_sec_head_on',
			'operator' => '==',
			'value'    => true,
		]
	],
));