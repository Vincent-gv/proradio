<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

$cta_on = get_theme_mod( 'proradio_cta_on' );
if( $cta_on ){
	$action 		= get_theme_mod( 'proradio_cta_action', 'link' );
	$cta_text 		= get_theme_mod( 'proradio_cta_text', esc_html__('Contact us', 'proradio') );
	$icon 			= get_theme_mod( 'proradio_cta_i');
	$cta_id 		=  get_theme_mod( 'proradio_cta_id' , 'proradioCta' );
	$cta_classes 	= array( 'proradio-btn','proradio-btn-primary ','proradio-btn-ctaheader proradio-hide-on-small-only', get_theme_mod( 'proradio_cta_class' ) );
	if( 'popup-player' === $action ){
		$cta_url 	= add_query_arg( array('proradio-popup' => '1'), home_url() );
	} else {
		$cta_url 	= get_theme_mod( 'proradio_cta_url' );
	}
	$attributes 	= [];
	if( $action === 'popup-player' || $action === 'popup-custom' ){
		$cta_classes[] = 'proradio-popupwindow';
		$attributes[] = 'data-width='.esc_attr( get_theme_mod( 'proradio_cta_popup_w', '300' ) );
		$attributes[] = 'data-height='.esc_attr( get_theme_mod( 'proradio_cta_popup_h', '430' ) );
	}
	if( get_theme_mod( 'proradio_cta_target' ) ){
		$attributes[] = 'target=_blank';
	}
	if( $cta_text && $icon ){
		$cta_classes[] = 'proradio-icon-l';
	}
	$cta_classes = implode(' ', $cta_classes );
	$attributes = implode(' ', $attributes );
	?><a id="<?php  echo esc_attr( $cta_id ); ?>" <?php echo esc_attr( $attributes ); ?> class="<?php  echo esc_attr( $cta_classes ); ?>"  href="<?php echo esc_attr( $cta_url ); ?>"><?php if( $icon ){ ?><i class="material-icons"><?php echo esc_attr( $icon ); ?></i> <?php } ?><?php echo esc_html( $cta_text ); ?></a><?php
}