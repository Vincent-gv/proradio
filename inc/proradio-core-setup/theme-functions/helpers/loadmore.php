<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * ====================
 * Load More button
 * Place after while loop
 * ====================
 */
if( $e_loadmore ){
	 /**
	 * 
	 * Variables for the "Load more"
	 *
	 * 
	 * @var [id] data-container
	 */
	$container = "#".$list_id;
	
	$callback = "fn.qtMasonry";
	$idbutton = $list_id."qtPostLoadmore";
	// get current URL
	global $wp;
	$current_url = home_url( add_query_arg( array(), $wp->request ) );

	// calculate new page id
	
	if( isset( $_GET ) ){
		if( isset(  $_GET[ $list_id ] ) ){
			if( intval( $_GET[ $list_id ] ) > 0){
				$newpage = intval( $_GET[ $list_id ] ) + 1;
			}
		} else {
			$newpage = 2;
		}
	} else {
		$newpage = 2;
	}

	$link = add_query_arg($list_id, intval($newpage), $current_url);
	$max = $wp_query->max_num_pages;
	if( $newpage <= $max): ?>   
		<div class="proradio-wp-pagination">
			<p class="proradio-loadmore-container proradio-clearfix">
				<a data-proradio-loadmore="#<?php echo esc_attr( $list_id ); ?>" data-buttonid="<?php echo esc_attr($idbutton); ?>" data-container="<?php echo esc_attr($container); ?>" data-callback="<?php echo esc_attr($callback); ?>" data-next-url="<?php esc_js( $link ); ?>" href="<?php echo esc_url( $link ); ?>"  class="proradio-btn proradio-center noajax">
				   <span><?php esc_html_e("Load more", "proradio"); ?></span><i class='material-icons'>sync</i>
				</a>
			</p>
		</div>
	<?php 
	endif; 
}
?>