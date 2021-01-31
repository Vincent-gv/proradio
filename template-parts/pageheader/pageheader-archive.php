<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
// Design override
$hide = 0;
$paged = proradio_get_paged();
if( is_page() ){

	if($paged == 1){
		$hide = get_post_meta($post->ID, 'proradio_page_header_hide', true); // see custom-types/page/page.php
	}
}

$title = proradio_get_title();
$has_html = false;
if($title != strip_tags($title)) {
	$has_html = true;
}

if('1' != $hide){
	?>
	<div class="proradio-pageheader proradio-pageheader--animate proradio-primary ">
		<div class="proradio-pageheader__contents proradio-negative">
			<div class="proradio-container">
				<h1 class="proradio-pagecaption <?php if(!$has_html){ ?>proradio-glitchtxt<?php } ?>"  data-proradio-text="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title);  ?></h1>
				<?php if( !is_page() ){ ?><p class="proradio-meta"><?php get_template_part( 'template-parts/pageheader/meta-archive' );  ?></p><?php } ?>
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
} // hide end


