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
				<?php  
				if( has_post_thumbnail(  )){
					?>
					<span class="proradio-pageheader__thumb">
						<?php the_post_thumbnail( 'proradio-squared-s', array('class' => 'proradio-thumb-round') );?>
					</span>
					<?php
				}
				?>
				<h5 class="proradio-capfont proradio-pageheader__sub">
					<?php  
					if( array_key_exists( 'member_role', $post_metas ) ){
						echo esc_html( $post_metas['member_role'][0] );
					}
					?>
				</h5>
				
				<h1 class="proradio-pagecaption"  data-proradio-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
				<?php 
				/**
				 * Social icons
				 */
				get_template_part( 'template-parts/pageheader/part-sociallinks-members' ); 
				?>
				
				
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
} // hide end
