<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<div class="proradio-pageheader proradio-pageheader__qtvideo proradio-pageheader--animate proradio-primary">
	<div class="proradio-pageheader__contents proradio-negative">
		<div class="proradio-container">
			<div class="proradio-row">
				<div class="proradio-col proradio-s12 proradio-m12 proradio-l9">
					<?php  
				        /**
				         * Create embedded video from the meta field
				         */
				        global $wp_embed;
				        $videoUrl = get_post_meta( $post->ID, '_videolove_url_key', true );
				        $post_embed = $wp_embed->run_shortcode('[embed width="760" height="480"]'.esc_attr(esc_url($videoUrl)).'[/embed]');
				        echo do_shortcode($post_embed);
			        ?>
				</div>
				<div class="proradio-col proradio-s12 proradio-m4 proradio-l3 proradio-pageheader__qtvideo__related proradio-hide-on-large-and-down">
					<?php  
					if( function_exists('proradio_template_caption') ){
						echo proradio_template_caption( array( 'title' => esc_html__( 'You may also like', 'proradio'), 'negative' => true, 'size' => 's', 'anim' => 1 ) );
					}
					?>
					<?php  
					$related_posttype = get_post_type( get_the_id());
					$related_taxonomy = esc_attr( proradio_get_type_taxonomy( $related_posttype ) );
					$terms = get_the_terms( get_the_id()  , $related_taxonomy, 'string');
					$term_ids = false;
					if( !is_wp_error( $terms ) ) {
						if(is_array($terms)) {
							$term_ids = wp_list_pluck($terms,'term_id');
							if ($term_ids && shortcode_exists('qt-post-grid' ) ) {
								$term_ids = implode(',' , $term_ids);
								$tax_filter = $related_taxonomy.':'.$term_ids;
								ob_start();
								echo do_shortcode('[qt-post-grid post_type="qtvideo" items_per_page="2"  tax_filter="'.$tax_filter.'" cols_l="1" cols_m="1"]' );
								$result = ob_get_clean();
								if( !$result ){
									echo do_shortcode('[qt-post-grid post_type="qtvideo" items_per_page="2" cols_l="1" cols_m="1"]' );
								} else {
									echo wp_kses_post( $result );
								}
							}
						}
					}
					?>
				</div>
			</div>

			
			<h1 class="proradio-pagecaption"  data-proradio-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
			<p class="proradio-meta proradio-small">
				<?php get_template_part( 'template-parts/post/metas' );  ?>
				<?php get_template_part( 'template-parts/post/interactions' );  ?>
			</p>
			<p class="proradio-meta proradio-small proradio-p-catz">
				<?php proradio_postcategories( 3, 'vdl_filters' ); ?>
			</p>
		</div>
	</div>
	<?php 
	/**
	 * ======================================================
	 * Background image
	 * ======================================================
	 */
	// get_template_part( 'template-parts/pageheader/image' ); 
	?>
</div>
	<?php  
/**
 * ======================================================
 * Shareball
 * ======================================================
 */
get_template_part( 'template-parts/shared/shareball' ); 
?>