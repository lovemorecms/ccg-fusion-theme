<?php
/**
 * Homepage hero carousel.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_hero_bg = esc_url( ccg_home_asset( 'assets/images/sections/hero-cms-home-primary-blue.png' ) );
$ccg_stars   = array(
	array( 54.81, 24.18, 0.40 ), array( 92.20, 98.97, 0.78 ), array( 76.26, 61.52, 0.50 ),
	array( 16.70, 59.02, 0.59 ), array( 65.94, 64.70, 0.51 ), array( 51.88, 92.60, 0.57 ),
	array( 86.27, 58.78, 0.47 ), array( 41.03, 82.76, 0.48 ), array( 99.34, 35.09, 0.50 ),
	array( 34.51, 17.22, 0.41 ), array( 23.72, 90.95, 0.49 ), array( 47.25, 34.60, 0.50 ),
	array( 44.00, 54.67, 0.59 ), array( 78.28, 21.12, 0.53 ), array( 16.19, 79.97, 0.50 ),
	array( 57.67, 32.38, 0.64 ), array( 88.25, 9.79, 0.48 ), array( 44.31, 28.35, 0.51 ),
	array( 31.39, 52.16, 0.34 ), array( 76.49, 78.63, 0.48 ), array( 20.95, 14.17, 0.93 ),
	array( 50.98, 76.46, 0.54 ), array( 3.56, 93.39, 0.49 ), array( 71.32, 1.22, 0.50 ),
	array( 10.60, 47.34, 0.87 ), array( 98.44, 93.28, 0.66 ), array( 78.20, 40.96, 0.41 ),
	array( 26.81, 65.18, 0.50 ), array( 89.96, 49.63, 0.61 ), array( 64.15, 16.97, 0.72 ),
);

/*
 * Hero content limits (kept in sync with React):
 * - line1 + line2 share a maximum of three displayed headline lines.
 * - body copy displays a maximum of three lines.
 * - all slides occupy one grid track so copy changes never alter hero height.
 */
$ccg_slides  = array(
	array(
		'line1' => 'Your Central Access Point for',
		'line2' => 'CMS Multi-Cloud Services',
		'body'  => 'FUSION connects you to the right tools, guidance, and support for delivering mission outcomes.',
	),
	array(
		'line1' => 'Run Sensitive Workloads on',
		'line2' => 'AWS GovCloud & CMS Patterns',
		'body'  => 'Dummy copy: align landing zones, IAM guardrails, and FedRAMP-ready baselines before you ship your first workload to Amazon Web Services.',
	),
	array(
		'line1' => 'Integrate Enterprise Identity with',
		'line2' => 'Microsoft Azure & Hybrid Cloud',
		'body'  => 'Dummy copy: bridge on-prem AD, Entra ID, and cloud landing zones so teams can deploy CMS-compliant apps without re-architecting every release.',
	),
	array(
		'line1' => 'Analyze & Scale on',
		'line2' => 'Google Cloud & Data Platforms',
		'body'  => 'Dummy copy: park curated datasets in BigQuery, wire up Cloud Run services, and keep egress costs predictable while you iterate on analytics use cases.',
	),
	array(
		'line1' => 'Orchestrate Hybrid &',
		'line2' => 'FinOps Across Every Cloud',
		'body'  => 'Dummy copy: tag spend by mission, compare reserved capacity across AWS, Azure, and GCP, and give finance a single pane for chargeback and forecasts.',
	),
);
?>
<section
	id="fusion-hero"
	class="fusion-hero ccg-home-hero"
	aria-roledescription="carousel"
	aria-labelledby="fusion-hero-carousel-label"
	data-hero-slide-count="<?php echo esc_attr( (string) count( $ccg_slides ) ); ?>"
