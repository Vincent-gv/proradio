<?php
/**
 * 
 * Display the post interactions on top of the header image
 *
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/


$format = get_post_format( $post->ID );
$posttype = get_post_type( $post->ID );



/**
 * ========================================================
 * Qt Music Player compatibility
 * Display a functional player for audio posts and 
 * ========================================================
 */
switch( $posttype ){
	/**
	 * Podcast
	 * ========================================================
	 */
	case 'podcast':

		$regex_mp3 = "/.mp3/";
		$_podcast_resourceurl = esc_url( get_post_meta( $post->ID, '_podcast_resourceurl' ,true ) );
		// SINCE 2020 03 26
		// powerpress compatibility
		// Find any field called enclosure something
		// For compatibility with PowerPress
		if( !$_podcast_resourceurl ){
			$all_metas = get_post_meta(  $post->ID ) ;
			$key = preg_grep('/enclosure/', array_keys($all_metas));
			if( $key ){
				$value = $all_metas[current( $key )];
				if( is_array($value) && count($value) > 0 ){
					$file_val = $value[0];
					$arr2= explode("\n", $file_val );
					if( count( $arr2) > 1 ){
						$file_val = $arr2[0]; // should do the trick
					}
					if (strpos($file_val, '.mp3') !== false) {
					    $_podcast_resourceurl = $file_val;
					}
				}
			}
		}
		if ( preg_match ( $regex_mp3 , $_podcast_resourceurl  ) ) {
			if(function_exists('qtmplayer_play_circle')){
				$atts = array(
					'file' 		=> 	$_podcast_resourceurl,
					'classes' 	=>	'proradio-actionicon'
				);
				echo qtmplayer_play_circle( $atts );
			}
		} else {
			?>
			<a href="<?php the_permalink(); ?>" class="proradio-actionicon"><i class="material-icons">insert_link</i></a>
			<?php
		}
		break;

	/**
	 * Team members
	 * ========================================================
	 */
	case 'members':
		?>
		<a href="<?php the_permalink(); ?>" class="proradio-actionicon"><i class='material-icons'>person_outline</i></a>
		<?php
		break;
	/**
	 * Chart
	 * ========================================================
	 */
	case 'chart':
		?>
		<a href="<?php the_permalink(); ?>" class="proradio-actionicon"><i class='material-icons'>queue_music</i></a>
		<?php
		break;

	/**
	 * Event
	 * ========================================================
	 */
	case 'event':
		?>
		<a href="<?php the_permalink(); ?>" class="proradio-actionicon"><i class='material-icons'>today</i></a>
		<?php
		break;

	/**
	 * Radio channel
	 * ========================================================
	 */
	case 'radiochannel':

		if(function_exists('qtmplayer_play_circle')){
			$atts = array(
				'id' 		=> 	$post->ID,
				'classes' 	=>	'proradio-actionicon'
			);
			echo qtmplayer_play_circle( $atts );
		}
		break;
	/**
	 * Post
	 * ========================================================
	 */
	default:
		
		switch ( $format ){
			/**
			 * Post: audio
			 * ========================================================
			 */
			case 'audio': 
				// If we have QT Music Player actived we can use this one
				// ========================================================
				$player = '';
				if( function_exists( 'qtmplayer_play_circle' )) {
					$atts = array(
						'id' 		=> 	$post->ID,
						'classes' 	=>	'proradio-actionicon'
					);
					echo qtmplayer_play_circle( $atts );
				} else {
					?>
					<a href="<?php the_permalink(); ?>" class="proradio-actionicon"><i class="material-icons">insert_link</i></a>
					<?php
				}
				break;
			case 'std': 
			/**
			 * Post: audio
			 * ========================================================
			 */
			default: 
				$icon = 'insert_link';
				/**
				 * Normal post type actions
				 */
				?>	
				<a href="<?php the_permalink(); ?>" class="proradio-actionicon"><i class="material-icons">insert_link</i></a>
			<?php
		}
}

