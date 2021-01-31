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
		if(!array_key_exists($n,$events)){
			$events[$n] = '';
		}
	}
	?>
	<li id="chartItem<?php echo esc_attr($pos); ?>" class="qt-collapsible-item proradio-part-chart proradio-chart-track proradio-card-s">
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
				<p class="proradio-capfont proradio-text-shadow"><?php echo esc_attr($pos); ?></p>
			</div>

			<?php 
			if($chartstyle !== 'chart-small'){
				if(!array_key_exists('releasetrack_rating', $event)) {
					 $event['releasetrack_rating'] = 0;
				}
				if(function_exists('qt_chartvote_buttons')){ 
					echo qt_chartvote_buttons(get_the_ID(), $trackid, $event['releasetrack_rating']);
					$trackid = $trackid +1;
				}
			}
			?>
			<div class="proradio-titles">
				<?php if($chartstyle == 'chart-notmal'){ ?>
					<h4 class="proradio-cutme-t-2"><?php echo esc_attr($event['releasetrack_track_title']); ?></h4>
				<?php } else { ?>
					<h5 class="proradio-cutme-t-2"><?php echo esc_attr($event['releasetrack_track_title']); ?></h5>
				<?php } ?>

				<p><?php echo esc_attr($event['releasetrack_artist_name']); ?></p>
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
				//======================= PLAYER ======================
				$pUrl =$event['releasetrack_scurl'];
				if($pUrl!=''){
					$regex_mp3 = "/.mp3/";
					$link = str_replace("https://","http://",$pUrl);
					if (preg_match ( $regex_mp3 , $link  )) {
						// echo do_shortcode('[audio src="'.esc_url($link ).'"]');
								
						?>
						<div class="qt-playlist-large">
							<ul class="qt-playlist qtmplayer-playlist">
								<li class="qtmplayer-trackitem qtmusicplayer-trackitem">
									<?php
									$pic = '';
									$tinythumb = false;
									if($event['releasetrack_img'] != ''){
										$tinythumb = wp_get_attachment_image_src($event['releasetrack_img'],'post-thumbnail');
										$tinythumb = $tinythumb[0];
										$pic = wp_get_attachment_image_src($event['releasetrack_img'],'medium');
										$pic = $pic[0];
									}


									if($tinythumb){
										?>
										<img src="<?php echo esc_url($tinythumb); ?>" alt="cover">
										<?php
									}
									?>
									<span class="qt-play qt-link-sec qtmusicplayer-play-btn" 
									data-qtmplayer-cover="<?php echo esc_attr( $pic ); ?>" 
									data-qtmplayer-file="<?php echo esc_url( $link); ?>" 
									data-qtmplayer-title="<?php echo esc_attr( $event['releasetrack_track_title'] ); ?>" 
									data-qtmplayer-artist="<?php  echo esc_attr( $event['releasetrack_artist_name'] ); ?>" 
									data-qtmplayer-album="" 
									data-qtmplayer-link="<?php the_permalink( get_the_id() ); ?>" 
									data-qtmplayer-buylink="<?php  echo esc_attr( $event['releasetrack_buyurl'] ); ?>" 
									data-qtmplayer-icon="open_in_browser" 
									><i class='material-icons'>play_circle_filled</i></span>
									<p>
										<span class="qt-tit"><?php echo esc_html(get_the_title()); ?></span><br>
										<span class="qt-art"><?php echo esc_html( $event['releasetrack_artist_name'] ); ?></span>
									</p>
								</li>
							</ul>
						</div>
						<?php


					} else {
						echo '<div data-autoembed="'. esc_url( $link ) .'"></div>';
					}
				} ?>
			</div>
		<?php } ?>

	</li>
	<?php 
	$pos = $pos+1;
}//foreach
?>
</ul>
<!-- CHART TRACKLIST END -->