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


/* = Typography section
=============================================*/

Kirki::add_field( 'proradio_config', array(
	'type'        => 'typography',
	'settings'    => 'proradio_typography_text',
	'label'       => esc_html__( 'Contents', "proradio" ),
	'section'     => 'proradio_typo_section',
	'description' => esc_html__('Be sure your language is supported by the font you choose on fonts.google.com', 'proradio'),
	'default'     => array(
		'font-family'    => 'Karla',
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
		'letter-spacing' => '0em',
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'body, html',
			'property' => 'font-family'
		),
	),
) );

Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_typography_text_r',
	'label'       => esc_html__( 'Global text rendering', 'proradio' ),
	'section'     => 'proradio_typo_section',
	'default'     => 'geometricPrecision',
	'description' => esc_html__('Be sure your language is supported by the font you choose on fonts.google.com', 'proradio'),
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'geometricPrecision'   	=> esc_attr__( 'geometricPrecision', 'proradio' ),
			'auto' 	=> esc_attr__( 'auto', 'proradio' ),
			'optimizeSpeed' 	=> esc_attr__( 'optimizeSpeed', 'proradio' ),
			'optimizeLegibility' 	=> esc_attr__( 'optimizeLegibility', 'proradio' ),
			'initial' 	=> esc_attr__( 'initial', 'proradio' ),
		)
) );


Kirki::add_field( 'proradio_config', array(
	'type'        => 'typography',
	'settings'    => 'proradio_typography_text_bold',
	'label'       => esc_html__( 'Bold', "proradio" ),
	'section'     => 'proradio_typo_section',
	'default'     => array(
		'font-family'    => 'Karla',
		'variant'        => '700',
		'subsets'        => array( 'latin-ext' ),
		'letter-spacing' => '-0.02em',
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'strong',
			'property' => 'font-family'
		),
	),
) );

Kirki::add_field( 'proradio_config', array(
	'type'        => 'typography',
	'settings'    => 'proradio_typography_headings',
	'label'       => esc_html__( 'Headings', "proradio" ),
	'section'     => 'proradio_typo_section',
	'default'     => array(
		'font-family'    => 'Montserrat',
		'variant'        => '600',
		'letter-spacing' => '-0.04em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none'
	),
	'description' => esc_html__('Style for the H tags.', 'proradio').' '.esc_html__('Be sure your language is supported by the font you choose on fonts.google.com', 'proradio'),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6',
			'property' => 'font-family'
		),
	),
) );


Kirki::add_field( 'proradio_config', array(
	'type'        => 'typography',
	'settings'    => 'proradio_typography_captions',
	'label'       => esc_html__( 'Captions', "proradio" ),
	'section'     => 'proradio_typo_section',
	'default'     => array(
		'font-family'    => 'Montserrat',
		'variant'        => '700',
		'letter-spacing' => '-0.04em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'uppercase'
	),
	'description' => esc_html__('Special captions.', 'proradio').' '.esc_html__('Be sure your language is supported by the font you choose on fonts.google.com', 'proradio'),
	'output'      => array(
		array(
			'element' => '.proradio-caption,  .proradio-capfont',
			'property' => 'font-family'
		),
	),
) );

Kirki::add_field( 'proradio_config', array(
	'type'        => 'typography',
	'settings'    => 'proradio_typography_pagecaptions',
	'label'       => esc_html__( 'Page header', "proradio" ),
	'section'     => 'proradio_typo_section',
	'default'     => array(
		'font-family'    => 'Montserrat',
		'variant'        => '700',
		'letter-spacing' => '-0.04em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none'
	),
	'description' => esc_html__('Page titles', 'proradio').' '.esc_html__('Be sure your language is supported by the font you choose on fonts.google.com', 'proradio'),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.proradio-pagecaption',
			'property' => 'font-family'
		),
	),
) );


Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_typography_headings_r',
	'label'       => esc_html__( 'Heading rendering', 'proradio' ),
	'section'     => 'proradio_typo_section',
	'default'     => 'geometricPrecision',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'geometricPrecision'   	=> esc_attr__( 'geometricPrecision', 'proradio' ),
			'auto' 	=> esc_attr__( 'auto', 'proradio' ),
			'optimizeSpeed' 	=> esc_attr__( 'optimizeSpeed', 'proradio' ),
			'optimizeLegibility' 	=> esc_attr__( 'optimizeLegibility', 'proradio' ),
			'initial' 	=> esc_attr__( 'initial', 'proradio' ),
		)
) );



Kirki::add_field( 'proradio_config', array(
	'type'        => 'typography',
	'settings'    => 'proradio_typography_menu',
	'label'       => esc_html__( 'Menu, buttons and metas', "proradio" ),
	'section'     => 'proradio_typo_section',
	'default'     => array(
		'font-family'    => 'Montserrat',
		'variant'        => '600',
		'letter-spacing' => '0.04em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'uppercase',
	),
	'description' => esc_html__('Default: Montserrat 600. Be sure your language is supported by the font you choose on fonts.google.com', 'proradio'),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.proradio-comment__rlink a, .proradio-comment__cancelreply a, .proradio-internal-menu, label, .proradio-footer__copy, .proradio-scf, .proradio-btn,  .proradio-itemmetas, .proradio-menubar, .proradio-secondaryhead, .proradio-cats, .proradio-menu-tree , button, input[type="button"], input[type="submit"], .button, .proradio-meta, .proradio-readm, .proradio-navlink, .woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button ',
			'property' => 'font-family'
		),
	),
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_typography_menu_r',
	'label'       => esc_html__( 'Menu rendering', 'proradio' ),
	'section'     => 'proradio_typo_section',
	'default'     => 'geometricPrecision',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'geometricPrecision'   	=> esc_attr__( 'geometricPrecision', 'proradio' ),
			'auto' 	=> esc_attr__( 'auto', 'proradio' ),
			'optimizeSpeed' 	=> esc_attr__( 'optimizeSpeed', 'proradio' ),
			'optimizeLegibility' 	=> esc_attr__( 'optimizeLegibility', 'proradio' ),
			'initial' 	=> esc_attr__( 'initial', 'proradio' ),
		)
) );

