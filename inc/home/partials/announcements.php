<?php
/**
 * Homepage Latest Announcements carousel.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_items = array(
	array( '2026-04-15', 'April 15, 2026', __( 'New Multi-Cloud Migration Tools Available', 'ccg-wp-theme' ), __( 'Enhanced automation capabilities for seamless cloud transitions', 'ccg-wp-theme' ), ccg_home_url( '/about/program-overview' ) ),
	array( '2026-04-18', 'April 18, 2026', __( 'Scheduled Maintenance: Match Platform', 'ccg-wp-theme' ), __( 'System updates on April 20, 2026 from 2:00 AM - 4:00 AM EST', 'ccg-wp-theme' ), ccg_home_url( '/learn/knowledge-center' ) ),
	array( '2026-04-22', 'April 22, 2026', __( 'Introducing Catalyst: Accelerated Deployments', 'ccg-wp-theme' ), __( 'New platform tool for faster CI/CD pipeline integration', 'ccg-wp-theme' ), ccg_home_url( '/learn/initiatives' ) ),
	array( '2026-04-28', 'April 28, 2026', __( 'Governance Office Hours — May Sessions', 'ccg-wp-theme' ), __( 'Drop-in Q&A for ATO artifacts and cloud control alignment', 'ccg-wp-theme' ), ccg_home_url( '/learn/knowledge-center' ) ),
	array( '2026-05-01', 'May 1, 2026', __( 'Fusion Academy: New Learning Paths Live', 'ccg-wp-theme' ), __( 'Self-paced modules for cloud governance and DevOps fundamentals', 'ccg-wp-theme' ), ccg_home_url( '/#fusion-academy' ) ),
	array( '2026-05-08', 'May 8, 2026', __( 'Security Baseline Updates', 'ccg-wp-theme' ), __( 'Review revised controls effective for new workload onboarding', 'ccg-wp-theme' ), ccg_home_url( '/learn/knowledge-center' ) ),
);
?>
<section id="fusion-announcements" class="fusion-announcements" aria-labelledby="fusion-announcements-heading">
	<div class="fusion-announcements__inner">
		<header class="fusion-announcements__header fusion-home-section__header fusion-home-section__header--banner">
			<h2 id="fusion-announcements-heading" class="fusion-announcements__title"><?php esc_html_e( 'Latest Announcements', 'ccg-wp-theme' ); ?></h2>
			<a class="ds-c-button ds-c-button--solid ccg-btn-accent fusion-announcements__view-all" href="<?php echo esc_url( ccg_home_url( '/learn/initiatives' ) ); ?>">
				<?php esc_html_e( 'View All', 'ccg-wp-theme' ); ?>
			</a>
		</header>
		<div class="fusion-announcements__viewport-wrap" data-announcements-viewport>
			<button type="button" class="fusion-announcements__arrow fusion-announcements__arrow--prev" data-announcements-prev aria-label="<?php esc_attr_e( 'Previous announcements', 'ccg-wp-theme' ); ?>" aria-controls="fusion-announcements-track" disabled>
				<span aria-hidden="true">‹</span>
			</button>
			<button type="button" class="fusion-announcements__arrow fusion-announcements__arrow--next" data-announcements-next aria-label="<?php esc_attr_e( 'Next announcements', 'ccg-wp-theme' ); ?>" aria-controls="fusion-announcements-track">
				<span aria-hidden="true">›</span>
			</button>
			<div id="fusion-announcements-track" class="fusion-announcements__track" data-announcements-track tabindex="0" role="group" aria-label="<?php esc_attr_e( 'Announcement items', 'ccg-wp-theme' ); ?>">
				<?php foreach ( $ccg_items as $item ) : ?>
					<article class="fusion-announcements__card" data-announcement-card>
						<a class="fusion-announcements__card-link" href="<?php echo esc_url( $item[4] ); ?>">
							<span class="fusion-announcements__meta">
								<time datetime="<?php echo esc_attr( $item[0] ); ?>"><?php echo esc_html( $item[1] ); ?></time>
							</span>
							<h3 class="fusion-announcements__card-title"><?php echo esc_html( $item[2] ); ?></h3>
							<p class="fusion-announcements__card-desc"><?php echo esc_html( $item[3] ); ?></p>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
