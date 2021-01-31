<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/


/**
 * ======================================================
 * Register sidebars
 * ------------------------------------------------------
 * Creates 2 custom sidebars for the theme
 * ======================================================
 */
if(!function_exists( 'proradio_widgets_init' )){
	add_action( 'widgets_init', 'proradio_widgets_init' );
	function proradio_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', "proradio" ),
			'id'            => 'proradio-right-sidebar',
			'before_widget' => '<li id="%1$s" class="proradio-widget proradio-col proradio-s12 proradio-m6 proradio-l12  %2$s">',
			'before_title'  => '<h6 class="proradio-widget__title proradio-caption proradio-caption__s proradio-anim" data-qtwaypoints-offset="30" data-qtwaypoints><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Off canvas Sidebar', "proradio" ),
			'id'            => 'proradio-offcanvas-sidebar',
			'before_widget' => '<li id="%1$s" class="proradio-widget proradio-col proradio-s12 proradio-m12 proradio-l12  %2$s">',
			'before_title'  => '<h6 class="proradio-widget__title proradio-caption proradio-caption__s proradio-anim" data-qtwaypoints-offset="30" data-qtwaypoints><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Event Sidebar', "proradio" ),
			'id'            => 'proradio-event-sidebar',
			'before_widget' => '<li id="%1$s" class="proradio-widget proradio-col proradio-s12 proradio-m12 proradio-l12  %2$s">',
			'before_title'  => '<h6 class=" proradio-caption proradio-caption__s proradio-anim" data-qtwaypoints-offset="30" data-qtwaypoints><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Video Sidebar', "proradio" ),
			'id'            => 'proradio-video-sidebar',
			'before_widget' => '<li id="%1$s" class="proradio-widget proradio-widget--videopage proradio-col proradio-s12 proradio-m12 proradio-l12  %2$s">',
			'before_title'  => '<h6 class=" proradio-caption proradio-caption__s proradio-anim" data-qtwaypoints-offset="30" data-qtwaypoints><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
	}
}