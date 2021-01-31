<?php  

$category = get_post_meta( get_the_ID(), 'show_category', true );
if($category != ''){
	
	if( $category !=='all' ){ $category = 'category:'.$category;}

	$html_output = false;
	if(shortcode_exists('qt-post-grid' )){
		$html_output = do_shortcode('[qt-post-grid post_type="post" items_per_page="3" e_loadmore="true" tax_filter="'.$category.'" cols_l="3" cols_m="3"]' );
	}
	if($html_output){
		?>
		<div class="proradio-container">
			<hr class="proradio-spacer-m">
			<h4 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo esc_attr__("Related news","proradio"); ?></span></h4>
			<hr class="proradio-spacer-s">
			<?php 
			echo $html_output;
			?>
		</div>
		<?php 
	}
} 