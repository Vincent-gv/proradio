<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * ======================================================
 * Post categories template output
 * ------------------------------------------------------
 * Display post categories
 * ======================================================
 */

if(!function_exists('proradio_postcategories')){
function proradio_postcategories( $quantity = 1, $tax = 'category', $print = true){
	ob_start();

	$result = false;
	if( $tax == 'category' ){
		$categories = get_the_category(); 
	} else {
		$categories =  get_the_terms( get_the_ID(), $tax );
		if ( ! $categories || is_wp_error( $categories ) ) {
	    	$categories = array();
	    }
	    // from https://core.trac.wordpress.org/browser/tags/5.2.1/src/wp-includes/category-template.php#L0
	    $categories = array_values( $categories );
	    if(function_exists('_make_cat_compat')){
		    foreach ( array_keys( $categories ) as $key ) {
				_make_cat_compat( $categories[ $key ] );
			}
		}
	}
	
	if( count($categories) > 0 ){
		$limit = $quantity - 1 ;
		foreach($categories as $i => $cat){
			if($i <= $limit){	
				?><a href="<?php echo get_category_link($cat->term_id ); ?>" class="proradio-catid-<?php echo esc_attr($cat->term_id ); ?>"><?php echo esc_html($cat->cat_name); ?></a><?php
			}
		}
	}
	$result = ob_get_clean();
	if( $print ){
		echo wp_kses_post( $result );
	}
	else {
		return $result;
	}
}}
