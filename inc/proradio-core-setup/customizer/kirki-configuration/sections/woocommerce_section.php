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

/* = WooCommerce section - goes in the WooCommerce section of the customizer
=============================================*/

Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_woocommerce_design',
	'label'       => esc_html__( 'Shop design', 'proradio' ),
	'section'     => 'proradio_woocommerce_section',
	'default'     => 'fullpage',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'fullpage'   	=> esc_attr__( 'Full page', 'proradio' ),
			'left-sidebar'   	=> esc_attr__( 'Left', 'proradio' ),
			'right-sidebar'   	=> esc_attr__( 'Right sidebar', 'proradio' ),
			
		)
) );

Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'proradio_woocommerce_design_single',
	'label'       => esc_html__( 'Single product design', 'proradio' ),
	'section'     => 'proradio_woocommerce_section',
	'default'     => 'fullpage',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'fullpage'   	=> esc_attr__( 'Full page', 'proradio' ),
			'left-sidebar'   	=> esc_attr__( 'Left sidebar', 'proradio' ),
			'right-sidebar'   	=> esc_attr__( 'Right sidebar', 'proradio' ),
			
		)
) );


