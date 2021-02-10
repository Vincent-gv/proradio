<?php
/**
* Proradio theme udpater
* Copyright 2020 Pro.Radio
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if(!function_exists('proradio_updater_theme_version')){
	function proradio_updater_theme_version(){
		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		return $current_theme->get( 'Version' );
	}
}


if(!function_exists('proradio_theme_update_is_available')){
	function proradio_theme_update_is_available(){
		$version = proradio_updater_theme_version();
		if (get_transient('proradio_latest_stored')) {
				$latest = get_transient('proradio_latest_stored');
		} else {
			delete_transient('proradio_latest_stored');
			$url = proradio_theme_update_version_url();
			$response = wp_remote_get( $url , array('sslverify' => false));
			if (is_wp_error($response)) {
				return false;
			}
			$latest = $response['body'];
			set_transient('proradio_latest_stored', $latest, 60 * 60 * 1); // hours
		}
		return version_compare($version, $latest, '<');
	}
}

// Theme update available
if(!function_exists('proradio_plugins_notice__themeupdate')){
	function proradio_plugins_notice__themeupdate() {
		if (proradio_theme_update_is_available()) {
			$scr = get_current_screen();
			if( $scr->id !== 'appearance_page_proradio-tgmpa-install-plugins' &&  $scr->id !== 'appearance_page_proradio-welcome' ){
				$version = proradio_updater_theme_version();
				?>
				<div class="notice notice-warning proradio-welcome__notice">
					<img src="<?php echo esc_url( get_theme_file_uri( '/inc/tgm-plugin-activation/img/logo.png' ) ); ?>" alt="<?php esc_attr_e('Logo','firlw'); ?>">
					<h3><?php esc_html_e('Good news: a theme update is available!'); ?></h3>
					<p><?php esc_html_e( 'New version', 'proradio') ; ?>: <?php echo esc_html( get_transient('proradio_latest_stored') ); ?>. 
						<?php esc_html_e( 'Current version', 'proradio') ; ?>: <?php echo esc_html( $version ); ?>. <strong><a href="<?php echo admin_url().'themes.php?page=proradio-welcome'; ?>"><?php esc_html_e('Go to the Updates page','proradio'); ?></a></strong>
				</p>
				</div>
				<?php
			}
		}
	}
}

add_action('admin_notices', 'proradio_plugins_notice__themeupdate');



/**
* ================================================================
* Theme action
* ================================================================
*/
if(!function_exists('proradio_theme_update_function')){
	function proradio_theme_update_function( $activation_key, $next_due_date ){
		if( !$next_due_date ){
			esc_html_e('Please renew the updates and support service to use this function', 'proradio');
			return;
		} else {
			wp_raise_memory_limit( 'admin' );
			
			if( '1' == get_option('proradio_automatic_backups', '1') ){
				proradio_backup_theme_folder();
			}
			$update_link = proradio_theme_update_link();
			$update_link = add_query_arg( 'version', esc_attr(trim( get_transient('proradio_latest_stored') )), $update_link );
			$update_link = add_query_arg( 'ack', esc_attr(trim( $activation_key )), $update_link );

			if ( ! class_exists( 'WP_Upgrader', false ) ) :
				include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			endif;
			$update_data = array(
				'theme_version' => get_transient('proradio_latest_stored'), 
				'update_link' => $update_link
			);
			$name = "proradio";
			$slug = "proradio";
			$version = $update_data['theme_version'];
			$download_link = $update_data['update_link'];
			delete_site_transient('update_themes');
			$themes = wp_get_themes();
			$current = (object) array("last_checked" => time(), "checked" => array(), "response" => array(), "translations" => array());
			foreach ($themes as $theme) {
				$current->checked[$theme->get('Slug')] = $theme->get('Version');
			}
			$current->response[$slug] = array(
				'theme' 		=> $slug, 
				'new_version' 	=> $version, 
				'url' 			=> '', 
				'package' 		=> $download_link
			);
			set_site_transient('update_themes', $current);
			$title = __('Update Theme');
			$nonce = 'upgrade-theme_' . $slug;
			$url = 'update.php?action=upgrade-theme&theme=' . urlencode($slug);
			$upgrader = new Theme_Upgrader(new Theme_Upgrader_Skin(compact('title', 'nonce', 'url', 'theme')));
			$upgrader->upgrade($slug);
			
			return true;
		}
	}
}


