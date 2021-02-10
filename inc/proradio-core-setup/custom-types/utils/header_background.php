<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function proradio_customtype_bg($posttype){
	if( isset( $posttype ) ){
		if( false !== $posttype ){
			$custom_header_bg = array(
				array(
					'label' => 'Custom header background',		
					'desc'	=> esc_html__('Replace the default featured image as header background',"proradio"),
					'id'    => 'qt_customheader_bg',
					'type'  => 'image'
				),
			);
			if(class_exists("Custom_Add_Meta_Box")){
				$custom_header_bg = new Custom_Add_Meta_Box( 'custom_header', esc_html__('Custom header','proradio'), $custom_header_bg, $posttype, true );
			}
		}
	}
}