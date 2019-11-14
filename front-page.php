<?php
/**
 * The template for displaying the static front page
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 */

get_header( 'front' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php while ( have_posts() ) :
			the_post();

			// get_template_part( 'template-parts/content', 'front-page' );

		endwhile; // End of the loop.
		?>

		</main>
	</div>

<?php get_footer( 'front' );