/**
* ================================================================
* Backup old theme folder in zip
* ================================================================
*/
if(!function_exists('proradio_backup_theme_folder')){
	function proradio_backup_theme_folder(){
		$errors = array();

		if(!class_exists('ZipArchive')){
			$errors[] = 'Sorry, your server does not feature the ZipArchive functionality';
			return false;
		}
		if( get_option('proradio_automatic_backups', '1') != '1' ){
			return;
		}
		try {
			$destination = proradio_backup_folder();
			if(!file_exists($destination)){
				wp_mkdir_p($destination);
			}
			if(!file_exists($destination)){
				$errors[] = 'There was an error while creating the backup folder. Please check your folders permissions, and set wp-content to 755';
			}

			// Make a security file
			$security_filename = $destination . DIRECTORY_SEPARATOR . 'index.php';
			if(!file_exists($security_filename)){
				$fh = fopen($security_filename, "w");
			    fwrite($fh, 'Forbidden');
			    fclose($fh);
			}


		    // Start the backup

			$source = realpath( get_parent_theme_file_path() ) . DIRECTORY_SEPARATOR;
			$security_hash = wp_generate_password( 5, false,false );

			$theme_backup_file_name = date("Y-m-d--H-i-s").'_proradio-theme-bk'.'_'.$security_hash.'.zip';
			$destination = $destination . DIRECTORY_SEPARATOR . $theme_backup_file_name;

			$zip = new ZipArchive();
			if($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
				$source = realpath($source);
				if(is_dir($source)) {
				  $iterator = new RecursiveDirectoryIterator($source);
				  $iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
				  $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
				  foreach($files as $file) {
					$file = realpath($file);
					if(is_dir($file)) {
					  $zip->addEmptyDir(str_replace($source . DIRECTORY_SEPARATOR, '', $file . DIRECTORY_SEPARATOR));
					}elseif(is_file($file)) {
					  $zip->addFile($file,str_replace($source . DIRECTORY_SEPARATOR, '', $file));
					}
				  }
				}elseif(is_file($source)) {
				  $zip->addFile($source,basename($source));
				}
			}
			return $zip->close();

		}catch (Exception $e) {
			$errors[] = $e->getMessage();
		}

		if( count($errors) > 0 ){
			foreach($errors as $e){
				?><p><?php echo esc_html( $e ); ?></p><?php  
			}
			die();
			exit;
		}

	}
}

/**
* ================================================================
* Output a list of theme backup files
* ================================================================
*/
function proradio_list_theme_backups(){
	$folder = proradio_backup_folder();
	$list = list_files( proradio_backup_folder(), 2, array('index.php'));
	$n = count($list);
	if($n <= 0){
		return;
	}
	rsort($list);
	$limit = 1;
	foreach( $list as $i => $file ){
		if($i < $limit ){
			echo '<p><strong>';
			esc_html_e('Last backup:', 'proradio');
			echo '</strong> ';
			echo str_replace($folder, '', $file).'<br>';
			echo '</p>';
		}
	}
}

