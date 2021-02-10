<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage ProRadio
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// sub pages
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/admin-pages/welcome.php' );
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/admin-pages/deactivation.php' );
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/admin-pages/redirect.php' );
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/admin-pages/menu.php' );
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/admin-pages/manual.php' );
require_once get_theme_file_path( '/inc/tgm-plugin-activation/inc/admin-pages/clear-cache.php' );

