<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * 
 * Information:
 * ============================================================
 * This template is meant for pure preview use.
 * ============================================================
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
	</head>
	<body id="proradio-body" <?php body_class(); ?>>
		<div id="proradio-global" class="proradio-global">
			<div id="proradio-pagecontent" class="proradio-pagecontent proradio-single proradio-single__fullwidth">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="proradio-maincontent">
					<div class="proradio-entrycontent">
					<?php the_content(); ?>
					</div>
				</div>
			<?php endwhile; endif; ?>
			</div>
	</div><!-- end of .proradio-globacontainer -->
	<?php wp_footer(); ?>
	</body>
</html>