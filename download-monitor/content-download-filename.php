<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage download monitor
 * @version 1.0.0
 *
 * Override the templates from the Download Monitor plugin
 * Default output
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
<div class="proradio-downloadbox__title">
	<p class="proradio-capfont">
		<a class="download-link filetype-icon <?php echo 'filetype-' . esc_attr( $dlm_download->get_version()->get_filetype() ); ?>"
		   title="<?php if ( $dlm_download->get_version()->has_version_number() ) {
			   printf( esc_attr__( 'Version %s', 'proradio' ), esc_attr( $dlm_download->get_version()->get_version_number() )  );
		   } ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
			<?php echo esc_html( $dlm_download->the_title() ); ?>
			(<?php 
			$count = $dlm_download->get_download_count();
			printf(
			    esc_attr(
			        _n(
			            '1 download',
			            '%d downloads',
			            $count,
			            'proradio'
			        )
			    ),
			    number_format_i18n( $count )
			);
			 ?>)
		</a>
	</p>
</div>