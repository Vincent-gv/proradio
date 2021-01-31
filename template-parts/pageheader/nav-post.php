<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

/**
 * ==============================================================
 * Special proradio navigation links:
 * --------------------------------------------------------------
 * if is a podcast and is within a serie, the next and previous will be taken from that same serie,
 * otherwise normal previous chronological post.
 * ==============================================================
 */
$in_same_term = false;
$taxonomy = 'category' ;
$excluded_terms = '';
if( function_exists( 'proradio_series_custom_series_name' ) ){
	$related_taxonomy = proradio_series_custom_series_name();
	$format = get_post_format();
	$terms = get_the_terms( $post->ID  , $related_taxonomy, 'string');
	if( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		if(is_array($terms)) {
			$in_same_term = true;
			$taxonomy = $related_taxonomy;
		}
	}
}

// Extract objects because we make custom HTML
$prev_post_obj = get_adjacent_post( $in_same_term, $excluded_terms, true, $taxonomy );
$next_post_obj = get_adjacent_post( $in_same_term, $excluded_terms, false, $taxonomy );


// Previous
$prev_post_ID   	= isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
$prev_post_link     = get_permalink( $prev_post_ID );
$prev_post_title    = get_the_title( $prev_post_ID ); // equals "»"

// Next
$next_post_ID   	= isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';
$next_post_link     = get_permalink( $next_post_ID );
$next_post_title    = get_the_title( $next_post_ID ); // equals "»"

?>
<div class="proradio-pageheader__nav-post">
	<div class="proradio-pageheader__nav-container">
		<a href="<?php echo esc_url( $prev_post_link ); ?>" rel="next" class="proradio-prev prev">
		    <span class="proradio-arr"><i class="material-icons">trending_flat</i> <?php esc_html_e('Prev', 'proradio'); ?></span>
		    <span class="proradio-tit"><?php echo esc_html( $prev_post_title ); ?></span>
		</a>
		<a href="<?php echo esc_url( $next_post_link ); ?>" rel="next" class="proradio-next next">
		    <span class="proradio-tit"><?php echo esc_html( $next_post_title ); ?></span>
		    <span class="proradio-arr"><?php esc_html_e('Next', 'proradio'); ?> <i class="material-icons">trending_flat</i></span>
		</a>
	</div>
</div>