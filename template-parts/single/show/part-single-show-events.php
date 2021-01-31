<?php
$eventtype = get_post_meta( get_the_ID(), 'show_eventslist', true );
if($eventtype != ''){
	if( $eventtype !=='all' ){ $eventtype = 'eventtype:'.$eventtype; }
	$html_output = false;
	if(shortcode_exists('qt-events' )){
		$html_output = do_shortcode('[qt-events items_per_page="1" e_loadmore="true" tax_filter="'.$eventtype.'" hideold="true"]' );
	}
	if($html_output){
		?>
		<div class="proradio-container">
			<hr class="proradio-spacer-m">
			<h4 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo get_the_title().' ' .esc_attr__("events","proradio"); ?></span></h4>
			<hr class="proradio-spacer-s">
			<?php 
			echo $html_output;
			?>
		</div>
		<?php 
	}
}  