<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0







 Legacy file






 */





?>	

<div id="proradio-footermenu" class="proradio-footer__section proradio-section proradio-primary-light">
	<div class="proradio-footer__content">


		<?php  
		/**
		 * ======================================================
		 * Fooer logo
		 * ------------------------------------------------------
		 * Display logo or site title
		 * ======================================================
		 */
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="proradio-footer__logo">
			<h4><?php echo proradio_show_logo('_footer'); ?></h4>
		</a>


		<?php  
		/**
		 * ======================================================
		 * Footer menu
		 * ------------------------------------------------------
		 * Display menu for specific footer location
		 * ======================================================
		 */
		?>
		<ul class="proradio-menubar">
			<?php 
			/**
			*  Footer left
			*  =============================================
			*/
			if ( has_nav_menu( 'proradio_menu_footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'proradio_menu_footer',
					'depth' => 1,
					'container' => false,
					'items_wrap' => '%3$s'
				));
			}
			?>
		</ul>


		<?php  
		/**
		 * ======================================================
		 * Social icons
		 * ------------------------------------------------------
		 * Display list of social icon links from customizer
		 * ======================================================
		 */
		if (function_exists( 'proradio_qt_socicons_array' )){
			$social = proradio_qt_socicons_array();
			krsort($social);
			$icons_amount = 0;
			foreach($social as $var => $val){
				$link = get_theme_mod( 'proradio_social_'.$var );
				if($link){
					$icons_amount = $icons_amount + 1;
				}
			}
			
			if ( $icons_amount > 0) {
				?>
				<div class="proradio-social">
					<?php  
					foreach($social as $var => $val){
						$link = get_theme_mod( 'proradio_social_'.$var );
						if($link){
							?>
							<a href="<?php echo esc_url($link); ?>" class="proradio-btn proradio-btn__r proradio-btn__white qt-disableembedding" target="_blank"><i class="qt-socicon-<?php echo esc_attr($var); ?> qt-socialicon"></i></a>
							<?php
						}
					}
					?>
				</div>
				<?php
			}
		} 
		?>

	</div>

	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	$bgimg = get_theme_mod( 'proradio_footer_bgimg', false );
	if( $bgimg ){
		?> 
			<div class="proradio-bgimg"><img src="<?php echo esc_url( $bgimg ); ?>" alt="<?php esc_attr_e('Background', 'proradio'); ?>"></div> 
		<?php
	}


	/**
	 * ======================================================
	 * Background tone color
	 * ======================================================
	 */
	if( get_theme_mod( 'proradio_overlay_tone', '1' ) ){
		?> 
			<div class="proradio-grad-layer"></div>
		<?php
	}

	
	?>
	

</div>