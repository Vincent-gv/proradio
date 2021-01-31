<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage ProRadio
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/* ADMIN CSS and Js loading
=============================================*/
if(!function_exists('proradio_tgm_admin_files_inclusion')){
function proradio_tgm_admin_files_inclusion() {
	wp_enqueue_style( 'proradio-tgm-admin', get_theme_file_uri('/inc/tgm-plugin-activation/css/proradio-tgm-admin.css' ), false, '1.0.0' );
}}
add_action( 'admin_enqueue_scripts', 'proradio_tgm_admin_files_inclusion', 999999 );