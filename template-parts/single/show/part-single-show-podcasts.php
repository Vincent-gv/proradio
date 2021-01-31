<?php  
$podcastfilter = get_post_meta( get_the_ID(), 'show_podcastfilter', true );
if($podcastfilter != ''){
	if( $podcastfilter !=='all' ){ $podcastfilter = 'podcastfilter:'.$podcastfilter;}

	$html_output = false;
	if(shortcode_exists('qt-post-grid' )){
		$html_output = do_shortcode('[qt-post-grid post_type="podcast" items_per_page="3" e_loadmore="true" tax_filter="'.$podcastfilter.'" cols_l="3" cols_m="3"]' );
	}
	if($html_output){
		?>
		<div class="proradio-section">
			<div class="proradio-container">
				<h4 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo esc_attr__("Show episodes","proradio"); ?></span></h4>
				<hr class="proradio-spacer-s">
				<?php 
				echo $html_output;
				?>
			</div>
		</div>
		<?php 
	}
}