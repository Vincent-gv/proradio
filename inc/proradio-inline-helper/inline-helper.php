<?php  
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
*	Scripts and styles Backend
*	
*/
if(!function_exists("proradio_styles")){
	add_action("admin_enqueue_scripts",'proradio_styles');
	function proradio_styles(){
		$version = 'PR.1.0.0';
		// this switch is in the Welcome page
		if( get_option( 'proradio_inline_helper', '1' ) ){
			wp_enqueue_style( 'proradio-inline-helper',get_theme_file_uri( '/inc/proradio-inline-helper/assets/css/inline-helper.css' , __FILE__ ),$version);
			wp_enqueue_script( 'proradio-inline-helper',get_theme_file_uri( '/inc/proradio-inline-helper/assets/js/prih.js' , __FILE__ ),array( 'jquery' ),$version);
		}
	}
}


/**
* ======================================
* Inline help switch
* this switch is in the Welcome page
* ======================================
*/
if ( ! function_exists( 'proradio_inline_help_switcher' ) ) {
	if( isset( $_GET ) && isset( $_POST ) ){
		if( isset( $_GET[ 'proradio-helper' ] ) && isset( $_POST[ 'proradio-helper-status' ] ) ){
			add_action( 'admin_init', 'proradio_inline_help_switcher' );
		}
	}
	function proradio_inline_help_switcher() {
		if ( wp_verify_nonce( $_POST[ 'proradio_disable_switch_field' ], 'proradio_disable_switch_action') ) {
			if( $_POST[ 'proradio-helper-status' ] == '0') {
				$val = '0';
			} else {
				$val = '1';
			}
			update_option( 'proradio_inline_helper', $val );
		}
	}
}


/**
* ======================================
* Output the switch in the Welcome page
* ======================================
*/
if ( ! function_exists( 'proradio_inline_help_switcher_form' ) ) {
	function proradio_inline_help_switcher_form() {
		?>
		<h3><?php esc_html_e('Admin inline help', 'proradio'); ?></h3>
		<p><?php esc_html_e('To hide those little question marks opening the theme documentation, use this switch', 'proradio'); ?></p>
		<form method="post" action="<?php echo admin_url() . 'themes.php?page=proradio-welcome&proradio-helper=switch'; ?>#proradio-helper-control">
			<?php 
			wp_nonce_field( 'proradio_disable_switch_action', 'proradio_disable_switch_field' );
			if( get_option( 'proradio_inline_helper', '1' ) ){
				?>
				<input type="hidden" name="proradio-helper-status" id="proradio-helper-status" value="0">
				<p><input type="submit" name="submit" value="<?php esc_html_e('Disable inline help', 'proradio'); ?>"  class="proradio-btn button button-error"></p>
				<?php  
			} else {
				?>
				<input type="hidden" name="proradio-helper-status" id="proradio-helper-status" value="1">
				<p><input type="submit" name="submit" value="<?php esc_html_e('Enable inline help', 'proradio'); ?>"  class="proradio-btn button button-primary"></p>
				<?php  
			}
			?>
		</form>
		<?php 
	}
}