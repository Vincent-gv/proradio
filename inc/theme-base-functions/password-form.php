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


/**
 * ======================================================
 * Custom password protected form
 * ------------------------------------------------------
 * Display the post password form using custom HTML
 * ======================================================
 */
if (!function_exists( 'proradio_password_form' )){
	add_filter( 'the_password_form', 'proradio_password_form' );
	function proradio_password_form() {
		global $post;
		$random_inputid = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		ob_start();
		?>
		<div class="proradio-form-wrapper">
			<form class="proradio-form" method="post" action="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?action=postpass">
				<div class="proradio-row">
					<div class="proradio-col proradio-s12 proradio-m8 proradio-l9">
						<div class="proradio-fieldset">
							<input name="post_password" id="<?php echo esc_attr( $random_inputid ); ?>" type="password" placeholder="<?php esc_attr_e( 'Password', 'proradio' ); ?>" />
						</div>
					</div>
					<div class="proradio-col proradio-s12 proradio-m4 proradio-l3">
						<input type="submit" name="<?php esc_attr_e( "Submit", "proradio" ); ?>" class="proradio-btn proradio-btn__l proradio-btn__full proradio-btn-primary" value="<?php esc_attr_e( "Submit", "proradio" ); ?>" />
					</div>
				</div>
			</form>
		</div>
		<?php
		return ob_get_clean();
	}
}
