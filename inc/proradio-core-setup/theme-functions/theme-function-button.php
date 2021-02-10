<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.5.4
 * Theme function for custom parts:
 * Custom Buttons
 *
 * Example:
 * [qt-button text="Click here" link="http" target="_blank" style="proradio-btn-primary" alignment="left|aligncenter|right" class="custom-classes"]
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists( 'proradio_template_button' )){
	function proradio_template_button( $atts = array() ){
		extract( shortcode_atts( array(
			'text' => false,
			'playradio' => false,
			'proradio_showicon' => false,
			'radio_id' => false,
			'link' => '#',
			'target' => '',
			'style' => '',
			'popup_w' => '300',
			'popup_h' => '300',
			'alignment' => '',
			'size'		=> '',
			'css_class' => ''
		), $atts ) );




		ob_start();
			if( $playradio ){
				
				if( function_exists('qtmplayer_play_button')){

					if(!$radio_id){

						$args = array(
							'post_type' 			=> 'radiochannel',
							'post_status' 			=> 'publish',
							'suppress_filters' 		=> false,
							'ignore_sticky_posts' 	=> 1,
							'posts_per_page' 		=> 1,
							'paged' 				=> 1,
							'orderby' 				=> array ('menu_order' => 'ASC', 'date' => 'DESC')
						);

						/**
						 * [$wp_query execution of the query]
						 * @var WP_Query
						 */
						$wp_query = new WP_Query( $args );
						if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$post = $wp_query->post;
							$radio_id = $post->ID;

						endwhile;endif;

					}
					if($radio_id){
						$atts = array(
							'button_text' => $text,
							'file'		=> false,
							'id' 		=> $radio_id, // the post id
							// 'content' 	=> 'proradio-btn proradio-btn-primary',
							'classes' 	=> 'proradio-btn '.$style.' '.$alignment.' '.$css_class.' '.$size, // additional classes for the play circle
						);
						if( $alignment == 'aligncenter' || $alignment == 'center' ){ 
							?><div class="aligncenter"><?php 
						} 
						echo qtmplayer_play_button( $atts );
					}
					if($alignment == 'aligncenter'){ 
						?></div><?php 
					} 
					wp_reset_postdata();
				} else {
					echo 'Missing player';
				}
			} else {
				if( $alignment == 'aligncenter' || $alignment == 'center' ){ 
					?> <p class="aligncenter"><?php 
				} 

				// @since 1.4.5 popup function
				$popup_atts = '';
				if( 'popup' == $target ){
					$css_class .= ' proradio-popupwindow ';
					if(is_array($popup_w)){
						$popup_w = $popup_w['size'];
					}
					if(is_array($popup_h)){
						$popup_h = $popup_h['size'];
					}
					$popup_atts = ' data-width="'.esc_attr($popup_w).'" data-height="'.esc_attr($popup_h).'" ';
				}



				?><a href="<?php echo esc_attr( $link ); ?>" <?php if( $target == "_blank" ){ ?> target="_blank" <?php } ?>  <?php if( 'popup' == $target ){ echo $popup_atts; } ?>
				class="proradio-btn <?php  echo esc_attr( $style.' '.$alignment.' '.$css_class.' '.$size ); ?>"><span><?php  
				echo esc_html($text); ?></span></a><?php 
				if($alignment == 'aligncenter'){ 
					?></p><?php 
				} 
			}
		
		return ob_get_clean();
	}


	// Set TTG Core shortcode functionality
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-button","proradio_template_button");
	}



	/**
	 *  Visual Composer integration
	 */
	
	if(!function_exists('proradio_template_button_vc')){
		add_action( 'vc_before_init', 'proradio_template_button_vc' );
		function proradio_template_button_vc() {
		  vc_map( array(
			"name" 			=> esc_html__( "Button", "proradio" ),
			"base" 			=> "qt-button",
			"icon" 			=> get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/button.png' ),
			"description" 	=> esc_html__( "Add a button with link", "proradio" ),
			"category" 		=> esc_html__( "Theme shortcodes", "proradio"),
			"params" 		=> array(
					array(
						'type' 		=> 'textfield',
						'value' 	=> '',
						'heading' 	=> esc_html__( 'Text', 'proradio' ),
						'param_name'=> 'text',
					),
					array(
						'type' 		=> 'textfield',
						'value' 	=> '',
						'heading'	=> esc_html__( 'Link', 'proradio' ),
						'param_name'=> 'link',
					),
					array(
						"type" 		=> "dropdown",
						"heading" 	=> esc_html__( "Link target", "proradio" ),
						"param_name"=> "target",
						'value' 	=> array( 
							esc_html__( "Same window","proradio") 	=> "",
							esc_html__( "New window","proradio") 	=> "_blank",
							)			
						),
					array(
						"type" 		=> "dropdown",
						"heading" 	=> esc_html__( "Size", "proradio" ),
						"param_name"=> "size",
						'value' 	=> array( 
							esc_html__( "Default","proradio") 	=> "",
							esc_html__( "Large","proradio") 	=> "proradio-btn__l",
							)			
						),

					array(
						"type" 		=> "dropdown",
						"heading" 	=> esc_html__( "Button style", "proradio" ),
						"param_name"=> "style",
						'value' 	=> array( 
							esc_html__( "Default","proradio") 	=> "proradio-btn-default",
							esc_html__( "Primary","proradio") 	=> "proradio-btn-primary",
							esc_html__( "White","proradio") 	=> "proradio-btn__white",
							esc_html__( "Bold","proradio") 		=> "proradio-btn__bold",
							esc_html__( "Text only","proradio") => "proradio-btn__txt"
							)			
						),
					array(
						"type" 			=> "dropdown",
						"heading" 		=> esc_html__( "Alignment", "proradio" ),
						"param_name"	=> "alignment",
						'value' 		=> array( 
										esc_html__( "Default","proradio") 	=> "",
										esc_html__( "Left","proradio") 		=> "alignleft",
										esc_html__( "Right","proradio") 	=> "alignright",
										esc_html__( "Center","proradio") 	=> "aligncenter",
										),
						"description" 	=> esc_html__( "Button style", "proradio" )
					),
					array(
						"type" 			=> "textfield",
						"heading" 		=> esc_html__( "Class", "proradio" ),
						"param_name" 	=> "css_class",
						'value' 		=> '',
						'description' 	=> esc_html__( "Add an extra class for CSS styling", "proradio" )
					)
				)
		  	));
		}
	}
}
