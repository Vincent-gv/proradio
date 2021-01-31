<?php
/**
 * Author in single post
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * =======================================
 * Requires to enable the option and to have a featured description.
 * =======================================
 */

if(get_theme_mod('proradio_show_author', '1' ) ){
	$user_id = get_the_author_meta('ID');
	$desc = get_the_author_meta( 'description' , $user_id );
	if( $desc  ){
		set_query_var( 'proradio_featuredauthor_id', $user_id );
		?>
		<div class="proradio-author-section">
			<div class="proradio-part-author">
				<h6 class="proradio-caption__s"><?php esc_html_e( 'About the author', 'proradio' ) ?></h6>
				<?php
					get_template_part( 'template-parts/author/featured-author' ); 
				?>
			</div>
		</div>
		<hr class="proradio-spacer-m">
		<?php  
		remove_query_arg( 'proradio_featuredauthor_id' );
	}
}