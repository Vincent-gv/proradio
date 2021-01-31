<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage download monitor
 * @version 1.0.0
 *
 * Override the templates from the Download Monitor plugin
 * no version default
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
123
<a class="download-link" title="<?php esc_attr_e( 'Please set a version in your WordPress admin', 'proradio' ); ?>" href="#" rel="nofollow">
	"<?php $dlm_download->the_title(); ?>" <strong><?php esc_html_e( 'has no version set!', 'proradio' ); ?></strong>
</a>