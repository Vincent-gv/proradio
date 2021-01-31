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

if(isset($date) && isset($time) && isset($date_end) && isset($time_end)){
	if(!empty($date) && !empty($time) && !empty($date_end) && !empty($time_end)){

		$link = 'https://www.google.com/calendar/render?action=TEMPLATE&text='
		.str_replace(' ','+',get_the_title())
		.'&dates='.str_replace('-','',$date ).'T'.str_replace(':','',$time).'00Z/'.str_replace( '-','',$date_end ).'T'.str_replace(':','',$time_end)
		.'00Z&details=For+details,+link+here:+'.urlencode(get_the_permalink()).'&location='.esc_attr(str_replace(" ", '+',$location)).',+'
		.esc_attr(str_replace(" ", '+', $address )).'&sf=true&output=xml';

		?>
		<li class="proradio-widget proradio-col proradio-s12 proradio-m12 proradio-l12">
			<div class="proradio-event-googlecalendar">
				<a href="<?php echo esc_attr($link); ?>" class="proradio-btn proradio-btn-primary events_btn__l" target="_blank"><i class="proradio-gc"></i><?php esc_html_e("Add to Calendar", 'proradio'); ?></a>
			</div>
		</li>
		<?php  
	}
}
?>