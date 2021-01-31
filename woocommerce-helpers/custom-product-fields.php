<?php
/*
* Package: proradio
* This is a WooCommerce support file to add custom fields to products
*/



if(!function_exists('proradio_woocommerce_custom_product_fields')){
	add_action('init', 'proradio_woocommerce_custom_product_fields');  
	function proradio_woocommerce_custom_product_fields() {
		// Single product sidebar option
		$fields_release = array(
			array (
				'label' =>  esc_html__('Custom product template',"proradio"),
				'description' =>  esc_html__('Override customizer settings for this product',"proradio"),
				'id' =>  'proradio_post_template',
				'default' => "default",
				'type' 	=> 'select',
				'options' => array (
					array('label' => esc_attr__( 'Force full',"proradio" ),'value' => 'fullpage'),	
					array('label' => esc_attr__( 'Right sidebar',"proradio" ),'value' => 'right-sidebar'),	
					array('label' => esc_attr__( 'Left sidebar',"proradio" ),'value' => 'left-sidebar'),	
				)
			)
			
		);
		if( post_type_exists( 'product' ) && class_exists('Custom_Add_Meta_Box')){
			$details_box = new Custom_Add_Meta_Box( 'associated_release_fields', 'Custom product design', $fields_release, 'product', true );
		}
	}
}
