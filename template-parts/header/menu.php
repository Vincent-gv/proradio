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

?>
<div id="proradio-menu" class="proradio-menu proradio-paper">
	<div class="proradio-menu__cont">
		<h3 class="proradio-menu__logo proradio-left">
			<a class="proradio-logolink" href="<?php echo home_url( '/' ); ?>">
				<?php
				echo proradio_show_logo('_header_mob');
				echo proradio_show_logo('_header');
				echo proradio_show_logo('_header_transparent');
				?>
			</a>
		</h3>

		<?php  
		proradio_ads_display('proradio_ad_menubar','proradio-hide-on-large-and-down');
		?>




		<?php if ( has_nav_menu( 'proradio_menu_primary' ) ) { ?>
			<nav id="proradio-menunav" class="proradio-menu-horizontal proradio-menu-horizontal--<?php echo esc_attr( get_theme_mod('menu_template', 'default')); ?>">
				<div class="proradio-menu-horizontal_c">
					<ul id="proradio-menubar" class="proradio-menubar proradio-menubar-<?php echo esc_attr( get_theme_mod('menu_template', 'default')); ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'proradio_menu_primary',
						'depth' => 3,
						'container' => false,
						'items_wrap' => '%3$s'
					));
					?>
					</ul>
				</div>
			</nav>
		<?php } ?>
		<div class="proradio-menubtns">
			<div class="proradio-menubtns__c">
			<?php 

			/**
			 * ============================================
			 * Cart button
			 * ============================================
			 */
			if ( function_exists('WC') && false !== get_theme_mod( 'proradio_wc_cart', false ) ) {
				get_template_part( 'template-parts/header/cart-btn' );
			}


			/**
			 * ============================================
			 * Search button
			 * ============================================
			 */
			if ( false !== get_theme_mod( 'proradio_search_header', false ) ) {
				?> 
				<a class="proradio-btn proradio-btn__r" data-proradio-switch="open" data-proradio-target="#proradio-searchbar"><i class='material-icons'>search</i></a> 
				<?php  
			}


			/**
			 * ===========================================
			 * Off canvas menu button
			 * IMPORTANT: we display this in desktop only if there is an offcanvas menu or widgets
			 * ===========================================
			 */
			$btn_classes = array();
			if ( !has_nav_menu( 'proradio_menu_desktop_off' ) &&  !is_active_sidebar( 'proradio-offcanvas-sidebar' )  ) {
				// No reason to display the button in desktop
				$btn_classes[] = 'proradio-hide-on-large-only';
			}
			if ( !has_nav_menu( 'proradio_menu_primary' ) && !has_nav_menu( 'proradio_menu_secondary' ) &&  !is_active_sidebar( 'proradio-offcanvas-sidebar' )  ) {
				// No reason to display the button in desktop
				$btn_classes[] = 'proradio-hide-on-large-and-down';
			}
				?><a class="proradio-btn proradio-btn__r <?php echo esc_attr( implode(' ', $btn_classes ) ); ?>" data-proradio-switch="proradio-overlayopen" data-proradio-target="#proradio-body"><i class="material-icons">menu</i></a><?php 
			/**
			 * ============================================
			 * END OF Off canvas menu button
			 * ============================================
			 */
			


			/**
			 * ============================================
			 * Play button
			 * ============================================
			 */
			if ( get_theme_mod( 'proradio_play_header' ) ) {
				get_template_part( 'template-parts/header/play-btn' );
			}

			/**
			 * ============================================
			 * Volume button
			 * ============================================
			 */
			if ( function_exists( 'qtmplayer_volume_control' ) && get_theme_mod( 'proradio_vol_header' ) ) {
				$classes = ['proradio-btn','proradio-btn__r','proradio-hide-on-large-and-down'];
				qtmplayer_volume_control( $classes );
			}

			/**
			 * ============================================
			 * CTA / Popup button
			 * ============================================
			 */
			get_template_part( 'template-parts/header/cta' );
			
			?>
			</div>

		</div>
	</div>

	<?php  

	/**
	 * ============================================
	 * Search bar
	 * ============================================ 
	 */
	get_template_part( 'template-parts/header/search' );

	/**
	 * ============================================
	 * Mega Menu plugin output
	 * ============================================ 
	 */
	if( function_exists('proradio_megamenu_display') && false == \Elementor\Plugin::$instance->editor->is_edit_mode()  && false == \Elementor\Plugin::$instance->preview->is_preview_mode()  ){
		proradio_megamenu_display();
	}

	?>
</div>