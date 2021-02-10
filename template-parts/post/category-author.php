<?php
/**
 * 
 * Display author and date for a post in archive
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<span class="proradio-p-catz"><?php proradio_postcategories( 1 ); ?></span> <span class="proradio-p-auth"><?php the_author(); ?></span>