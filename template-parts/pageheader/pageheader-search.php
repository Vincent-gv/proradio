<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
$title = proradio_get_title();
?>
<div class="proradio-pageheader proradio-pageheader--animate proradio-primary">
	<div class="proradio-pageheader__contents proradio-negative">
		<div class="proradio-container">
			
			<h1 class="proradio-pagecaption"  data-proradio-text="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title );  ?></h1>
			<div class="proradio-pageheader__search proradio-spacer-xs">
				<?php get_search_form(); ?>
			</div>
			<p class="proradio-meta"><?php get_template_part( 'template-parts/pageheader/meta-archive' );  ?></p>
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