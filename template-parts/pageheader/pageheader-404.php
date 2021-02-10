<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


?>
<div class="proradio-pageheader proradio-pageheader--animate proradio-primary">
	<div class="proradio-pageheader__contents proradio-negative">
		<div class="proradio-container proradio-container--404">
			<h1 class="proradio-pagecaption"><?php esc_html_e('404', 'proradio'); ?></h1>
			<h6 class="proradio-meta"><?php esc_html_e('Page Not Found', 'proradio'); ?></h6>
			<div class="proradio-pageheader__search proradio-spacer-xs">
				<?php get_search_form(); ?>
			</div>
			<p class="proradio-meta"><a class="" href="<?php echo home_url( '/' ); ?>"><?php esc_html_e( 'Return to the homepage','proradio' ); ?></a></p>
		</div>
	</div>
	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/image' ); 
	?>
</div>