<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



/**
 * =============================================
 * CLEAR CACHE
 * =============================================
 */
if ( ! function_exists( 'proradio_welcome_page_clear_cache' ) ) {
	function proradio_welcome_page_clear_cache() {
		?>
		<div class="proradio-welcome proradio-welcome__page">
		<div class="proradio-welcome__container" id="proradio-helper-control">
			<div class="proradio-welcome__defaultcontainer">
				<h3>Clear customizations & Elementor cache</h3>
				<p>
				If you moved your website from another domain and you are experiencing issues such as customizations not appearing correctly in frontend, missing fonts, or Elementor styling not applying correctly, this function will help you fix the issue. By clearing the cache the following will happen:
				</p>
				<ol>
					<li>Google fonts selected in customizer will be purged (you may need to set them again in the Customization Settings)</li>
					<li>Elementor cached styles will be purged</li>
				</ol>
				<h3>Important</h3>
				<p>This function <strong>will NOT purge any other cache</strong> like: browser cache, plugins cache (wprocket, w3tc or similar), server cache (LiteSpeed or other) nor any other caching layer like CDN or your provider's server cache.</p><p>If you use caching plugins or server cache, that will need to be manually purged.</p>
				<?php  
				/**
				* ======================================
				* Inline help switch
				* ======================================
				*/
				if(function_exists('proradio_admin_clear_cache_form')){
					proradio_admin_clear_cache_form();					
				}
				?>

				<h3>More tools</h3>
		<p><a href="<?php echo admin_url() . 'admin.php?page=elementor-tools#tab-general'; ?>"  class="proradio-btn button">Go to Elementor Cache</a> <a href="<?php echo admin_url() . 'admin.php?page=elementor-tools#tab-replace_url'; ?>"  class="proradio-btn button">Go to Elementor URL update tool</a></p>
			</div>
		</div>
		</div>
		<?php
	}
}


/**
* ======================================
* Inline help switch
* this switch is in the Welcome page
* ======================================
*/
if ( ! function_exists( 'proradio_welcome_page_clear_cache_ACTION' ) ) {
	if( isset( $_GET ) && isset( $_POST ) ){
		if( isset( $_GET[ 'proradio-clearcache' ] ) && isset( $_POST[ 'proradio_chearcache_field' ] ) ){
			add_action( 'admin_init', 'proradio_welcome_page_clear_cache_action' );
		}
	}
	function proradio_welcome_page_clear_cache_action() {
		if ( wp_verify_nonce( $_POST[ 'proradio_chearcache_field' ], 'proradio_chearcache_action') ) {
			// Elementor cache
			do_action( 'elementor/core/files/clear_cache' );
			// Kirki cache 
			delete_transient('kirki_googlefonts_cache');
		}
	}
}


/**
* ======================================
* Clear cache form
* ======================================
*/
if ( ! function_exists( 'proradio_admin_clear_cache_form' ) ) {
	function proradio_admin_clear_cache_form() {
		?>
		<form method="post" action="<?php echo admin_url() . 'admin.php?page=proradio-clear-cache&proradio-clearcache=1&kirki-reset-cache=1'; ?>">
			<?php 
			wp_nonce_field( 'proradio_chearcache_action', 'proradio_chearcache_field' );
			?>
			<p><input type="submit" name="submit" value="<?php esc_html_e('Attempt automatic cache cleaning', 'proradio'); ?>"  class="proradio-btn button proradio-btn button button-primary"> [On some servers doesn't work]</p>
		</form>

		<?php 
	}
}