<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
$title = proradio_get_title();
$has_html = false;
if($title != strip_tags($title)) {
	$has_html = true;
}
?>
<div class="proradio-pageheader proradio-pageheader--animate proradio-primary">
	<div class="proradio-pageheader__contents proradio-negative">
		<div class="proradio-container">
			<p class="proradio-meta proradio-small proradio-p-catz">
				<?php proradio_postcategories( 1 ); ?>
			</p>
			<h1 class="proradio-pagecaption <?php if(!$has_html){ ?>proradio-glitchtxt<?php } ?>"  data-proradio-text="<?php echo esc_attr( $title ); ?>"><?php the_title();  ?></h1>
			<p class="proradio-meta proradio-small">
				<span class="proradio-meta__dets">
					<i class="material-icons">today</i><?php echo get_the_date(); ?>
					<?php echo proradio_do_shortcode('[proradio_reaktions-views-raw]' ); ?>
					<?php echo proradio_do_shortcode('[proradio_reaktions-commentscount-raw]' ); ?>
					<?php echo proradio_do_shortcode('[proradio_reaktions-loveit-raw]' ); ?>
					<?php echo proradio_do_shortcode('[proradio_reaktions-rating-raw]' ); ?>
				</span>
			</p>	
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