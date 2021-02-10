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
	<div class="proradio-pageheader proradio-pageheader--animate proradio-pageheader__member proradio-primary">
		<div class="proradio-pageheader__contents proradio-negative">
			<div class="proradio-container">
				<p class="proradio-meta proradio-small proradio-p-catz">
					<?php proradio_postcategories( 1, 'genre' ); ?>
				</p>
				<h1 class="proradio-pagecaption"  data-proradio-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
				<?php 
				/**
				 * Social icons
				 */
				get_template_part( 'template-parts/pageheader/part-sociallinks' ); 
				?>
				<?php if( array_key_exists( 'subtitle2', $post_metas ) && $post_metas['subtitle2'][0] !== '' ){ ?>
					<p class="proradio-meta proradio-small"><?php echo esc_html( $post_metas['subtitle2'][0] ); ?></p>
				<?php } ?>
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
