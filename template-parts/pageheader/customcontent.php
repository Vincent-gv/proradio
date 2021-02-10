<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Display the page editor content in the first page of archives
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 *
 *  This template can be used also as page template.
 *  In this case we show the page content only if is a page and is page 1
 * 
 */
$paged = proradio_get_paged();
if(is_page()){
	if($paged == 1){
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$content = get_the_content();
			if( ( $content != '' && !is_wp_error( $content ) ) || ( \Elementor\Plugin::$instance->editor->is_edit_mode()  || \Elementor\Plugin::$instance->preview->is_preview_mode()) ){
				?>
				<div class="proradio-customcontent-firstpage">
					<div class="proradio-container">
						<?php the_content(); ?>
					</div>
				</div>
				<?php
			}
		endwhile; endif;
	}
}
// wp_reset_postdata();