<?php
/**
 * 
 * Template part for displaying shows with inline design
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$classes = array( 'proradio-post' , 'proradio-post__inline', 'proradio-paper' );

/**
 * [$event array of scheduling information if this template is loaded within the schedule day]
 * @var [array]
 */
$event = get_query_var( 'event', false );
if( $event ){
	$neededEvents = array('show_id','show_time','show_time_end', 'day');
	foreach($neededEvents as $n){
	  if(!array_key_exists($n,$event)){
	      $event[$n] = false;
	  }
	}
	$day = $event['day'];
	$show_time_d = $event['show_time'];
	$show_time_end_d = $event['show_time_end'];
	if($show_time_d === "24:00"){
		$show_time_d === "00:00";
	}
	if($show_time_end_d === "24:00"){
		$show_time_end_d === "00:00";
	}
	// 12 hours format
	if(get_theme_mod('QT_timing_settings', '12') == '12'){
		$show_time_d = date("g:i a", strtotime($show_time_d));
		$show_time_end_d = date("g:i a", strtotime($show_time_end_d));
	}
	$now = current_time("H:i");
}
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<?php  
	if( has_post_thumbnail()){
	?>
	<a class="proradio-thumb proradio-duotone" href="<?php the_permalink(); ?>">
		<?php 
		the_post_thumbnail( 'proradio-squared-s', array( 'class' => 'proradio-post__thumb', 'alt' => esc_attr( get_the_title() ) ) ); 
		?>
	</a>
	<?php  
	}
	?>
	<h6><a class="proradio-cutme-t-2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
		<p class="proradio-meta proradio-small">
			<?php  
			$sub =  get_post_meta( $post->ID, 'subtitle2',true );
			if( $sub ){
				echo esc_html($sub).'<br>';
			}

			/**
			 * In case we are in a schedule, add the time and date
			 */
			if( $event ){
				 
				$string = '';
				if( $show_time_d ){
					$string .= $show_time_d;
					if( $show_time_end_d ){
						$string .= ' - ';
					}
				}
				if( $show_time_end_d ){
					$string .= $show_time_end_d;
				}
				echo esc_html( $string );
			}
			?>
		</p>
</article>