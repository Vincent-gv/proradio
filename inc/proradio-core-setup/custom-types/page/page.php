<?php
/**
 * @package WordPress
 * @subpackage proradio-core
 * @subpackage proradio
 * @version 1.0.0
 *
 * ======================================================================
 * SETTINGS FOR THE TTGCORE PLUGIN
 * _____________________________________________________________________
 * This file adds configurations for the TTGcore plugin for custom 
 * posty types and/or taxonomies
 * ======================================================================
 */

/*
 *	Design settings for single page
 *	=============================================================
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(!function_exists("proradio_custom_page_fields_settings")){
function proradio_custom_page_fields_settings() {
	$settings = array (
		array (
			'label' =>  esc_html__('Hide page header',"proradio"),
			'id' =>  'proradio_page_header_hide',
			'default' => "0",
			'type' 	=> 'checkbox'
		),
		array (
			'label' =>  esc_html__('Menu opacity',"proradio"),
			'id' =>  'proradio_menu_opacity',
			'default' => "default",
			'desc'	=> esc_html__('Override customizer option for this page', 'proradio'),
			'type' 	=> 'select',
			'options' => array (
				array('label' => esc_attr__( 'Opaque', "proradio" ), 'value' => 'proradio-menu-opaque' ),	
				array('label' => esc_attr__( 'Transparent', "proradio" ), 'value' => 'proradio-menu-transp' ),	
			)
		)
	);
	if(class_exists('Custom_Add_Meta_Box')){
		$settingsbox = new Custom_Add_Meta_Box('proradio_post_special_fields', 'Page design settings', $settings, 'page', true );
	}
}}
add_action('init', 'proradio_custom_page_fields_settings');  

