<?php
/*
Package: qt-kentharadio
*/

$date = current_time("Y-m-d");
$current_dayweek = current_time("D");
$args = array(
	'post_type' => 'schedule',
	'posts_per_page' => 31,
	'post_status' => 'publish',
	'orderby' => 'menu_order',
	'order'   => 'ASC'
);

$the_query_meta = new WP_Query( $args );
$total = 0;
$tabsArray = array();
$id_of_currentday = 0;
if(!isset($grid_id)){ $grid_id =  uniqid('qt-kentharadio-showslider'); }
?>
<!-- SCHEDULE ================================================== -->
<div class="qt-kentharadio-show-schedule">
	<ul id="qt-kentharadio-ShowSelector" class="tabs qt-tabs qt-content-primary-dark qt-small hide-on-med-and-down qt-kentharadio-show-schedule-menu">
		<?php
		while ( $the_query_meta->have_posts() ):
			global $post;
			$the_query_meta->the_post();
			setup_postdata( $post );
			$active = '';
			$maincolor = '';
			$total++;
			$tabsArrayTemp = array(
				'name' => $post->post_name,
				'title' => $post->post_title,
				'id' => $post->ID,
				'post' => $post,
				'active' => ''
			);
			$schedule_date = get_post_meta($post->ID, 'specific_day', true);
			$schedule_week_day = get_post_meta($post->ID, 'week_day', true);
			// ====================================
			// 1. check if is a precise date
			// ====================================
			if($schedule_date == $date){
				$id_of_currentday = $post->ID;
				$active = ' active';
				$tabsArrayTemp["active"] = 'active';
				$maincolor = ' maincolor';
			} else {
				// ====================================
				// 2. check if is this day of the week
				// ====================================
				if(is_array($schedule_week_day)){
					foreach($schedule_week_day as $day){ // each schedule can fit multiple days
						if(strtolower($day) == strtolower($current_dayweek)){
							$id_of_currentday = $post->ID;
							$active = ' active';
							$maincolor = ' maincolor';
							$tabsArrayTemp["active"] = 'active';
						}
						
					}
				}
			}
			$tabsArray[] = $tabsArrayTemp;
			?>
			 <li class="tab">
				 <a href="#<?php echo esc_js(esc_attr($post->post_name)); ?>" id="optionSchedule<?php echo esc_js(esc_attr($post->post_name)); ?>" class="<?php echo esc_attr($active.$maincolor);?>">
				 	<?php echo esc_attr($post->post_title); ?>
				 </a>
			 </li>
			 <?php
		endwhile;
		wp_reset_postdata();	
		?>
	</ul>


	<?php
	/*
	*
	*	For mobile // options select instead of tabs // driven by js to click on hidden tabs
	*
	**/
	?>
	<h4 class="hide-on-large-only"><?php echo esc_attr__("Choose a day","proradio"); ?></h4>
	<hr class="qt-spacer-s hide-on-large-only">
	<select class="qt-kentharadio-select hide-on-large-only" id="qt-kentharadio-ShowDropdown">
		<?php
		wp_reset_postdata();
		$result = '';
		$args = array(
			'post_type' => 'schedule',
			'posts_per_page' => 31,
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order'   => 'ASC'
		);
		if( isset($proradio_schedulefilter) ) {
			if($proradio_schedulefilter !== ''){
				$args ['tax_query'] = array(
					array(
						'taxonomy' => 'schedulefilter',
						'field'    => 'slug',
						'terms'    => $proradio_schedulefilter
					)
				);
			}
		}
		/**
		 * ====================================================================================================
		 * Update from 2017 September 10
		 * adding week-of-the-month filtering if enabled
		 */
		if(get_theme_mod('QT_monthly_schedule', '0' )){
			$week_num = proradio_week_number();
			$args ['meta_key'] = 'month_week';
			$args ['meta_value'] = $week_num;
			$args['meta_compare'] = 'LIKE';
		}
		/* =========================================== update end ===========================================*/


		$the_query_meta = new WP_Query( $args );

		$total = 0;
		while ( $the_query_meta->have_posts() ):
			$active = false;
			$maincolor = '';
			$the_query_meta->the_post();
			$total++;
			setup_postdata( $post );
			$schedule_date = get_post_meta($post->ID, 'specific_day', true);
			$schedule_week_day = get_post_meta($post->ID, 'week_day', true);
			// ====================================
			// 1. check if is a precise date
			// ====================================
			if($schedule_date == $date){
				$active = true;
			} else {
				// ====================================
				// 2. check if is this day of the week
				// ====================================
				if(is_array($schedule_week_day)){
					foreach($schedule_week_day as $day){ // each schedule can fit multiple days
						if(strtolower($day) == strtolower($current_dayweek)){
							$active = true;
						}
						
					}
				}
			}
			?>
		 	<option value="optionSchedule<?php echo esc_js(esc_attr($post->post_name)); ?>" <?php if($active){ ?> selected="selected" <?php } ?>><?php echo esc_attr($post->post_title); ?></option>
		 	<?php
			$active = false;
		endwhile;
		wp_reset_postdata();
		?>
	</select>
	<hr class="qt-spacer-s">
	<?php
	/*
	*	CONTENT OF THE TABS
	*/
	foreach($tabsArray as $qt_kentharadio_day_tab){ 
		?>
		<div id="<?php echo esc_js(esc_attr($qt_kentharadio_day_tab['name'])); ?>" class="qt-show-schedule-day <?php echo esc_attr($qt_kentharadio_day_tab["active"]); ?>">
			<?php
			$id = $qt_kentharadio_day_tab['id'];
			/**
			 * ================================================
			 * Dynamic template inclusion (can be overridden by the theme)
			 * [$file name of the php template file]
			 * 
			 *	This function allows to override local plugin template and use the one in the theme
			 *	such as WooCommerce and Page Builder does.
			 *
			 * @var string
			 */
			$file = 'schedule-day.php';
			$template = locate_template( qt_kentharadio_override_template_path() . $file );
			if ( !$template ){
				$template = $file ;
			}
			include $template;
			/**
			 * End of template inclusion
			 * ================================================*/
			?>
		</div>
	<?php 
	$active = '';
	} 
	?>
</div>
<!-- SCHEDULE END ================================================== -->
