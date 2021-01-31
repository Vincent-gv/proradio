<?php  
/**
 * Configuration for the Kirki Customizer.
 * @package Kirki
 */


Kirki::add_config( 'proradio_config', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod'
) );

if(!function_exists('proradio_kirki_configuration')){
function proradio_kirki_configuration( $config ) {
	return wp_parse_args( array (
		'disable_loader' => true
	), $config );
}}

add_filter( 'kirki/config', 'proradio_kirki_configuration' );



/*= Use External stylesheet for Kirki generated styles =*/
/*=============================================<<<<<*/
if (!is_customize_preview() ) {
	add_filter( 'kirki_output_inline_styles', '__return_false' );
}
add_filter( 'kirki/config', function( $config = array() ) {
    $config['styles_priority'] = 10000;
    return $config;
} );
