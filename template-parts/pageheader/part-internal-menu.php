<?php
/**
* Internal menu for pages
* 
* @package WordPress
* @subpackage proradio
* @version 1.0.0
*/


$links = get_post_meta($post->ID, 'proradio_internalmenu_items', true);
if( is_array( $links )){
	if( count($links) > 0 ){
		$overlap = get_post_meta($post->ID, 'proradio_internalmenu_overlap', true);
		?>
		<div id="proradio-sticky" class="proradio-sticky proradio-internal-menu" data-offset="0">
			<div id="proradio-stickycon" class="proradio-internal-menu__c proradio-sticky__content  <?php if($overlap){ ?>proradio-internal-menu__c__overlap<?php } ?>">
				<div class="proradio-container__l">
					<ul class="proradio-paper" data-proradio-scrollspy>
						<?php
						foreach( $links as $b ){
							if(!array_key_exists('txt', $b ) || !array_key_exists('url', $b )){
								continue;
							}
							if($b['txt'] == '' || $b['url'] == ''){
								continue;
							}
							/**
							 * Add hash if is not URL
							 */
							$b[ 'url' ] = trim( $b[ 'url' ] );
							$search = '/^http/';
							preg_match ($search, $b[ 'url' ], $find );
							if( count($find) < 1 ){
								$b[ 'url' ] = '#'.$b[ 'url' ];
							}

							/**
							 * Add class primary if is a highlight button
							 */
							$class_li = '';
							$class_a = '';
							if(array_key_exists('highlight', $b )){
								if( $b[ 'highlight' ] == '1' ){
									$class_a = 'proradio-btn-primary';
									$class_li = 'proradio-right';
								}
							}

							?>
							<li class="<?php echo esc_attr( $class_li ); ?>"><a href="<?php echo esc_attr( $b[ 'url' ] ); ?>" class="<?php echo esc_attr( $class_a ); ?>"><?php echo esc_html( $b['txt'] ); ?></a></li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}
