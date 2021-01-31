<?php
/**
 * Table of place details
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/

/**
 * 
 * List of public fields added with the QT Places plugin
 * 
 */
$details = array(
	
	'qt_location' 	=> esc_html__( 'Location', 'proradio' ),
	'qt_country' 	=> esc_html__( 'Country', 'proradio' ),
	'qt_address' 	=> esc_html__( 'Address', 'proradio' ),
	'qt_city' 		=> esc_html__( 'City', 'proradio' ),
	'qt_link' 		=> esc_html__( 'Link', 'proradio' ),
	'qt_phone' 		=> esc_html__( 'Phone', 'proradio' ),
	'qt_email' 		=> esc_html__( 'Email', 'proradio' ),
);


?>
<div class="proradio-place-table">
	<table>
		<?php  
		/**
		 * 
		 * Display the fields
		 * 
		 */
		foreach( $details as $key => $label ){
			$data = get_post_meta( $post->ID, $key, true);
			if( $data ){

				// Link the URL
				if('qt_link' == $key ){
					$data = '<a href="'.esc_url( $data ).'" target="_blank" rel="nofollow">'.wp_kses_post( $data ).'</a>';
				}

				// Link the phone call
				if('qt_phone' == $key ){
					$data = '<a href="tel:'.esc_attr( $data ).'" rel="nofollow">'.wp_kses_post( $data ).'</a>';
				}

				// Link the email
				if('qt_email' == $key ){
					$data = '<a href="mailto:'.esc_attr( $data ).'" rel="nofollow">'.wp_kses_post( $data ).'</a>';
				}

				?>
				<tr class="proradio-meta proradio-place-table__<?php echo esc_attr($key); ?>">
					<th>
						<?php echo esc_html( $label ); ?>
					</th>
					<td>
						<?php echo wp_kses_post( $data ); ?>
					</td>
				</tr>
				<?php 
			} 
		}
		?>
	</table>
</div>