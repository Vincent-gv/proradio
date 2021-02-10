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



if(!function_exists('proradio_custom_shorttext')){
	function proradio_custom_shorttext( $post = false, $excerpt_length = 50 ) {
		// return $excerpt;
		$excerpt = '';
		if($post){
			if(is_object( $post )){
				if( ! empty( $post->post_excerpt ) ){
					$excerpt = $post->post_excerpt;
				} else {
					$excerpt = $post->post_content;
				}
			}
		}

		if ( ! empty( $excerpt ) ) {
			
			$excerpt = strip_shortcodes( $excerpt );
			$excerpt = str_replace(']]>', ']]&gt;', $excerpt);

			$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
			$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
			return $excerpt;
		}
		return;
	}
}



if(!function_exists('proradio_get_excerpt_by_id')){
function proradio_get_excerpt_by_id($post_id, $excerpt_length = 30){
	$the_post = get_post($post_id); //Gets post ID
	$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = 35; //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);

	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '…');
		$the_excerpt = implode(' ', $words);
	endif;

	$the_excerpt = '<p>' . $the_excerpt . '</p>';

	return $the_excerpt;
}}


/**
 * ======================================================
 * Excerpt length
 * ------------------------------------------------------
 * Depending on the template we may require to change the 
 * excerpt length to different sizes for a nice effect.
 * ======================================================
 */
add_filter( 'excerpt_length', 'proradio_excerpt_length', 999 );
if(!function_exists('proradio_excerpt_length')){
function proradio_excerpt_length( $length ) {
	return 50;
}}
if(wp_is_mobile()){
	add_filter( 'excerpt_length', 'proradio_excerpt_length_20', 999 );
}


add_filter( 'the_excerpt', 'proradio_the_excerpt_scremove_now', 20 );

if(!function_exists('proradio_the_excerpt_scremove_now')){
function proradio_the_excerpt_scremove_now( $content ) {
	$content = str_replace('[&#8230;]', '...', $content);
	return strip_shortcodes( $content );
}}


if(!function_exists('proradio_excerpt_length_20')){
function proradio_excerpt_length_20( $length ) {
	return 20;
}}

if(!function_exists('proradio_excerpt_length_30')){
function proradio_excerpt_length_30( $length ) {
	return 30;
}}
if(!function_exists('proradio_excerpt_length_40')){
function proradio_excerpt_length_40( $length ) {
	return 40;
}}
if(!function_exists('proradio_excerpt_post_vertical')){
function proradio_excerpt_post_vertical( $length ) {
	return 55;
}}
if(!function_exists('proradio_excerpt_length_100')){
function proradio_excerpt_length_100( $length ) {
	return 100;
}}
if(!function_exists('proradio_excerpt_length_300')){
function proradio_excerpt_length_300( $length ) {
	return 300;
}}

if(!function_exists('proradio_trim_all_excerpt')){
function proradio_trim_all_excerpt($text) {
	// Creates an excerpt if needed; and shortens the manual excerpt as well
	global $post;
   $raw_excerpt = $text;
   if ( '' == $text ) {
	  $text = get_the_content('');
	  $text = strip_shortcodes( $text );
	  $text = apply_filters('the_content', $text);
	  $text = str_replace(']]>', ']]&gt;', $text);
   }

	$text = strip_tags($text);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$text = wp_trim_words( $text, $excerpt_length, $excerpt_more ); 

	return apply_filters('proradio_trim_excerpt', $text, $raw_excerpt); 
}}
add_filter('get_the_excerpt', 'proradio_trim_all_excerpt');