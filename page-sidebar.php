<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Template Name: Page sidebar
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header(); 
?>
<div id="proradio-pagecontent" class="proradio-pagecontent">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php 
		/**
		 * ======================================================
		 * Page header template
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/pageheader-page' ); 
		?>
		<div class="proradio-maincontent">
			<div class="proradio-section proradio-paper">
				<div class="proradio-container">
					<div class="proradio-row proradio-stickycont">
						<div id="proradio-content" class="proradio-col proradio-s12 proradio-m12 proradio-l8">
							<div class="proradio-entrycontent">
								<div class="proradio-the_content">
									<?php the_content(); ?>
								</div>
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
							?>

							<?php  
							/**
							 * ==============================================
							 * Comments section here
							 * ==============================================
							 */
							$comments_count = wp_count_comments( $id );
							$comments_count = $comments_count->approved;
							if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
								?>
								<div class="proradio-section">
									<div class="proradio-container">
										<div class="proradio-comments-section">
											<h3 class="proradio-caption"><span><?php esc_html_e("Post comments","proradio"); ?> (<?php echo esc_html( $comments_count ); ?>)</span></h3>
											<?php  
											/**
											 * Comments template
											 */
											comments_template();
											?>
										</div>
									</div>
								</div>
								<?php 
							endif; 
							?>
						</div>
						<div id="proradio-sidebarcontainer" class="proradio-col proradio-s12 proradio-m12 proradio-l4 proradio-stickycol">
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php endwhile; endif; ?>
</div>
<?php 
get_footer();