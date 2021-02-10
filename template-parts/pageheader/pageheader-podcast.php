<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
$title = proradio_get_title();
$has_html = false;
if($title != strip_tags($title)) {
	$has_html = true;
}
?>
<div class="proradio-pageheader proradio-pageheader--animate proradio-primary">
	<div class="proradio-pageheader__contents proradio-negative">
		<div class="proradio-container">
			
			<?php  
			$regex_mp3 = "/.mp3/";

			$_podcast_resourceurl = get_post_meta( $post->ID, '_podcast_resourceurl' ,true );
			if(is_numeric($_podcast_resourceurl)){
				$_podcast_resourceurl = wp_get_attachment_url( intval( $_podcast_resourceurl ) );
			} 
			$_podcast_resourceurl = esc_url($_podcast_resourceurl );
			
			// SINCE 2020 03 26
			// powerpress compatibility
			// Find any field called enclosure something
			// For compatibility with PowerPress
			if( !$_podcast_resourceurl ){
				$all_metas = get_post_meta(  $post->ID ) ;
				$key = preg_grep('/enclosure/', array_keys($all_metas));
				if( $key ){
					$value = $all_metas[current( $key )];
					if( is_array($value) && count($value) > 0 ){
						$file_val = $value[0];
						$arr2= explode("\n", $file_val );
						if( count( $arr2) > 1 ){
							$file_val = $arr2[0]; // should do the trick
						}
						if (strpos($file_val, '.mp3') !== false) {
						    $_podcast_resourceurl = $file_val;
						}
					}
				}
			}
			if ( preg_match ( $regex_mp3 , $_podcast_resourceurl  ) ) {
				if(function_exists('qtmplayer_play_circle')){
					$atts = array(
						'file' 		=> 	$_podcast_resourceurl,
						'classes' 	=>	'proradio-pageheader__featuredplayer'
					);
					?>
					<div class="">
						<?php 
						echo qtmplayer_play_circle( $atts );
						?>
					</div>
					<?php
				}
			} 

			?>
			<p class="proradio-meta proradio-small proradio-p-catz">
				<?php proradio_postcategories( 1, 'podcastfilter' ); ?>
			</p>

			<h1 class="proradio-pagecaption <?php if(!$has_html){ ?>proradio-glitchtxt<?php } ?>"  data-proradio-text="<?php echo esc_attr( $title ); ?>"><?php the_title();  ?></h1>
			<p class="proradio-meta proradio-small">
				<span class="proradio-meta__dets">
					<?php
					/**
					 * Podcast artist (custom field)
					 */
					$artist = get_post_meta( $post->ID, '_podcast_artist', true );
					if( $artist && $artist !== ''){ 
						?><i class="material-icons">mic</i><?php  echo esc_html( $artist );
					}

					/**
					 * Podcast date (custom field)
					 */
					$date = get_post_meta( $post->ID, '_podcast_date', true );
					if( $date && $date !== ''){ 
						?><i class="material-icons">today</i><?php  echo esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $date )));
					} 
					
					?>
					<?php echo proradio_do_shortcode('[proradio_reaktions-views-raw]' ); ?>
					<?php echo proradio_do_shortcode('[proradio_reaktions-loveit-raw]' ); ?>
					<?php echo proradio_do_shortcode('[proradio_reaktions-rating-raw]' ); ?>
				</span>
			</p>	
			<?php  
			/**
			 * ======================================================
			 * Mouse scroll icon
			 * ======================================================
			 */
			get_template_part( 'template-parts/pageheader/part-decoration' ); 
			?>
		</div>
		<?php  
		/**
		 * ======================================================
		 * Mouse scroll icon
		 * ======================================================
		 */
		get_template_part( 'template-parts/misc/mousescroll' ); 
		?>
	</div>
	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	get_template_part( 'template-parts/pageheader/image' ); 


	?>
</div>
<?php  
/**
 * ======================================================
 * Shareball
 * ======================================================
 */
get_template_part( 'template-parts/shared/shareball' ); 
?>