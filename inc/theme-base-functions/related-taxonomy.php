<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/* Gets the taxonomy associated with any post type for other queries
=============================================*/
if(!function_exists('proradio_get_type_taxonomy')){
function proradio_get_type_taxonomy($posttype){
	if($posttype != ''){
		switch($posttype){
			case "qtvideo":
				$taxonomy = 'vdl_filters';
				break;
			case "shows":
				$taxonomy = 'genre';
				break;
			case "product":
				$taxonomy = 'product_cat';
				break;
			case "event":
				$taxonomy = 'eventtype';
				break;
			case "members":
				$taxonomy = 'memberstype';
				break;
			case "proradio_testimonial":
				$taxonomy = 'proradio_testimonialcat';
				break;
			default:
				$taxonomy = 'category';
		}
	}
	return $taxonomy;
}}