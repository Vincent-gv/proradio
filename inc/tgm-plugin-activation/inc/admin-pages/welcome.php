<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * =============================================
 * FORM ACTIVATION
 * Welcome Page
 * =============================================
 */
if ( ! function_exists( 'proradio_welcome_page_content' ) ) {
	function proradio_welcome_page_content() {
		if(!is_admin()){
			return;
		}
		/*===========
		STATIC THEME DATA
		============*/
		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s', 'proradio' ),
			$current_theme->name
		);

		/*===========
		If requested, remove the License Key from the database
		============*/
		$msg_rem = proradio_disable_activation_link();

		/*===========
		PURCHASE CODE CHECK:
		HAS A STORED KEY?
			- YES - VERIFY IF IS STILL VALID
					- YES [NO NEED RECHECK] 	- VERIFY IF THE UPDATE SERVICE IS EXPIRED
					- NO [NEED TO RECHECK] 		- 
						2. Display notification
						3. PRINT FORM TO SUBMIT
			- NO - PRINT FORM TO SUBMIT THE CODE
					1. CODE CHECK ON POST SUBMIT.
					2. CHECK ADD-ON SERVICE VALIDITY
						- YES [ADD-ON VALID] STORE THE ACTIVATION KEY
						- NO [ADD-ON INVALID] 
							1. REMOVE THE ACTIVATION KEY IF EXISTS. 
							2. PROMPT ERROR

		============*/

		$proradio_iid 			= proradio_iid();
		$stored_activation_key 	= get_option( 'proradio_ack_' . trim( $proradio_iid ) );
		$stored_license_key 	= get_option( 'proradio_licensekey_' . trim( $proradio_iid ) );
		$service_to_check 		= proradio_license_expiration_string(); // Name of the service of Support and Update in "WHMCS"
		$error_response_stored 	= false;
		$next_due_date 			= false;

		if( $stored_activation_key && $stored_license_key ){
			$has_stored_activation_key = true;
			$results = proradio_whmcs_check_license( $stored_license_key, $stored_activation_key ); // check the local license, if is expired revalidate online
			// Debug
			// echo '<textarea cols="200" rows="30">' . print_r($results, true) . '</textarea>';
			switch ($results['status']) {
			    case "Active":
			    	// Do nothing
			       	$next_due_date = proradio_whmcs_next_due_date( $results,  $service_to_check );
			        break;
			    case "Invalid":
			        $error_response_stored = "The stored License key is invalid.";
			        break;
			    case "Expired":
			        $error_response_stored = "The stored License key is expired.";
			        break;
			    case "Suspended":
			        $error_response_stored = "The stored License key is suspended.";
			        break;
			    default:
			        $error_response_stored = "The stored License key is not valid.";
			        break;
			}
		}
		if( $error_response_stored ){
			// Reset stored keys as it's faulty
			delete_option( 'proradio_ack_'. $proradio_iid );
			delete_option( 'proradio_licensekey_'. $proradio_iid );
		}
		$error_response = false;

		if(isset($_POST)){

			/**
			* ================================================================
			* Plugins updater
			* ================================================================
			*/
			if(isset( $_POST['proradiopcode']) ){
				if ( ! isset( $_POST['proradio_license_update_field'] )   || ! wp_verify_nonce( $_POST['proradio_license_update_field'], 'proradio_license_update_action' ) ) {
				   	wp_die( esc_html_e('This request comes from an unidentified source. If you should not expect this error, please contact the theme author.', 'proradio') );
				    exit;
				} else {
					$licensekey =  esc_attr( trim( $_POST['proradiopcode'] ) );
					/**
					 * ------------------------
					 * Use the WHMCS License Manager validation script
					 * ------------------------
					 */
					$results = proradio_whmcs_check_license($licensekey);
					// Raw output of results for debugging purpose
					// echo '<textarea cols="100" rows="20">Risultati' . print_r($results, true) . '</textarea>';
					// Interpret response
					switch ($results['status']) {
					    case "Active":
					        // get new local key and save it somewhere
					        $localkeydata = esc_attr( trim( $results['localkey'] ) );
					        
					        
					        $next_due_date = proradio_whmcs_next_due_date( $results,  $service_to_check );
					        if( $next_due_date ){
						        update_option( 'proradio_licensekey_'. $proradio_iid, $licensekey ); // store the license key locally
						        update_option( 'proradio_ack_'. $proradio_iid, $localkeydata ); // store the activation key locally
					       		delete_transient('proradio_latest_stored');
					       		$stored_activation_key = $localkeydata;
					       		$stored_license_key = $licensekey;
					        } else {
					        	// The service is expired, let's remove the stored keys
					        	delete_option( 'proradio_ack_'. $proradio_iid );
								delete_option( 'proradio_licensekey_'. $proradio_iid );
								$error_response = 'The license key you entered is associated with an expired Update and Support service.<br>You need a valid license to download the udpates. <a href="https://pro.radio/" target="_blank">Get a license here</a>';
					        }
					        break;
					    case "Invalid":
					        $error_response = "License key is Invalid";
					        break;
					    case "Expired":
					        $error_response = "License key is Expired";
					        break;
					    case "Suspended":
					        $error_response = "License key is Suspended";
					        break;
					    default:
					        $error_response = "Invalid Response";
					        break;
					}
				}
			}
		}

		
		?>
		<div class="proradio-welcome proradio-welcome__page">
			<?php 

			/**
			* ======================================
			* Theme Updater
			* ======================================
			*/
			if( $stored_activation_key && $stored_license_key && function_exists('proradio_theme_update_form_output') ){
				?>
				<div class="proradio-welcome__container">
					<div class="proradio-welcome__updater">
						<?php 
						if( $next_due_date ){
							proradio_theme_update_form_output( $stored_activation_key, $stored_license_key, $next_due_date );
						} else {
							?>
							<h3>Ooops, we may need an update...</h3>
							<p>It seems your license expirer or is not available. Please, make sure to renew it at https://pro.radio/ </p>
							<p>If you have more than one website, we provide huge discounts! <a href="https://pro.radio/shop/submitticket.php?step=2&deptid=1" target="_blank">Coutact us</a> for more info</p>
							<?php
						}
						?>
					</div>
				</div>
				<?php  
			}
			?>



			<?php  
			/**
			* ======================================
			* License key activation
			* ======================================
			*/
			?>
			<div class="proradio-welcome__container">
				<div class="proradio-welcome__wrapper">
					<div class="proradio-welcome__logo">
						<img src="<?php echo esc_url( get_theme_file_uri('/inc/tgm-plugin-activation/img/logo.png' )); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
					</div>
					<h1 class="proradio-welcome__title"><?php echo esc_html( $title ); ?></h1>
					<?php

					if( isset( $msg ) ){
						?> <p class="proradio-welcome__center"> <?php echo wp_kses_post( $msg ); ?></p><?php
					}

					/**
					 * =============================================
					 * CASE 1 - I ALREADY HAVE A STORED INFORMATION FOR THE LICENSE KEY
					 * =============================================
					 */
					
					if( $stored_activation_key && $stored_license_key ){
						

						if( $next_due_date ){
							// Depending on the response of the stored key you can display an error
							// Or display further installation functionalities
							if( $error_response_stored ){
								?><p class="proradio-welcome__center" style="color:red;"><?php echo esc_html( $error_response_stored ); ?></p><?php
								?><p class="proradio-welcome__center">You should verify the License Key in your <a href="https://pro.radio/shop/clientarea.php" target="_blank">Pro.Radio private area</a></p><?php
							} else {
								?>
								<p class="proradio-welcome__description" style="color: #64dd17;">
									<?php
									echo esc_html(
										sprintf(
											esc_html__( 'Very good! The %1$s license is active.', 'proradio' ),
												$current_theme->name
										)
									);
									?>
								</p>

								<?php  
								
								/**
								========================================
								* Information about expiration date
								========================================
								*/
								?><p class="proradio-welcome__center">Your "Support and Updates" access expires on <?php echo esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $next_due_date ))); ?>.<br>You can <a target="_blank" href="https://pro.radio/?from=renew">renew anytime</a> to make sure you can download the new updates.</p><?php



								/**
								========================================
								* Link including a force refresh
								========================================
								*/
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
									<p class="proradio-welcome__center">
										<a href="<?php echo esc_url( $url ); ?>" class="proradio-welcome__bigbutton"><?php
										echo esc_html(
											sprintf(
												esc_html__( 'Install & update plugins', 'proradio' ),
												$current_theme->name
											)
										);
										?></a>
									</p>
									
								<?php
							}

						} else { // false === $next_due_date

							/**
							========================================
							* License expired!!
							========================================
							*/
							?>
							<p class="proradio-welcome__center">
								<?php esc_html_e("We're sorry but your license key is linked to an expired update and support service. Please renew the license to update the plugins.", 'proradio'); ?>
								<br><a href="<?php echo proradio_license_renew_link(); ?>" target="_blank"><?php esc_html_e('Click here to extend Support and Updates', 'proradio'); ?></a>
							</p>
							<?php
						}


					/**
					 * =============================================
					 * CASE 2 - THERE IS NO STORED INFORMATION
					 * =============================================
					 */
					} else {
						?>
						<h4 class="proradio-welcome__center"><?php esc_html_e( 'Please copy here your License Key' , 'proradio' ); ?></h4>
						<?php
						if( $error_response ){
							?><p class="proradio-welcome__center" style="color:red;"><?php echo wp_kses_post( $error_response ); ?></p><?php
						}
						?>
						<form class="proradio-welcome__form" method="post" action="<?php echo admin_url() . 'themes.php?page=proradio-welcome'; ?>">
							<input type="text" name="proradiopcode" class="proradio-pcode" placeholder="<?php esc_attr_e('Your license key', 'proradio'); ?>">
							<?php wp_nonce_field( 'proradio_license_update_action', 'proradio_license_update_field' ); ?>
							<input type="submit" value="<?php esc_html_e('Verify', 'proradio'); ?>"  class="proradio-btn button button-primary">
						</form>
						<p class="proradio-welcome__center"><a href="https://pro.radio/shop/clientarea.php" target="_blank"><?php esc_html_e( 'Where is my license key?', 'proradio' ); ?></a></p>
						<?php
					}

					?>
				</div>
			</div>



			<?php  

			if( $stored_license_key ){
			?>

			<div class="proradio-welcome__container" id="proradio-helper-control">
				<div class="proradio-welcome__defaultcontainer">
					<h3>Plugins udpate issues</h3>
					<p>If you see a message "Sorry, you are not allowed to access this page." there can be 2 causes:</p>
					<p>1) All of the plugins are installed and up to date</p>
					<p>2) The purchase code is linked to another domain. In this case, please go to your product download page and click the Reissue button. Then remove and add again your license Key in this page.</p>
				</div>
			</div>
			<?php  
			}
			?>


			


			<?php 
			/**
			* ======================================
			* Inline help switch
			* ======================================
			*/
			if(function_exists('proradio_inline_help_switcher_form')){
				?>
				<div class="proradio-welcome__container" id="proradio-helper-control">
					<div class="proradio-welcome__defaultcontainer">
						<?php  
						proradio_inline_help_switcher_form();
						?>
					</div>
				</div>
				<?php  
			}
			?>


			<?php 
			/**
			* ======================================
			* Info
			* ======================================
			*/
			?>
			<div class="proradio-welcome__container">
				<div class="proradio-welcome__info">
					<h3><?php esc_html_e('Activation process info and privacy', 'proradio'); ?></h3>
					<ul>
						<li><?php esc_html_e('This is just a one-time activation process.', 'proradio'); ?></li>
						<li><?php esc_html_e('We will validate your purchase code on https://pro.radio/. If you experience any issue, please make sure your server can connect to https://pro.radio/', 'proradio'); ?></li>
						<li><?php esc_html_e('To change installation URL you need to reissue the purchase code in your Pro.Radio private area', 'proradio'); ?></li>
					</ul>
				</div>
			</div>

			

			<?php
			/**
			* ======================================
			* Purchase code output
			* ======================================
			*/
			if( $stored_license_key ){
				?><p class="proradio-welcome__center"><?php
				echo "License key: ". esc_html( $stored_license_key ); 
				?></p><?php 
				/**
				 * ======================================
				 * Output a link to remove the stored license key
				 * ======================================
				 */
				if( isset( $msg_rem ) ){
					echo wp_kses_post( $msg_rem ) ;
				}
			}
			?>
		</div>
		<?php
	}
}