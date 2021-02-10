<?php
/**
 * @package proradio
 * @version 1.0.0
 * 
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 *  
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( post_password_required() )
	return;

if ( ( comments_open() || '0' != get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) : ?>
	<!-- ==================================== COMMENTS START ========= -->
	<div id="comments" class="comments-area comments-list proradio-part-post-comments proradio-card  proradio-paper">
		
		<?php if ( have_comments() ) : ?>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
				<nav id="comment-nav-below" class="proradio-comment__navigation proradio-comment__navigation__top" role="navigation">
					<p class="proradio-itemmetas proradio-comment__navlinks">
					<span class="proradio-comment__previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "proradio" ) ); ?></span>
					<span class="proradio-comment__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "proradio" ) ); ?></span>
					</p>
				</nav>
			<?php endif; // check for comment navigation ?>
				<ol class="proradio-comment-list">
					<?php
					wp_list_comments( array( 'callback' => 'proradio_s_comment' ) );
					?>
				</ol>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
					
			<nav id="comment-nav-below" class="proradio-comment__navigation" role="navigation">
				<p class="proradio-itemmetas proradio-comment__navlinks">
				<span class="proradio-comment__previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', "proradio" ) ); ?></span>
				<span class="proradio-comment__next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', "proradio" ) ); ?></span>
				</p>
			</nav>
			<hr class="proradio-spacer-s">
			<?php endif; // check for comment navigation ?>
		<?php endif; // have_comments ?>
		<?php
			if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="proradio-comment__closed"><?php esc_html_e( 'Comments are closed.', "proradio" ); ?></p>
		<?php endif; ?>
		<?php

		/*
		*
		*     Custom parameters for the comment form
		*
		*/
		$required_text = esc_html__('Required fields are marked *',"proradio");
		if(!isset ($consent) ) { 
			$consent = ''; 
		}
		$args = array(
			'id_form'           => 'proradio-commentform',
			'id_submit'         => 'proradio-submit',
			'class_form'		=> 'proradio-form-wrapper proradio-commentform',
			'title_reply_to'    => esc_html__( 'Leave a Reply to %s', "proradio" ),
			'cancel_reply_before' 	=> '<span class="proradio-commentform__cancelreply">',
			'cancel_reply_after'	=> '</span>',
			'cancel_reply_link' 	=> '<span class="proradio-comment__cancelreply">'.esc_html__( 'Cancel', 'proradio' ).'</span>',
			'label_submit'      => esc_html__( 'Post Comment' ,"proradio" ),
			'class_submit'		=> 'proradio-btn proradio-btn__l',
			
			'title_reply'       => esc_html__( 'Leave a reply', "proradio" ),
			'title_reply_before' => '<h4><span>',
			'title_reply_after'   => '</span></h4>',
			
			'must_log_in' => '<p class="must-log-in proradio-mustlogin proradio-small">' .
				esc_html__( 'You must be logged in to post a comment.' , "proradio").
				' '.'<a href="'.wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ).'">'.esc_html__( 'Log in now' , "proradio").'</a>'.
				'</p>',
			'logged_in_as' => '<p class="proradio-small">' .
				sprintf(
					esc_html__( 'Logged in as ','proradio')
					.' <a href="%1$s">%2$s</a>. '
					.'<a href="%3$s" title="'.esc_attr__('Log out of this account','proradio').'">'
					.' '.esc_html__('Log out?','proradio')
					.'</a>',
					admin_url( 'profile.php' ),
					$user_identity,
					wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</p>',
			'comment_notes_before' => '<p class="proradio-small">'.esc_html__( "Your email address will not be published. Required fields are marked *", "proradio" ).'</p>',
			'comment_notes_after' => '',


			'comment_field' 	=>  '
				<div class="proradio-fieldset">
					<label for="comment" >'.esc_html__( "Comment*", 'proradio').'</label>
					<textarea id="comment" name="comment" required="required"></textarea>
				</div>',

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author'  => '
					<div class="proradio-fieldset proradio-fieldset__half">
						<label for="author" >'.esc_html__( "Name*", 'proradio').'</label>
						<input id="author" name="author" type="text" required="required"  value="' . esc_attr( $commenter['comment_author'] ) .'" />
						
					</div>',
				'email'  => '
					<div class="proradio-fieldset proradio-fieldset__half">
						<label for="email" >'.esc_html__( "Email*", 'proradio').'</label>
						 <input id="email" name="email" type="text" required="required"  value="' . esc_attr( $commenter['comment_author_email'] ) .'" />
					</div>',
				'url'  => '
					<div class="proradio-fieldset">
						<label for="url" >'.esc_html__( "Url", 'proradio').'</label>
						 <input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" />
					</div>'
				)
			),
		);


		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (  comments_open() && post_type_supports( get_post_type(), 'comments' ) ) :?>
				<?php  
				comment_form($args); 
				?>
		<?php endif; ?>

	</div><!-- #comments -->
	<!-- ==================================== COMMENTS END ========= -->
<?php endif; ?>
