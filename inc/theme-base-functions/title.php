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


/**
 * =================================
 * proradio_is_shop
 * This function tells you if we are in a shop page
 * =================================
 */
if(!function_exists('proradio_is_shop')){
	function proradio_is_shop(){
		if(function_exists("is_shop")){
			if( is_shop() || is_woocommerce() || is_product_category() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ){
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
}


/**
 * =================================
 * proradio_shop_title
 * This function returns an appropriate string for the page title of a shop page
 * =================================
 */
if(!function_exists('proradio_shop_title')){
	function proradio_shop_title(){
		if(function_exists("is_shop")){
			if(function_exists("is_shop")){
				if( is_shop() ){
					return esc_html__('Shop' , 'proradio');
				}
				else if( is_cart() ){
					return esc_html__('Cart' , 'proradio');
				}
				else if( is_product() ){
					return get_the_title();
				}
				else if( is_checkout() ){
					return esc_html__('Checkout' , 'proradio');
				}
				else if( is_account_page() ){
					return esc_html__('Account' , 'proradio');
				} 
				else if( is_wc_endpoint_url() ){
					if( is_wc_endpoint_url('order-pay') ){
						return esc_html__('Order payment' , 'proradio');
					} 
					else if( is_wc_endpoint_url( 'order-received' ) ){
						return esc_html__('Order received' , 'proradio');
					}
					else if( is_wc_endpoint_url( 'view-order' ) ){
						return esc_html__('View order' , 'proradio');
					}
					else if( is_wc_endpoint_url( 'edit-account' ) ){
						return esc_html__('Edit account' , 'proradio');
					}
					else if( is_wc_endpoint_url( 'edit-address' ) ){
						return esc_html__('Edit address' , 'proradio');
					}
					else if( is_wc_endpoint_url( 'lost-password' ) ){
						return esc_html__('Password recovery' , 'proradio');
					}
					else if( is_wc_endpoint_url( 'customer-logout' ) ){
						return esc_html__('Log out' , 'proradio');
					}
					else if( is_wc_endpoint_url( 'add-payment-method' ) ){
						return esc_html__('Add payment method' , 'proradio');
					}
				}
				else  {
					return esc_html__('Shop' , 'proradio');
				}
			}
		}
		return;
	}
}


function proradio_get_title(){
	ob_start();
	if ( is_category() ) : single_cat_title();
	elseif (is_page() || is_singular() ) : the_title();
	



	elseif ( is_search() ) : printf( esc_html__( 'Search Results for: %s', "proradio" ),  esc_html(get_search_query()) );
	elseif ( is_tag() ) : single_tag_title();
	elseif ( is_author() ) :
		the_author_meta('nickname');
		rewind_posts();
	elseif ( is_day() ) : printf( esc_html__( 'Day: %s', "proradio" ), esc_html(get_the_date())  );
	elseif ( is_month() ) : printf( esc_html__( 'Month: %s', "proradio" ), esc_html(get_the_date( 'F Y' ))  );
	elseif ( is_year() ) :  printf( esc_html__( 'Year: %s', "proradio" ), esc_html(get_the_date( 'Y' ))  );
	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) : esc_html_e( 'Asides', "proradio" );
	elseif ( is_tax( 'post_format', 'post-format-image' ) ) : esc_html_e( 'Images', "proradio");
	elseif ( is_tax( 'post_format', 'post-format-video' ) ) : esc_html_e( 'Videos', "proradio" );
	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) : esc_html_e( 'Quotes', "proradio" );
	elseif ( is_tax( 'post_format', 'post-format-link' ) ) : esc_html_e( 'Links', "proradio" );
	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) : esc_html_e( 'Galleries', "proradio" );
	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) : esc_html_e( 'Sounds', "proradio" );
	elseif (is_post_type_archive( 'podcast' ) || is_tax('podcastfilter')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Podcast","proradio"); 
			}
	elseif (is_post_type_archive( 'event' ) || is_tax('eventtype')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Events","proradio"); 
			}
	elseif (is_post_type_archive( 'qtvideo' ) || is_tax('vdl_filters')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Videos","proradio"); 
			}
	elseif (is_post_type_archive( 'members' ) || is_tax('membertype')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Team","proradio"); 
			}
	elseif (is_post_type_archive( 'chart' ) || is_tax('chartcategory')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Charts","proradio"); 
			}
	elseif (is_post_type_archive( 'shows' ) || is_tax('genre')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Shows","proradio"); 
			}
	elseif (is_post_type_archive( 'proradio_testimonial' ) || is_tax('proradio_testimonialcat')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Testimonial","proradio"); 
			}
	elseif (is_post_type_archive( 'place' ) || is_tax('pcategory')):      
			$termname = '';
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if(is_object($term)){
				echo esc_html($term->name).' ';
			} else {
				esc_html_e("Venues","proradio"); 
			}

	
	// WooCommerce categories
	elseif(  is_tax( 'product_cat' )  || is_tax( 'product_tag' ) ) :
		$termname = '';
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if(is_object($term)){
			echo esc_html($term->name).' ';
		} else {
			esc_html_e("Products","proradio"); 
		}
	// WooCommerce
	elseif( proradio_is_shop() ) : 
		echo esc_html( proradio_shop_title() );// the function has already the translation inside
		


	else: esc_html_e( 'Blog', "proradio" );
	endif;


	$output = ob_get_clean();
	return $output;
}
