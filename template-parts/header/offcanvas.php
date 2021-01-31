<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Off canvas
 */
?>
<nav id="proradio-overlay" class="proradio-overlay proradio-paper">
	<div class="proradio-overlay__closebar"><span class="proradio-btn proradio-btn__r"  data-proradio-switch="proradio-overlayopen" data-proradio-target="#proradio-body"> <i class="material-icons">close</i></span></div>
	<?php  
	/**
	 * =======================================================
	 * MOBILE ONLY
	 * =======================================================
	 */
	?>
	<div class="proradio-hide-on-large-only">
		<?php
		/**
		 * ============================================
		 * CTA / Popup button
		 * ============================================
		 */
		get_template_part( 'template-parts/header/cta-mobile' );

		/**
		 * ============================================
		 * Remove any trace of megamenu classes to be very sure
		 * ============================================
		 */
		function proradio_nav_menu_css_class($classes) {
		    $custom_classes = array();
		    foreach($classes as $class) {
		        $class = str_replace('proradio-megamenu-is', 'proradio-megamenu-was', $class);
		        $custom_classes[] = $class;
		    }
		    return $custom_classes;
		}
		add_filter('nav_menu_css_class', 'proradio_nav_menu_css_class');


		/**
		 * ============================================
		 * Primary menu - mobile sidebar
		 * ============================================
		 */
		if ( has_nav_menu( 'proradio_menu_primary' ) ) { 
			?>
			<ul class="proradio-menu-tree">
				<?php
				wp_nav_menu( array (
					'theme_location' => 'proradio_menu_primary',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				) );
				?>
			</ul>
			<?php 
		} 

		/**
		 * ============================================
		 * Secondary menu - mobile sidebar
		 * ============================================
		 */
		if ( has_nav_menu( 'proradio_menu_secondary' ) ) { 
			?>
			<ul class="proradio-menu-tree proradio-menu-tree__secondary">
				<?php  
					wp_nav_menu( array(
						'theme_location' => 'proradio_menu_secondary',
						'depth' => 1,
						'container' => false,
						'items_wrap' => '%3$s'
					) );
				?>
			</ul>
			<?php 
		} 
		?>
	</div>
	<?php  

	/**
	 * =======================================================
	 * MOBILE ONLY END
	 * =======================================================
	 */





	/**
	 * =======================================================
	 * DESKTOP ONLY
	 * =======================================================
	 */
	?>
	<div class="proradio-hide-on-large-and-down">
		<?php 
		/**
		 * Primary menu - mobile sidebar
		 */
		if ( has_nav_menu( 'proradio_menu_desktop_off' ) ) { 
			?>
			<ul class="proradio-menu-tree">
				<?php
				wp_nav_menu( array (
					'theme_location' => 'proradio_menu_desktop_off',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				) );
				?>
			</ul>
			<?php 
		} 
		?>
	</div>
	<?php  
	/**
	 * =======================================================
	 * DESKTOP ONLY END
	 * =======================================================
	 */

	/**
	 * =======================================================
	 * OFF CANVAS SIDEBAR
	 * =======================================================
	 */
	if( is_active_sidebar( 'proradio-offcanvas-sidebar' ) ){
		?>
		<div id="proradio-sidebar-offcanvas" role="complementary" class="proradio-sidebar proradio-sidebar__secondary proradio-sidebar__offcanvas">
			<ul class="proradio-row">
				<?php dynamic_sidebar( 'proradio-offcanvas-sidebar' ); ?>
			</ul>
		</div>
		<?php 
	}
	/**
	 * =======================================================
	 * OFF CANVAS SIDEBAR END
	 * =======================================================
	 */
	?>
</nav>
<div class="proradio-overlay__pagemask" data-proradio-switch="proradio-overlayopen" data-proradio-target="#proradio-body"></div>