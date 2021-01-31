<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage kirki
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/* = Social section
=============================================*/
if( !function_exists( 'proradio_qt_socicons_array' )){
	function proradio_qt_socicons_array(){
		return array(
			'android' 			=> 'Android',
			'amazon' 			=> 'Amazon',
			'facebook' 			=> 'Facebook',
			'djtunes'			=> 'DjTunes',
			'itunes' 			=> 'iTunes',
			'juno' 				=> 'Juno',
			'lastfm' 			=> 'LastFm',
			'trackitdown' 		=> 'TrackitDown',
			'spotify' 			=> 'Spotify',
			'reverbnation' 		=> 'Reverbnation',
			'residentadvisor' 	=> 'Residentadvisor',
			'mixcloud' 			=> 'Mixcloud',
			'tunein' 			=> 'Tunein',
			'beatport' 			=> 'Beatport',
			'flickr' 			=> 'Flickr',
			'instagram' 		=> 'Instagram',
			'soundcloud' 		=> 'Soundcloud',
			'snapchat' 			=> 'Snapchat',
			'pinterest' 		=> 'Pinterest',
			'myspace' 			=> 'Myspace',
			'twitter' 			=> 'Twitter',
			'vimeo' 			=> 'Vimeo',
			'vk' 				=> 'VK.com',
			'wordpress' 		=> 'WordPress',
			'youtube' 			=> 'YouTube',
		);
	}
}

$qt_socicons_array = proradio_qt_socicons_array();
ksort($qt_socicons_array);
foreach ( $qt_socicons_array as $var => $val ){
	Kirki::add_field( 'proradio_config', array( 'settings' => 'proradio_social_'.$var, 'type' => 'text', 'label' => $val, 'section' => 'proradio_social_section',));
}
