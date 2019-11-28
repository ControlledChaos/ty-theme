<?php
/**
 * Template part for displaying clip single posts
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 *
 * <?php echo sprintf(); ?>
 */

/**
 * Set up custom fields
 */

// Clip title.
$get_title = get_field( 'clip_title' );
if ( $get_title ) {
	$title = sprintf(
		'<h1 class="entry-title">%1s</h1>',
		$get_title
	);
} else {
	$title = sprintf(
		'<h1 class="entry-title">%1s</h1>',
		get_the_title()
	);
}

// Clip info.
$description = get_field( 'clip_description' );
$clip_info   = get_field( 'clip_info' );

// Vimeo video image.
$video_image  = get_field( 'clip_image' );
$vimeo_video  = get_field( 'clip_vimeo_url' );
$video_size   = 'video-large';
$video_width  = $video_image['sizes'][ $video_size . '-width' ];
$video_height = $video_image['sizes'][ $video_size . '-height' ];
$vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo_video ) );

if ( $video_image ) {
	$thumb = $video_image['sizes'][ $video_size ];
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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<div class="entry-content" itemprop="articleBody">
		<div class="clip-top">
			<header class="entry-header">

			<?php echo $title; ?>
				<?php if ( $description ) {
					echo sprintf(
						'<p><span class="clip-description-label">%1s</span> <br />%2s</p>',
						__( 'Description:', 'ty-theme' ),
						$description
					);
				} ?>
				<?php echo $clip_info; ?>
			</header>
		</div>
		<div class="project-video-embed">
			<iframe src="https://player.vimeo.com/video/<?php echo $vimeo; ?>?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe>
		</div>
	</div>
</article>