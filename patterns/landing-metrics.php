<?php
/**
 * Title: Landing metrics band
 * Slug: ccg-wp-theme/landing-metrics
 * Categories: ccg-stats
 */
$stats = array(
	array( 'value' => '99.9%', 'label' => 'Platform availability', 'detail' => 'Rolling 12-month average' ),
	array( 'value' => '120+', 'label' => 'Applications onboarded', 'detail' => 'Across hybrid environments' ),
	array( 'value' => '24/7', 'label' => 'Operational support', 'detail' => 'Follow-the-sun coverage' ),
	array( 'value' => '4', 'label' => 'Cloud providers', 'detail' => 'AWS, Azure, GCP, Oracle' ),
);
?>
<!-- wp:html -->
<section id="metrics" class="lpl-section lpl-section--metrics fusion-section-reveal fusion-section-reveal--stagger" aria-labelledby="metrics-heading" tabindex="-1">
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="metrics-heading" class="lpl-section__title"><?php esc_html_e( 'Metrics band', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Surface program outcomes, platform stats, or adoption numbers in a scannable row.', 'ccg-wp-theme' ); ?></p>
		</header>
		<dl class="lpl-stats">
			<?php foreach ( $stats as $stat ) : ?>
			<div class="lpl-stats__item">
				<dt class="lpl-stats__label"><?php echo esc_html( $stat['label'] ); ?></dt>
				<dd class="lpl-stats__value"><?php echo esc_html( $stat['value'] ); ?></dd>
				<dd class="lpl-stats__detail"><?php echo esc_html( $stat['detail'] ); ?></dd>
			</div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>
<!-- /wp:html -->
