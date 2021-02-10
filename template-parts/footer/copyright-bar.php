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


$copy_text = get_theme_mod('proradio_footer_text');


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
	if(is_array($social)){
		if(count($social)>0){
			foreach($social as $var => $val){
				$link = get_theme_mod( 'proradio_social_'.$var );
				if($link){
					$icons_amount = $icons_amount + 1;
				}
			}
		}
	}			
}

if( $copy_text || has_nav_menu( 'proradio_menu_footer' ) ){
	?>	
	<div id="proradio-copybar" class="proradio-footer__copy proradio-primary">
		<div class="proradio-container">
			<?php  

			/**
			 * ======================================================
			 * Copyright text
			 * ======================================================
			 */ 
			
			if( $copy_text ){
				?>
				<p><?php echo wp_kses_post( get_theme_mod('proradio_footer_text') ); ?></p>
				<?php
			}

			/**
			 * ======================================================
			 * Footer menu
			 * ======================================================
			 */ 
			
				?>
				<ul class="proradio-menubar proradio-menubar__footer">
					<?php
					if ( has_nav_menu( 'proradio_menu_footer' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'proradio_menu_footer',
							'depth' => 1,
							'container' => false,
							'items_wrap' => '%3$s'
						));
					}
					?>

					<?php  
					/**
					 * Print the P only if there are social icons from the customizer
					 */
					if (function_exists( 'proradio_qt_socicons_array' )){
						if(is_array($social)){
							$social = proradio_qt_socicons_array();
							krsort($social);
							if(count($social)>0){
								foreach( $social as $var => $val ){
									$link = get_theme_mod( 'proradio_social_'.$var );
									if($link){
										?>
										<li class="proradio-social"><a href="<?php echo esc_url($link); ?>" class="qt-disableembedding" target="_blank"><i class="qt-socicon-<?php echo esc_attr($var); ?> qt-socialicon"></i></a></li>
										<?php
									}
								}
							}
						}
					}
					?>

				</ul>
				<?php  
			
			?>
		</div>
	</div>
	<?php  
}
?>