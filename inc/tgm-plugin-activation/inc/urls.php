<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Never change these values, or you won't be able to download the updates
function proradio_tgm_iid_url(){
	return 'https://pro.radio/proradio-connector/proradio/iid/';
}
function proradio_additional_plugins_url(){
	return 'https://pro.radio/proradio-connector/proradio/tgm-json/index.php';
}
function proradio_support_message(){
	return 'Please contact us via HelpDesk https://pro.radio/shop/supporttickets.php';
}
function proradio_documentation_url(){
	return "https://pro.radio/shop/index.php?rp=/knowledgebase";
}
function proradio_license_expiration_string(){
	return 'ProRadio WordPress Updates and Support';
}
function proradio_whmcsurl(){
	return 'https://pro.radio/shop/';
}
function proradio_secret_key(){
	return 'prSkWp7H3m3Tr1t0F1NdM3';
}
function proradio_theme_update_version_url(){
	return 'https://pro.radio/proradio-connector/proradio/theme/version.php';
}
function proradio_theme_update_link(){
	return 'https://pro.radio/proradio-connector/proradio/theme/download-theme.php';
}
function proradio_license_renew_link(){
	return 'https://pro.radio/shop/cart.php?gid=addons';
}
function proradio_backup_folder(){
	return WP_CONTENT_DIR . '/proradio-automatic-backups/';
}