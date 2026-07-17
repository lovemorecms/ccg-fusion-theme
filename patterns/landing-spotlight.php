<?php
/**
 * Title: Landing spotlight splits
 * Slug: ccg-wp-theme/landing-spotlight
 * Categories: ccg-content
 */
?>
<!-- wp:html -->
<section id="spotlight" class="lpl-section lpl-section--split fusion-section-reveal" aria-labelledby="spotlight-heading" tabindex="-1" data-lpl-tabs>
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="spotlight-heading" class="lpl-section__title"><?php esc_html_e( 'Split media spotlights', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Fifty-fifty layouts for storytelling and proof points. Switch tabs to preview a feature spotlight, standard copy blocks, or reversed media.', 'ccg-wp-theme' ); ?></p>
		</header>

		<div class="lpl-ms-tabs lpl-ms-tabs--split">
			<div class="lpl-ms-tabs__bar" role="tablist" aria-label="<?php esc_attr_e( 'Split media spotlight variants', 'ccg-wp-theme' ); ?>">
				<button type="button" role="tab" id="lpl-split-feature-tab" class="lpl-ms-tabs__tab lpl-ms-tabs__tab--active" aria-selected="true" aria-controls="lpl-split-feature-panel" tabindex="0" data-tab="feature-spotlight"><?php esc_html_e( 'Feature spotlight', 'ccg-wp-theme' ); ?></button>
				<button type="button" role="tab" id="lpl-split-copy-tab" class="lpl-ms-tabs__tab" aria-selected="false" aria-controls="lpl-split-copy-panel" tabindex="-1" data-tab="copy-media"><?php esc_html_e( 'Copy + media', 'ccg-wp-theme' ); ?></button>
				<button type="button" role="tab" id="lpl-split-reverse-tab" class="lpl-ms-tabs__tab" aria-selected="false" aria-controls="lpl-split-reverse-panel" tabindex="-1" data-tab="copy-media-reverse"><?php esc_html_e( 'Reversed', 'ccg-wp-theme' ); ?></button>
			</div>
			<p class="lpl-split-variant__description" data-panel="feature-spotlight"><?php esc_html_e( 'Unified spotlight card with a photographic media panel, badge and headline overlay, and a feature list with icons plus a full-width CTA.', 'ccg-wp-theme' ); ?></p>
			<p class="lpl-split-variant__description" data-panel="copy-media" hidden><?php esc_html_e( 'Lead with narrative copy, bullets, or CTAs on the left. Place product screenshots, diagrams, or photography in the media frame on the right.', 'ccg-wp-theme' ); ?></p>
			<p class="lpl-split-variant__description" data-panel="copy-media-reverse" hidden><?php esc_html_e( 'Mirror the layout to create rhythm down the page. Useful when alternating storytelling and visual proof points.', 'ccg-wp-theme' ); ?></p>
		</div>

		<div role="tabpanel" id="lpl-split-feature-panel" aria-labelledby="lpl-split-feature-tab" class="lpl-ms-tabs__panel lpl-ms-tabs__panel--split" data-panel="feature-spotlight">
			<article class="lpl-split-spotlight" aria-labelledby="lpl-feature-spotlight-heading">
				<div class="lpl-split-spotlight__visual">
					<img src="<?php echo esc_url( ccg_wp_theme_asset_url( 'assets/images/sections/hero-cloud-servers.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Server racks and cabling in a modern cloud data center', 'ccg-wp-theme' ); ?>" class="lpl-split-spotlight__image" decoding="async" />
					<div class="lpl-split-spotlight__visual-scrim" aria-hidden="true"></div>
					<div class="lpl-split-spotlight__visual-copy">
						<span class="lpl-split-spotlight__badge"><?php esc_html_e( 'Enterprise Ready', 'ccg-wp-theme' ); ?></span>
						<h3 id="lpl-feature-spotlight-heading" class="lpl-split-spotlight__media-title"><?php esc_html_e( 'Infrastructure built for mission-critical workloads', 'ccg-wp-theme' ); ?></h3>
					</div>
				</div>
				<div class="lpl-split-spotlight__panel">
					<ul class="lpl-split-spotlight__features">
						<li class="lpl-split-spotlight__feature">
							<span class="lpl-split-spotlight__feature-icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 3.5 5 6.5v5.8c0 4.1 2.8 7.9 7 9.2 4.2-1.3 7-5.1 7-9.2V6.5L12 3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg></span>
							<div class="lpl-split-spotlight__feature-copy"><h4 class="lpl-split-spotlight__feature-title"><?php esc_html_e( 'FedRAMP High authorized', 'ccg-wp-theme' ); ?></h4><p class="lpl-split-spotlight__feature-body"><?php esc_html_e( 'Pre-approved security controls mean you inherit compliance coverage from day one — no redundant audits.', 'ccg-wp-theme' ); ?></p></div>
						</li>
						<li class="lpl-split-spotlight__feature">
							<span class="lpl-split-spotlight__feature-icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="4" y="4" width="16" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><rect x="4" y="14" width="16" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><circle cx="8" cy="7" r="1" fill="currentColor"/><circle cx="8" cy="17" r="1" fill="currentColor"/></svg></span>
							<div class="lpl-split-spotlight__feature-copy"><h4 class="lpl-split-spotlight__feature-title"><?php esc_html_e( 'Multi-cloud flexibility', 'ccg-wp-theme' ); ?></h4><p class="lpl-split-spotlight__feature-body"><?php esc_html_e( 'Deploy across AWS GovCloud and Azure Government with shared managed services like CI/CD, monitoring, and logging.', 'ccg-wp-theme' ); ?></p></div>
						</li>
						<li class="lpl-split-spotlight__feature">
							<span class="lpl-split-spotlight__feature-icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M13 2 5 13h6l-1 9 8-11h-6l1-9Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg></span>
							<div class="lpl-split-spotlight__feature-copy"><h4 class="lpl-split-spotlight__feature-title"><?php esc_html_e( 'Elastic on-demand scaling', 'ccg-wp-theme' ); ?></h4><p class="lpl-split-spotlight__feature-body"><?php esc_html_e( 'Scale up for peak periods and right-size when demand drops — with Financial Advisor guidance on cost optimization.', 'ccg-wp-theme' ); ?></p></div>
						</li>
						<li class="lpl-split-spotlight__feature">
							<span class="lpl-split-spotlight__feature-icon" aria-hidden="true"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.5"/><path d="M8.5 12.2 10.8 14.5 15.5 9.8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
							<div class="lpl-split-spotlight__feature-copy"><h4 class="lpl-split-spotlight__feature-title"><?php esc_html_e( 'Continuous ATO support', 'ccg-wp-theme' ); ?></h4><p class="lpl-split-spotlight__feature-body"><?php esc_html_e( 'Your Technical Advisor monitors your ATO posture and flags issues before they become findings.', 'ccg-wp-theme' ); ?></p></div>
						</li>
					</ul>
					<a class="ds-c-button ds-c-button--solid lpl-split-spotlight__cta" href="<?php echo esc_url( home_url( '/explore/' ) ); ?>"><?php esc_html_e( 'View all services', 'ccg-wp-theme' ); ?></a>
				</div>
			</article>
		</div>

		<div role="tabpanel" id="lpl-split-copy-panel" aria-labelledby="lpl-split-copy-tab" class="lpl-ms-tabs__panel lpl-ms-tabs__panel--split" data-panel="copy-media" hidden>
			<div class="lpl-split">
				<div class="lpl-split__copy">
					<h3 class="lpl-split__title"><?php esc_html_e( 'Text left, media right', 'ccg-wp-theme' ); ?></h3>
					<p class="lpl-split__body"><?php esc_html_e( 'Use this pattern when copy should set context before the visual. Primary and secondary actions are supported below the bullet list.', 'ccg-wp-theme' ); ?></p>
					<ul class="lpl-split__list">
						<li><?php esc_html_e( 'Section title and lede above the block', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Primary and secondary actions supported', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Responsive stack on smaller viewports', 'ccg-wp-theme' ); ?></li>
					</ul>
					<div class="lpl-split__actions">
						<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="#"><?php esc_html_e( 'Primary action', 'ccg-wp-theme' ); ?></a>
						<a class="ds-c-button ds-c-button--ghost ft-btn-secondary" href="#"><?php esc_html_e( 'Secondary action', 'ccg-wp-theme' ); ?></a>
					</div>
				</div>
				<div class="lpl-split__media" aria-hidden="true">
					<div class="lpl-split__media-frame">
						<span class="lpl-split__media-label"><?php esc_html_e( 'Media placeholder — 4:3 ratio', 'ccg-wp-theme' ); ?></span>
					</div>
				</div>
			</div>
		</div>

		<div role="tabpanel" id="lpl-split-reverse-panel" aria-labelledby="lpl-split-reverse-tab" class="lpl-ms-tabs__panel lpl-ms-tabs__panel--split" data-panel="copy-media-reverse" hidden>
			<div class="lpl-split lpl-split--reverse">
				<div class="lpl-split__copy">
					<h3 class="lpl-split__title"><?php esc_html_e( 'Text right, media left', 'ccg-wp-theme' ); ?></h3>
					<p class="lpl-split__body"><?php esc_html_e( 'Reversed column order on large screens keeps the same typography and spacing tokens while flipping visual emphasis.', 'ccg-wp-theme' ); ?></p>
					<ul class="lpl-split__list">
						<li><?php esc_html_e( 'Reversed column order on large screens', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Same typography and spacing tokens', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Optional eyebrow or badge above title', 'ccg-wp-theme' ); ?></li>
					</ul>
					<div class="lpl-split__actions">
						<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="#"><?php esc_html_e( 'See example', 'ccg-wp-theme' ); ?></a>
					</div>
				</div>
				<div class="lpl-split__media" aria-hidden="true">
					<div class="lpl-split__media-frame">
						<span class="lpl-split__media-label"><?php esc_html_e( 'Media placeholder — reversed', 'ccg-wp-theme' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->
