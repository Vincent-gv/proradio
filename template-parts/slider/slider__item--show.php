<?php
/**
 * 
 * Template part for displaying posts with Hero design (title in image)
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
global $post;
$series = false;


/**
 * [$event array of scheduling information if this template is loaded within the schedule day]
 * @var [array]
 */
$event = get_query_var( 'event', false );
// $currentshow = get_query_var( 'currentshow', false );
$current = false;



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
	$now = current_time("H:i");



	/**
	 * ===============================================================
	 * Check if this is the current show
	 * @since  20200904
	 * // 2 cases:
		// case 1: show started yesterday > Just check if is still on
		// case 2: show starting today > Check also if NOW is > ShowStart
	 * ===============================================================
	 */
	$current_show = false;
	$isactive = get_query_var( 'scheduleday_is_active', false );
	if( $isactive && !$current_show ){
		$found_active_show = false;


		$show_time_end_d_comparison = $show_time_end_d;
		if( $show_time_end_d_comparison === '00:00' ){
			$show_time_end_d_comparison = '24:00';
		}

		if( $show_time_end_d_comparison < $show_time_d ){
			// Show started yesterday
			if( $now < $show_time_end_d_comparison ) {
				$current_show = true;
			}
		} else {
			// Show started today (same day)
			if(  $now > $show_time_d && $now < $show_time_end_d_comparison ) {
				$current_show = true;
			}
		}
	}

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
	
}

// Show details
$string = '';
if( $event ){
	if( $show_time_d ){
		$string .= $show_time_d;
		if( $show_time_end_d ){
			$string .= ' - ';
		}
	}
	if( $show_time_end_d ){
		$string .= $show_time_end_d;
	}
}


$format = 'std';

?>
<article id="proradio-slider-post-<?php the_ID(); ?>" class="proradio-post proradio-slider__item proradio-negative">
	<div class="proradio-slider__img proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php 
		if( has_post_thumbnail( $post->ID )){
			the_post_thumbnail( 'large', array( 'class' => 'proradio-slider__i', 'alt' => esc_attr( get_the_title() ) ) );
		}
		?>
	</div>
	
	<div class="proradio-slider__c">
		<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
		<div class="proradio-container">			
			<p class="proradio-cats">
				<?php proradio_postcategories( 1, 'genre' ); ?>
				<?php 
				if( $current_show || $currentshow ){
					esc_html_e('Now on air', 'proradio');
				} 
				?>
			</p>

			<h3 class="proradio-post__title proradio-cutme-t-3 proradio-bigtitle" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php  
			$sub =  get_post_meta( $post->ID, 'subtitle2',true );
			if( $sub ){
				?>
				<h5 class="proradio-post__subtitle proradio-cutme-t proradio-h3">
					<?php echo esc_html($sub); ?>
				</h5>
				<?php 
			}
			?>
			<?php  
			/**
			 * In case we are in a schedule
			 */
			if( $string ){ ?>
				<h6 class="proradio-itemmetas">
					<i class='material-icons'>access_time</i><?php echo esc_html( $string ); ?>
				</h6>
			<?php }	?>
		</div>
		<?php 
		/**
		 * Action content
		 * ===============================
		 */
		?>
	</div>
		
</article>
<?php  