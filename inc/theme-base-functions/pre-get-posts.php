<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * ======================================================
 * Item pagination amount
 * ------------------------------------------------------
 * Customize number of posts depending on the archive post type
 * ======================================================
 */





if(!function_exists('proradio_custom_number_of_posts')){
function proradio_custom_number_of_posts( $query ) {
	if($query->is_main_query() && !is_admin()){


		/**
		 * Team members pages archives
		 */
		if ( $query->is_post_type_archive( 'members' ) || $query->is_tax('memberstype')){
			$query->set( 'posts_per_page', 9 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'postname' => 'ASC'));
		}

		
		/**
		 * Events pages archives
		 */
		else if ( $query->is_post_type_archive( 'proradio_testimonial' ) || $query->is_tax('proradio_testimonialcat')){
			$query->set( 'posts_per_page', 12 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'date' => 'DESC'));
		}

		/**
		 * Events pages archives
		 */
		else if ( $query->is_post_type_archive( 'place' ) || $query->is_tax('pcategory')){
			$query->set( 'posts_per_page', 9 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'postname' => 'ASC'));
		}

		/**
		 * Shows pages archives
		 */
		else if ( $query->is_post_type_archive( 'shows' ) || $query->is_tax('genre')){
			$query->set( 'posts_per_page', 12 );
			// $query->set( 'orderby', array ('menu_order' => 'ASC', 'postname' => 'ASC'));
		}

		/**
		 * Shows pages archives
		 */
		else if ( $query->is_post_type_archive( 'chart' ) || $query->is_tax('chartcategory')){
			$query->set( 'posts_per_page', 12 );
			// $query->set( 'orderby', array ('menu_order' => 'ASC', 'postname' => 'ASC'));
		}

		/**
		 * Events pages archives
		 */
		else if ( $query->is_post_type_archive( 'event' ) || $query->is_tax('eventtype')){
			$query->set( 'posts_per_page', 9 );

			$query->set( 'orderby', 'meta_value');
			$query->set( 'order', 'ASC');
			$query->set( 'meta_key', 'proradio_date');

			if ( get_theme_mod ( 'events_hideold', 0 ) == '1'){
				$query->set ( 
					'meta_query' , array (
					array (
						'key' => 'eventdate',
						'value' => date('Y-m-d'),
						'compare' => '>=',
						'type' => 'date'
						 )
					)
				);
			}
		}

		/**
		 * Podcast pages archives
		 */
		else if ( $query->is_post_type_archive( 'podcast' ) || $query->is_tax('podcastfilter')){
			$query->set( 'posts_per_page',12 );
			$query->set( 'meta_query', array(
			    'relation' => 'OR',
			    array(
			        'key' => '_podcast_date', 
			        'compare' => 'EXISTS'
			    ),
			    array(
			        'key' => '_podcast_date', 
			        'compare' => 'NOT EXISTS'
			    )
			) );
			$query->set( 'order', 'DESC DESC');
			$query->set( 'orderby', 'meta_value date' ); 
		}

		/**
		 * QtVideo pages archives for plugin Qt Videogalleries
		 */
		else if ( $query->is_post_type_archive( 'qtvideo' ) || $query->is_tax('vdl_filters')){
			$query->set( 'posts_per_page',12 );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'postname' => 'ASC'));
		}

		/**
		 * Defaults for any other archive
		 */
		else if ( 
			is_archive()
			|| is_category()
			|| is_tag()
		) {
			$query->set( 'posts_per_page','9' );
		}
		
		return;
	}
}}
add_action( 'pre_get_posts', 'proradio_custom_number_of_posts', 1, 999 );

