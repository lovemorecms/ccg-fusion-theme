<?php
/**
 * Title: Landing cards section
 * Slug: ccg-wp-theme/landing-cards
 * Categories: ccg-cards
 * Description: Card grid with layout variant tabs (defaults to 3-up).
 */
$cards = array(
	array(
		'title' => 'Secure by design',
		'body'  => 'Template copy for a primary capability. Replace with program-specific messaging about compliance and guardrails.',
		'cta'   => 'Learn more',
	),
	array(
		'title' => 'Built for teams',
		'body'  => 'Describe collaboration patterns, shared services, or self-service workflows available to application teams.',
		'cta'   => 'Explore tools',
	),
	array(
		'title' => 'Scale with confidence',
		'body'  => 'Summarize elastic capacity, automation, or operational support that helps teams grow workloads safely.',
		'cta'   => 'View capabilities',
	),
	array(
		'title' => 'Operate with clarity',
		'body'  => 'Highlight observability, runbooks, and support channels that keep production workloads healthy after launch.',
		'cta'   => 'See support',
	),
);
$visible = array_slice( $cards, 0, 3 );
?>
<!-- wp:html -->
<section id="cards" class="lpl-section lpl-section--cards fusion-section-reveal fusion-section-reveal--stagger" aria-labelledby="cards-heading" tabindex="-1">
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="cards-heading" class="lpl-section__title"><?php esc_html_e( 'Card layouts', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Switch between common card grid patterns for capabilities, services, or pathways. Use the tabs to preview two-up, three-up, four-up, and text-only variants.', 'ccg-wp-theme' ); ?></p>
		</header>
		<div class="lpl-ms-tabs lpl-ms-tabs--cards" data-lpl-card-tabs>
			<div class="lpl-ms-tabs__bar" role="tablist" aria-label="<?php esc_attr_e( 'Card layout variants', 'ccg-wp-theme' ); ?>">
				<button type="button" role="tab" class="lpl-ms-tabs__tab lpl-ms-tabs__tab--active" aria-selected="true" data-layout="three"><?php esc_html_e( '3 cards', 'ccg-wp-theme' ); ?></button>
				<button type="button" role="tab" class="lpl-ms-tabs__tab" aria-selected="false" data-layout="two"><?php esc_html_e( '2 cards', 'ccg-wp-theme' ); ?></button>
				<button type="button" role="tab" class="lpl-ms-tabs__tab" aria-selected="false" data-layout="four"><?php esc_html_e( '4 cards', 'ccg-wp-theme' ); ?></button>
				<button type="button" role="tab" class="lpl-ms-tabs__tab" aria-selected="false" data-layout="text"><?php esc_html_e( 'Text grid', 'ccg-wp-theme' ); ?></button>
			</div>
			<div class="lpl-ms-tabs__panel" role="tabpanel">
				<div class="lpl-card-grid lpl-card-grid--three" data-lpl-card-grid>
					<?php foreach ( $visible as $i => $card ) : ?>
					<article class="lpl-card" data-card-index="<?php echo (int) $i; ?>">
						<div class="lpl-card__icon-wrap" aria-hidden="true">
							<svg width="28" height="28" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="13" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="3" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="13" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/></svg>
						</div>
						<h3 class="lpl-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="lpl-card__body"><?php echo esc_html( $card['body'] ); ?></p>
						<a class="ds-c-button ds-c-button--ghost lpl-card__cta" href="#"><?php echo esc_html( $card['cta'] ); ?></a>
					</article>
					<?php endforeach; ?>
					<?php
					// Fourth card kept in DOM for 4-up tab (hidden until selected via JS).
					$fourth = $cards[3];
					?>
					<article class="lpl-card" data-card-index="3" hidden>
						<div class="lpl-card__icon-wrap" aria-hidden="true">
							<svg width="28" height="28" viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="13" y="3" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="3" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/><rect x="13" y="13" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.5"/></svg>
						</div>
						<h3 class="lpl-card__title"><?php echo esc_html( $fourth['title'] ); ?></h3>
						<p class="lpl-card__body"><?php echo esc_html( $fourth['body'] ); ?></p>
						<a class="ds-c-button ds-c-button--ghost lpl-card__cta" href="#"><?php echo esc_html( $fourth['cta'] ); ?></a>
					</article>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->
