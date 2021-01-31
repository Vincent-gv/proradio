<?php  
/**
 * [$category slug of taxonomy]
 * @var [string]
 */
$show_members_pick = get_post_meta( get_the_ID(), 'show_members_pick', true );
if(is_array($show_members_pick)){
	if(count($show_members_pick) > 0){
		$members_array = '';
		if(array_key_exists('showmember', $show_members_pick[0])){

			if($show_members_pick[0]['showmember'][0]){

				foreach($show_members_pick as $arr => $s){
					$members_array .= $s['showmember'][0].',';
				}
				?>
				<!-- ======================= MANUALLY ASSOCIATED MEMBERS ======================= -->
				<div class="proradio-container">
					<hr class="proradio-spacer-m">
					<h4 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo get_the_title().' ' .esc_attr__("crew","proradio"); ?></span></h4>
					<hr class="proradio-spacer-s">
					<?php 
					if( count( $show_members_pick ) == 1 ){
						echo do_shortcode('[qt-post-hero post_type="members" include_by_id="'.rtrim($members_array,',').'"]' );
					} else {
						if(shortcode_exists('qt-post-carousel' )){
							echo do_shortcode('[qt-post-carousel items_per_row_desktop="3" autoplay="false" center="false" post_type="members" include_by_id="'.rtrim($members_array,',').'"]' );
						}
					}
					?>
					<hr class="proradio-spacer-s"><hr class="proradio-spacer-m">
				</div>

				<!-- ======================= RELATED MEMBERS END ======================= -->
				<?php
			}
		}
	}
}  