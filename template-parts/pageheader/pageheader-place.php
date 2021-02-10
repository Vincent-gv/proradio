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
				<?php proradio_postcategories( 1, 'pcategory' ); ?>
			</p>
				
			<h1 class="proradio-pagecaption <?php if(!$has_html){ ?>proradio-glitchtxt<?php } ?>"  data-proradio-text="<?php echo esc_attr( $title ); ?>"><?php the_title();  ?></h1>
			<p class="proradio-meta proradio-small">
				<?php if(get_post_meta( $post->ID, 'qt_country', true )){ ?>
					<i class="material-icons">public</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_country', true )); ?>
				<?php } ?>
				<?php if(get_post_meta( $post->ID, 'qt_city', true )){ ?>
					<i class="material-icons">location_on</i><?php echo esc_attr( get_post_meta( $post->ID, 'qt_city', true )); ?>
				<?php } ?>
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