>
	<p id="fusion-hero-carousel-label" class="sr-only">
		<?php esc_html_e( 'Featured cloud topics. Use previous and next buttons or slide indicators to change slides.', 'ccg-wp-theme' ); ?>
	</p>
	<img src="<?php echo $ccg_hero_bg; ?>" alt="" class="fusion-hero__bg-img fusion-hero__bg-fill" decoding="async" fetchpriority="high" />
	<img src="<?php echo $ccg_hero_bg; ?>" alt="" class="fusion-hero__bg-img fusion-hero__bg-art" decoding="async" fetchpriority="high" />
	<div class="fusion-hero__scrim" aria-hidden="true"></div>
	<div class="fusion-hero__tint" aria-hidden="true"></div>
	<div class="fusion-hero__stars" aria-hidden="true">
		<?php foreach ( $ccg_stars as $star ) : ?>
			<span
				class="fusion-hero__star"
				style="<?php echo esc_attr( sprintf( 'left:%.2f%%;top:%.2f%%;opacity:%.2f', $star[0], $star[1], $star[2] ) ); ?>"
			></span>
		<?php endforeach; ?>
	</div>

	<div class="fusion-hero__content-wrap">
		<div class="fusion-hero__content">
			<div class="fusion-hero__slide-stage">
				<?php foreach ( $ccg_slides as $i => $slide ) : ?>
					<div
						class="fusion-hero__slide<?php echo 0 === $i ? ' fusion-hero__slide--active' : ''; ?>"
						data-hero-slide="<?php echo esc_attr( (string) $i ); ?>"
						aria-hidden="<?php echo 0 === $i ? 'false' : 'true'; ?>"
						<?php echo $i > 0 ? ' hidden' : ''; ?>
					>
						<h1 class="fusion-hero__headline"<?php echo 0 === $i ? ' id="fusion-hero-heading"' : ''; ?>>
							<span class="fusion-hero__headline-line"><?php echo esc_html( $slide['line1'] ); ?></span>
							<span class="fusion-hero__headline-accent fusion-hero__headline-line"><?php echo esc_html( $slide['line2'] ); ?></span>
						</h1>
						<p class="fusion-hero__body"><?php echo esc_html( $slide['body'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="fusion-hero__actions">
				<a class="ds-c-button ds-c-button--solid ccg-btn-accent fusion-hero__cta-primary" href="<?php echo esc_url( ccg_home_url( '/#pathways' ) ); ?>">
					<?php esc_html_e( 'Start your journey', 'ccg-wp-theme' ); ?>
				</a>
				<a class="ds-c-button ds-c-button--ghost ds-c-button--on-dark fusion-hero__cta-secondary" href="<?php echo esc_url( ccg_home_url( '/#multi-cloud-services' ) ); ?>">
					<?php esc_html_e( 'Explore cloud options', 'ccg-wp-theme' ); ?>
				</a>
			</div>
		</div>
	</div>

	<div class="fusion-hero__carousel-dock">
		<div class="fusion-hero__carousel-well" role="group" aria-label="<?php esc_attr_e( 'Carousel controls', 'ccg-wp-theme' ); ?>">
			<button type="button" class="fusion-hero__carousel-btn" data-hero-prev aria-label="<?php esc_attr_e( 'Previous slide', 'ccg-wp-theme' ); ?>">
				<svg width="9" height="16" viewBox="0 0 9 16" fill="none" aria-hidden="true"><path d="M8 15L1 8L8 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
			<div class="fusion-hero__carousel-dots" aria-label="<?php esc_attr_e( 'Slides', 'ccg-wp-theme' ); ?>">
				<?php foreach ( $ccg_slides as $i => $slide ) : ?>
					<button
						type="button"
						class="fusion-hero__carousel-dot-btn"
						data-hero-dot="<?php echo esc_attr( (string) $i ); ?>"
						aria-pressed="<?php echo 0 === $i ? 'true' : 'false'; ?>"
						aria-label="<?php echo esc_attr( sprintf( __( 'Go to slide %1$d of %2$d', 'ccg-wp-theme' ), $i + 1, count( $ccg_slides ) ) ); ?>"
					>
						<span class="fusion-hero__carousel-dot<?php echo 0 === $i ? ' fusion-hero__carousel-dot--active' : ''; ?>" aria-hidden="true"></span>
					</button>
				<?php endforeach; ?>
			</div>
			<button type="button" class="fusion-hero__carousel-btn" data-hero-next aria-label="<?php esc_attr_e( 'Next slide', 'ccg-wp-theme' ); ?>">
				<svg width="9" height="16" viewBox="0 0 9 16" fill="none" aria-hidden="true"><path d="M1 1L8 8L1 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
		</div>
	</div>
	<div class="fusion-hero__fade" aria-hidden="true"></div>
</section>