/**
* ================================================================
* Theme updater form
* ================================================================
*/
if(!function_exists('proradio_theme_update_form_output')){
	function proradio_theme_update_form_output( $stored_activation_key, $stored_license_key, $next_due_date ){

		if(!current_user_can('manage_options')){
			wp_die('You are not allowed to manage this page');
		}

		$current_theme = wp_get_theme();
		if( is_child_theme() ){
			$current_theme = $current_theme->parent();
		}
		$title = sprintf(
			esc_html__( 'Thank you for choosing %1$s %2$s', 'proradio' ),
			$current_theme->name,
			$current_theme->version
		);


		/*==============================
		launch the update
		==============================*/
		$theme_updated_success = false;
		if( $next_due_date &&  isset($_POST) ){
			if(array_key_exists('proradio_theme_update_field', $_POST)){
				if(  wp_verify_nonce( $_POST['proradio_theme_update_field'], 'proradio_theme_update_action' ) ){
					if( isset( $_POST['proradio-confirm-update'] ) && isset( $_GET['themeupdate'] ) ){
						?>
						<div class="proradio-welcome__updater-debug">
							<?php $theme_updated_success = proradio_theme_update_function( $stored_activation_key, $next_due_date ); ?>
						</div>
						<?php
					}
				} 
			}
		}
		if( true === $theme_updated_success ){
			$urladmin = admin_url( 'themes.php?page=proradio-tgmpa-install-plugins' );
			$urladmin = add_query_arg(
				array(
					'tgmpa-force' => '1',
					'tgmpa-force-nonce' => wp_create_nonce( 'tgmpa-force-nonce' )
				),
				$urladmin
			);
			?>
			<h1><?php esc_html_e('Update completed.', 'proradio' ); ?></h1>
			<p><?php esc_html_e('Please check for plugin updates:', 'proradio' ); ?> <a href="<?php echo esc_url( $urladmin ); ?>"><?php esc_html_e('Click here', 'proradio'); ?></a></p>
			<?php
		} else {
			if (proradio_theme_update_is_available()) {
				?>
				<h1><?php esc_html_e('Good news: a theme update is available!', 'proradio'); ?></h1>
				<p><a href="https://pro.radio/changelog/" target="_blank">Open release notes</a></p>
				<?php 
				if( $stored_activation_key && $stored_license_key && $next_due_date ){
					?>
					<p class="proradio-welcome__warning"><strong><?php esc_html_e('Please back up your website before updating. The old theme folder will be deleted.','proradio'); ?></strong><br>
						<?php esc_html_e('Remember to save a copy of any custom theme translation from the /languages folder or any customized template file.','proradio'); ?></p>
					<form method="post" action="<?php echo admin_url() . 'themes.php?page=proradio-welcome&themeupdate=1'; ?>">
						<?php wp_nonce_field( 'proradio_theme_update_action', 'proradio_theme_update_field' ); ?>
						<p><input type="checkbox" name="proradio-confirm-update" id="proradio-confirm-update" required> <label for="proradio-confirm-update"><?php esc_html_e('I have a backup', 'proradio'); ?></label></p>						
						<p><input type="submit" name="submit" value="<?php esc_html_e('Update theme now', 'proradio'); ?>"  class="proradio-btn button button-primary"></p>
					</form>
					<?php
				} else {
					?>
					<p style="font-size:18px;"><?php esc_html_e('Please activate your license to access automatic updates','proradio'); ?>.</p>
					<?php
				}
			} else {
				?>
				<h2><?php esc_html_e('Your theme is already up to date', 'proradio' ); ?></h2>
				<p>Version <?php echo esc_html( $current_theme->version ); ?></p>
				<?php
			}
		}



		/*==============================
		Manual backup
		==============================*/
		
		$nonce_value = '';
		if(isset($_POST)){
			if(array_key_exists('proradio_backup',$_POST)){
				$nonce_value = $_POST['proradio_backup'];
			}
		}

		if(  wp_verify_nonce( $nonce_value, 'proradio_do_backup' ) ){
			if( proradio_backup_theme_folder() ){
				?>
				<p style="color: green;"><strong>Backup completed</strong></p>
				<?php
			} else {
				?>
				<p style="color: red;"><strong>Backup failed, please back up your theme folder manually.</strong></p>
				<?php
			}
		} else {
			?>
			<form method="post" action="<?php echo admin_url() . 'themes.php?page=proradio-welcome&proradio-mk-bk=1'; ?>">
				<?php wp_nonce_field( 'proradio_do_backup', 'proradio_backup' ); ?>
				<p><input type="submit" name="submit" value="<?php esc_html_e('Backup the theme', 'proradio'); ?>"  class="proradio-btn button button-primary"> <?php esc_html_e('If this function fails, manually backup your theme via FTP.','proradio'); ?><strong> <?php  esc_html_e('This will only backup the theme folder, nothing else, not your site, not the database.','proradio'); ?></strong></p>
			</form>

			<?php  
		}

		// Available backups
		proradio_list_theme_backups();
	}
}


