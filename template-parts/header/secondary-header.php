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
<div id="proradio-secondary-header" class="proradio-secondaryhead proradio-primary">
	<div class="proradio-secondaryhead__cont">


		<?php  
		/**
		 * ======================================================
		 * SOS text CTA
		 * ------------------------------------------------------
		 * Display a custom text super prominent in secondary header
		 * ======================================================
		 */
		$ic 	= get_theme_mod( 'proradio_sos_cta_i' );
		$type 	= get_theme_mod( 'proradio_customtext_type', 'text' );
		$t1 	= get_theme_mod( 'proradio_sos_cta_text1' );
		$t2 	= get_theme_mod( 'proradio_sos_cta_text2' );
		$l  	= get_theme_mod( 'proradio_sos_cta_l' );

		if( 'text' === $type ){
			if($t1 || $t2){
				?>
				<h6 class="proradio-sos proradio-scf">
					<?php if($l){ ?><a href="<?php echo esc_url( $l ); ?>"><?php } ?>
							<?php 
							/**
							 * ===============================================
							 * ICON
							 * ================================================
							 */
							if($ic){ 
								?><i class="material-icons"><?php echo esc_html($ic); ?></i><?php 
							} 
							?><?php echo esc_html( $t1 ); ?> 
							<span class="proradio-sos__t2"><?php echo esc_html( $t2 ); ?></span>

							<?php  
							/**
							 * ===============================================
							 * COUNTDOWN FROM CUSTOMIZER
							 * ================================================
							 */
							$countdown_event_id = get_theme_mod( 'proradio_ctaevent' );
							if( $countdown_event_id ){
								// Safe shortcode execution
								echo proradio_do_shortcode('[qt-countdown include_by_id="'.esc_attr( $countdown_event_id ).'" size="inherit"  labels="inline" show_ms="'.esc_attr( get_theme_mod( 'show_ms' ) ).'"]');
							}
							?>

					<?php if($l){ ?></a><?php } ?>
				</h6>
				<?php
			}
		} else if( 'song' === $type ){
			/**
			 * ===============================================
			 * Display current song title via javascript
			 * Requires player and a valid radio feed
			 * ===============================================
			 */
			?>
			<h6 class="proradio-sos proradio-scf qtmplayer-feed">
				<?php 
				if($ic){ 
					?><i class="material-icons"><?php echo esc_html($ic); ?></i><?php 
				} 
				?><span class="qtmplayer__artist"></span> <span class="proradio-sos__t2 qtmplayer__title"></span>
			</h6>
			<?php
		}
		?>


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
		?>

		<?php 

		/**
		 * ======================================================
		 * Secondary menu
		 * ======================================================
		 */
		
		if ( has_nav_menu( 'proradio_menu_secondary' ) || $icons_amount > 0 ) { 
			?>
			<ul class="proradio-menubar proradio-menubar__secondary">
				<?php  

					/**
					 * Menu
					 */
					if ( has_nav_menu( 'proradio_menu_secondary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'proradio_menu_secondary',
							'depth' => 1,
							'container' => false,
							'link_before' => '',
							'items_wrap' => '%3$s'
						) );
					}
					
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
		} 
		?>
	</div>
</div>