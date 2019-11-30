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
		<img src="<?php echo $poster_src; ?>" srcset="<?php echo $poster_srcset; ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" alt="<?php echo $title . __( ' poster art', 'ty-theme' ); ?>" />
		<figcaption>
			<?php echo sprintf( '<h2 class="archives-image-title">%1s</h2>', $title ); ?>
			<div class="clip-links">
				<?php if ( $vimeo ) : ?><a class="project-vimeo-link tooltip" data-fancybox data-caption="<?php echo esc_attr( $caption ); ?>" href="https://player.vimeo.com/video/<?php echo $vimeo; ?>?title=0&byline=0&portrait=0&color=ffffff&autoplay=1" title="<?php _e( 'Watch the trailer', 'ty-theme' ); ?>" target="_blank"><svg viewBox="0 0 448 512"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg></a><?php endif; ?>
				<a class="clip-project-link tooltip" href="<?php the_permalink(); ?>" target="_blank" title="<?php _e( 'View this project\'s info', 'ty-theme' ); ?>">
					<svg viewBox="0 0 192 512"><path d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"/></svg>
				</a>
			</div>
		</figcaption>
	</figure>
</li>