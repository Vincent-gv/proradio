<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage download monitor
 * @version 1.0.0
 *
 * Override the templates from the Download Monitor plugin
 * Download button
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
<div class="proradio-downloadbox__button">
		<a class="proradio-downloadbox__buttonlink proradio-btn-primary" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
		<p class="proradio-capfont"><?php printf( esc_html__( 'Download &ldquo;%s&rdquo;', 'proradio' ), esc_html( $dlm_download->get_title() ) ); ?></p>
		<p class="proradio-itemmetas"><?php echo esc_html( $dlm_download->get_version()->get_filename() ); ?> &ndash; <?php 
			$count = $dlm_download->get_download_count();
			printf(
			    esc_attr(
			        _n(
			            'Downloaded 1 time', 
			            'Downloaded %d times',
			            $count,
			            'proradio'
			        )
			    ),
			    number_format_i18n( $count )
			);
			?> &ndash; <?php echo esc_html(  $dlm_download->get_version()->get_filesize_formatted() ); ?></p>
		</a>
</div>