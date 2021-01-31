<?php
/**
 * Protected post
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
?>
<div class="proradio-section">
	<div class="proradio-container">
		<div class="proradio-entrycontent">
			<div class="proradio-card proradio-pad proradio-paper">
				<div class="proradio-single__pwform">
					<h6 class="proradio-caption"><?php esc_html_e( "This post is protected, please insert the password", 'proradio' ); ?></h6>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</div>