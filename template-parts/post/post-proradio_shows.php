<?php
/**
 * 
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $post;

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
$incipit = get_post_meta( $post->ID, 'show_incipit',true );
$classes = array( 'proradio-post','proradio-post__card','proradio-post__card--shows','proradio-darkbg proradio-negative' );

?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'proradio-squared-m', array( 'class' => 'proradio-post__thumb') ); } ?>
	</div>
	<div class="proradio-post__headercont">

		<?php  
		/**
		 * @since  20200904
		 * Current show label
		 */
		if( isset($current_show) && false !== $current_show ){
			?>
			<h5 class="proradio-element-caption proradio-caption proradio-caption--neg proradio-caption__s center proradio-center proradio-caption__c" data-qtwaypoints-offset="30" data-qtwaypoints=""><span><?php esc_html_e( 'Now playing', 'proradio' ) ?></span>
				</h5><?php
		}

		?>

		<a class="proradio-post__header__link" href="<?php the_permalink(); ?>"></a>
		<div class="proradio-post__card__cap">
			<p class="proradio-cats">
				<?php proradio_postcategories( 1, 'genre' ); ?>
			</p>
			<h3 class="proradio-post__title proradio-cutme-t-2 proradio-h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php 
		
			/**
			 * In case we are in a schedule, add the time and date
			 */
			if( $event ){
				?>
				<p class="proradio-itemmetas">
					<?php  
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
					?>
				</p>
				<?php 
			}
			?>
		</div>
		<?php if( $incipit && $incipit != ''){ ?>
		<i class='material-icons proradio-post__switchcontent' data-proradio-activates="gparent">more_vert</i>
		<?php } ?>
	</div>
	<?php  
	
	if( $incipit && $incipit != ''){
		?>
		<div class="proradio-post__headercont--ex proradio-paper">
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php 
			$sub =  get_post_meta( $post->ID, 'subtitle2',true );
			if( $sub ){
				?>
				<h6 class="proradio-cutme-t">
					<?php echo esc_html($sub); ?>
				</h6>
				<?php 
			}
			?>
			<p><?php echo wp_strip_all_tags( $incipit, true ); ?></p>
			<i class='material-icons proradio-post__switchcontent' data-proradio-activates="gparent">close</i>
		</div>
		<?php  
	}
	?>
	
</article>