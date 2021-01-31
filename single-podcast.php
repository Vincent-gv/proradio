<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single--podcast">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		set_query_var( 'proradio_header_wavescolor', get_theme_mod( 'proradio_paper', '#ffffff' ) ) ; // set waves color
		get_template_part( 'template-parts/pageheader/pageheader-podcast' ); 
		?>
		<div class="proradio-maincontent">
			<div class="proradio-section proradio-paper">
				<div class="proradio-container">
					<div class="proradio-featuredcontent">
						<?php 

						//======================= PLAYER ======================
						$link = esc_url( get_post_meta( $post->ID, '_podcast_resourceurl' ,true ) );
						// Find the classic Enclosure field
						if($link == ''){
							$link = get_post_meta( $post->ID, 'enclosure' ,true ) ;
						}
						// Find the first field containing the Enclosure word
						if($link==''){
							$all_metas = get_post_meta( $post->ID ) ;
							$key = preg_grep('/enclosure/', array_keys($all_metas));
							if( $key ){
								$value = $all_metas[current( $key )];
								if( is_array($value) && count($value) > 0 ){
									$file = $value[0];
									$arr2= explode("\n", $file );
									if( count( $arr2) > 1 ){
										$file = $arr2[0]; // should do the trick
									}
									if (strpos($file, '.mp3') !== false) {
									    $link = $file;
									}
								}
							}
						}
						if($link!=''){
							$regex_mp3 = "/.mp3/";
							if ( preg_match ( $regex_mp3 , $link  ) ) {
								if(function_exists('qtmplayer_create_singletrack')){
									$artist = get_post_meta( $post->ID, '_podcast_artist', true );
									if(!$artist || $artist == ''){
										$artist =  get_the_author_meta('nickname');
									}
									$track = array(
										'img_id' 		=> ( has_post_thumbnail( $post->ID ) ) ? get_post_thumbnail_id( $post->ID ) : false,
										'title'			=> esc_attr( $post->post_title ),
										'artist_name'	=> esc_attr( $artist ),
										'album'			=> get_post_meta( $post->ID, '_podcast_date', true ),
										'buyurl'		=> get_the_permalink($post->ID),
										'icon'			=> 'open_in_browser',
										'link'			=> get_the_permalink($post->ID),
										'file'			=> $link,
									);
									$player = qtmplayer_create_singletrack( $track );
									if( $player ){
										echo wp_kses_post( $player );
										?>
										<hr class="proradio-spacer-xxs">
										<?php
									}
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
					<div class="proradio-entrycontent">
						<div class="proradio-the_content">

							<?php 
							/**
							 * Editor content
							 */
							the_content();
							
							/**
							 * Taxonomy output
							 */
							$tags = proradio_postcategories( 20, 'podcastfilter', false );
							if( $tags ){
								?>
								<hr class="proradio-spacer-s">
								<p class="proradio-tags">
								<?php echo wp_kses_post( $tags ); ?>
								</p>
								<?php 
							}

							/**
							 * Post footer with share
							 */
							get_template_part( 'template-parts/single/part-content-footer' );
							?>
						</div>
					</div>
				</div>
			</div>
			<?php 
			/**
			 * Related
			 */
			if( get_theme_mod( 'related_podcast' )){
				get_template_part( 'template-parts/single/part-related-podcast' ); 
			}
			?>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();