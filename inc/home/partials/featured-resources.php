<?php
/**
 * Homepage Featured Resources.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_cards = array(
	array( 'spotlight', __( 'FUSION Spotlight', 'ccg-wp-theme' ), __( 'Platform overview', 'ccg-wp-theme' ), ccg_home_url( '/about/program-overview' ), '' ),
	array( 'briefings', __( 'Executive Briefings', 'ccg-wp-theme' ), __( 'Stakeholder updates', 'ccg-wp-theme' ), ccg_home_url( '/learn/initiatives' ), 'violet' ),
	array( 'status', __( 'System Status', 'ccg-wp-theme' ), __( 'All Systems Operational', 'ccg-wp-theme' ), ccg_home_url( '/learn/knowledge-center' ), 'success' ),
	array( 'announcements', __( 'Announcements', 'ccg-wp-theme' ), __( 'Latest program updates', 'ccg-wp-theme' ), ccg_home_url( '/#fusion-announcements' ), 'sky' ),
);
?>
<section id="fusion-featured-resources" class="fusion-featured-resources fusion-band-gradient-primary-mist" aria-labelledby="fusion-featured-resources-heading">
	<div class="fusion-featured-resources__inner">
		<header class="fusion-featured-resources__header fusion-home-section__header">
			<h2 id="fusion-featured-resources-heading" class="fusion-featured-resources__heading"><?php esc_html_e( 'Featured Resources', 'ccg-wp-theme' ); ?></h2>
			<p class="fusion-featured-resources__support"><?php esc_html_e( 'Quick links to program updates, status, and overview materials.', 'ccg-wp-theme' ); ?></p>
		</header>
		<ul class="fusion-featured-resources__grid">
			<?php foreach ( $ccg_cards as $card ) : ?>
				<li>
					<article class="fusion-featured-resources__card" aria-labelledby="fusion-featured-<?php echo esc_attr( $card[0] ); ?>">
						<span class="fusion-featured-resources__status-dot" aria-hidden="true"></span>
						<?php if ( $card[4] ) : ?>
							<span class="fusion-featured-resources__accent-glow fusion-featured-resources__accent-glow--<?php echo esc_attr( $card[4] ); ?>" aria-hidden="true"></span>
						<?php endif; ?>
						<h3 id="fusion-featured-<?php echo esc_attr( $card[0] ); ?>" class="fusion-featured-resources__card-title"><?php echo esc_html( $card[1] ); ?></h3>
						<a class="fusion-featured-resources__card-link" href="<?php echo esc_url( $card[3] ); ?>">
							<span><?php echo esc_html( $card[2] ); ?></span>
							<span class="fusion-featured-resources__arrow" aria-hidden="true">→</span>
						</a>
					</article>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
