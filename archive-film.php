<?php
/**
 * The template for displaying archive pages
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">
			<header class="page-header">
				<?php
				echo sprintf(
					'<h1 class="page-title archive-title">%1s</h1>',
					esc_html__( 'Feature Films', 'ty-theme' )
				); ?>
			</header>
			<?php if ( have_posts() ) : ?>
			<ul class="video-grid film-archive-grid">
			<?php while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'film-archive' );
			endwhile; ?>
			</ul>
			<?php the_posts_navigation(); ?>
			<?php else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
		</main>
	</div>

<?php get_footer();