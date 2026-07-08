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
$ccg_slides  = array(
	array(
		'line1' => 'Your Central Access Point for',
		'line2' => 'CMS Multi-Cloud Services',
		'body'  => 'FUSION connects you to the right tools, guidance, and support for delivering mission outcomes.',
	),
	array(
		'line1' => 'Run Sensitive Workloads on',
		'line2' => 'AWS GovCloud & CMS Patterns',
		'body'  => 'Align landing zones, IAM guardrails, and FedRAMP-ready baselines before you ship your first workload to Amazon Web Services.',
	),
	array(
		'line1' => 'Integrate Enterprise Identity with',
		'line2' => 'Microsoft Azure & Hybrid Cloud',
		'body'  => 'Bridge on-prem AD, Entra ID, and cloud landing zones so teams can deploy CMS-compliant apps without re-architecting every release.',
	),
	array(
		'line1' => 'Analyze & Scale on',
		'line2' => 'Google Cloud & Data Platforms',
		'body'  => 'Park curated datasets in BigQuery, wire up Cloud Run services, and keep egress costs predictable while you iterate on analytics use cases.',
	),
	array(
		'line1' => 'Orchestrate Hybrid &',
		'line2' => 'FinOps Across Every Cloud',
		'body'  => 'Tag spend by mission, compare reserved capacity across AWS, Azure, and GCP, and give finance a single pane for chargeback and forecasts.',
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
	<img src="<?php echo $ccg_hero_bg; ?>" alt="" class="fusion-hero__bg-img" decoding="async" fetchpriority="high" />
	<div class="fusion-hero__scrim" aria-hidden="true"></div>
	<div class="fusion-hero__tint" aria-hidden="true"></div>

	<div class="fusion-hero__content-wrap">
		<div class="fusion-hero__content">
			<?php foreach ( $ccg_slides as $i => $slide ) : ?>
				<div
					class="fusion-hero__slide<?php echo 0 === $i ? ' fusion-hero__slide--active' : ''; ?>"
					data-hero-slide="<?php echo esc_attr( (string) $i ); ?>"
					<?php echo 0 === $i ? ' aria-hidden="false"' : ' hidden aria-hidden="true"'; ?>
				>
					<h1 class="fusion-hero__headline"<?php echo 0 === $i ? ' id="fusion-hero-heading"' : ''; ?>>
						<span class="fusion-hero__headline-line"><?php echo esc_html( $slide['line1'] ); ?></span>
						<span class="fusion-hero__headline-accent fusion-hero__headline-line"><?php echo esc_html( $slide['line2'] ); ?></span>
					</h1>
					<p class="fusion-hero__body"><?php echo esc_html( $slide['body'] ); ?></p>
				</div>
			<?php endforeach; ?>

			<div class="fusion-hero__actions">
				<a class="ds-c-button ds-c-button--solid ccg-btn-accent fusion-hero__cta-primary" href="<?php echo esc_url( ccg_home_url( '/#pathways' ) ); ?>">
					<?php esc_html_e( 'Start your journey', 'ccg-wp-theme' ); ?>
				</a>
				<a class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark fusion-hero__cta-secondary" href="<?php echo esc_url( ccg_home_url( '/#multi-cloud-services' ) ); ?>">
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
