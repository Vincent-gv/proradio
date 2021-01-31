<?php
/**
 * 
 * Display author and date for a post
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

?>
<span class="proradio-p-catz"><?php proradio_postcategories( 10 ); ?></span> <span class="proradio-p-auth"><?php the_author(); ?></span>