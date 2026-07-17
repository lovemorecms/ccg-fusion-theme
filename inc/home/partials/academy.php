<?php
/**
 * Homepage Fusion Academy.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_hero_bg = esc_url( ccg_home_asset( 'assets/images/sections/fusion-academy-hero.png' ) );
$ccg_tiles   = array(
	array(
		'paths',
		__( 'Role-based learning paths:', 'ccg-wp-theme' ),
		array( __( 'Business', 'ccg-wp-theme' ), __( 'Technical', 'ccg-wp-theme' ), __( 'Support teams', 'ccg-wp-theme' ) ),
		__( 'Start Learning', 'ccg-wp-theme' ),
		ccg_home_url( '/#fusion-academy-offerings' ),
		'sky',
	),
	array(
		'docs',
		__( 'Documentation Library', 'ccg-wp-theme' ),
		array( __( 'Playbooks', 'ccg-wp-theme' ), __( 'Architecture patterns', 'ccg-wp-theme' ), __( 'Onboarding guides', 'ccg-wp-theme' ) ),
		__( 'View Docs', 'ccg-wp-theme' ),
		ccg_home_url( '/learn/knowledge-center' ),
		'violet',
	),
	array(
		'tools',
		__( 'Decision Support Tools', 'ccg-wp-theme' ),
		array(
			__( 'Cost calculators', 'ccg-wp-theme' ),
			__( 'Platform selection tools', 'ccg-wp-theme' ),
			__( 'Migration readiness assessments', 'ccg-wp-theme' ),
		),
		__( 'View Tools', 'ccg-wp-theme' ),
		ccg_home_url( '/about/program-overview' ),
		'success',
	),
);
?>
<section id="fusion-academy" class="fusion-academy">
	<div class="fusion-academy__hero" style="background-image:url(<?php echo $ccg_hero_bg; ?>)">
		<div class="fusion-academy__hero-inner">
			<div class="fusion-academy__copy">
				<p class="fusion-academy__eyebrow"><?php esc_html_e( 'Empowering knowledge across the cloud ecosystem.', 'ccg-wp-theme' ); ?></p>
				<h2 id="fusion-academy-heading" class="fusion-academy__heading">
					<span class="fusion-academy__heading-word"><?php esc_html_e( 'Fusion', 'ccg-wp-theme' ); ?></span>
					<span class="fusion-hero__headline-accent fusion-academy__heading-accent"><?php esc_html_e( 'Academy', 'ccg-wp-theme' ); ?></span>
				</h2>
				<p class="fusion-academy__lede"><?php esc_html_e( 'Learning in motion—connected, guided, and built for the CMS cloud ecosystem.', 'ccg-wp-theme' ); ?></p>
				<p class="fusion-academy__body"><?php esc_html_e( 'FUSION Academy is the learning and enablement layer of the Fusion Ecosystem—providing structured pathways, training resources, and guided experiences that empower CMS stakeholders to build knowledge, develop skills, and confidently navigate the multi-cloud landscape.', 'ccg-wp-theme' ); ?></p>
				<div class="fusion-academy__actions">
					<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="<?php echo esc_url( ccg_home_url( '/#fusion-academy-offerings' ) ); ?>"><?php esc_html_e( 'Start Learning', 'ccg-wp-theme' ); ?></a>
					<a class="ds-c-button ds-c-button--ghost fusion-academy__cta-secondary" href="<?php echo esc_url( ccg_home_url( '/#fusion-academy-offerings' ) ); ?>"><?php esc_html_e( 'Explore Paths', 'ccg-wp-theme' ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<div id="fusion-academy-offerings" class="fusion-academy__offerings fusion-band-gradient-primary-mist" aria-labelledby="fusion-academy-offerings-heading">
		<div class="fusion-academy__offerings-inner">
			<h2 id="fusion-academy-offerings-heading" class="sr-only"><?php esc_html_e( 'Fusion Academy offerings', 'ccg-wp-theme' ); ?></h2>
			<ul class="fusion-academy-offerings__grid">
				<?php foreach ( $ccg_tiles as $tile ) : ?>
					<li>
						<article class="fusion-academy-offerings__card" aria-labelledby="fusion-academy-tile-<?php echo esc_attr( $tile[0] ); ?>">
							<span class="fusion-academy-offerings__status-dot" aria-hidden="true"></span>
							<span class="fusion-academy-offerings__accent-glow fusion-academy-offerings__accent-glow--<?php echo esc_attr( $tile[5] ); ?>" aria-hidden="true"></span>
							<span class="fusion-academy-offerings__icon-ring" aria-hidden="true">
								<svg viewBox="0 0 24 24" fill="none" focusable="false">
									<path d="M5 19v-8M12 19V5M19 19v-8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
								</svg>
							</span>
							<h3 id="fusion-academy-tile-<?php echo esc_attr( $tile[0] ); ?>" class="fusion-academy-offerings__title"><?php echo esc_html( $tile[1] ); ?></h3>
							<ul class="fusion-academy-offerings__list">
								<?php foreach ( $tile[2] as $bullet ) : ?>
									<li><?php echo esc_html( $bullet ); ?></li>
								<?php endforeach; ?>
							</ul>
							<a class="fusion-academy-offerings__cta" href="<?php echo esc_url( $tile[4] ); ?>">
								<span><?php echo esc_html( $tile[3] ); ?></span>
								<span class="fusion-academy-offerings__cta-arrow" aria-hidden="true">→</span>
							</a>
						</article>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
