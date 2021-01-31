<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
?>
<?php
/**
 * ==================================
 * classic pagination numbers
 * ==================================
 */

if( ! isset($wp_query) ){ global $wp_query; }
$max = $wp_query->max_num_pages;
if($max > 1){
?>
<div id="proradio-pagination" class="proradio-wp-pagination proradio-row qt-ms-item">
		<div class="proradio-clearfix  proradio-col proradio-s12 proradio-m12 proradio-l12">
			<div class="proradio-pagination"><?php // Do not go on new line with PHP tag.


				if(  get_theme_mod('proradio_loadmore') ){
					$link =  get_next_posts_page_link();
					$callback = ( isset($callback) ) ? $callback : "";
					global $wp_query;
					$max = $wp_query->max_num_pages;
					
					if ( get_query_var('paged') ) {
						$paged = get_query_var('paged');
					} elseif ( get_query_var('page') ) {
						$paged = get_query_var('page');
					} else {
					   $paged = 1;
					}
					if(!empty($link) && ($paged < $max)): ?>
						<p class="proradio-loadmore-container proradio-clearfix">
							<a data-proradio-loadmore="#proradio-loop" href="<?php echo esc_url( $link ); ?>"  class="proradio-btn pproradio-btn__r  proradio-center noajax">
							   <span><?php esc_html_e("Load more", "proradio"); ?></span><i class='material-icons'>sync</i>
							</a>
						</p>
					<?php  else: ?>
						<p class="proradio-loadmore-container proradio-clearfix">
							<span class="proradio-item-metas"> <?php esc_html_e("No more entries", 'proradio'); ?></span>
						</p>
					<?php  
					endif; 
				} else {


					// Do not go on new line with PHP tag.
					// Empty pagination will be hidden to avoid useless spacing.
					$args = array(
					'type' => 'plain',
					'prev_next' => true,
					'before_page_number' => '<span class="proradio-num proradio-btn  proradio-btn__r proradio-card ">',
					'after_page_number'  => '</span>',
					'mid_size' => 2,
					'prev_text'          => '<span class="proradio-btn   proradio-icon-l"><i class="material-icons">navigate_before</i>'.esc_html__('Previous', 'proradio').'</span>',
					'next_text'          => '<span class="proradio-btn  proradio-icon-r">'.esc_html__('Next', 'proradio').'<i class="material-icons">navigate_next</i></span>',
					);
					echo paginate_links( $args ); 
				}

				// Do not go on new line with PHP tag.
				// Empty pagination will be hidden to avoid useless spacing.
			?></div>
		</div>
</div>
<?php 
}
