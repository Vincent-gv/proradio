<?php  
/*
Package: proradio
Create a card with a
*/

if(!function_exists('proradio_radiocard_shortcode')){
	function proradio_radiocard_shortcode ($atts){
		extract( shortcode_atts( array(
			'include_by_id' => false,
		), $atts ) );
		ob_start();
		wp_reset_postdata();
		if( !$include_by_id ){
			return esc_html__( 'No ID selected', 'proradio' );
		}
		// Elementor widget compatibility
		if(is_array($include_by_id)){
			$include_by_id = $include_by_id[0];
		}
		
		if( !is_string( get_post_status( $include_by_id ) ) ){
			return esc_html__( 'Invalid ID', 'proradio' );
		}
		global $post;
		$post = get_post( intval( $include_by_id ) ); 
		if( !is_object($post) ):
			return esc_html__( 'Invalid ID', 'proradio' );
		else:
			setup_postdata( $post );
			get_template_part( 'template-parts/post/post-radiochannel' );
		endif;
		wp_reset_postdata();
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-radiocard","proradio_radiocard_shortcode");
}

/**
 *  Visual Composer integration
 */

if(!function_exists('proradio_vc_radiocard_shortcode')){
	add_action( 'vc_before_init', 'proradio_vc_radiocard_shortcode' );
	function proradio_vc_radiocard_shortcode() {
	  vc_map( array(
		"name" 			=> esc_html__( "Radio card", "proradio" ),
		"base" 			=> "qt-radiocard",
		"icon" 			=> get_template_directory_uri(). '/img/vc/button.png',
		"description" 	=> esc_html__( "Display a playable radio card for a channel", "proradio" ),
		"category" 		=> esc_html__( "Theme shortcodes", "proradio"),
		"params" 		=> array(
				array(
					'type' 			=> 'autocomplete',
					'heading' 		=> esc_html__( 'Channel', 'proradio'),
					'param_name' 	=> 'include_by_id',
					'settings'		=> array( 
						'values' 		=> proradio_autocomplete('radiochannel') ,
						'multiple'      => false,
						'sortable'      => false,
		          		'min_length'    => 1,
		          		'groups'        => false,  // In UI show results grouped by groups
		          		'unique_values' => true,  // In UI show results except selected. NB! You should manually check values in backend
		          		'display_inline'=> true, // In UI show results inline view),
					),
					'dependency' 	=> array(
						'element' 		=> 'post_type',
						'value' 		=> array( 'ids' ),
					),
				),
				
			)
	  	));
	}
}
