<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.3.3
 */


// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * @since 1.3.3
 * Player plugin output
 * Required to avoid volume slider glitch
 =============================*/
if( 'footer' == get_theme_mod( 'qtmplayer_design', 'header' ) && function_exists('qtmplayer_interface')){
	get_template_part( 'template-parts/header/part-player-footer' ) ;
}

?>
<div id="proradio-headerbar" class="proradio-headerbar <?php if( get_theme_mod('proradio_header_sticky') ){ ?> proradio-headerbar__sticky <?php } ?>" <?php if( get_theme_mod('proradio_header_sticky') ){ ?> data-proradio-stickyheader <?php } ?>>
	<?php 

	/**
	 * Player plugin output
	 =============================*/
	if( 'header' == get_theme_mod( 'qtmplayer_design', 'header' ) && function_exists('qtmplayer_interface')){
		get_template_part( 'template-parts/header/part-player' ) ;
	} 

	?>
	<div id="proradio-headerbar-content" class="proradio-headerbar__content proradio-paper">
		<?php  

		/**
		 * Secondary Header
		 * ============================= */
		if( get_theme_mod('proradio_sec_head_on') ){
			get_template_part( 'template-parts/header/secondary-header' );
		}

		/**
		 * Menu
		 * ============================= */
		get_template_part( 'template-parts/header/menu' );
		
		?>
	</div>
</div>
<?php  
/**
 * Off canvas
 * ============================= */
get_template_part( 'template-parts/header/offcanvas' );

