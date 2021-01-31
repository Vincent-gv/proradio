<?php
/**
 * @package WordPress
 * @subpackage woocommerce
 * @subpackage proradio
 * @version 1.0.0
 *
 * Provide setup functions for WooCommerce
*/

/**==========================================================================================
 *
 *
 *	Developer guidelines
 *	1) The theme must have a header-shop.php, footer-shop.php and sidebar-shop.php
 *	2) sidebar-shop.php must contain the classes of its column wrapper
 *	3) The customizer options about columns amount are proradio_woocommerce_design and proradio_woocommerce_design_single
 *
 * 
 ==========================================================================================*/



/**==========================================================================================
 *
 *
 *	WooCommerce settings
 *
 * 
 ==========================================================================================*/
if ( class_exists( 'WooCommerce' ) ) {


	if(!function_exists('proradio_wc_files_inclusion')){
		add_action( 'wp_enqueue_scripts', 'proradio_wc_files_inclusion', 999999 );
		function proradio_wc_files_inclusion(){
			$suffix           = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			/**
			 * Move this to the ajax plugin
			 * 
			 * IMPORTANT! 'proradio-price-slider' MUST BE CALLED IN THE SAME WAY IN THE AJAX PAGE LOAD SCRIPT
			 */
			wp_register_script( 'proradio-price-slider',  get_template_directory_uri().'/woocommerce-helpers/assets/js/min/price-slider-min.js', array(), proradio_theme_version(), true );
			$register_scripts = array(
				'flexslider',
				'js-cookie',
				'jquery-blockui',
				'jquery-cookie',
				'jquery-payment',
				'photoswipe',
				'photoswipe-ui-default',
				'prettyPhoto',
				'prettyPhoto-init',
				'select2',
				'selectWoo',
				// 'wc-address-i18n',
				// 'wc-add-payment-method',
				'wc-cart',
				'wc-cart-fragments',
				// 'wc-checkout',
				// 'wc-country-select',
				// 'wc-credit-card-form',
				'wc-add-to-cart',
				'wc-add-to-cart-variation',
				// 'wc-geolocation',
				// 'wc-lost-password',
				// 'wc-password-strength-meter',
				'wc-single-product',
				'wc-price-slider',
				'proradio-price-slider',
				'woocommerce',
				'zoom',
			);
			foreach ( $register_scripts as $name ) {
				wp_enqueue_script( $name );
			}
			

			// css =============================================
			$register_styles = array(
				'woocommerce-layout',
				'woocommerce-smallscreen',
				'woocommerce-general',
			);
			foreach ( $register_styles as $name ) {
				wp_enqueue_style( $name );
			}
		}
	}

	/* Declare WooCommercecontainer support
	============================================= */
	add_action( 'after_setup_theme', 'proradio_woocommerce_support_add' );
	if (!function_exists('proradio_woocommerce_support_add')) {
	function proradio_woocommerce_support_add() {
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width'         => 270,
			'gallery_thumbnail_image_width' => 140,
			'single_image_width'            => 770,
		) );
		add_theme_support( 'wc-product-gallery-zoom' ); 
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'disable-custom-colors' );
	
		register_sidebar( array(
			'name'          =>  esc_html__( 'WooCommerce Sidebar', "proradio" ),
			'id'            =>  'proradio-woocommerce-sidebar',
			'before_widget' => '<li id="%1$s" class="proradio-widget proradio-col proradio-s12 proradio-m6 proradio-l12  %2$s">',
			'before_title'  => '<h6 class="proradio-widget__title proradio-caption proradio-caption__s"><span>',
			'after_title'   => '</span></h6>',
			'after_widget'  => '</li>'
		));
	}}

	/**
	 * Cart button update in header (requires class cart-contents)
	 ============================================= */
	add_filter( 'woocommerce_add_to_cart_fragments', 'proradio_woocommerce_header_add_to_cart_fragment' );
	function proradio_woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?><a class="cart-contents proradio-btn proradio-btn__r proradio-btn__cart proradio-btn__cart__upd"  href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'proradio'); ?>">
			<i class="material-icons">shopping_cart</i> <?php echo WC()->cart->get_cart_total(); ?>
		</a><?php
		$html = ob_get_clean();
		$fragments['a.cart-contents'] = $html;
		return $fragments;
	}


	/**
	 * Custom product meta
	 */
	
	if( !function_exists( 'proradio_woocommerce_product_meta_start' ) ){
		function proradio_woocommerce_product_meta_start(){
			echo '<span class="proradio-itemmetas">';
		}
	}
	if( !function_exists( 'proradio_woocommerce_product_meta_end' ) ){
		function proradio_woocommerce_product_meta_end(){
			echo '</span>';
		}
	}


	/**
	 * Images size
	 */

	add_filter( 'woocommerce_get_image_size_shop_single', 'proradio_woocommerce_set_product_img_size' );
	function proradio_woocommerce_set_product_img_size()
	{
		$size = array(
			'width'  => 370,
			'height' => 370,
			'crop'   => 1,
		);
		return $size;
	}

	/* Check if WooCommerce is installed and active
	============================================= */
	if(!function_exists('proradio_woocommerce_active')){
	function proradio_woocommerce_active(){
		return  class_exists( 'WC_API' );
	}}


	/**
	 * ==========================================================================================
	 *
	 *
	 * Returns current plugin version.
	 * @return string Plugin version
	 *
	 * 
	 * ==========================================================================================*/

	if(!function_exists('proradio_woocommerce_get_version')){
	function proradio_woocommerce_get_version() {
		if( true === proradio_woocommerce_active() ){	
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}
			$the_plugs = get_option('active_plugins');
			$plugin_base_name = 'woocommerce/woocommerce.php';
			// if is active check version
			if(in_array($plugin_base_name, $the_plugs)) {
				$all_plugins = get_plugins();		
				$proradio_woocommerce_name = 'woocommerce/woocommerce.php';
				if(array_key_exists($proradio_woocommerce_name, $all_plugins)){
					return $all_plugins[$proradio_woocommerce_name]['Version'];
				}
			}
		}
		// or return 0 means no woocommerce
		return 0;
	}}


	/* Custom WooCommerce columns number
	============================================= */
	
	if (!function_exists('proradio_woocommerce_loop_columns')) {
		add_filter( 'loop_shop_columns', 'proradio_woocommerce_loop_columns', 9999 );
		function proradio_woocommerce_loop_columns() {
			$layout = get_theme_mod( 'proradio_woocommerce_design', 'fullpage' );
			switch($layout){
				case 'left-sidebar':
				case 'right-sidebar':
					return 3;
					break; 
				case 'fullpage':
				default:
				return 4;
			}
		}
	}



	/* Custom WooCommerce items per page
	============================================= */
	if (!function_exists('proradio_woocommerce_product_query')) {
		add_action( 'woocommerce_product_query', 'proradio_woocommerce_product_query' );
		function proradio_woocommerce_product_query( $q ) {
			if ( $q->is_main_query() && ( $q->get( 'wc_query' ) === 'product_query' ) ) {
				$layout = get_theme_mod( 'proradio_woocommerce_design', 'fullpage' );
				switch($layout){
					case 'left-sidebar':
					case 'right-sidebar':
						$q->set( 'posts_per_page', '12' );
						break; 
					case 'fullpage':
					default:
					$q->set( 'posts_per_page', '12' );
				}
			}
		}
	}


	/* Remove title to use our own template pageheader-shop.php
	============================================= */
	if (!function_exists('proradio_woocommerce_show_page_title')) {
		add_filter( 'woocommerce_show_page_title', 'proradio_woocommerce_show_page_title' );
		function proradio_woocommerce_show_page_title( ) {
			return false;
		}
	}


	/* Custom WooCommerce container CSS
	============================================= */
	
	// Open block
	if (!function_exists('proradio_woocommerce_theme_wrapper_start')) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
		add_action('woocommerce_before_main_content', 'proradio_woocommerce_output_content_wrapper', 10);
		function proradio_woocommerce_output_content_wrapper() {
			if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ){
				$layout = get_theme_mod( 'proradio_woocommerce_design', 'fullpage' );
			} else {
				$layout = get_theme_mod( 'proradio_woocommerce_design_single', 'fullpage' );
				/**
				 * Check for meta fields override
				 */
				$proradio_post_template = get_post_meta(get_the_ID(),  'proradio_post_template' , true);
				if($proradio_post_template){
					$layout = $proradio_post_template;
				}
			}
			switch ($layout){
				case 'right-sidebar':
					$column_class = 'proradio-col proradio-s12 proradio-m12 proradio-l8 ';
					break;
				case 'left-sidebar':
					$column_class = 'proradio-col proradio-s12 proradio-m12 proradio-l8 proradio-right';
					break;
				case 'fullpage':
				default:
					if ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ){
						$column_class = 'proradio-col proradio-s12 proradio-m12 proradio-l12';
					} else {
						$column_class = 'proradio-col proradio-s12 proradio-m12 proradio-l12';
					}
					
					break;
			}
			echo '<div class="proradio-col '.esc_attr( $column_class ).'"><section id="proradio-woocommerce-section" class="proradio-woocommerce-content">';
		}
	}
	// Close block
	if (!function_exists('proradio_woocommerce_theme_wrapper_end')) {
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
		add_action('woocommerce_after_main_content', 'proradio_woocommerce_output_content_wrapper_end', 10);
		function proradio_woocommerce_output_content_wrapper_end() {
			echo '</section></div>';
		}
	}





	


	/* Append Woocommerce Classes for the theme
	=============================================*/
	
	if ( ! function_exists( 'proradio_woocommerce_class_names_append_woo_classes' ) ) {
		add_filter('body_class', 'proradio_woocommerce_class_names_append_woo_classes');
		function proradio_woocommerce_class_names_append_woo_classes($classes){
			$classes[] = ' woocommerce woomanual proradio-woocommerce-body';
			return $classes;
		}
	}


	/* Woocommerce related products amount
	=============================================*/
	
	if(!function_exists('proradio_woocommerce_related_products_args')){
		add_filter( 'woocommerce_output_related_products_args', 'proradio_woocommerce_related_products_args' );
		function proradio_woocommerce_related_products_args( $args ) {
			$args['posts_per_page'] = 3; // number of related products
			$args['columns'] = 3;
			return $args;
		}
	}


	/* Woocommerce flash sale icon
	=============================================*/
	
	if(!function_exists('proradio_woocommerce_woo_sale_flash')){
		add_filter( 'woocommerce_sale_flash', 'proradio_woocommerce_woo_sale_flash' );
		function proradio_woocommerce_woo_sale_flash() {
			return '<span class="proradio-sale-flash proradio-itemmetas"><i class="material-icons">flash_on</i>'.esc_html__( 'On Sale' , 'proradio' ).'</span>';
		}
	}



	/* WooCommerce thumbnail settings
	=============================================*/
	
	if(!function_exists('proradio_woocommerce_image_dimensions')){
		add_action( 'after_switch_theme', 'proradio_woocommerce_image_dimensions', 1 );
		function proradio_woocommerce_image_dimensions() {
			global $pagenow;
			if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
				return;
			}
			$catalog = array(
				'width' 	=> '370',	// px
				'height'	=> '370',	// px
				'crop'		=> 1 		// true
			);
			$single = array(
				'width' 	=> '770',	// px
				'height'	=> '770',	// px
				'crop'		=> 1 		// true
			);
			$thumbnail = array(
				'width' 	=> '140',	// px
				'height'	=> '140',	// px
				'crop'		=> 1 		// false
			);
			// Image sizes
			update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
			update_option( 'shop_single_image_size', $single ); 		// Single product image
			update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
		}
	}

	/* WooCommerce custom search form HTML
	=============================================*/
	function get_product_search_form(){
		?>
		<div  class="proradio-searchform">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="proradio-form-wrapper">
				<div class="proradio-fieldset">
					<input id="s" name="s" placeholder="<?php esc_attr_e( 'Search products', 'proradio' ); ?>" type="text" required="required" value="<?php echo esc_attr( get_search_query() ); ?>" />
				</div>
				<input type="hidden" name="post_type" value="product" />
				<button type="submit" name="<?php esc_attr_e( "Submit", "proradio" ); ?>" class="proradio-btn proradio-btn__txt"><i class="material-icons">search</i></button>
			</form>
		</div>
		<?php
	}



}
