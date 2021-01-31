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


// Page header padding =============================
Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'proradio_headerpadding_top',
	'label'       => esc_html__( 'Padding top', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 160,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 40,
		'max'  => 400,
		'step' => 10,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader__contents',
			'property'      => 'padding-top',
			'value_pattern' => esc_attr( ' $px;' ),
			// 'media_query' => '@media (min-width: 600px)'
		),
	),
] );

Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'proradio_headerpadding_bottom',
	'label'       => esc_html__( 'Padding bottom', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 140,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 40,
		'max'  => 400,
		'step' => 10,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader__contents',
			'property'      => 'padding-bottom',
			'value_pattern' => esc_attr( ' $px;' ),
			// 'media_query' => '@media (min-width: 600px)'
		),
	),
] );


Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'proradio_headerpadding_mobile',
	'label'       => esc_html__( 'Mobile padding', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 50,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 20,
		'max'  => 150,
		'step' => 5,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader__contents',
			'property'      => 'padding-bottom',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (max-width: 600px)'
		),
		array(
			'element'       => '.proradio-pageheader__contents',
			'property'      => 'padding-top',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (max-width: 600px)'
		),
	)
] );

Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'proradio_headerpadding_mobile_b',
	'label'       => esc_html__( 'Mobile padding bottom', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 50,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 20,
		'max'  => 150,
		'step' => 5,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader__contents',
			'property'      => 'padding-bottom',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (max-width: 600px)'
		),
	)
] );

Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'mousescroll',
	'label'       => esc_html__( 'Mouse icon', "proradio" ),
	'section'     => 'proradio_pageheader_section',
	'priority'    => 10,
	'default'     => '1'
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'header_decor',
	'label'       => esc_html__( 'Header decoration', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 'none',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'none' 	=> esc_attr__( 'None', 'proradio' ),
			'default'   	=> esc_attr__( 'Default', 'proradio' ),
			
		)
) );


Kirki::add_field( 'proradio_config', array(
	'type'        => 'image',
	'settings'    => 'proradio_header_bgimg',
	'label'       => esc_html__( 'Default page header background image', "proradio" ),
	'description' => esc_html__( 'Suggested size: 1660x790', "proradio" ),
	'section'     => 'proradio_pageheader_section',
	'priority'    => 10,
	'choices'     => array(
		'save_as' => 'id',
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_header_waves',
	'label'       => esc_html__( 'Waves effect', "proradio" ),
	'default'     => '0',
	'section'     => 'proradio_pageheader_section',
	'priority'    => 10,
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_header_duotone',
	'label'       => esc_html__( 'Duotone effect', "proradio" ),
	'section'     => 'proradio_pageheader_section',
	'description' => esc_html__( 'Use the duotone effect on the page header. The colors are available in the Colors section of the customizer.', "proradio" ),
	'priority'    => 10,
	'default'     => '1'
));




Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'proradio_header_greyscale',
	'label'       => esc_html__( 'Greyscale background', 'proradio' ),
	'description' => esc_html__( 'Remove colors from header background for neat effect', "proradio" ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 73,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 100,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader .proradio-bgimg.proradio-greyscale',
			'property'      => 'filter',
			'value_pattern' => esc_attr( ' contrast(1.2) grayscale($%);' ),
		),
	),
] );

Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'proradio_header_darken',
	'label'       => esc_html__( 'Darken background', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 0.6,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 1,
		'step' => 0.1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-dark-layer',
			'property'      => 'opacity',
			'value_pattern' => esc_attr( ' $;' ),
		),
	),
] );


Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'proradio_header_gradlayer_alfa',
	'label'       => esc_html__( 'Gradient overlay', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 0.9,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 1,
		'step' => 0.1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader .proradio-grad-layer',
			'property'      => 'opacity',
			'value_pattern' => esc_attr( ' $;' ),
		),
	),
] );



Kirki::add_field( 'proradio_config', [
    'type'        => 'multicolor',
    'settings'    => 'gradient_overlay',
    'label'       => esc_html__( 'Gradient overlay', 'proradio' ),
    'section'     => 'proradio_pageheader_section',
    'priority'    => 10,
    'choices'     => [
        'start'    => esc_html__( 'Color', 'proradio' ),
        'end'   => esc_html__( 'Hover', 'proradio' ),
    ],
    'default'     => [
        'start'    => '#ff0062',
        'end'   => '#be024a',
    ],
] );




Kirki::add_field( 'proradio_config', [
    'type'        => 'multicolor',
    'settings'    => 'gradient_overlay',
    'label'       => esc_html__( 'Gradient overlay', 'proradio' ),
    'section'     => 'proradio_pageheader_section',
    'priority'    => 10,
    'choices'     => [
        'start'    => esc_html__( 'Start', 'proradio' ),
        'end'   => esc_html__( 'End', 'proradio' ),
    ],
    'default'     => [
        'start'    => '#e01c67',
        'end'   => '#b70135',
    ],
] );



Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'header_frame',
	'label'       => esc_html__( 'Frame border width', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 0,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 15,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader__contents .proradio-container',
			'property'      => 'border-width',
			'value_pattern' => esc_attr( ' $px;' ),
		),
	),
] );

Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'header_frame_pad',
	'label'       => esc_html__( 'Frame padding', 'proradio' ),
	'section'     => 'proradio_pageheader_section',
	'default'     => 0,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 150,
		'step' => 10,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-pageheader__contents .proradio-container',
			'property'      => 'padding-top',
			'value_pattern' => esc_attr( ' $px;' ),
		),
		array(
			'element'       => '.proradio-pageheader__contents .proradio-container',
			'property'      => 'padding-bottom',
			'value_pattern' => esc_attr( ' $px;' ),
		),
	),
] );



Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_header_parallax',
	'label'       => esc_html__( 'Page header parallax', "proradio" ),
	'section'     => 'proradio_pageheader_section',
	'description' => esc_html__( 'Enable effect on scroll for archive and default headers', "proradio" ),
	'priority'    => 10,
	'default'     => '0'
));


