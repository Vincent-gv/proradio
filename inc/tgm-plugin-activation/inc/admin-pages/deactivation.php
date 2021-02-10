<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * ===============================================
 * REMOVE THE ACTIVATION
 * ===============================================
 */
if(!function_exists('proradio_disable_activation_link')){
	function proradio_disable_activation_link(){
		ob_start();
		$proradio_iid = proradio_iid();
		if(isset($_GET)){
			if( isset( $_GET[ 'proradio-tgm-remove-act-nonce' ] ) && isset( $_GET[ 'proradio-tgm-remove-act' ] ) ){
				$nonce = $_GET[ 'proradio-tgm-remove-act-nonce' ];
				if ( wp_verify_nonce( $nonce, 'remove-act-nonce') ) {
				   	if( isset ($_GET[ 'proradio-tgm-remove-act-conf' ] ) ){
				   		if( $_GET[ 'proradio-tgm-remove-act-conf' ] == '2' ){
					   		delete_option( 'proradio_ack_'. $proradio_iid );
					   		delete_option( 'proradio_licensekey_'. $proradio_iid );
					   		?>
							<p class="proradio-welcome__center" style="color: orange"><?php esc_html_e("The license key has been removed from this website.", 'proradio') ?></p>
							<?php
							return ob_get_clean();
					   	} else {
					   		esc_html_e( 'Invalid request', 'proradio' );
					   	}
				   	} else {
					   	/**
						 * 
						 * Allow to disable activation + confirmation
						 * @var [type]
						 * 
						 */
						$urladmin = admin_url( 'themes.php?page=proradio-welcome' );
						$url = add_query_arg(
					        array(
					        	'proradio-tgm-remove-act' => '1',
					        	'proradio-tgm-remove-act-conf' => '2',
					            'proradio-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
					        ),
					        $urladmin
					    );
						?>
						<p class="proradio-welcome__center" style="color: red"><?php esc_html_e("Please confirm to remove the license key from this website: ", 'proradio') ?><a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'proradio' ); ?></a></p>

						<?php
					}
				} else {
					echo 'Invalid';
				}
			} else {
				/**
				 * 
				 * Allow to disable activation
				 * @var [type]
				 * 
				 */
				$urladmin = admin_url( 'themes.php?page=proradio-welcome' );
				$url = add_query_arg(
			        array(
			        	'proradio-tgm-remove-act' => '1',
			            'proradio-tgm-remove-act-nonce' => wp_create_nonce( 'remove-act-nonce' )
			        ),
			        $urladmin
			    );
				?>
				<p class="proradio-welcome__center"><?php esc_html_e("To remove the license from this website", 'proradio') ?> <a href="<?php echo esc_url( $url ); ?>"><?php esc_html_e( 'click here', 'proradio' ); ?></a>
				<br>Removing a license will not reissue the license for usage on another website. Please contact our helpdesk to use your license on another domain.</p>
				<?php
			}
			return ob_get_clean();
		}
		return;
	}
}