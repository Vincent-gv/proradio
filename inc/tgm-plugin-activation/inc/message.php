<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage ProRadio
 **/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function proradio_message_tgm ( ){
	ob_start();
	$item_remote = proradio_iid();	
    
	$v = proradio_tgm_pcv( $item_remote );
	
	/**
	 * Display message
	 */
	if(!$v) {
		?>
		<p class="proradio-welcome__activation-msg">
			<a href="<?php echo admin_url().'themes.php?page=proradio-welcome'; ?>"><?php esc_html_e( 'Please activate your license', 'proradio' ); ?></a> 
			<?php esc_html_e("to install the premium plugins and demo contents", 'proradio') ?>
		</p>
		<?php
	}

	/**
	 * Display the product ID if set in remote
	 */
	if('pending' !== $item_remote) {
		?>
		<p><?php esc_html_e('Item ID: ','proradio'); echo esc_html( $item_remote ); ?></p>
		<?php
	}

	/**
	 * Display a force refresh link. Can be used every 30 seconds.
	 * Triggers product ID update as well
	 */
    if( get_transient( 'proradio_tgm_refreshed' ) ){
		?>
		<p><?php esc_html_e("The plugins list is up to date.", 'proradio') ?></p>
		<?php
	} else {
		$urladmin = admin_url( 'themes.php?page=proradio-tgmpa-install-plugins' );
		$url = add_query_arg(
	        array(
	        	'tgm-refresh-iid' => '1',
	            'tgmpa-force' => '1',
	            'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
	        ),
	        $urladmin
	    );
		?>
		<p><?php esc_html_e("If you just updated your theme, please ", 'proradio') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'Try to refresh clicking here', 'proradio' ); ?></a></p>
		<?php
	}

	return ob_get_clean();
}