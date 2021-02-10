<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div  class="proradio-searchform">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="proradio-form-wrapper">
		<div class="proradio-fieldset">
			<input id="s" name="s" placeholder="<?php esc_attr_e( 'Search in this website', 'proradio' ); ?>" type="text" required="required" value="<?php echo esc_attr( get_search_query() ); ?>" />
		</div>
		<button type="submit" name="<?php esc_attr_e( "Submit", "proradio" ); ?>" class="proradio-btn proradio-btn__txt"><i class="material-icons">search</i></button>
	</form>
</div>