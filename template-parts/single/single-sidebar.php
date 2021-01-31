<?php
/**
 * Single post with sidebar
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
?>
<div class="proradio-section proradio-paper">
	<div class="proradio-container">
		<div class="proradio-row proradio-stickycont">
			<div class="proradio-col proradio-s12 proradio-m12 proradio-l8">
				<div class="proradio-entrycontent">
					<div class="proradio-the_content">
						<?php the_content(); ?>
					</div>
					<?php
					$atts_pagelink = array(
						'before'           => '<h6 class="proradio-itemmetas proradio-pagelinks">',
						'after'            => '</h6>',
						'link_before'      => '',
						'link_after'       => '',
						'next_or_number'   => 'next',
						'separator'        => '  ',
						'nextpagelink'     => esc_html__( 'Next page', 'proradio').'<i class="material-icons">chevron_right</i>',
						'previouspagelink' => '<i class="material-icons">chevron_left</i>'.esc_html__( 'Previous page', 'proradio' ),
						'pagelink'         => '%',
						'echo'             => 1
					);
					wp_link_pages( $atts_pagelink );

					/**
					 * Author
					 */
					?>
					<p class="proradio-itemmetas proradio-single__author"><span><?php esc_html_e("Written by:  ", "proradio"); ?><a href="<?php echo esc_attr( get_author_posts_url( get_the_author_meta('ID') ) ); ?>" class="qt-authorname qt-capfont"><?php echo get_the_author_meta( 'display_name', get_the_author_meta('ID') ); ?></a></p>
					<?php

					/**
					 * Tags
					 */
					the_tags('<p class="proradio-tags">', ' ', '</p>' );

					/**
					 * Post footer with share
					 */
					get_template_part( 'template-parts/single/part-content-footer' );
					?>
				</div>

				<?php  
				/**
				 * ==============================================
				 * Previous post section
				 * ==============================================
				 */
				?>
				<div class="proradio-previouspost-section">
					<hr class="proradio-spacer-m">
					<?php get_template_part( 'template-parts/single/part-previous' ); ?>
				</div>
				<?php  
				/**
				 * ==============================================
				 * Related posts section
				 * ==============================================
				 */
				if( get_theme_mod( 'related_post' )){
					?>
					<div class="proradio-relatedpost-section">
						<?php get_template_part( 'template-parts/single/part-related' ); ?>
					</div>
					<?php  
				}
				/**
				 * ==============================================
				 * Comments section
				 * ==============================================
				 */
				$comments_count = wp_count_comments( $id );
				$comments_count = $comments_count->approved;
				if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
					?>
					<div class="proradio-comments-section proradio-spacer-m">
						<h3 class="proradio-caption proradio-caption__l"><span><?php esc_html_e("Post comments","proradio"); ?> (<?php echo esc_html( $comments_count ); ?>)</span></h3>
						<?php  
						/**
						 * Comments template
						 */
						comments_template();
						?>
					</div>
					<?php 
				endif; 
				?>
				<hr class="proradio-spacer-m proradio-hide-on-large-only">
			</div>
			<div class="proradio-col proradio-s12 proradio-m12 proradio-l4 proradio-stickycol">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
