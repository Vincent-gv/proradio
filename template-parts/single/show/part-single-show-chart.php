<?php  
/**
 * Music charts
 */
$chartcategory = get_post_meta( get_the_ID(), 'show_chartcategory', true );
if($chartcategory != ''){

	$html_output = false;
	
	if( $chartcategory == 'all'){$chartcategory = '';}

	if(shortcode_exists('qt-chart' )){
		$html_output = do_shortcode('[qt-chart number="3" chartcategory="'.$chartcategory.'"]' );
	}

	if($html_output){
		?>
		<div class="proradio-container">
			<h4 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo get_the_title().' ' .esc_attr__("charts","proradio"); ?></span></h4>
			<hr class="proradio-spacer-s">
			<?php 
			echo $html_output;
			?>
			<hr class="proradio-spacer-m">
		</div>
		<?php 
	}
}  

?>