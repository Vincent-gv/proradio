<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Include the Welcome Page in the menu
 * =============================================*/
if ( ! function_exists( 'proradio_welcome_menupage' ) ) {
	add_action( 'admin_menu', 'proradio_welcome_menupage' );
	function proradio_welcome_menupage() {
		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$pid = proradio_iid();
		if($pid == 'pending'){
			return;
		}
		add_theme_page(
			sprintf( esc_html__( '%s activation and update', 'proradio' ), $current_theme->name ),
			sprintf( esc_html__( '%s activation and updates', 'proradio' ),  $current_theme->name ),
			'manage_options',
			'proradio-welcome',
			'proradio_welcome_page_content'
		);
		add_menu_page(
			sprintf( esc_html__( '%s admin', 'proradio' ), $current_theme->name ),
			sprintf( esc_html__( '%s admin', 'proradio' ),  $current_theme->name ),
			'manage_options',
			'proradio-welcome',
			'proradio_welcome_page_content',
			get_theme_file_uri('/img/menu-icon.png' ),
			0 // Order ID
		);

		add_submenu_page(
			'proradio-welcome',
			sprintf( esc_html__( '%s Knowledgebase', 'proradio' ), $current_theme->name ),
			sprintf( esc_html__( 'Knowledgebase', 'proradio' ),  $current_theme->name ),
			'manage_options',
			'proradio-manual',
			'proradio_welcome_page_manual',
			1 // Order ID
		);
		add_submenu_page(
			'proradio-welcome',
			sprintf( esc_html__( '%s Clear cache', 'proradio' ), $current_theme->name ),
			sprintf( esc_html__( 'Clear cache', 'proradio' ),  $current_theme->name ),
			'manage_options',
			'proradio-clear-cache',
			'proradio_welcome_page_clear_cache',
			2 // Order ID
		);
	}	
}