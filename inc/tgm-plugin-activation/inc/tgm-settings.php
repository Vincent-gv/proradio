<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage ProRadio
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'tgmpa_register', 'proradio_register_required_plugins' );
add_action( 'admin_init', 'proradio_register_required_plugins' );
function proradio_register_required_plugins() {
	// wp_clean_plugins_cache( true );
	if(!is_admin()){
		return;
	}
	$plugins = proradio_default_plugins_list();
	$additional_plugins = proradio_get_pluginslist( proradio_additional_plugins_url() );
	if( $additional_plugins ){
		$plugins = array_merge (
			$additional_plugins,
			$plugins
		);
	}


	$config = array(
		'id'           => 'proradio-tgmpa',
		'default_path' => '',
		'menu'         => 'proradio-tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => proradio_message_tgm()
	);


	if( is_array( $plugins ) ) {
		if( count( $plugins ) > 0 ) {
			tgmpa( $plugins, $config );
		} else {
			// It seems that something is wrong, let's display a link to refresh this
			add_action( 'admin_notices', 'proradio_plugins_notice__refresh' );
		}
	} else {
		 add_action( 'admin_notices', 'proradio_plugins_notice__nolist' );
	}
}