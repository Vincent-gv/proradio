<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

 
$cta_on = get_theme_mod( 'proradio_cta_on' );
$cta_on_mobile = get_theme_mod( 'proradio_cta_on_mob' );

if( $cta_on && $cta_on_mobile ){
	$action 		= get_theme_mod( 'proradio_cta_action', 'link' );
	$cta_text 		= get_theme_mod( 'proradio_cta_text', esc_html__('Contact us', 'proradio') );
	$icon 			= get_theme_mod( 'proradio_cta_i');
	$cta_id 		=  get_theme_mod( 'proradio_cta_id' , 'proradioCta' );
	$cta_classes = array( 'proradio-btn','proradio-btn-primary','proradio-btn__full','proradio-btn-ctaheader','proradio-hide-on-med-and-up', get_theme_mod( 'proradio_cta_class' ) );
	if( 'popup-player' === $action ){
		$cta_url 	= add_query_arg( array('proradio-popup' => '1'), home_url() );
	} else {
		$cta_url 	= get_theme_mod( 'proradio_cta_url' );
	}
	$attributes 	= [];
	if( get_theme_mod( 'proradio_cta_target' ) ||  $action === 'popup-player' || $action === 'popup-custom' ){
		$attributes[] = 'target=_blank';
	}
	if( $cta_text && $icon ){
		$cta_classes[] = 'proradio-icon-l';
	}
	$cta_classes = implode(' ', $cta_classes );
	$attributes = implode(' ', $attributes );
	?>
	<div class="proradio-sidebar__offcanvas">
	<a id="<?php  echo esc_attr( $cta_id ); ?>" <?php echo esc_attr( $attributes ); ?> class="<?php  echo esc_attr( $cta_classes ); ?>"  href="<?php echo esc_attr( $cta_url ); ?>"><?php if( $icon ){ ?><i class="material-icons"><?php echo esc_attr( $icon ); ?></i> <?php } ?><?php echo esc_html( $cta_text ); ?></a>
	</div>
	<?php
}