<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage ProRadio
 * @version    PR.2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer, Igor Nardo, ProRadio
 * @copyright  Copyright (c) 2011, Thomas Griffin / Igor Nardo - ProRadio (for authentication part)
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**========================================================
 *
 *	CUSTOM SPECIAL LAUNCHER FOR TGM
 *  
 ========================================================*/
 
// Service URLs
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/urls.php' );

// Configuration
require_once get_theme_file_path( '/inc/tgm-plugin-activation/conf.php' );

// WHMCS Service
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/whmcs_api_service.php' );
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/expiration-date.php' );

// Tgm library
require_once get_theme_file_path( '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php' );

// Helper functions
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/helpers.php' );

// Error messages admin
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/errors.php' );


// Theme updater
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/theme-updater.php' );

// Remote call
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/remote.php' );

// Plugins list
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/list.php' );

// Activation message TGM
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/message.php' );

// Enqueue scripts
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/enqueue.php' );

// Welcome page with activation form
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/welcome-page.php' );

// TGM settings
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/tgm-settings.php' );

// End of functions