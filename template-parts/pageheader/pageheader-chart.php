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
$hide = get_post_meta($post->ID, 'proradio_page_header_hide', true); // see custom-types/page/page.php
$title = proradio_get_title();
$post_metas = get_post_meta( $post->ID );


if('1' != $hide){
	?>
	<div class="proradio-pageheader proradio-pageheader--animate proradio-pageheader__chart proradio-primary">
		<div class="proradio-pageheader__contents proradio-negative">
			<div class="proradio-container">
				
				<p class="proradio-meta proradio-small proradio-p-catz">
					<?php proradio_postcategories( 1, 'chartcategory' ); ?>
				</p>
				<h1 class="proradio-pagecaption"  data-proradio-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
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
	<?php  
} // hide end
