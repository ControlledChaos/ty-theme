<?php
/**
 * Template part for displaying film single posts
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

// Project title.
$get_title = get_field( 'typ_project_title' );
if ( $get_title ) {
	$title = $get_title;
} else {
	$title = get_the_title();
}

// Project info.
$description = get_field( 'typ_project_description' );
$director    = get_field( 'typ_project_director' );
$imdb_page   = get_field( 'typ_project_imdb_page' );

// Poster image.
$poster_image  = get_field( 'typ_poster_image' );
$poster_size   = 'poster-large';
$poster_width  = $poster_image['sizes'][ $poster_size . '-width' ];
$poster_height = $poster_image['sizes'][ $poster_size . '-height' ];

// Vimeo video image.
$video_image  = get_field( 'typ_project_image' );
$vimeo_video  = get_field( 'typ_project_vimeo_id' );
$video_size   = 'video-large';
$video_width  = $video_image['sizes'][ $video_size . '-width' ];
$video_height = $video_image['sizes'][ $video_size . '-height' ];
$vimeo_data = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $vimeo_video ) );

if ( $poster_image ) {
	$poster_src    = $poster_image['sizes'][ $poster_size ];
	$poster_srcset = wp_get_attachment_image_srcset( $poster_image['ID'], $poster_size );
} else {
	$poster_src    = get_theme_file_uri( '/assets/images/poster-placeholder.jpg' );
	$poster_srcset = null;
}

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

if ( $title && $director ) {
	$caption = $title . '<br />Directed by ' . $director;
} elseif ( $title ) {
	$caption = $title;
} else {
	$caption = '';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
	<div class="entry-content" itemprop="articleBody">
		<div class="project-top project-top-film">
			<figure class="poster-image">
				<a href="<?php echo $poster_image['url']; ?>" data-fancybox>
					<img src="<?php echo $poster_src; ?>" srcset="<?php echo $poster_srcset; ?>" sizes="(max-width: 640px) 640px, (max-width: 960px) 960px, 640px" alt="<?php echo $title . __( ' poster art', 'ty-theme' ); ?>" />
				</a>
				<figcaption class="screen-reader-text">
					<?php echo $title . __( ' poster art', 'ty-theme' ); ?>
				</figcaption>
			</figure>
			<section class="project-summary">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>
				<?php echo sprintf(
					'<p><strong>%1s</strong><br />%2s</p>',
					__( 'Description:' ),
					$description
				); ?>
				<?php if ( $imdb_page ) {
					echo sprintf(
						'<p>%2s<br /><a href="%1s" target="_blank">%3s</a></p>',
						__( 'More info on IMDb:', 'ty-theme' ),
						$imdb_page,
						$imdb_page
					);
				} ?>
			</section>
		</div>
		<div class="project-video-embed">
			<iframe src="https://player.vimeo.com/video/<?php echo $vimeo; ?>?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0"></iframe>
		</div>
	</div>

	<footer class="entry-footer">
		<?php TY_Theme\Tags\entry_footer(); ?>
	</footer>
</article>