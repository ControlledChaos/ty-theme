<?php
/**
 * The template for displaying the footer
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 */

// Get the site name.
$site_name = esc_attr( get_bloginfo( 'name' ) );

// Copyright HTML.
$copyright = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'ty-theme' ),
	get_the_time( 'Y' ),
	$site_name,
	esc_html__( 'All rights reserved', 'ty-theme' )
); ?>

	</div>

	<footer id="colophon" class="site-footer">
		<div class="footer-content global-wrapper footer-wrapper">
				<?php echo $copyright; ?>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
<script>
jQuery( document ).ready( function ($) {

	var button = $( '#theme-toggle' );

    // Check local storage and set theme.
    if ( localStorage.theme ) {
		$( 'body' ).addClass( localStorage.theme );
		$( button ).text( localStorage.text );
	} else {

		// Set default theme.
		$( 'body' ).addClass( 'light-mode' );
		$( button ).text( '<?php esc_html_e( 'Dark Theme', 'ty-theme' ); ?>' );
	}

	// Switch theme and store in local storage.
	$( button ).click( function() {

		if ( $ ( 'body' ).hasClass( 'light-mode') ) {
			$( 'body' ).removeClass( 'light-mode' ).addClass( 'dark-mode' );
			$( button ).text( '<?php esc_html_e( 'Light Theme', 'ty-theme' ); ?>' );
			localStorage.theme = 'dark-mode';
			localStorage.text  = '<?php esc_html_e( 'Light Theme', 'ty-theme' ); ?>';
		} else {
			$( 'body' ).removeClass( 'dark-mode' ).addClass( 'light-mode' );
			$( button ).text( '<?php esc_html_e( 'Dark Theme', 'ty-theme' ); ?>' );
			localStorage.theme = 'light-mode';
			localStorage.text  = '<?php esc_html_e( 'Dark Theme', 'ty-theme' ); ?>';
		}
	});
});
</script>
</body>
</html>