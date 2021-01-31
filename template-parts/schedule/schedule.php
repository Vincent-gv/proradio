<?php  




/**
 * Data extraction
 * @var $schedulefilter = text flag of the parameter taxonomy
 * @var $today = return only current day
 */

$schedulefilter = get_query_var( 'schedulefilter', false );

$return_only_today = false;
$data_extraction 	= proradio_extract_schedule_days( $schedulefilter, $return_only_today ); // $schedulefilter, $today []

$schedules 			= $data_extraction[ 'posts' ];
$current_day_id 	= $data_extraction[ 'current_day_id' ];

if( 0 == count( $schedules )){
	echo esc_html__( 'No schedules selected', 'proradio' );
}


/**
 * ================================================
 * Array of entities
 * ================================================
 */
$schedulesarray = [];
foreach ( $schedules as $schedule ) {
	$schedulesarray[ $schedule->ID ] = array(
		'title' => $schedule->post_title,
		'unique_schedule_id'=>'proradio-shortcodeschedule-'.$schedule->ID,
		'post' => $schedule,
		'active' => ($current_day_id == $schedule->ID)? 1 : 0
	);
}

$grid_id = 'proradio-qt-schedule-'.md5( serialize($schedulefilter) ).'-'.get_the_ID();
remove_query_arg( 'scheduleday_is_active' );
?>
<div id="<?php echo esc_attr($grid_id); ?>" class="proradio-schedule proradio-container" data-proradio-autorefresh>
	<div class="proradio-program proradio-tabs" data-proradio-tabs>
		<?php 

		/**
		 * ================================================
		 * Tabs
		 * ================================================
		 */
		if( count( $schedulesarray ) >= 1  ){
			?>
			<a href="#" class="proradio-btn proradio-btn__full proradio-tabs__switch" data-proradio-switch="open" data-proradio-target="#proradio-tabslist"><?php esc_html_e("Select", 'proradio'); ?> <i class="material-icons">arrow_drop_down</i></a>
			<ul id="proradio-tabslist" class="proradio-tabs__menu proradio-paper">
				<?php  
				foreach( $schedulesarray as $id => $p ){
					$active = '';
					if($p['active'] == 1){
						$active = 'proradio-active';
					}
					?>
					<li><a href="#<?php echo esc_attr( $p['unique_schedule_id'] ); ?>" class="proradio-btn <?php echo esc_attr($active); ?>" data-proradio-switch="open" data-proradio-target="#proradio-tabslist"><?php echo esc_html(  $p['title'] ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
		}

		/**
		 * ================================================
		 * Tabs Content
		 * ================================================
		 */
		foreach ($schedulesarray as $schedule_id => $p ) {
			?>
			<div id="<?php echo esc_attr( $p['unique_schedule_id'] ); ?>" class="proradio-tabs__content">
				<?php 
				$post = $p['post'];
				set_query_var( 'scheduleday_is_active', 0 );
				if($p['active'] == 1){
					set_query_var( 'scheduleday_is_active', 1 );
				}
				
				setup_postdata( $post );
				get_template_part ('template-parts/schedule/schedule-day');
				wp_reset_postdata();
				?>
			</div>
			<?php
		}

		?>
	</div>
</div>