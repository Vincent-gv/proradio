<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */


$items = array(
	array( 'release', 'Releases', 'genre'),
	array( 'podcast', 'Podcast', 'podcastfilter'),
	array( 'artist', 'Artists', 'artistgenre'),
	array( 'event', 'Events', 'eventtype'),
);


$custom_tax_series = 'podcastfilter';
if( function_exists( 'proradio_series_custom_series_name' )){
	$custom_tax_series = proradio_series_custom_series_name();
}

?>
<div class="proradio-pageheader__breadcrumb">
	<ul id="proradio-breadcrumb" class="proradio-breadcrumb proradio-small">
		<?php 
		if (!is_home() && !is_front_page()) { 
			?>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home', 'proradio'); ?></a></li>
			<?php  
			if (is_category() ) {
				?>
				<li><?php the_category('</li><li><i class="material-icons">keyboard_arrow_right</i>'); ?></li>
				<?php
			}
			elseif (is_single()) {

				$id = $post->ID;

				if(get_post_type( $id ) == 'post'){
					$category = get_the_category(); 
					
					if( count($category) > 0 ){
						$category = get_the_category(); 
						$limit = 2;
						foreach($category as $i => $cat){
							if($limit > $i){	
								?><li> <i class="material-icons">keyboard_arrow_right</i> <a href="<?php echo get_category_link($cat->term_id ); ?>"><?php echo esc_html($cat->cat_name); ?></a></li><?php
							}
						}
					}
				}
				?>
				

				<?php
				// Only for podcasts in series
				if( get_post_format(  ) == 'audio'){
					?>
					<li><i class="material-icons">keyboard_arrow_right</i><a href="<?php echo get_post_format_link( 'audio' ); ?>"><?php esc_html_e("Podcasts", "proradio") ?></a></li>
					<?php
				}
				if( function_exists( 'proradio_series_custom_series_name' )){
					echo get_the_term_list( get_the_id(), $custom_tax_series, '<li>'.'<i class="material-icons">keyboard_arrow_right</i>', '</li><li><i class="material-icons">keyboard_arrow_right</i>', '</li>' );
				}
				
				
				foreach($items as $item){
					if(get_post_type( $post->ID ) == $item[0]){
						?>
						<li>/<a href="<?php echo get_post_type_archive_link( $item[0] ); ?>">
							<?php echo (array_key_exists(1, $item)? esc_html( $item[1] ) : '' ); ?></a></li>
						<?php
						echo '<li><i class="material-icons">keyboard_arrow_right</i></li><li><i class="material-icons">keyboard_arrow_right</i></li>';
					}
				}
				?>
				<li><i class="material-icons">keyboard_arrow_right</i> <span><?php the_title(); ?></span></li>
				<?php  
			} 
			elseif (is_page() && !is_home() && !is_front_page()) {
				?>
				<li><i class="material-icons">keyboard_arrow_right</i><span><?php the_title(); ?></span></li>
				<?php  
			} elseif ( is_tax( $custom_tax_series ) ) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
				?>
				<li><i class="material-icons">keyboard_arrow_right</i><span><?php echo esc_html( $term->name ); ?></span></li>
				<?php  			
			}
			elseif (is_tag()) {
				single_tag_title();
			}
			elseif (is_day()) { ?>
				<li><i class="material-icons">keyboard_arrow_right</i><?php esc_html_e('Archive for',"proradio"); the_time('F jS, Y'); ?></li>
				<?php
			}
			elseif (is_month()) { ?>
				<li><i class="material-icons">keyboard_arrow_right</i><?php esc_html_e('Archive for',"proradio"); the_time('F, Y'); ?></li>
				<?php
			}
			elseif (is_year()) { ?>
				<li><i class="material-icons">keyboard_arrow_right</i><?php esc_html_e('Archive for',"proradio"); the_time('Y'); ?></li>
				<?php
			}
			elseif (is_author()) { ?>
				<li><i class="material-icons">keyboard_arrow_right</i><?php esc_html_e('Author archive',"proradio"); the_time('Y'); ?></li>
				<?php
			}
			elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
				?>
				<li><i class="material-icons">keyboard_arrow_right</i><span><?php esc_html_e('Blog archive',"proradio"); ?></span></li>
				<?php 
			}
			elseif (is_search()) {
				?>
				<li><i class="material-icons">keyboard_arrow_right</i><?php
				printf( 
					esc_html__( 'Search Results for: %s', "proradio" ), 
					esc_html(get_search_query())
				); 
				?></li><?php
			}
		} 
		?>
	</ul>
</div>

