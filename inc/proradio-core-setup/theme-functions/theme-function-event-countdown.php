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

if(!function_exists('proradio_countdown_shortcode')) {
	function proradio_countdown_shortcode($atts){

		extract( shortcode_atts( array(
			'include_by_id' => false,
			'size' => '3',
			'align' => 'center',
			'labels' => false,
			'style' => 'default',
			'color_text' => false,
			'color_border' => false,
			'color_bg' => false,
			'color_bgn' => false,
			'bwidth' => false,
			'show_ms' => false
		), $atts ) );
	


		/**
		 * Output start
		 */
		ob_start();

		if( !$include_by_id ){
			return esc_html__( 'No ID selected', 'proradio' );
		}
		if(is_array( $include_by_id )){
			$include_by_id = $include_by_id[0];
		}

		if( !is_string( get_post_status( $include_by_id ) ) ){
			return esc_html__( 'Invalid ID', 'proradio' );
		}

		/**
		 * ========================================
		 * Create a unique ID for the custom css
		 * ========================================
		 */
		
		
		$cid = 'proradio-countdown--'.$include_by_id.'-'.$size.'-'.$align; 

		$css_styles = [];
		$selector = '.'.$cid;
		if( $color_text ) {
			$css_styles[] = $selector.' .proradio-countdown__container { color: '.esc_attr($color_text).'} ';
		}
		if( $color_border ) {
			$css_styles[] = $selector.'.proradio-countdown--bricks .proradio-countdown__i { border-color: '.esc_attr($color_border).'} ';
			$css_styles[] = $selector.'.proradio-countdown--boxed .proradio-countdown__container { border-color: '.esc_attr($color_border).'} ';
		}
		if( $color_bg ) {
			$css_styles[] = $selector.' .proradio-countdown__container { background-color: '.esc_attr($color_bg).'} ';
		}
		if( $color_bgn ) {
			$css_styles[] = $selector.' .proradio-countdown__i { background-color: '.esc_attr($color_bgn).'} ';
		}
		if( $bwidth ){
			$css_styles[] = $selector.'.proradio-countdown--bricks .proradio-countdown__i { border-width: '.esc_attr($bwidth).'} ';	
			$css_styles[] = $selector.'.proradio-countdown--boxed .proradio-countdown__container { border-width: '.esc_attr($bwidth).'} ';	
		}
		
		
		if( count( $css_styles ) > 0 ){
			$css_styles = implode(' ', $css_styles );
			?>
			<div data-proradio-customstyles="<?php echo wp_strip_all_tags( $css_styles ); ?>"></div>
			<?php 
		}

		$date = get_post_meta($include_by_id, 'proradio_date',true);


		$day = '';
		$monthyear = '';

		if($date && $date != ''){
			$day = date( "d", strtotime( $date ));
			$monthyear=esc_attr(date_i18n("M Y",strtotime($date)));
		}

		$time = get_post_meta($include_by_id, 'proradio_time',true);
		$now =  current_time("Y-m-d").'T'.current_time("H:i");
		$location = get_post_meta($include_by_id, 'proradio_location',true);
		$address = get_post_meta($include_by_id, 'proradio_address',true);

		$classes = array( 
			'proradio-countdown-shortcode'
		);

		if( $align ){
			$classes[] = 'proradio-countdown-shortcode--'.$align;
		}
		if( $style ){
			$classes[] = 'proradio-countdown--'.$style;
		}

		$classes[] = $cid;

		if( $labels == 'full' ){
			$classes[] 	= 	'proradio-countdown-shortcode--labels';
			$label_d 	=  	esc_html__( "Days",'proradio' );
			$label_h 	=  	esc_html__( "Hours",'proradio' );
			$label_m 	=  	esc_html__( "Minutes",'proradio' );
			$label_s 	=  	esc_html__( "Seconds",'proradio' );
			$label_ms 	=  	esc_html__( "Milliseconds",'proradio' );

		} else if ( $labels == 'inline' ){
			$classes[] 	= 	'proradio-countdown-shortcode--labels-inline';
			$label_d 	=   esc_html_x( 'D', 'Letter label for days', 'proradio' );
			$label_h 	=  	esc_html_x( 'H', 'Letter label for hours', 'proradio' );
			$label_m 	= 	esc_html_x( 'M', 'Letter label for minutes', 'proradio' );
			$label_s 	=  	esc_html_x( 'S', 'Letter label for seconds', 'proradio' );
			$label_ms 	=  	esc_html_x( 'MS', 'Letter label for milliseconds', 'proradio' );
		}

		$classes = implode(' ', $classes );

		if( $date && $date !== '' && $date > $now){
			?>
			<span id="<?php echo esc_attr( $cid ); ?>" class="<?php echo esc_attr( $classes ); ?>">
				<span class="proradio-countdown__container">
					<span class="proradio-countdown  proradio-countdown-size--<?php echo esc_attr( $size ); ?>" 
					data-proradio-date="<?php echo esc_attr( $date ); ?>" 
					data-proradio-time="<?php echo esc_attr( $time ); ?>" 
					data-proradio-now="<?php echo esc_attr( $now ); ?>">
						<span class="proradio-countdown__i d"><span class="n"></span><span class="l"><?php echo esc_html( $label_d ); ?></span></span>
						<span class="proradio-countdown__i h"><span class="n"></span><span class="l"><?php echo esc_html( $label_h ); ?></span></span>
						<span class="proradio-countdown__i m"><span class="n"></span><span class="l"><?php echo esc_html( $label_m ); ?></span></span>
						<span class="proradio-countdown__i s"><span class="n"></span><span class="l"><?php echo esc_html( $label_s ); ?></span></span>
						<?php if( $show_ms ){ ?><span class="proradio-countdown__i ms"><span class="n"></span><span class="l"><?php echo esc_html( $label_ms ); ?></span></span><?php } ?>
					</span>
				</span>
			</span>
			<?php  
		}
		/**
		 * Output end
		 */
		return ob_get_clean();
	}
}

