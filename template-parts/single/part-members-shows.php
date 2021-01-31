<?php  
/**
 * [$category slug of taxonomy]
 * @var [string]
 */
$members_show_pick = get_post_meta( get_the_ID(), 'members_show_pick', $single = true );
if(is_array($members_show_pick)){
	if(count($members_show_pick) > 0){
		$shows_array = '';
		if(array_key_exists('membershow', $members_show_pick[0])){
			if($members_show_pick[0]['membershow'][0]){

				foreach($members_show_pick as $arr => $s){
					$shows_array .= $s['membershow'][0].',';
				}
				
				if(shortcode_exists('qt-slideshow' )){
					?><div class="proradio-container">
					<?php 
					echo do_shortcode('[qt-post-hero post_type="show" dots="false" fullwidth="false" loop="false" include_by_id="'.rtrim($shows_array,',').'"]' );
					?>
					</div>
					<hr class="proradio-spacer-s">
					<hr class="proradio-spacer-s">
					<?php
					
				}
				
			}
		}
	}
}  