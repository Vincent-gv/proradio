<?php
/**
 * Featured author template part
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/ 
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/**
 * @var $proradio_featuredauthor_id id [<id of the wp author, can be passed using set_query_var]
 */
if( isset( $proradio_featuredauthor_id ) ){
	$user_id = $proradio_featuredauthor_id; 
	$avatar = get_avatar_url($user_id );
	$desc = get_the_author_meta( 'description' , $user_id );
	
	// Compatibility with proradio_core_authorbox plugin
	$image_id = false;
	$bg = false;
	if( function_exists( 'ttg_authorbox_plugin_get_version' )){
		$image_id = get_user_meta (  $user_id , 'ttg_authorbox_imgid', true );
		if ( $image_id ) { 
			$avatar = wp_get_attachment_image_src( $image_id, 'proradio-squared-s' );    
			$avatar = $avatar[0];
			$bg = wp_get_attachment_image_src( $image_id, 'medium' );    
			$bg = $bg[0];
		} 
	}

	?>
	<div class="proradio-authorbox proradio-paper">
		<div class="proradio-authorbox__cn">
			<?php if ( $image_id ) { ?>
				<a class="proradio-authorbox__img proradio-paper" href="<?php get_author_posts_url( $user_id ); ?>">
				<?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
				</a>
			<?php } else { ?>
				<?php if($avatar){ ?>
					<a class="proradio-authorbox__img proradio-paper" href="<?php get_author_posts_url( $user_id ); ?>">
						<img src="<?php echo esc_url($avatar); ?>" alt="<?php esc_attr_e( "Avatar", "proradio" ); ?>">
					</a>
				<?php } ?>
			<?php } ?>
			<h4><a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-authorname qt-capfont"><?php echo get_the_author_meta( 'display_name', $user_id ); ?></a></h4>
			<?php if($desc && $desc !== ''){ ?>
				<p class="proradio-small">
				<?php echo wp_kses($desc, array() ); ?>
				</p>
			<?php } else { ?>
				<p class="proradio-spacer-xxs">
				<a class="proradio-btn" href="<?php get_author_posts_url( $user_id ); ?>">
					<?php esc_html_e('Author archive' , 'proradio'); ?>
				</a>
				</p>
			<?php } ?>
		</div>
	</div>
	<?php 
}