if(function_exists('proradio_core_custom_shortcode')) {
	proradio_core_custom_shortcode("qt-countdown","proradio_countdown_shortcode");
}


/**
 *  Visual Composer integration
 */

if(!function_exists( 'proradio_countdown_shortcode_vc' ) ){
	add_action( 'vc_before_init', 'proradio_countdown_shortcode_vc' );
	function proradio_countdown_shortcode_vc() {
	  vc_map( array(
		 "name" => esc_html__( "Countdown", "proradio" ),
		 "base" => "qt-countdown",
		 "icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/events-featured.png' ),
		 "description" => esc_html__( "Show only a countdown", "proradio" ),
		 "category" => esc_html__( "Theme shortcodes", "proradio"),
		 "params" => array(
			array(
				'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Event', 'proradio'),
				'param_name' 	=> 'include_by_id',
				'settings'		=> array( 
					'values' 		=> proradio_autocomplete('event') ,
					'multiple'       => false,
					'sortable'       => false,
	          		'min_length'     => 1,
	          		'groups'         => false,  // In UI show results grouped by groups
	          		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
	          		'display_inline' => true, // In UI show results inline view),
				),
				'dependency' => array(
					'element' 		=> 'post_type',
					'value' 		=> array( 'ids' ),
				),
			),
			array(
				'heading' 	=> esc_html__( 'Labels', 'proradio'),
				"type" 		=> "dropdown",
				"param_name"=> "labels",		
				'std'		=> false,
				'value' 	=> array( 
					esc_html__('Hidden', 'proradio' ) 	=> false,
					esc_html__('Full', 'proradio' ) 	=> 'full',
					esc_html__('Inline', 'proradio' ) 	=> 'inline',
				)	
			),

			array(
				'heading' 	=> esc_html__( 'Show milliseconds', 'proradio'),
				"type" 		=> "checkbox",
				"param_name"=> "show_ms",		
				'std'		=> false,
				'value' 	=> 'true'
			),

			array(
				'heading' 	=> esc_html__( 'Size', 'proradio'),
				"type" 		=> "dropdown",
				"param_name"=> "size",
				'std'		=> '3',
				'value' 	=> array( 
					'1','2','3','4','5','6','7','8','9','10'
					)			
			),

			array(
				'heading' 	=> esc_html__( 'Align', 'proradio'),
				"type" 		=> "dropdown",
				"param_name"=> "align",
				'value' 	=> array( 
					esc_html__('inline', 'proradio' ) 	=>'inline',
					esc_html__('center', 'proradio' ) 	=>'center',
					esc_html__('left', 'proradio' ) 	=> 'left',
					esc_html__('right', 'proradio' ) 	=> 'right',
				)			
			),

			array(
				'heading' 	=> esc_html__( 'Style', 'proradio'),
				"type" 		=> "dropdown",
				"param_name"=> "style",
				'std'		=> 'default',
				'value' 	=> array( 
					esc_html__('Default', 'proradio' ) => 'default',
					esc_html__('Bricks', 'proradio' ) 	=> 'bricks',
					esc_html__('Boxed', 'proradio' ) 	=> 'boxed'
				)			
			),
			array(
				"group" 	=> esc_html__( "Colors", "proradio" ),
			   	"type" 		=> "colorpicker",
			   	"heading" 	=> esc_html__( "Text", "proradio" ),
			   	"param_name"=> "color_text"
			),
			array(
				"group" 	=> esc_html__( "Colors", "proradio" ),
			   "type" 		=> "colorpicker",
			   "heading" 	=> esc_html__( "Borders", "proradio" ),
			   "param_name" => "color_border"
			),
			array(
				"group" 	=> esc_html__( "Colors", "proradio" ),
				'heading' 	=> esc_html__( 'Borders width', 'proradio'),
				"type" 		=> "textfield",
				"param_name"=> "bwidth",
			),
			array(
				"group" 	=> esc_html__( "Colors", "proradio" ),
			   	"type" 		=> "colorpicker",
			   	"heading" 	=> esc_html__( "Background", "proradio" ),
			   	"param_name"=> "color_bg"
			),
			array(
				"group" 	=> esc_html__( "Colors", "proradio" ),
			   	"type" 		=> "colorpicker",
			   	"heading" 	=> esc_html__( "Numbers background", "proradio" ),
			   	"param_name"=> "color_bgn"
			),
		 )
	  ) );
	}
}