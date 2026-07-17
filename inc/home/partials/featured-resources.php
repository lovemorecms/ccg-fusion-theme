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

$ccg_featured_icon = static function ( $icon ) {
	$icons = array(
		'spotlight'     => '<svg viewBox="0 0 24 24" fill="none" focusable="false"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/><path d="M14 2v6h6M9 13h6M9 17h4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>',
		'briefings'     => '<svg viewBox="0 0 24 24" fill="none" focusable="false"><path d="M4 19V5M4 19h16M7 15v3M12 9v9M17 12v6" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>',
		'status'        => '<svg viewBox="0 0 24 24" fill="none" focusable="false"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.75"/><path d="M12 8v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M12 16h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>',
		'announcements' => '<svg viewBox="0 0 24 24" fill="none" focusable="false"><path d="M18 8A6 6 0 1 0 6 8c0 7-3 7-3 7h18s-3 0-3-7M13.73 21a2 2 0 0 1-3.46 0" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	);

	return $icons[ $icon ] ?? '';
};
?>
<section id="fusion-featured-resources" class="fusion-featured-resources fusion-band-gradient-primary-mist" aria-labelledby="fusion-featured-resources-heading">
	<div class="fusion-featured-resources__inner">
		<header class="fusion-featured-resources__header fusion-home-section__header">
			<h2 id="fusion-featured-resources-heading" class="fusion-featured-resources__heading"><?php esc_html_e( 'Featured Resources', 'ccg-wp-theme' ); ?></h2>
			<p class="fusion-featured-resources__support"><?php esc_html_e( 'Heading support info', 'ccg-wp-theme' ); ?></p>
		</header>
		<ul class="fusion-featured-resources__grid">
			<?php foreach ( $ccg_cards as $card ) : ?>
				<li>
					<article class="fusion-featured-resources__card" aria-labelledby="fusion-featured-<?php echo esc_attr( $card[0] ); ?>">
						<span class="fusion-featured-resources__status-dot" aria-hidden="true"></span>
						<?php if ( $card[4] ) : ?>
							<span class="fusion-featured-resources__accent-glow fusion-featured-resources__accent-glow--<?php echo esc_attr( $card[4] ); ?>" aria-hidden="true"></span>
						<?php endif; ?>
						<span class="fusion-featured-resources__icon-ring" aria-hidden="true"><?php echo $ccg_featured_icon( $card[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
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
