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


/**
 * Layout
 * ============================================================ */
Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'layout_width',
	'label'       => esc_html__( 'Maximum width', 'proradio' ),
	'description' => esc_html__( 'Affect border radius of every button from this theme', "proradio" ),
	'section'     => 'proradio_layout_section',
	'default'     => 3000,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 1260,
		'max'  => 3000,
		'step' => 10,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-master, .proradio-headerbar__content, .proradio-global, .qtmplayer__playlistcontainer',
			'property'      => 'max-width',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1200px)'
		),
		array(
			'element'       => '.proradio-menu__cont, .qtmplayer__controls, .proradio-secondaryhead__cont',
			'property'      => 'max-width',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1200px)'
		),

		
	),
] );


Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'layout_container_shadow',
	'label'       => esc_html__( 'Container shadow', 'proradio' ),
	'section'     => 'proradio_layout_section',
	'default'     => 0.5,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 1,
		'step' => 0.05,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-global',
			'property'      => 'box-shadow',
			'value_pattern' => esc_attr( ' 0px 0px 20px 0px rgba(0,0,0,$); ' ),
		),
	),
] );

/**
 * Load more
 * ============================================================ */
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_loadmore',
	'label'       => esc_html__( 'Load more', "proradio" ),
	'section'     => 'proradio_layout_section',
	'description' => esc_html__( 'Replace pagination with a load more button', "proradio" ),
	'priority'    => 10,
));


/**
 * Blog post sidebar
 * ============================================================ */
Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_postsidebar',
	'label'       => esc_html__( 'Blog post sidebar', "proradio" ),
	'section'     => 'proradio_layout_section',
	'description' => esc_html__( 'Enable sidebar in single posts. Does not affect other post types.', "proradio" ),
	'priority'    => 10,
));


/**
 * Corner radius
 * ============================================================ */
Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'items_rad',
	'label'       => esc_html__( 'Post items corner radius', 'proradio' ),
	'description' => esc_html__( 'Affect border radius of every card element in the site for coherence', "proradio" ),
	'section'     => 'proradio_layout_section',
	'default'     => 0,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 12,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-chart-tracklist .proradio-chart-track, .proradio-post, .proradio-bgimg, .proradio-post__header, .proradio-post__header .proradio-bgimg, .proradio-cards__content , .proradio-pricingtable__content, .proradio-pricingtable__pc::before, .proradio-card, .proradio-scard, .proradio-authorbox, .proradio-cat-card,  .blocks-gallery-item figure',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( ' $px;' ),
		),
		array(
			'element'       => '.proradio-videogalleries__item',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( ' $px;' ),
		),


	),
] );


Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'items_shad',
	'label'       => esc_html__( 'Shadow', 'proradio' ),
	'section'     => 'proradio_layout_section',
	'default'     => 0.5,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 1,
		'step' => 0.01,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-post, #proradio-body a.proradio-cat-card, .proradio-videogalleries__item, .proradio-arrow',
			'property'      => 'box-shadow',
			'value_pattern' => esc_attr( '0 0 6px 0px rgba(0, 0, 0, $);' ),
		),
	),
] );



Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'archive_template',
	'label'       => esc_html__( 'Archives template', 'proradio' ),
	'description' => esc_html__( 'Set default tempalte for blog archives', "proradio" ),
	'section'     => 'proradio_layout_section',
	'default'     => 'archive-sidebar',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'archive-sidebar' 	=> esc_attr__( 'Default: archive sidebar', 'proradio' ),
			'archive-no-sidebar' 	=> esc_attr__( 'Archive no sidebar', 'proradio' ),
			'archive-grid-sidebar' 	=> esc_attr__( 'Grid sidebar', 'proradio' ),
			'archive-grid' 	=> esc_attr__( 'Grid no sidebar', 'proradio' ),
			'archive-horizontal' 	=> esc_attr__( 'Horizontal sidebar', 'proradio' ),
			'archive-masonry' 	=> esc_attr__( 'Masonry', 'proradio' ),
		)
) );
