<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>	
			<?php  
			/**
			 * ======================================================
			 * Global hook used by our plugin to add special functions
			 * as ajax page loading or more
			 * ======================================================
			 */
			do_action( 'proradio-after-maincontent' );

			/**
			 * ======================================================
			 * Compatibility for the MegaFooter plugin
			 * ======================================================
			 */
			if( function_exists('proradio_megafooter_display') && false == \Elementor\Plugin::$instance->editor->is_edit_mode()  && false == \Elementor\Plugin::$instance->preview->is_preview_mode()  ){
				proradio_megafooter_display();
			}
			?>
			<div id="proradio-footer" class="proradio-footer">
				<?php 
				/**
				 * ======================================================
				 * Load footer copyright bar. Can set in customizer
				 * ======================================================
				 */
				get_template_part( 'template-parts/footer/copyright-bar' ); 
				?>
			</div>
		</div><!-- end of .proradio-master (ajax) -->
	</div><!-- end of .proradio-globacontainer -->


	<?php  


	
	/**
	 * Player placeholder
	 =============================*/
	if(function_exists('qtmplayer_interface') && 'footer' == get_theme_mod( 'qtmplayer_design', 'header' )){

		$placeholder_class = 'proradio-placeholder--regular';
		if(function_exists('qtmplayer_is_in_popup')){
			if( qtmplayer_is_in_popup() ){
				$placeholder_class = 'proradio-placeholder--popup';
			} 
		}


		?>
		<div class="proradio-player-footer-placeholder <?php echo esc_attr($placeholder_class); ?>">
		<?php /* placeholder */ ?>
		</div>
		<?php  
	}
	?>

	<?php wp_footer(); ?>
	</body>
</html>