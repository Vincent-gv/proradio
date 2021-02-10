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

// Design override
$title = proradio_get_title();
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	$defaults['wrap_before'] = '';
	$defaults['wrap_after'] = '';
	$defaults['delimiter'] = ' &gt; ';
	return $defaults;
}
add_action( 'proradio_woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
?>
<div class="proradio-pageheader proradio-pageheader--animate proradio-pageheader__shop proradio-primary">
	<div class="proradio-pageheader__contents proradio-negative">
		<div class="proradio-container">
			<h1 class="proradio-pagecaption"><?php echo esc_html( $title ); ?></h1>
			<p class="proradio-meta proradio-small"><?php do_action( 'proradio_woocommerce_before_main_content' ); ?></p>
			<?php  
			/**
			 * ======================================================
			 * Mouse scroll icon
			 * ======================================================
			 */
			get_template_part( 'template-parts/pageheader/part-decoration' ); 
			?>
		</div>
		<?php  
		/**
		 * ======================================================
		 * Mouse scroll icon
		 * ======================================================
		 */
		get_template_part( 'template-parts/misc/mousescroll' ); 
		?>
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
<?php  
/**
 * ======================================================
 * Shareball
 * ======================================================
 */
get_template_part( 'template-parts/shared/shareball' ); 
?>

