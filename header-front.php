<?php
/**
 * The header for the front page
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 *
 * @todo       Add hooks for nav above or below header.
 */

if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

?>
<!doctype html>
<?php do_action( 'before_html' ); ?>
<html <?php language_attributes(); ?> class="no-js front-html">
<head id="<?php echo get_bloginfo( 'wpurl' ); ?>" data-template-set="<?php echo get_template(); ?>">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open() ) {
		echo sprintf( '<link rel="pingback" href="%s" />', get_bloginfo( 'pingback_url' ) );
	} ?>
	<link href="<?php echo $canonical; ?>" rel="canonical" />
	<?php if ( is_search() ) { echo '<meta name="robots" content="noindex,nofollow" />'; } ?>

	<!-- Prefetch font URLs -->
	<link rel='dns-prefetch' href='//fonts.adobe.com'/>
	<link rel='dns-prefetch' href='//fonts.google.com'/>

	<?php do_action( 'before_wp_head' ); ?>
	<?php wp_head(); ?>
	<?php do_action( 'after_wp_head' ); ?>
</head>

<body <?php body_class(); ?>>
<?php TY_Theme\Tags\before_page(); ?>
<div id="page" class="site" itemscope="itemscope" itemtype="<?php TY_Theme\Tags\site_schema(); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ty-theme' ); ?></a>

	<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
		<div class="site-branding">
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<?php
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>
		</div>
	</header>

	<nav id="site-navigation" class="main-navigation front-navigation" role="directory" itemscope itemtype="http://schema.org/SiteNavigationElement">
		<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="theme-icon menu-icon"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
			<?php esc_html_e( 'Menu', 'ty-theme' ); ?>
		</button>
		<?php
		wp_nav_menu( [
			'theme_location' => 'main',
			'menu_id'        => 'main-menu',
		] );
		?>
	</nav>

	<?php
	// Check for the Advanced Custom Fields Pro plugin.
	if ( class_exists( 'acf_pro' ) ) :

		// Intro slides and content.
		$slides = get_field( 'ryt_intro_gallery' );
		$size   = 'slide';
		if ( $slides ) : ?>
		<div class="intro-image">
			<div id="slick-flexbox-fix"><!-- Stops SlickJS from getting original image rather than the intro-large size" -->
				<ul class="intro-slides">
					<?php foreach( $slides as $slide ) :
						$thumb  = $slide['sizes'][ $size ];
						$width  = $slide['sizes'][ $size . '-width' ];
						$height = $slide['sizes'][ $size . '-height' ];
					?>
					<li class="slide" style="background-image: url('<?php echo $thumb; ?>');"></li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	<?php endif; ?>

	<div id="content" class="site-content">
