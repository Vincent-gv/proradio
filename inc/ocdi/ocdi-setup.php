<?php
/**
 * 
 * @package WordPress
 * @subpackage One Click Demo Import
 * @subpackage proradio
 * @version 1.4.3
 * Settings for the demo import
 * https://wordpress.org/plugins/one-click-demo-import/
 * 
*/

add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


function proradio_ocdi_change_time_of_single_ajax_call() {
	return 230;
}
add_action( 'pt-ocdi/time_for_one_ajax_call', 'proradio_ocdi_change_time_of_single_ajax_call' );


/**
 * Customize the popup width
 */
if(!function_exists('proradio_ocdi_confirmation_dialog_options')){
	add_filter( 'pt-ocdi/confirmation_dialog_options', 'proradio_ocdi_confirmation_dialog_options', 10, 1 );
	function proradio_ocdi_confirmation_dialog_options ( $options ) {
	    return array_merge( $options, array(
	        'width'       => 500,
	        'dialogClass' => 'wp-dialog',
	        'resizable'   => false,
	        'height'      => 'auto',
	        'modal'       => true,
	    ) );
	}
}

/**
 * Customize the popup width
 */
if(!function_exists('proradio_ocdi_plugin_intro_text')){
	add_filter( 'pt-ocdi/plugin_intro_text', 'proradio_ocdi_plugin_intro_text' );
	function proradio_ocdi_plugin_intro_text( $default_text ) {
	    $default_text .= '<h2>'.esc_html__('Welcome to the "ProRadio Theme" Demo Import.', 'proradio' ).'</h2>';
	     $default_text .=  '<h3>'.esc_html__('Please make sure you check the manual before proceeding', 'proradio').'</h3>';
	      $default_text .=  '<p>If you experience 500, 504, 400 or other errors, please check:  <a href="https://github.com/awesomemotive/one-click-demo-import/blob/master/docs/import-problems.md">the official troubleshooting guide</a> </p>';
	    $default_text .=  '<p style="font-weight:700">'.esc_html__('If the import process gets stuck for more than 2 minutes, and is not complete, please reload this page and click again the Import Demo button. You can repeat the procedure until you see the confirmation message.', 'proradio').'</p>';
	    return $default_text;
	}
}

if(!function_exists('proradio_ocdi_import_files')){
	add_filter( 'pt-ocdi/import_files', 'proradio_ocdi_import_files' );
	function proradio_ocdi_import_files() {
		$url = 'https://pro.radio/proradio-connector/proradio/ocdi/';
		return array(
			array(
				'import_file_name'           => 'Default Demo',
				'categories'                 => array( 'Default' ),
				'import_file_url'            => $url.'demo1/proradioimportabledemo.WordPress.2020-11-26.xml',
				'import_widget_file_url'     => $url.'demo1/demo.pro.radio-wp1-import2-widgets.wie',
				'import_customizer_file_url' => $url.'demo1/proradio-child-export-2.json', // dat extension triggers security restrictions, renamed to json
				'import_notice'              => esc_html__( 'IMPORTANT NOTICE: activate the ProRadio Child theme and  any required plugin first.', 'proradio' ),
				'preview_url'                => 'https://demo.pro.radio/wp1/',
				'import_preview_image_url'	 => get_template_directory_uri() . '/screenshot.png',
			),
		);
	}
}


if(!function_exists('proradio_ocdi_after_import_setup')){
	add_action( 'pt-ocdi/after_import', 'proradio_ocdi_after_import_setup' );
	function proradio_ocdi_after_import_setup($selected_import) {
		// Home page ID
		$front_page_id = get_page_by_title( 'HOME 17' );
		// use the name of the selected import
		$demo_name =  $selected_import['import_file_name'];
		// Icons2Go configuration
		update_option("t2gicons_family_business", "1");
		/**
		 * 
		 * Set the menus
		 * 
		 */
		$proradio_menu_primary = get_term_by( 'name', 'Main', 'nav_menu' );
		$proradio_menu_secondary = get_term_by( 'name', 'Secondary', 'nav_menu' );
		$proradio_menu_footer = get_term_by( 'name', 'Footer', 'nav_menu' );
		// $proradio_menu_desktop_off = get_term_by( 'name', 'OffCanvas', 'nav_menu' ); // not in use in this demo
		$menus = array();

		if( isset( $proradio_menu_primary ) ){
			$menus['proradio_menu_primary'] = $proradio_menu_primary->term_id;
		}
		if( isset( $proradio_menu_secondary ) ){
			$menus['proradio_menu_secondary'] = $proradio_menu_secondary->term_id;
		}
		if( isset( $proradio_menu_footer ) ){
			$menus['proradio_menu_footer'] = $proradio_menu_footer->term_id;
		}
		if( isset( $proradio_menu_desktop_off ) ){
			$menus['proradio_menu_desktop_off'] = $proradio_menu_desktop_off->term_id;
		}
		if( count( $menus ) >= 1 ){ // If my array has items, set them
			set_theme_mod( 'nav_menu_locations', $menus );
		}
		// Assign front page and posts page (blog page).
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
	}
}
