<?php 
/*
Package: proradio
Description: part chart teaser (limited tracks)
Version: 0.0.0
Author: ProRadio
Author URI: http://proradio.com
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if(!function_exists('proradio_chart_array_orderby')){
function proradio_chart_array_orderby(){

    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}
}


if(!function_exists('proradio_chart_tracklist')) {
	function proradio_chart_tracklist($atts){
		extract( shortcode_atts( array(
				'show_link' => 'yes',
				'chart_id' => false,
				'id' => false,
				'number' => 100,
				'showtitle' => false,
				'chartcategory' => false,
				'chartstyle' => 'chart-normal',
				'showthumbnail' => false
		), $atts ) );

		if(!is_numeric($number)){
			$number = 100;
		}
		if(!is_numeric($id)){
			$id = false;
		}
		if( $chart_id ){
			$id = $chart_id;
		}

		if(false == $id){
			$args = array(
				'post_type' => 'chart',
				'posts_per_page' => 1,
				'post_status' => 'publish',
				'orderby' => array ( 'menu_order' => 'ASC', 'date' => 'DESC'),
				'paged' => 1,
				'suppress_filters' => false,
				'ignore_sticky_posts' => 1
			);

			if(false !== $chartcategory && '' !== $chartcategory){
				$args[ 'tax_query'] = array(
						array(
						'taxonomy' => 'chartcategory',
						'field' => 'slug',
						'terms' => array(esc_attr($chartcategory)),
						'operator'=> 'IN' //Or 'AND' or 'NOT IN'
					)
				);
			}
		} else {
			$args = array(
			'p' => esc_attr($id), 
			'post_type' => 'chart');
		}
		ob_start();
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			$events= get_post_meta(get_the_ID(), 'track_repeatable', true);   
			$total = count($events);
			if(is_array($events)){


				if($showtitle){
					?>
					<h4 class="qt-title">
					<?php the_title(); ?>
					</h4>
					<?php
				}
				if($showthumbnail){
					?><a href="<?php the_permalink(); ?>" alt="<?php esc_attr_e("Chart image", 'proradio'); ?>" class="qt-short-chart-featured"><?php  
					the_post_thumbnail('medium', array("class" => "qt-featuredimage") );
					?></a><?php  
				}

				$pos = 1;
				$counter = 0;
				$trackid = 0;

				/**
				 * Set ID and rating in the tracks attributes
				 */
				for( $ti = 0; $ti < count( $events ); $ti++ ){
					$events[$ti]['trackid'] = $ti;
					if(!array_key_exists('releasetrack_rating', $events[$ti])) {
						$events[$ti]['releasetrack_rating'] = 0;
					}
				}

				if( get_theme_mod( 'chart_reorder' ) ){
					$events = proradio_chart_array_orderby($events, 'releasetrack_rating', SORT_DESC, 'trackid', SORT_ASC);
				}

				?>
				<!-- CHART TRACKLIST -->
				<ul class="qt-collapsible proradio-chart-tracklist <?php echo "proradio-".esc_attr($chartstyle); ?>" data-collapsible="accordion">
				<?php  

				foreach($events as $event){ 
					if($number <= $counter) {
						break;
					}
					$counter = $counter +1;
					$neededEvents = array('releasetrack_track_title','releasetrack_scurl','releasetrack_buyurl','releasetrack_artist_name','releasetrack_img');
					foreach($neededEvents as $n){
						if(!array_key_exists( $n,$events )){
							$events[$n] = '';
						}
					}
					?>
					<li id="chartItem<?php echo esc_attr($pos); ?>" class="qt-collapsible-item proradio-paper proradio-part-chart proradio-chart-track proradio-card">
						<div class="proradio-chart-table collapsible-header qt-content-primary">
							<div class="proradio-position qt-content-primary-dark">
								<?php 
								if($event['releasetrack_img'] != ''){
									$img = wp_get_attachment_image_src($event['releasetrack_img'],'post-thumbnail');
									if($img){
										?>
										<img src="<?php echo esc_url($img[0]); ?>" class="proradio-chart-cover" alt="Chart track" width="<?php echo esc_attr($img[1]); ?>" height="<?php echo esc_attr($img[2]); ?>">
										<?php
									}
								}   
								?>
								<p class="proradio-capfont "><?php echo esc_attr($pos); ?></p>
							</div>

							<?php 
							if($chartstyle !== 'chart-small'){
								if(!array_key_exists('releasetrack_rating', $event)) {
									 $event['releasetrack_rating'] = 0;
								}
								if(function_exists('qt_chartvote_buttons')){ 
									// 2020 11 26 replaced $trackid with $event['trackid']
									echo qt_chartvote_buttons(get_the_ID(), $event['trackid'], $event['releasetrack_rating']);
								}
							}
							?>
							<div class="proradio-titles">
								<?php if($chartstyle == 'chart-normal'){ ?>
									<h4 class="proradio-cutme-t"><?php echo esc_attr($event['releasetrack_track_title']); ?></h4>
								<?php } else { ?>
									<h5 class="proradio-cutme-t"><?php echo esc_attr($event['releasetrack_track_title']); ?></h5>
								<?php } ?>

								<p class="proradio-itemmetas"><?php echo esc_attr($event['releasetrack_artist_name']); ?></p>
							</div>
							<div class="proradio-action">

								<?php 
								if($event['releasetrack_buyurl'] !== ''){ 
									/**
									 *
									 * WooCommerce update:
									 *
									 */
									$buylink = $event['releasetrack_buyurl'];
									if(is_numeric($buylink)) {
										$prodid = $buylink;
										$buylink = add_query_arg("add-to-cart" ,   $buylink, get_the_permalink());
										?>
										<a href="<?php echo esc_url($buylink); ?>" data-quantity="1" data-product_id="<?php echo esc_attr($prodid); ?>" class="proradio-btns qt-content-primary qt-cart product_type_simple add_to_cart_button ajax_add_to_cart"><i class='material-icons'>add_shopping_cart</i></a>
										<?php  
									} else {
										?>
										<a href="<?php echo esc_url($buylink); ?>" class="proradio-btns qt-content-primary" target="_blank"><i class='material-icons'>add_shopping_cart</i></a>
										<?php
									}
								} 
								?>
							</div>
						</div>
						<?php if($event['releasetrack_scurl'] != ''){ ?>
							<div id="chartPlayer<?php echo esc_attr($pos); ?>" class="collapsible-body proradio-paper">
								<?php 

								$link = $event['releasetrack_scurl'];

								if(is_numeric($link)){
									$link = wp_get_attachment_url( intval( $link ) );
								} 


								if($link!=''){
									$regex_mp3 = "/.mp3/";
									if ( preg_match ( $regex_mp3 , $link  ) ) {
										if(function_exists('qtmplayer_create_singletrack')){
											$img = wp_get_attachment_image_src($event['releasetrack_img'],'post-thumbnail');
											$track = array(
												'img_id' 		=> ( $event['releasetrack_img'] != '' ) ? $event['releasetrack_img'] : false,
												'title'			=> $event['releasetrack_track_title'],
												'artist_name'	=> $event['releasetrack_artist_name'],
												'album'			=> $wp_query->post->post_title,
												'buyurl'		=> $event['releasetrack_buyurl'],
												'icon'			=> 'open_in_browser',
												'link'			=> get_the_permalink($wp_query->post->ID),
												'file'			=> $link,
											);
											echo qtmplayer_create_singletrack( $track );
										} else {
											echo esc_html__( 'Missing QtMusicPlayer plugin', 'proradio' );
										}
									} else {
										// If is not MP3 we rely on the javascript autoembed of the theme
										?>
										<div data-autoembed="<?php echo esc_url( $link ); ?>"></div>
										<?php  
									}
								} 

								?>
							</div>
						<?php } ?>

					</li>
					<?php 
					$pos = $pos+1;
				}//foreach
				?>
				</ul>
				<!-- CHART TRACKLIST END -->
				<?php  

			}//end debuf if


			/**
			 *
			 *	If the total amount of tracks is more than the number we show, add button to single chart page
			 * 
			 */
			if($total > $number && $show_link == 'yes'){
				?>
				<p class="<?php if($chartstyle == "chart-normal") { ?>aligncenter proradio-spacer-s<?php } ?>">
					<a class="proradio-btn <?php if($chartstyle == "chart-normal") { ?> proradio-btn__m <?php } else { ?>proradio-btn__s<?php } ?> qt-btn-primary" href="<?php the_permalink(); ?>"><?php echo esc_attr__("Full tracklist","proradio"); ?></a>
				</p>
				<?php
			}
			
		endwhile; endif;
		wp_reset_postdata();
		return ob_get_clean();
	}

	// Set TTG Core shortcode functionality
	if(function_exists('proradio_core_custom_shortcode')) {
		proradio_core_custom_shortcode("qt-chart","proradio_chart_tracklist");
	}

	/**
	 *  Visual Composer integration
	 */
	
	if(!function_exists('proradio_vc_proradio_chart_tracklist')){
		add_action( 'vc_before_init', 'proradio_vc_proradio_chart_tracklist' );
		function proradio_vc_proradio_chart_tracklist() {
		  vc_map( array(
			 "name" => esc_html__( "Chart tracks", "proradio" ),
			 "base" => "qt-chart",
			 // "icon" => get_theme_file_uri( '/inc/proradio-core-setup/theme-functions/img/category-grid.png' ),
			 "description" => esc_html__( "Display the tracks of the latest chart or specify a chart by id.", "proradio" ),
			 "category" => esc_html__( "Theme shortcodes", "proradio"),
			 "params" => array(
				array(
				   "type" => "textfield",
				   "heading" => esc_html__( "ID", "proradio" ),
				   "description" => esc_html__( "Optional Chart ID, if not specified will always show the latest chart by menu order or publish date", "proradio" ),
				   "param_name" => "id",
				   'value' => ''
				),
				array(
				   "type" => "textfield",
				   "heading" => esc_html__( "Number of tracks (default: 100)", "proradio" ),
				   "param_name" => "number",
				),
				array(
				   "type" => "checkbox",
				   "heading" => esc_html__( "Show chart title", "proradio" ),
				   "description" => esc_html__( "Display the title of the chart", "proradio" ),
				   "param_name" => "showtitle",
				),
				array(
				   "type" => "checkbox",
				   "heading" => esc_html__( "Featured image", "proradio" ),
				   "description" => esc_html__( "Display the image linked to the full chart", "proradio" ),
				   "param_name" => "showthumbnail",
				),
				array(
				   "type" => "dropdown",
				   "heading" => esc_html__( "Chart style", "proradio" ),
				   "param_name" => "chartstyle",
				   'value' => array("chart-normal","chart-small"),
				   "description" => esc_html__( "Chart visualization style", "proradio" )
				)
			 )
		  ) );
		}
	}
}
