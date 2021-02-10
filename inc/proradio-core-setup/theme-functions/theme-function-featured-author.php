<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Theme function for custom parts:
 * Featured author
 *
 * Example:
 * [qt-featured-author id="0"]
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists( 'proradio_template_featured_author' )){
	function proradio_template_featured_author( $atts = array() ){
		extract( shortcode_atts( array(
			'id'	=> false
		), $atts ) );
		ob_start();
		// Output start
		?>
		<div class="proradio-container">
			<?php  
			if( !$id ){
				$query = array(
					'blog_id'      => $GLOBALS['blog_id'],
					'orderby'      => 'post_count', // nicename // registered
					'order'        => 'DESC', // ASC
					'offset'       => '',
					'search'       => '',
					'number'       => 1, // HOW MANY
					'count_total'  => false,
					'fields'       => 'ID',
					'who'          => 'subscriber', // subscriber
					'class' 		=> ''
				);
				$blogusers = get_users( $query );
				if(is_array( $blogusers )){	
					$id =  $blogusers[0]; 
				}
			}
			set_query_var( 'proradio_featuredauthor_id', $id );
			get_template_part( 'template-parts/author/featured-author' ); 
			remove_query_arg( 'proradio_var_series_amount' );
			?>
		</div>
		<?php

		$output = ob_get_clean();
		
		return $output;
		
	}
}

// Set TTG Core shortcode functionality
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-featured-author","proradio_template_featured_author");
}


/**
 *  Visual Composer / Page Builder integration
 */
if(!function_exists('proradio_template_featured_author_vc')){
	add_action( 'vc_before_init', 'proradio_template_featured_author_vc' );
	function proradio_template_featured_author_vc() {
		vc_map( 
			array(
				"name" 			=> esc_html__( "Featured author", "proradio" ),
				"base" 			=> "qt-featured-author",
				"icon" 			=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/featured-author.png' ),
				"description" 	=> esc_html__( "Display a single featured author", "proradio" ),
				"category" 		=> esc_html__( "Theme shortcodes", "proradio"),
				"params" 		=> array(
					array(
					   "type" 			=> "textfield",
					   "heading" 		=> esc_html__( "User ID", "proradio" ),
					   "param_name" 	=> "id",
					   "description" 	=> esc_html__( "If empty, the author with most posts will be used.", "proradio" )
					),
				)
			)
		);
	}
}