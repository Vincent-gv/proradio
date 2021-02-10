<?php  
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 *
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * 
 * Caption medium
 * =============================================
 */
if(!function_exists('proradio_herolist')){
	function proradio_herolist ($atts){
		extract( shortcode_atts( array(
			'items' => array(),
			'class' => '',
		), $atts ) );
		

		if(is_array($atts)){
			if(array_key_exists("items", $atts)){
				if( is_array($atts['items']) && count($atts['items']) > 0 ){
					if( !is_array($atts['items'][0]  ) ){
						if(function_exists('vc_param_group_parse_atts') ){
							$items = vc_param_group_parse_atts( $atts['items'] );
						}
					}
				}
			}
		}
	

		ob_start();
		?>
		<div class="proradio-herolist <?php echo esc_html($class); ?>">
			<?php 
			if( is_array( $items ) ){
				foreach( $items as $item ){
					if( array_key_exists( "text", $item ) ){ 
						?>
						<p><span class="proradio-btn proradio-btn__r"><i class="material-icons">check</i></span> <?php echo esc_html( $item["text"] ); ?></p>
						<?php	
					}
				}
			}
			?>
		</div>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-herolist","proradio_herolist");
}
/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_vc_herolist' );
if(!function_exists('proradio_vc_herolist')){
	function proradio_vc_herolist() {
	  vc_map( array(
		 "name" 		=> esc_html__( "Hero List", "proradio" ),
		 "base" 		=> "qt-herolist",
		 "icon" 		=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/herolist.png' ),
		 "description" 	=> esc_html__( "Title with bullet list", "proradio" ),
		 "category" 	=> esc_html__( "Theme shortcodes", "proradio"),
		 "params" 		=> array(
			array(
				'type' 			=> 'param_group',
				'value' 		=> '',
				'param_name' 	=> 'items',
				'params' 		=> array(
					array(
						'type' 			=> 'textfield',
						'value' 		=> '',
						'heading' 		=> esc_html__('Enter item content', 'proradio'),
						'param_name' 	=> 'text',
					)
				)
			),
			array(
				"type" 			=> "textfield",
				"heading" 		=> esc_html__( "Class", "proradio" ),
				'description' 	=> esc_html__( "Add an extra class for CSS styling", "proradio" ),
				"param_name" 	=> "class",
				'value' 		=> '',
			)
		 )
	  ) );
	}
}
