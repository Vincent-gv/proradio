<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

// Design override
$hide = get_post_meta($post->ID, 'proradio_page_header_hide', true); // see custom-types/page/page.php
$title = proradio_get_title();
$post_metas = get_post_meta( $post->ID );
if('1' != $hide){
	?>
	<div class="proradio-pageheader proradio-pageheader--animate proradio-pageheader__radiochannel proradio-primary">
		<div class="proradio-pageheader__contents proradio-negative">
			<div class="proradio-container">
				

				<div>
					<?php  
					if(function_exists('qtmplayer_play_button')){
						$atts = array(
							'file'=>false,
							'id' 		=> 	$post->ID,
							'classes' => 'proradio-pageheader__actions'
						);
						echo qtmplayer_play_circle( $atts );
					}
					?>
				</div>

				
				<p class="proradio-meta proradio-small proradio-p-catz">
					<?php proradio_postcategories( 1, 'radio-genre' ); ?>
				</p>

				<?php  

				/**
				 * ===========================================================================
				 * Radio logo
				 * =========================================================================== 
				*/
			
				$customlogo = wp_get_attachment_image_src( get_post_meta( get_the_ID(),'qt_radio_logo', true ),'full');
			
				if($customlogo) {
					?>
					<img src="<?php echo esc_url($customlogo[0]); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="proradio-spacer-s proradio-center">
					<?php
				} else {
					?>
					<h1 class="proradio-pagecaption"><?php the_title(); ?></h1>
					<?php if( array_key_exists( 'qt_radio_subtitle', $post_metas ) && $post_metas['qt_radio_subtitle'][0] !== '' ){ ?>
						<p class="proradio-meta proradio-small"><?php echo esc_html( $post_metas['qt_radio_subtitle'][0] ); ?></p>
					<?php } ?>
					<?php  
					/**
					 * ======================================================
					 * Mouse scroll icon
					 * ======================================================
					 */
					get_template_part( 'template-parts/pageheader/part-decoration' ); 
					?>
					<?php 
				}
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
