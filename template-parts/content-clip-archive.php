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
$get_title = get_field( 'clip_title' );
if ( $get_title ) {
	$title = $get_title;
} else {
	$title = get_the_title();
}

$description = get_field( 'clip_description' );
$image       = get_field( 'video_placeholder' );
$vimeo       = get_field( 'clip_vimeo_url' );
$size        = 'video-medium';
$srcset      = wp_get_attachment_image_srcset( $image['ID'], $size );
$width       = $image['sizes'][ $size . '-width' ];
$height      = $image['sizes'][ $size . '-height' ];
$gallery     = get_field( 'typ_project_gallery' );
$vimeo_data  = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo ) );

if ( $image ) {
	$thumb = $image['sizes'][ $size ];
} elseif ( $vimeo_data ) {
	$thumb = $vimeo_data->thumbnail_url;
} else {
	$thumb = get_theme_file_uri( '/assets/images/video-placeholder.jpg' );
}

if ( ! $vimeo_data ) {
	$vimeo = null;
} else {
	$vimeo = $vimeo_data->video_id;
}

if ( $title ) {
	$caption = sprintf(
		'<span class="modal-caption-title">%1s</span>',
		$title
	);
} else {
	$caption = '';
}

if ( $title && $description ) {
	$caption = sprintf(
		'<p><span class="modal-caption-title">%1s</span><br />%2s</p>',
		$title,
		$description
	);
} elseif ( $title ) {
	$caption = sprintf(
		'<p><span class="modal-caption-title">%1s</span></p>',
		$title
	);
} else {
	$caption = '';
}

?>

<li class="clip-archive-entry" id="<?php echo 'clip-' . get_the_ID(); ?>">
	<figure>
		<?php if ( $vimeo ) : ?><a data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" target="_blank"><?php endif; ?>
			<img src="<?php echo $thumb; ?>" srcset="<?php echo esc_attr( $srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
		<?php if ( $vimeo ) : ?></a><?php endif; ?>
		<figcaption>
			<?php echo sprintf( '<h2 class="archives-image-title">%1s</h2>', $title ); ?>
			<?php echo $description; ?>
		</figcaption>
	</figure>
</li>