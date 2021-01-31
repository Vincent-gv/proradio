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
 * Buttons
 * ============================================================ */
Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'buttons_radius',
	'label'       => esc_html__( 'Buttons corner radius', 'proradio' ),
	'description' => esc_html__( 'Affect border radius of every button from this theme', "proradio" ),
	'section'     => 'proradio_buttons_section',
	'default'     => 3,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-arrow, .proradio-countdown__i, .proradio-slider__ab, .proradio-btn, .proradio-p-catz a, input[type="submit"],  .proradio-tags a, .ttg-btn-share,  .woocommerce a.button,#proradio-body.woocommerce #proradio-master .button,#proradio-body.woocommerce #proradio-master .proradio-woocommerce-content a.button,#proradio-body.woocommerce #proradio-master .proradio-woocommerce-content a.button,  a.button',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( ' $px;' ),
		),
		array(
			'element'       => '.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button, #proradio-body.woocommerce .proradio-master .button, #proradio-body.woocommerce #proradio-master .woocommerce form .select2-container--default .select2-selection--single, .proradio-actions .proradio-a0::after',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( ' $px !important;' ),
		),
		array(
			'element'       => '.qtmplayer__volume.proradio-btn.proradio-btn__r .qtmplayer__vcontainer, #proradio-body #proradio-master form input[type="submit"], #proradio-body #proradio-master form button, .proradio-comment__rlink a, .proradio-comment__cancelreply',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( ' $px;' ),
		),
		array(
			'element'       => '.proradio-tabs__menu li:first-child a',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( ' $px 0 0 $px' ),
			'media_query' => '@media (min-width: 1200px)'
		),
		array(
			'element'       => '.proradio-tabs__menu li:last-child a',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( ' 0 $px $px 0' ),
			'media_query' => '@media (min-width: 1200px)'
		),
		array (
			'element' => '.qtmplayer-donutcontainer.proradio-a0, .qtmplayer-donutcontainer.proradio-a0::after',
			'property'      => 'border-radius',
			'value_pattern' => esc_attr( '50%' ),
		)


		
	),
] );



$selectors_list = array(
			'input[type="submit"]', 
			'#proradio-body.woocommerce .proradio-master #respond input#submit', 
			'#proradio-body.woocommerce .proradio-master .woocommerce #respond input#submit', 
			'#proradio-body.woocommerce .proradio-master .woocommerce a.button', 
			'#proradio-body.woocommerce .proradio-master .woocommerce button.button', 
			'#proradio-body.woocommerce .proradio-master .woocommerce input.button', 
			'.proradio-entrycontent .wp-block-button .wp-block-button__link', 
			'.proradio-entrycontent .wp-block-button .wp-block-file__button', 
			'.woocommerce #respond input#submit, .woocommerce a.button', 
			'.woocommerce button.button', 
			'.woocommerce input.button, .proradio-btn.proradio-active', 
			'.proradio-btn.proradio-active',  
			'.proradio-btn-primary', 
			'.woocommerce a.button',
			'#proradio-body.woocommerce #proradio-master .button',
			'#proradio-body.woocommerce #proradio-master .proradio-woocommerce-content a.button',
			'#proradio-body.woocommerce #proradio-master .proradio-woocommerce-content a.button',  
			'a.button'
		);










Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_btn_background',
	'label'       => esc_html__( 'Buttons background', "proradio" ),
	'section'     => 'proradio_buttons_section',
	'default'	  => '#ff0062',
	'transport'   => 'auto',
	'priority'    => 0,
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'       => implode(',',$selectors_list),
			'property'      => 'background-color',
		),
	),
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_btn_col',
	'label'       => esc_html__( 'Buttons color', "proradio" ),
	'section'     => 'proradio_buttons_section',
	'default'	  => '#ffffff',
	'transport'   => 'auto',
	'priority'    => 0,
	'choices'     => [
		'alpha' => false,
	],
	'output'    => array(
		array(
			'element'       => implode(',',$selectors_list),
			'property'      => 'color',
			 'suffix'   => ' !important',
		),
	),
));


// Hover classes array
$hover_selectors = array();
foreach( $selectors_list as $selector){
	$hover_selectors[] = $selector.':hover';
}
// Hover background
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_btn_background_h',
	'label'       => esc_html__( 'Buttons hover', "proradio" ),
	'section'     => 'proradio_buttons_section',
	'default'	  => '#be024a',
	'transport'   => 'auto',
	'priority'    => 0,
	'choices'     => [
		'alpha' => true,
	],
	'output'    => array(
		array(
			'element'       => implode(',',$hover_selectors),
			'property'      => 'background-color',
			'media_query' => '@media (min-width: 100px)',
			 'suffix'   => ' !important',
		),
	),
));



