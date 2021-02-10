<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * ======================================================
 * HTML output starts here
 * ======================================================
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- WP HEAD -->
		<?php wp_head(); ?>
		<!-- WP HEAD END -->
	</head>
	<body id="proradio-body" <?php body_class(); ?>>
		<?php  
				
		/**
		 * ======================================================
		 * @var array
		 * Global classes to style di alternative design globals
		 * ======================================================
		 */
		$global_classes = [];

		// If sticky menu is enabled, add a class
		if( get_theme_mod('proradio_header_sticky') ){
			$global_classes[] = 'proradio-global__sticky';
			// If secondary header is enabled add a class
			if( get_theme_mod('proradio_sec_head_on') ){
				$global_classes[] = 'proradio-global__sticky__sec-h';
			}
		}
		$global_classes = implode( ' ', $global_classes );

		?>
		<div id="proradio-global" class="proradio-global <?php echo esc_attr( $global_classes ); ?>">
			<?php  
			
			/**
			 * ======================================================
			 * Load menu bar
			 * ======================================================
			 */
			get_template_part( 'template-parts/header/header' );

			?>

			<?php  
			/**
			 * ======================================================
			 * Global hook used by our plugin to add special functions
			 * as ajax page loading or more
			 * ======================================================
			 */
			do_action( 'proradio-before-maincontent' );
			?>

			<div id="proradio-ajax-master" class="proradio-master"><?php /* The id MASTER is required for the ajax page loading */ ?>