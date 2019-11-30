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
	<span class="clip-links">
		<a class="clip-project-link tooltip" href="<?php the_permalink(); ?>" target="_blank" title="<?php _e( 'View this clip\'s page', 'ty-theme' ); ?>"><svg width="100%" height="100%" viewBox="0 0 512 512"><path d="M326.612 185.391c59.747 59.809 58.927 155.698.36 214.59-.11.12-.24.25-.36.37l-67.2 67.2c-59.27 59.27-155.699 59.262-214.96 0-59.27-59.26-59.27-155.7 0-214.96l37.106-37.106c9.84-9.84 26.786-3.3 27.294 10.606.648 17.722 3.826 35.527 9.69 52.721 1.986 5.822.567 12.262-3.783 16.612l-13.087 13.087c-28.026 28.026-28.905 73.66-1.155 101.96 28.024 28.579 74.086 28.749 102.325.51l67.2-67.19c28.191-28.191 28.073-73.757 0-101.83-3.701-3.694-7.429-6.564-10.341-8.569a16.037 16.037 0 0 1-6.947-12.606c-.396-10.567 3.348-21.456 11.698-29.806l21.054-21.055c5.521-5.521 14.182-6.199 20.584-1.731a152.482 152.482 0 0 1 20.522 17.197zM467.547 44.449c-59.261-59.262-155.69-59.27-214.96 0l-67.2 67.2c-.12.12-.25.25-.36.37-58.566 58.892-59.387 154.781.36 214.59a152.454 152.454 0 0 0 20.521 17.196c6.402 4.468 15.064 3.789 20.584-1.731l21.054-21.055c8.35-8.35 12.094-19.239 11.698-29.806a16.037 16.037 0 0 0-6.947-12.606c-2.912-2.005-6.64-4.875-10.341-8.569-28.073-28.073-28.191-73.639 0-101.83l67.2-67.19c28.239-28.239 74.3-28.069 102.325.51 27.75 28.3 26.872 73.934-1.155 101.96l-13.087 13.087c-4.35 4.35-5.769 10.79-3.783 16.612 5.864 17.194 9.042 34.999 9.69 52.721.509 13.906 17.454 20.446 27.294 10.606l37.106-37.106c59.271-59.259 59.271-155.699.001-214.959z"/></svg></a>
		<a class="clip-page-link tooltip" href="<?php the_field( 'clip_project_link' ); ?>" target="_blank" title="<?php _e( 'View this project\'s info', 'ty-theme' ); ?>"><svg width="100%" height="100%" viewBox="0 0 192 512"><path d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"/></svg></a>
	</span>
</li>