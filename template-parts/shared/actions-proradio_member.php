<?php
/**
 * 
 * Display the post interactions on top of the header image
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/


$format = get_post_format( $post->ID );
if(!$format) {
	$format = 'std';
}
$share = false;
?>
<div class="proradio-actions__cont">
	<div class="proradio-actions">
			<a href="<?php the_permalink(); ?>" class="proradio-a0"><i class="material-icons">insert_link</i></a>
	</div>
</div>


