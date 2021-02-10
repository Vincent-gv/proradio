<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Search
 */
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( false !== get_theme_mod( 'proradio_search_header', false ) ) {
	?>
	<nav id="proradio-searchbar" class="proradio-searchbar proradio-paper">
		<div class="proradio-searchbar__cont">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
				<input name="s" type="text" placeholder="<?php esc_attr_e( 'Search', 'proradio' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
				<button type="submit" name="<?php esc_attr_e( "Submit", "proradio" ); ?>" class="proradio-btn proradio-icon-l proradio-hide-on-small-only proradio-btn-primary" value="<?php esc_attr_e( "Search", "proradio" ); ?>" ><i class="material-icons">search</i> <?php esc_html_e( "Search", "proradio" ); ?></button>
			</form>

			<a class="proradio-btn proradio-btn__r"  data-proradio-switch="open" data-proradio-target="#proradio-searchbar"> <i class="material-icons">close</i></a>
		</div>
	</nav>
	<?php
}
