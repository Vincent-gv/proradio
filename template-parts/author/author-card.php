<?php
/**
 * Featured author template part
 * 
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/ 


/**
 * @var $proradio_featuredauthor_id [id of the wp author, can be passed using set_query_var]
 */

if( isset($proradio_featuredauthor_id) ){
	$user_id = $proradio_featuredauthor_id; 
	$avatar = get_avatar_url($user_id );

	// Compatibility with proradio_core_authorbox plugin
	if( function_exists( 'ttg_authorbox_plugin_get_version' )){
		$image_id = get_user_meta (  $user_id , 'ttg_authorbox_imgid', true );
		if ( $image_id ) { 
			$avatar = wp_get_attachment_image_src( $image_id, 'proradio-squared-s' );    
			$avatar = $avatar[0];
		} 
	}

	?>
	<div class="proradio-authorbox proradio-authorbox__card proradio-paper">
		<a class="proradio-authorbox__img" href="<?php echo get_author_posts_url( $user_id ); ?>">
			<?php if($avatar){ ?>
				<img src="<?php echo esc_url($avatar); ?>" alt="<?php esc_attr_e( "Avatar", "proradio" ); ?>">
			<?php } ?>
		</a>
		<h6>
			<a href="<?php echo  get_author_posts_url( $user_id  ); ?>" class="proradio-cutme"><?php echo get_the_author_meta( 'display_name', $user_id ); ?></a>
		</h6>
		<p class="proradio-caption proradio-caption__s proradio-caption__c">
			<?php echo esc_html( get_the_author_meta( 'user_title', $user_id ) ? get_the_author_meta( 'user_title', $user_id ) : esc_html__('Author', 'proradio') ) ; ?>
		</p>
	</div>
	<?php 
}
