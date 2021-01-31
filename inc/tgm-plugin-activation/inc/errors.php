<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage ProRadio
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Notification about remote connection used by remote.php
 */
function proradio_plugins_refresh__outputtest() {
	?>
	<div class="notice notice-success is-dismissible">
		<h4><?php esc_html_e( 'Searching for updates on the remote repository', 'proradio' ); ?></h4>
	</div>
	<?php
}


/**
 * Error notices
 */
function proradio_plugins_refresh__success() {
	?>
	<div class="notice notice-success is-dismissible">
		<h4><?php esc_html_e( 'ProRadio - The plugins list was successfully updated', 'proradio' ); ?></h4>
	</div>
	<?php
}


// refreshing too fast
function proradio_tgm_remote_refreshed__message(){
	?>
	<div class="notice notice-warning is-dismissible">
		<h4><?php esc_html_e( 'Refreshing the page too often. Please wait a a few seconds to avoid overloads.', 'proradio' ); ?></h4>
	</div>
	<?php
}

// allow refresh
function proradio_plugins_notice__refresh() {
	$urladmin = admin_url( 'themes.php?page=proradio-tgmpa-install-plugins' );
	$url = add_query_arg(
		array(
			'tgmpa-force' => '1',
			'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
		),
		$urladmin
	);
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'ProRadio Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'The stored list of required plugins is empty, do you want to try again?', 'proradio' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email providing the purchase code.', 'proradio' ); ?> <?php echo proradio_support_message(); ?></p>
		<p><?php esc_html_e( 'If you already tried this, please wait some time, the server can be under maintainance.', 'proradio' ); ?></p>
		<p><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Try to refresh clicking here', 'proradio' ); ?></a></p>
	</div>
	<?php
}


// Activation notice
function proradio_plugins_notice__activationnag() {
	$scr = get_current_screen();
	if( $scr->id !== 'appearance_page_proradio-tgmpa-install-plugins' &&  $scr->id !== 'appearance_page_proradio-welcome' && !proradio_tgm_pcv( proradio_iid() ) ){

		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s', 'qtt' ),
			$current_theme->name
		);
		?>
		<div class="notice notice-success is-dismissible proradio-welcome__notice">
			<img src="<?php echo esc_url( get_theme_file_uri( '/inc/tgm-plugin-activation/img/logo.png' ) ); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
			<h3><?php echo wp_strip_all_tags( $title ); ?></h3>
			<p><a href="<?php echo admin_url().'themes.php?page=proradio-welcome'; ?>"><?php esc_html_e( 'Please activate your license', 'proradio' ); ?></a> <?php esc_html_e("to install the premium plugins and demo contents", 'proradio') ?></p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'proradio_plugins_notice__activationnag' );





// generic error
function proradio_plugins_notice__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'ProRadio Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'We are experiencing an error while searching for the required plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'proradio' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via Helpdesk, providing the license key.', 'proradio' ); ?> https://pro.radio/shop/submitticket.php?step=2&deptid=2 <?php echo proradio_support_message(); ?></p>
		<p><a href="https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html" target="_blank"><?php esc_html_e( 'Where is my license key?', 'proradio' ); ?></a></p>
	</div>
	<?php
}
// generic error
function proradio_plugins_notice__nolist() {
	?>
	<div class="notice notice-warning is-dismissible">
		<h3><?php esc_html_e( 'ProRadio Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'It seems the list of plugins is actually empty. You can try searching again in a couple of minutes.', 'proradio' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the License key', 'proradio' ); ?> <?php echo proradio_support_message(); ?></p>
		<p><a href="https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'proradio' ); ?></a></p>
	</div>
	<?php
}

// database error
function proradio_plugins_update_error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'ProRadio TGM Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'There is some issue while saving data in your database, please check database permissions', 'proradio' ); ?></p>
		<p><?php esc_html_e( 'If you need support please check the Support section of your manual.', 'proradio' ); ?></p>
		<p><a href="https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'proradio' ); ?></a></p>
	</div>
	<?php
}

// connection error
function proradio_plugins_conn__error() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'ProRadio Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'Your server is being blocked while searching for plugins. Please make sure your server or firewall are not blocking outgoing requests to our server.', 'proradio' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email at, providing the License key.', 'proradio' ); ?> <?php echo proradio_support_message(); ?></p>
		<p><a href="https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'proradio' ); ?></a></p>
	</div>
	<?php
}

// expired
function proradio_plugins_conn__expired() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Update license expired', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, your current license is expired.', 'proradio' ); ?></p>
		<p><?php esc_html_e( 'Please renew your support and updates service on ', 'proradio' ); ?><a href="https://pro.radio" target="_blank">https://pro.radio</a></p>
	</div>
	<?php
}

// missing
function proradio_plugins_conn__missing() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Missing license key', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'Please activate your license key to install the plugins.', 'proradio' ); ?></p>
	</div>
	<?php
}

// connection error server
function proradio_plugins_conn__error_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'ProRadio TGM Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is temporary unable to retreive the plugins list. You may try in a few minutes or contact our helpdesk at, providing the License key.', 'proradio' ); ?> <?php echo proradio_support_message(); ?></p>
		<p><a href="https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'proradio' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function proradio_plugins_id_miss() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'ProRadio TGM Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'Your server is not able to parse the product ID. Your firewall or server settings are blocking the request.', 'proradio' ); ?></p>
		<p><?php esc_html_e( 'If you need support please contact us via email, providing the License key.', 'proradio' ); ?> <?php echo proradio_support_message(); ?></p>
		<p><a href="https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'proradio' ); ?></a></p>
	</div>
	<?php
}

// product ID missing
function proradio_plugins_id_miss_server() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'ProRadio TGM Notice', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'Sorry, our server is not able to handle your request. You may try in a few minutes or contact our helpdesk, providing the License key.', 'proradio' ); ?> <?php echo proradio_support_message(); ?></p>
		<p><a href="https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html" target="_blank"><?php esc_html_e( 'Where is my purchase code?', 'proradio' ); ?></a></p>
	</div>
	<?php
}

// Server responding wrong
function proradio_plugins_conn__error_sever() {
	?>
	<div class="notice notice-error is-dismissible">
		<h3><?php esc_html_e( 'Activation required', 'proradio' ); ?></h3>
		<p><?php esc_html_e( 'Premium plugins require a valid License Key.', 'proradio' ); ?> <?php echo proradio_support_message(); ?></p>
	</div>
	<?php
}


// Check if a purchase code is stored
function proradio_tgm_pcv ( $proradio_iid = false ){
	$stored_activation_key = get_option( 'proradio_ack_' . trim( $proradio_iid ) );
	if( $stored_activation_key ){
		return true;
	}
	return false;
}