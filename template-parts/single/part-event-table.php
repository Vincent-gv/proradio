<?php
/**
 * Table of event details
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

$date = get_post_meta($post->ID, 'proradio_date',true);
$time = get_post_meta($post->ID, 'proradio_time',true);
$date_end = get_post_meta($post->ID, 'proradio_date_end',true);
$time_end = get_post_meta($post->ID, 'proradio_time_end',true);
$location = get_post_meta($post->ID, 'proradio_location',true);
$address = get_post_meta($post->ID, 'proradio_address',true);
$link = get_post_meta($post->ID, 'proradio_link',true);
$phone = get_post_meta($post->ID, 'proradio_phone',true);

/**
 * ========================
 * Convert time format if required
 * ========================
 */
if(!function_exists('proradio_time_convert')){
	function proradio_time_convert($time){
		if(get_theme_mod( 'timeformat_am' )){
			if($time === "24:00"){
				$time === "00:00";
			}
			$time = date_i18n("g:i a", strtotime($time));
		} else {
			$time = date_i18n("H:i", strtotime($time));
		}
		return $time;
	}
}
?>
<div class="proradio-event-table">
	<hr class="proradio-spacer-s">
	<h5 class="proradio-caption proradio-caption__s"><span><?php esc_html_e( 'Details' , 'proradio' ); ?></span></h5>
	<table>
		<?php  
		/**
		 * Below there are the rows containing event details
		 */
		if( $date ){
			?>
			<tr class="proradio-meta">
				<th><?php esc_html_e( 'Begin', 'proradio' ); ?></th>
				<td>
					<?php 
					echo esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $date )));
					
					if( $time ){
						echo '&nbsp;'; esc_html_e('H ','proradio'); echo esc_html( proradio_time_convert( $time ) );
					}
					?>
				</td>
			</tr>
			<?php 
		} 

		if( $date_end ){
			?>
			<tr class="proradio-meta">
				<th><?php esc_html_e( 'End', 'proradio' ); ?></th>
				<td>
					<?php 
					echo esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $date_end )));
					
					if( $time_end ){
						echo '&nbsp;'; esc_html_e('H ','proradio'); echo esc_html( proradio_time_convert( $time_end ) );
					}
					?>
				</td>
			</tr>
			<?php 
		} 

		if( $location ){
			?>
			<tr class="proradio-meta">
				<th><?php esc_html_e( 'Location', 'proradio' ); ?></th>
				<td>
					<?php 
					echo esc_html( $location );
					?>
				</td>
			</tr>
			<?php 
		} 

		if( $address ){
			?>
			<tr class="proradio-meta">
				<th><?php esc_html_e( 'Address', 'proradio' ); ?></th>
				<td>
					<?php 
					echo esc_html( $address );
					?>
				</td>
			</tr>
			<?php 
		} 

		if( $link ){
			?>
			<tr class="proradio-meta">
				<th><?php esc_html_e( 'Link', 'proradio' ); ?></th>
				<td>
					<a href="<?php echo esc_attr( $link ); ?>" target="_blank"><?php echo esc_html( $link ); ?></a>
				</td>
			</tr>
			<?php 
		} 

		if( $phone ){
			?>
			<tr class="proradio-meta">
				<th><?php esc_html_e( 'Phone', 'proradio' ); ?></th>
				<td>
					<?php 
					echo esc_html( $phone );
					?>
				</td>
			</tr>
			<?php 
		} 
		?>
	</table>
</div>