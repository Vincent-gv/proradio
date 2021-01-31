<?php  

Kirki::add_field( 'proradio_config', array(
	'type'        => 'select',
	'settings'    => 'QT_timing_settings',
	'label'       => esc_html__( 'Time format', 'proradio' ),
	'description' => esc_html__( 'Change the time format used for the shows in frontend', "proradio" ),
	'section'     => 'proradio_schedule_settings',
	'default'     => '12',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'12'   	=> esc_attr__( '12 Hours format', 'proradio' ),
			'24'   	=> esc_attr__( '24 Hours format', 'proradio' ),
		)
) );

