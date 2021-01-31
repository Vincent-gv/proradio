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
$proradio_countdown = get_query_var( 'proradio_countdown', false );
$proradio_btntxt = get_query_var( 'proradio_btntxt', false );
$eventtype = get_the_term_list( $post->ID, 'eventtype' , '', ' / ', '');


$classes = array( 'proradio-post proradio-post__eventfeat' , 'proradio-darkbg proradio-negative' );
?>
<article <?php post_class( $classes ); ?> data-qtwaypoints>
	<div class="proradio-bgimg--full proradio-duotone">
		<?php if( has_post_thumbnail( ) ){ the_post_thumbnail( 'large', array( 'class' => 'proradio-post__eventfeat__i') ); } ?>
	</div>
	<div class="proradio-post__eventfeat__c proradio-negative">
		<div class="proradio-post__eventfeat__c__c">
			
			<p class="proradio-meta proradio-small">
				<?php if( $eventtype ){ ?>
				<span class="proradio-p-catz"><?php echo get_the_term_list( $post->ID, 'eventtype' , '', '  ', ''); ?></span>
				<?php } ?>
				<span class="proradio-meta__dets">
					<?php
					if( $date && $date !== ''){ 
						echo esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $date )));
					}
					?>
				</span>
			</p>

			<div class="proradio-post__eventfeat__caption">
				<?php  
				
				/**
				 * Countdown
				 * ======================================== */
				if( $proradio_countdown ){
					echo proradio_do_shortcode('[qt-countdown include_by_id="'.$post->ID.'" size="5"  labels="inline"]');
				}
				/**
				 * Title
				 * ======================================== */
				$caption = get_the_title();
				if( $caption ){
					?>
					<h2 class="proradio-capfont" data-proradio-text="<?php echo esc_attr( $caption ); ?>"><?php echo esc_html( $caption ); ?></h2>
					<?php
				}

				?>
			</div>


			<div class="proradio-post__eventfeat__exc">
				<?php echo wp_kses_post( proradio_custom_shorttext( $post, 30)); ?>
			</div>
			<a href="<?php the_permalink( ); ?>" class="proradio-btn proradio-btn__l proradio-btn-primary"><?php echo esc_html( $proradio_btntxt ); ?></a>
		</div>
		<?php  
		get_template_part( 'template-parts/shared/actions' ); 
		?>
	</div>
	
</article>
