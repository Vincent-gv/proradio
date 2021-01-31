<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
get_header(); 
?>
			<div id="proradio-pagecontent" class="proradio-pagecontent proradio-primary-light proradio-notfound404">
				<?php  
				get_template_part( 'template-parts/pageheader/pageheader-404' ); 
				?>
			</div>
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
		</div><!-- end of .proradio-master -->
	</div><!-- end of .proradio-globacontainer -->
	<?php wp_footer(); ?>
	</body>
</html>