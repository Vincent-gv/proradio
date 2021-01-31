<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * ======================================================
 * Display logo or site name.
 * Native WP function is super buggy and doesn't support
 * live refreshing, while ours does.
 * ======================================================
 */
if(!function_exists('proradio_show_logo')){
function proradio_show_logo( $alternative = ''){
	$logo = get_theme_mod("proradio_logo".$alternative, '');
	ob_start();
	if($logo != ''){
		?>
		<img src="<?php echo esc_url( $logo ); ?>" class="proradio-logo<?php echo esc_attr( $alternative ); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
		<?php
	}else{
		?>
		<span class="proradio-sitename proradio-logo<?php echo esc_attr( $alternative ); ?>"><?php bloginfo('name'); ?></span>
		<?php
	}
	return ob_get_clean();
}}
