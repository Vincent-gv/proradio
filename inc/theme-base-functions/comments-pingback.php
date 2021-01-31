<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * ======================================================
 * Comments and pingbacks.
 * ------------------------------------------------------
 * Used as a callback by wp_list_comments() for 
 * displaying the comments.
 * ======================================================
 */
if ( ! function_exists( 'proradio_s_comment' ) ) {
	function proradio_s_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class("comment proradio-comment__item"); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="proradio-comment__body ">
					<div class="proradio-comment proradio-pingback">
						<span class="proradio-comment__icon"><i class="material-icons">link</i></span>
						<div class="proradio-comment__c">
							<?php esc_html_e( 'Pingback:', "proradio" ); ?> <?php edit_comment_link( '<i class="material-icons">mode_edit</i>'.esc_html__( "Edit pingback","proradio"), '<span class="edit-link">', '</span>' ); ?>
							<?php comment_author_link(); ?> 
						</div>
					</div>
				</article>
		<?php else : ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'comment proradio-comment__item proradio-depth-'.$depth  : 'comment proradio-comment__item parent proradio-depth-'.$depth ); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="proradio-comment__body ">
					<div class="proradio-comment">
						<a href="<?php echo esc_url( get_comment_author_url() ); ?>" class="proradio-avatar">
							<?php 
							/** 
							 * User avatar
							 */
							$avatar = get_avatar( $comment, $args['avatar_size'] );
							if ( 0 != $args['avatar_size'] && $avatar != '' ){
								echo get_avatar( $comment, $args['avatar_size'] );
							}else{
								?><i class="fa fa-user"></i><?php
							}
							?>
						</a>
						<p class="proradio-comment__auth proradio-itemmetas">
							<?php echo get_comment_author_link(); ?>
							<span class="proradio-comment__metas"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_attr_x( 'on %1$s', 'Comment date', "proradio" ), get_comment_date(), get_comment_time() ); ?></a> <?php edit_comment_link( '<i class="material-icons">mode_edit</i> '.esc_html__( "Edit comment","proradio"), '<span class="edit-link">', '</span>' ); ?></span>
						</p>
						
						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="proradio-comment__c"><?php esc_html_e( 'Your comment is awaiting moderation.', "proradio" ); ?></p>
						<?php endif; ?>
						<div class="proradio-the-content proradio-comment__c">
							<?php comment_text(); ?>							
						</div>
						<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply proradio-comment__rlink">',
							'after'     => '</div>',
						) ) );
						?>	
					</div>	
			</article><!-- .comment-body -->
		<?php
		/* Yes, the LI is open and is correct in this way. */
		endif;
	}
}


