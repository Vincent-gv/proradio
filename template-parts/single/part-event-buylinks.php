<?php
/**
 * Table of event details
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.1.6
*/
$buylinks = get_post_meta($post->ID, 'proradio_buylinks', true);
if( is_array( $buylinks )){
	if( count($buylinks) > 0 ){
		ob_start();
		foreach( $buylinks as $b ){
			if(!array_key_exists('txt', $b ) || !array_key_exists('url', $b )){
				continue;
			}
			if($b['txt'] == '' || $b['url'] == ''){
				continue;
			}
			$target = '';
			if( array_key_exists('target', $b )){
				$target = ( $b['target'] == '1' ) ? '_blank' : '_self' ;
			}
			?>
			<a href="<?php echo esc_url( $b[ 'url' ] ); ?>" target="<?php echo esc_attr( $target ); ?>" class="proradio-btn"><span class="proradio-cutme"><?php echo esc_html( $b['txt'] ); ?></span></a>
			<?php
		}

		$html = ob_get_clean();
		
		if( $html != '' ){
			?>
			<li class="proradio-widget proradio-col proradio-s12 proradio-m12 proradio-l12">
				<div class="proradio-buylinks">
					<h5 class="proradio-caption proradio-caption__s"><span><?php esc_html_e( 'Book event' , 'proradio' ); ?></span></h5>
					<div class="proradio-buylinks__btns">
						<?php
						echo $html;
						?>
					</div>
				</div>
			</li>
			<?php
		}
	}
}