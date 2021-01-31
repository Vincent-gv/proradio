<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * 
*/
$id = (isset($id))? $id : get_the_id();

$active_class = '';



if(1 === get_query_var( 'scheduleday_is_active', false ) ){
	$active_class = 'proradio-activeschedule';
}
?>
<!-- SCHEDULE DAY ================================================== -->
<div class="proradio-row <?php echo $active_class; ?>">
	<?php
   	$events= get_post_meta($id, 'track_repeatable', true);
    if(is_array($events)){
    	$n = 0;
    	$count = 0;
      	foreach($events as $event){ 
      		if(array_key_exists('show_id', $event)){
      			if(array_key_exists(0, $event['show_id'])){
      				if( $event['show_id'][0] !== 0 ){
      					?>
      					<div class="proradio-col proradio-col__post proradio-s12 proradio-m6 proradio-l4">
	      					<?php
	      					$show_id = $event['show_id'][0];
							$post = get_post($show_id); 
							if(is_object($post)):
								$count = $count+1;
								$event['day'] = get_the_title($id);
								set_query_var( 'event', $event );
								setup_postdata($post);
								
								/**
								 * ================================================
								 * Dynamic template inclusion (can be overridden by the theme)
								 * [$file name of the php template file]
								 * @var string
								 */
								get_template_part( 'template-parts/post/post-proradio_shows' );
								/**
								 * End of template inclusion
								 * ================================================*/
								set_query_var( 'event', false);
								remove_query_arg('event');
							endif; 
							wp_reset_postdata();
							?>
						</div>
						<?php  
					} // is_numeric	      				
				}
			} // array_key_exists
		}//foreach
	} else {
		echo esc_attr__("Sorry, there are no shows scheduled on this day","qt-kentharadio");
	}
	wp_reset_postdata();
	?>
</div>
<!-- SCHEDULE DAY END ================================================== -->