<?php
/**
 * Template part for displaying film archive posts
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 */

/**
 * Set up custom fields
 */
$get_title = get_field( 'typ_project_title' );
if ( $get_title ) {
	$title = $get_title;
} else {
	$title = get_the_title();
}

$director = get_field( 'typ_project_director' );
$image    = get_field( 'typ_project_image' );
$vimeo    = get_field( 'typ_project_vimeo_id' );
$size     = 'poster-medium';
$srcset   = wp_get_attachment_image_srcset( $image['ID'], $size );
$width    = $image['sizes'][ $size . '-width' ];
$height   = $image['sizes'][ $size . '-height' ];
$gallery  = get_field( 'typ_project_gallery' );
$vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo ) );

// Poster image.
$poster_image  = get_field( 'typ_poster_image' );
$poster_size   = 'poster-large';
$poster_width  = $poster_image['sizes'][ $poster_size . '-width' ];
$poster_height = $poster_image['sizes'][ $poster_size . '-height' ];

if ( $poster_image ) {
	$poster_src    = $poster_image['sizes'][ $poster_size ];
	$poster_srcset = wp_get_attachment_image_srcset( $poster_image['ID'], $poster_size );
} else {
	$poster_src    = get_theme_file_uri( '/assets/images/poster-placeholder.jpg' );
	$poster_srcset = null;
}

if ( ! $vimeo_data ) {
	$vimeo = null;
} else {
	$vimeo = $vimeo_data->video_id;
}

if ( $title && $director ) {
	$caption = sprintf(
		'<span class="modal-caption-title">%1s</span><br />%2s %3s',
		$title,
		__( 'Directed by', 'ty-theme' ),
		$director
	);
} elseif ( $title ) {
	$caption = $title;
} else {
	$caption = '';
}

?>

<li class="film-archive-entry" id="<?php echo 'film-' . get_the_ID(); ?>">
	<figure>
		<?php if ( $vimeo ) : ?><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank"><?php endif; ?>
			<img src="<?php echo $poster_src; ?>" srcset="<?php echo $poster_srcset; ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" alt="<?php echo $title . __( ' poster art', 'ty-theme' ); ?>" />
		<?php if ( $vimeo ) : ?></a><?php endif; ?>
		<figcaption>
			<?php echo sprintf( '<h2 class="archives-image-title">%1s</h2>', $title ); ?>
		</figcaption>
	</figure>
</li>