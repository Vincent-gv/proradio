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
$title = get_the_title();
$has_html = false;
if($title != strip_tags($title)) {
	$has_html = true;
}
if('1' != $hide){
	?>
	<div class="proradio-pageheader proradio-pageheader--animate proradio-primary">
		<div class="proradio-pageheader__contents proradio-negative">
			<div class="proradio-container">
				<h1 class="proradio-pagecaption <?php if(!$has_html){ ?>proradio-glitchtxt<?php } ?>"  data-proradio-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
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



		/**
		 * ======================================================
		 * Internal menu
		 * ======================================================
		 */
		$internalmenu_enable = get_post_meta($post->ID, 'proradio_internalmenu_enable', true);
		if( $internalmenu_enable ){
			?><div class="proradio-stickybar-parent"><?php
				get_template_part( 'template-parts/pageheader/part-internal-menu' ); 
			?></div><?php  
		}
		?>
	</div>
	<?php  
} // hide end