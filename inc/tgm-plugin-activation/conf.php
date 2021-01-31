<?php  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}




/**
 * Set page builder as theme extension
 */
if( function_exists('vc_set_as_theme') ){
	add_action( 'vc_before_init', 'vc_set_as_theme' );
	vc_set_as_theme();
}



/**
 * This is the list of plugins used by TGM
 * It can be extended by our repository list which can be fetched dynamically.
 */
function proradio_default_plugins_list(){
	return array(
		array(
	        'name'     			 => esc_html__('Server check', 'proradio' ),
	        'slug'     			 => 'proradio-servercheck',
	        'required'           => true,
	        'source'			 => get_template_directory_uri() . '/inc/tgm-plugin-activation/plugins/proradio-servercheck-PR.1.0.6.zip',
	        'version'			 => 'PR.1.0.6'
		),
	);
}




/**
Deactivate obsolete plugins
*/
if(!function_exists( 'proradio_deactivate_plugin_admin_notice' ) ){
function proradio_deactivate_plugin_admin_notice(){   
     echo '<div class="notice notice-warning is-dismissible">
         <p>The plugin Easy Swipebox has been deactived because incompatible with WordPress 5.6</p>
     </div>';
}}
if(!function_exists( 'proradio_deactivate_plugin_conditional' ) && function_exists( 'run_easy_swipebox' )){
	add_action( 'admin_init', 'proradio_deactivate_plugin_conditional' );
	function proradio_deactivate_plugin_conditional() {
		$plugin_path = 'easy-swipebox/easy-swipebox.php';
	    if ( is_plugin_active( $plugin_path ) ) {
			deactivate_plugins( $plugin_path, true );    
	    	add_action('admin_notices', 'proradio_deactivate_plugin_admin_notice');
	    }
	}
}