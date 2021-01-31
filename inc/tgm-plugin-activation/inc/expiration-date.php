<?php  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * ================================
 * Verify the service expiration date
 * CHECKS ONLY THE EXPIRATION OF THE SERVICE PASSED TO THE STRING $service_name
 * =================================
 */
 
function proradio_whmcs_next_due_date($results,  $service_to_check){
	if(!$results || !$service_to_check){
		return false;
	}
	if(!array_key_exists('addons', $results) || !array_key_exists('status', $results)){
		return false;
	}
	if($results['status'] !== 'Active'){
		return false;
	}

	/**
	 * ==============
	 * DESERIALIZE THE ADD-ONS
	 * CHECK IF THE SERVICE WE NEED ( $service_to_check ) IS ACTIVE OR EXPIRED
	 * - ACTIVE: RETURN DATE
	 * - EXPIRED: RETURN FALSE
	 */
	
	// from https://docs.whmcs.com/Licensing_Addon
	
	$tempresults = explode("|",$results["addons"]);
	foreach ($tempresults AS $tempresult) {
		$tempresults2 = explode(";",$tempresult);
		$temparr = array();
		foreach ($tempresults2 AS $tempresult) {
			$tempresults3 = explode("=",$tempresult);
			$temparr[$tempresults3[0]] = $tempresults3[1];
		}
		$addons[] = $temparr;
	}
	foreach($addons as $addon){
		if( $addon['name'] === $service_to_check ){
			$status = $addon['status'];
			if( $addon['nextduedate'] >= date("Y-m-d") ){
				return $addon['nextduedate'];
			}
		}
	}
	return false;
}