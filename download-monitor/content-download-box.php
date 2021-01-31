<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage download monitor
 * @version 1.0.0
 *
 *	Override the templates from the Download Monitor plugin
 * 
 * Detailed download output
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */


// ==============================================================================
// 
// 
// THIS FILE IS ONLY A TEMPLATING OVERRIDE FOR THE COMPATIBLE PLUGIN "DOWNLOAD MONITOR"
// 
// 
// ==============================================================================

?>
<div class="proradio-downloadbox">
	<aside class="proradio-downloadbox__card ">
		<div class="proradio-downloadbox__i">
		<?php $dlm_download->the_image(); ?>
		</div>
		<div class="proradio-downloadbox__content proradio-card proradio-primary">
			<h4 class="proradio-downloadbox__cap proradio-caption__s"><?php $dlm_download->the_title(); ?></h4>
			<?php 
			// THERE IS NO PRINT. SANITIZATION MADE FROM THE PLUGIN ALREADY!
			// THIS FILE IS ONLY A TEMPLATING OVERRIDE FOR THE COMPATIBLE PLUGIN "DOWNLOAD MONITOR"
			$dlm_download->the_excerpt(); 

			?>
			<div class="proradio-downloadbox__count proradio-itemmetas"><?php 
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

			?></div>

			<p class="proradio-downloadbox__act">
			<a class="proradio-btn proradio-btn-primary" title="<?php if ( $dlm_download->get_version()->has_version_number() ) {
				printf( esc_html__( 'Version %s', 'proradio' ), esc_html( $dlm_download->get_version()->get_version_number() ) );
			} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
				<?php esc_html_e( 'Download', 'proradio' ); ?>
			</a>
			</p>

		</div>
	</aside>
</div>

