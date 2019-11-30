<?php
/**
 * The template for displaying all single posts
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 */

$left_arrow = '<span class="theme-icon inline-icon post-nav-icon"><svg class="arrow-left" width="100%" height="100%" viewBox="0 0 448 512"><path d="M 217.13867,45.728516 C 204.12242,48.009809 198.22314,61.485394 188.49245,68.936094 128.97521,129.07835 68.084842,187.97935 9.5039062,248.98633 c -4.7428693,9.68262 2.4662628,19.95414 10.2444068,25.42776 63.959637,63.31427 126.692627,127.98223 191.507547,190.36716 9.34702,4.63114 19.94112,-2.12806 24.95508,-10.08008 7.63329,-8.14396 19.91063,-14.85225 20.39844,-27.33203 -1.88364,-13.03277 -15.55451,-18.8119 -23.22014,-28.11359 -38.91837,-37.07519 -77.83503,-74.15219 -116.75447,-111.22625 104.19767,-0.57883 208.48278,1.00861 312.625,-0.81446 10.36449,-3.60731 12.52119,-16.29831 10.47656,-25.77734 -0.28374,-11.06599 3.50702,-24.52024 -5.14649,-33.50195 -10.5149,-7.34488 -23.81228,-2.77392 -35.68554,-3.93555 -94.07422,0 -188.14844,0 -282.22266,0 45.77242,-44.4941 93.19632,-87.38695 138.08789,-132.724609 4.84015,-9.240036 -1.62871,-20.178759 -9.72851,-25.154297 -8.34838,-7.545634 -15.06436,-20.672917 -27.90235,-20.392578 z" /></svg></span>';

$right_arrow = '<span class="theme-icon inline-icon post-nav-icon"><svg class="arrow-right" width="100%" height="100%" viewBox="0 0 448 512"><path d="m 228.95703,45.667969 c -13.79377,1.874436 -19.41339,16.701689 -30.19922,23.671875 -8.01565,6.400186 -10.20428,20.229095 -1.46679,26.894531 24.33471,22.802555 48.19713,46.117295 72.44826,69.028435 20.54412,19.57106 41.08675,39.14369 61.63181,58.71375 -104.06159,0.47605 -208.18903,-0.83334 -312.208981,0.67188 -9.9467553,3.06929 -13.2501807,15.52203 -10.9218746,24.74023 0.4894533,11.29687 -3.5028861,24.5985 4.5722656,34.17969 10.429093,8.1188 24.266336,3.20124 36.324219,4.43164 94.060551,0 188.121091,0 282.181641,0 -45.76709,44.47503 -93.15233,87.37406 -138.06055,132.67578 -4.89307,9.25321 1.59076,20.24009 9.70703,25.21094 8.18474,7.54539 14.8103,20.00157 27.22461,20.49609 13.32018,-1.81937 19.47292,-15.55249 29.17311,-23.21195 59.62345,-60.0999 120.43979,-119.12257 179.10619,-180.10641 4.77443,-9.63076 -2.40455,-20.05087 -10.21616,-25.48336 C 364.67773,174.42214 301.89248,110.42683 237.75977,47.855469 c -2.63934,-1.560965 -5.73892,-2.336926 -8.80274,-2.1875 z" /></svg></span>';

if ( 'clip' == get_post_type() ) {
	$prev_text = $left_arrow . __( 'Previous Clip', 'ty-theme' );
	$next_text = __( 'Next Clip', 'ty-theme' ) . $right_arrow;
} else {
	$prev_text = $left_arrow . '%title';
	$next_text = '%title' . $right_arrow;
}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation( [
				'prev_text'          => $prev_text,
				'next_text'          => $next_text,
				'screen_reader_text' => null
			] );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main>
	</div>

<?php get_footer();