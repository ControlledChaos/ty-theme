<?php
/**
 * Template part for displaying the contact page
 *
 * @package    WordPress/ClassicPress
 * @subpackage TY_Theme
 * @since      1.0.0
 */

$contact_info = get_field( 'typ_contact_info' );
if ( $contact_info ) {
	$title_class = '';
} else {
	$title_class = '';
} ?>
<article class="global-wrapper hentry" id="post-<?php the_ID(); ?>" role="article">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title ' . $title_class . '">', '</h1>' ); ?>
	</header>
	<div class="entry-content" itemprop="articleBody">
		<div class="info-page-content">
			<?php if ( $contact_info ) { echo get_field( 'typ_contact_info' ); } ?>
			<?php if ( have_rows( 'typ_agency' ) ) :  while ( have_rows( 'typ_agency' ) ) : the_row(); ?>
			<div class="agency-content">
				<h3><span><?php echo get_sub_field( 'typ_agency_name' ); ?></span></h3>
				<?php if ( have_rows( 'typ_agents' ) ) : ?>
				<ul class="agents-list">
					<?php while ( have_rows( 'typ_agents' ) ) : the_row();
					$name  = get_sub_field( 'typ_agent_name' );
					$dept  = get_sub_field( 'typ_agent_department' );
					$phone = get_sub_field( 'typ_agent_phone' );
					$email = get_sub_field( 'typ_agent_email' ); ?>
					<li>
						<span class="agent agent-department"><?php echo $dept; ?></span> | <span class="agent agent-name"><?php echo $name; ?></span>
						<br /><a class="agent-email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
						<br /><a class="agent-tel" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
					</li>
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>
				<?php if ( get_sub_field( 'typ_agency_info' ) ) { ?>
				<div class="agency-info">
					<div class="agency-info-image">
						<?php $image  = get_sub_field( 'typ_agency_logo' );
						if ( ! empty( $image ) ) { ?>
							<img class="agency-logo" src="<?php echo $image; ?>" alt="<?php echo get_sub_field( 'typ_agency_name' ); ?>" />
						<?php } ?>
					</div>
					<div class="agency-info-content">
						<?php echo get_sub_field( 'typ_agency_info' ); ?>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php endwhile; endif; ?>
			<div class="resume-link">
				<?php the_field( 'typ_resume_notice' ); ?>
				<?php
				$type = get_field( 'typ_resume_type' );
				$link = get_field( 'typ_resume_link' );
				$file = get_field( 'typ_resume_file' );
				if ( 'url' == $type && ! empty( $link ) ) {
					echo sprintf(
						'<p><a class="button resume-link-button tooltip" href="%1s" target="_blank">%2s</a></p>',
						esc_url( $link ),
						__( 'Download Resume', 'typ-theme' )
					);
				} elseif ( 'file' == $type && ! empty( $file ) ) {
					echo sprintf(
						'<p><a class="button resume-link-button tooltip" href="%1s" target="_blank">%2s</a></p>',
						esc_url( $file['url'] ),
						__( 'Download Resume', 'typ-theme' )
					);
				} ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div><!-- entry-content -->
</article>