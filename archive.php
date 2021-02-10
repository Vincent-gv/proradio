<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


$template = get_theme_mod('archive_template', 'archive-sidebar');
get_template_part( $template );