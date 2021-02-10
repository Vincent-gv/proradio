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
if('1' != $hide){
	?>
	<div class="proradio-pageheader proradio-pageheader--animate proradio-pageheader__testimonial proradio-primary">
		<div class="proradio-pageheader__contents proradio-negative">
			<div class="proradio-container proradio-pageheader__testimonial__quote">
				<?php  
				// IMPORTANT!
				//  is the material icon for the glitch effect, is not an error!!
				?>
				<span class="proradio-pageheader__decoricon"><i class="material-icons">format_quote</i></span>
				<h1 class="proradio-pagecaption"  data-proradio-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
				<p class="proradio-meta proradio-small">
					<?php  
					$author = get_post_meta( $post->ID, 'proradio_author', true );
					$role = get_post_meta( $post->ID, 'member_role', true );
					echo esc_html( $author );
					if($author && $role){
						?> / <?php  
					}
					echo esc_html( $role );
					?>
				</p>
				<i class="proradio-decor proradio-center"></i>
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
