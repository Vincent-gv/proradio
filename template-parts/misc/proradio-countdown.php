<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

$date = get_post_meta($post->ID, 'proradio_date',true);
$day = '';
$monthyear = '';

if($date && $date != ''){
	$day = date( "d", strtotime( $date ));
	$monthyear=esc_attr(date_i18n("M Y",strtotime($date)));
}

$time = get_post_meta($post->ID, 'proradio_time',true);
$now =  current_time("Y-m-d").'T'.current_time("H:i");
$location = get_post_meta($post->ID, 'proradio_location',true);
$address = get_post_meta($post->ID, 'proradio_address',true);

if( $date && $date !== '' && $date > $now){
	?>
	<span class="proradio-countdown__container proradio-countdown__container--shortcode">
		<span class="proradio-countdown  proradio-countdown--shortcode" 
		data-proradio-date="<?php echo esc_attr( $date ); ?>" 
		data-proradio-time="<?php echo esc_attr( $time ); ?>" 
		data-proradio-now="<?php echo esc_attr( $now ); ?>"
		><?php esc_html_e('Coming soon', 'proradio'); ?></h4>
	</span>
	<?php  
}


