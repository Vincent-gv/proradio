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
 *	Design settings for single post to override customizer defaults
 *	=============================================================
 */
if(!function_exists("proradio_custom_post_fields_settings")){
	add_action('init', 'proradio_custom_post_fields_settings');  
	function proradio_custom_post_fields_settings() {
		$settings = array (
			array (
				'label' =>  esc_html__('Post template',"proradio"),
				'id' =>  'proradio_post_template',
				'default' => "default",
				'type' 	=> 'select',
				'options' => array (
					array('label' => esc_html__( 'Force full',"proradio" ),'value' => '1'),	
					array('label' => esc_html__( 'Force sidebar',"proradio" ),'value' => '2'),	
				)
			)
		);
		if(class_exists('Custom_Add_Meta_Box')){
			$settingsbox = new Custom_Add_Meta_Box('proradio_post_special_fields', 'Design settings', $settings, 'post', true );
		}
	}
}


