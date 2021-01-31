<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Carousel design fields
*/


/**
 * ===============================================================
 * CAROUSEL DESIGN FIELDS
 * ================================================================
 */

function proradio_carousel_design_fields(){
	$fields = array (

		array(
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Items per row in desktop', 'proradio' ),
			'param_name' => 'items_per_row_desktop',
			'value' => array(
				esc_html__( '1', 'proradio' ) 	=> '1',
				esc_html__( '2', 'proradio' ) 	=> '2',
				esc_html__( '3', 'proradio' ) 	=> '3',
				esc_html__( '4', 'proradio' ) 	=> '4',
				esc_html__( '5', 'proradio' ) 	=> '5',
				esc_html__( '6', 'proradio' ) 	=> '6',
				esc_html__( '7', 'proradio' ) 	=> '7',
				esc_html__( '8', 'proradio' ) 	=> '8',
			),
			'std' => '3',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-7',
			'description' => esc_html__( 'Select number of items per row.', 'proradio' ),
		),
		array(
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Gap', 'proradio' ),
			'param_name' => 'gap',
			'value' => array(
				esc_html__( '0px', 'proradio' ) => '0',
				esc_html__( '1px', 'proradio' ) => '1',
				esc_html__( '2px', 'proradio' ) => '2',
				esc_html__( '3px', 'proradio' ) => '3',
				esc_html__( '4px', 'proradio' ) => '4',
				esc_html__( '5px', 'proradio' ) => '5',
				esc_html__( '6px', 'proradio' ) => '6',
				esc_html__( '7px', 'proradio' ) => '7',
				esc_html__( '8px', 'proradio' ) => '8',
				esc_html__( '9px', 'proradio' ) => '9',
				esc_html__( '10px', 'proradio' ) => '10',
				esc_html__( '11px', 'proradio' ) => '11',
				esc_html__( '12px', 'proradio' ) => '12',
				esc_html__( '13px', 'proradio' ) => '13',
				esc_html__( '14px', 'proradio' ) => '14',
				esc_html__( '15px', 'proradio' ) => '15',
				esc_html__( '16px', 'proradio' ) => '16',
				esc_html__( '17px', 'proradio' ) => '17',
				esc_html__( '18px', 'proradio' ) => '18',
				esc_html__( '19px', 'proradio' ) => '19',
				esc_html__( '20px', 'proradio' ) => '20',
				esc_html__( '21px', 'proradio' ) => '21',
				esc_html__( '22px', 'proradio' ) => '22',
				esc_html__( '23px', 'proradio' ) => '23',
				esc_html__( '24px', 'proradio' ) => '24',
				esc_html__( '25px', 'proradio' ) => '25',
				esc_html__( '26px', 'proradio' ) => '26',
				esc_html__( '27px', 'proradio' ) => '27',
				esc_html__( '28px', 'proradio' ) => '28',
				esc_html__( '29px', 'proradio' ) => '29',
				esc_html__( '30px', 'proradio' ) => '30'
			),
			'std' => '15',
			'description' => esc_html__( 'Select gap between items.', 'proradio' ),
			'edit_field_class' => 'vc_col-sm-7',
		),

		array(
			"type" 		=> "textfield",
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			"heading" 	=> esc_html__( "Autoplay timeout", "proradio" ),
			'description' => esc_html__( 'Set to 0 to disable', 'proradio' ),
			"param_name"=> "autoplay_timeout",
			'std'		=> '4000',
			'value'		=> ''
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			"heading" 	=> esc_html__( "Pause on hover", "proradio" ),
			"param_name"=> "pause_on_hover",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			"heading" 	=> esc_html__( "Loop", "proradio" ),
			"param_name"=> "loop",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			"heading" 	=> esc_html__( "Center", "proradio" ),
			"param_name"=> "center",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			"heading" 	=> esc_html__( "Nav", "proradio" ),
			"param_name"=> "nav",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		array(
			"type" 		=> "checkbox",
			"group" 	=> esc_html__( "Carousel settings", "proradio" ),
			"heading" 	=> esc_html__( "Dots", "proradio" ),
			"param_name"=> "dots",
			'std'		=> 'true',
			'value'		=> 'true'
		),
		
		
		// Tablet
		// --------------------------------------------------------

		array(
			"group" 	=> esc_html__( "Tablet", "proradio" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Items per row tablet', 'proradio' ),
			'param_name' => 'items_per_row_tablet',
			'value' => array(
				esc_html__( '1', 'proradio' ) 	=> '1',
				esc_html__( '2', 'proradio' ) 	=> '2',
				esc_html__( '3', 'proradio' ) 	=> '3',
				esc_html__( '4', 'proradio' ) 	=> '4',
				esc_html__( '5', 'proradio' ) 	=> '5',
				esc_html__( '6', 'proradio' ) 	=> '6',
				esc_html__( '7', 'proradio' ) 	=> '7',
				esc_html__( '8', 'proradio' ) 	=> '8',
			),
			'std' => '2',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-7',
		),
		
		// Mobile
		// --------------------------------------------------------
		
		array(
			"group" 	=> esc_html__( "Mobile", "proradio" ),
			'type' => 'dropdown',
			'heading' => esc_html__( 'Items per row mobile', 'proradio' ),
			'param_name' => 'items_per_row_mobile',
			'value' => array(
				esc_html__( '1', 'proradio' ) 	=> '1',
				esc_html__( '2', 'proradio' ) 	=> '2',
				esc_html__( '3', 'proradio' ) 	=> '3',
				esc_html__( '4', 'proradio' ) 	=> '4',
				esc_html__( '5', 'proradio' ) 	=> '5',
				esc_html__( '6', 'proradio' ) 	=> '6',
				esc_html__( '7', 'proradio' ) 	=> '7',
				esc_html__( '8', 'proradio' ) 	=> '8',
			),
			'std' => '1',
			'admin_label' => true,
			'edit_field_class' => 'vc_col-sm-7',
			'description' => esc_html__( 'Select number of single grid elements per row.', 'proradio' ),
		),
		array(
			'type' => 'vc_grid_id',
			'param_name' => 'grid_id',
		),
	);
	return $fields;

}

