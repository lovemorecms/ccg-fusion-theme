<?php
/**
 * Title: Landing hero concepts
 * Slug: ccg-wp-theme/landing-heroes
 * Categories: ccg-hero
 * Description: Tabbed contained and full-width hero examples.
 */
$contained_image = esc_url( ccg_wp_theme_asset_url( 'assets/images/sections/initiatives-hero-cms-gov.png' ) );
$fullwidth_image = esc_url( ccg_wp_theme_asset_url( 'assets/images/sections/hero-cloud-servers.jpg' ) );
$explore_url     = esc_url( home_url( '/explore/' ) );
?>
<!-- wp:html -->
<section id="heroes" class="lpl-section lpl-section--heroes fusion-section-reveal" aria-labelledby="heroes-heading" tabindex="-1" data-lpl-tabs>
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="heroes-heading" class="lpl-section__title"><?php esc_html_e( 'Heroes', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Hero patterns for program and platform landing pages. Each concept shows a different treatment for background imagery, copy placement, and optional calls to action.', 'ccg-wp-theme' ); ?></p>
		</header>

		<div class="lpl-ms-tabs lpl-ms-tabs--heroes">
			<div class="lpl-ms-tabs__bar" role="tablist" aria-label="<?php esc_attr_e( 'Hero concept variants', 'ccg-wp-theme' ); ?>">
				<button type="button" role="tab" id="lpl-hero-image-copy-tab" class="lpl-ms-tabs__tab lpl-ms-tabs__tab--active" aria-selected="true" aria-controls="lpl-hero-image-copy-panel" tabindex="0" data-tab="image-copy"><?php esc_html_e( 'Image + copy', 'ccg-wp-theme' ); ?></button>
				<button type="button" role="tab" id="lpl-hero-full-width-tab" class="lpl-ms-tabs__tab" aria-selected="false" aria-controls="lpl-hero-full-width-panel" tabindex="-1" data-tab="full-width-overlay"><?php esc_html_e( 'Full width + CTAs', 'ccg-wp-theme' ); ?></button>
			</div>
			<p class="lpl-hero-concept__description" data-panel="image-copy"><?php esc_html_e( 'Contained hero with a background image, gradient scrim for readability, and left-aligned title and subtitle.', 'ccg-wp-theme' ); ?></p>
			<p class="lpl-hero-concept__description" data-panel="full-width-overlay" hidden><?php esc_html_e( 'Edge-to-edge cloud infrastructure photo, weighted to the right with a soft fade into the left for title, subtitle, and CTAs.', 'ccg-wp-theme' ); ?></p>
		</div>
	</div>

	<div role="tabpanel" id="lpl-hero-image-copy-panel" aria-labelledby="lpl-hero-image-copy-tab" class="lpl-ms-tabs__panel lpl-ms-tabs__panel--heroes" data-panel="image-copy">
		<div class="lpl-container">
			<div class="lpl-hero-showcase">
				<div class="lpl-hero-showcase__band" aria-labelledby="lpl-contained-hero-heading">
					<img src="<?php echo $contained_image; ?>" alt="" class="lpl-hero-showcase__bg" decoding="async" />
					<div class="lpl-hero-showcase__scrim" aria-hidden="true"></div>
					<div class="lpl-hero-showcase__inner">
						<div class="lpl-hero-copy">
							<h3 id="lpl-contained-hero-heading" class="lpl-hero-copy__title"><span class="lpl-hero-copy__title-accent"><?php esc_html_e( 'Explore', 'ccg-wp-theme' ); ?></span> <?php esc_html_e( 'Platforms & Services', 'ccg-wp-theme' ); ?></h3>
							<p class="lpl-hero-copy__subtitle"><?php esc_html_e( 'Discover cloud platforms, FUSION toolkit products, and shared services available on CMS Hybrid Cloud—built for secure, scalable, and compliant hosting.', 'ccg-wp-theme' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div role="tabpanel" id="lpl-hero-full-width-panel" aria-labelledby="lpl-hero-full-width-tab" class="lpl-ms-tabs__panel lpl-ms-tabs__panel--heroes" data-panel="full-width-overlay" hidden>
		<div class="lpl-hero-fullwidth">
			<div class="lpl-hero-fullwidth__band" aria-labelledby="lpl-fullwidth-hero-heading">
				<img src="<?php echo $fullwidth_image; ?>" alt="<?php esc_attr_e( 'Rows of illuminated server racks in a modern cloud data center', 'ccg-wp-theme' ); ?>" class="lpl-hero-fullwidth__bg" decoding="async" />
				<div class="lpl-hero-fullwidth__overlay" aria-hidden="true"></div>
				<div class="lpl-hero-fullwidth__inner">
					<div class="lpl-hero-copy">
						<h3 id="lpl-fullwidth-hero-heading" class="lpl-hero-copy__title"><span class="lpl-hero-copy__title-accent"><?php esc_html_e( 'CMS', 'ccg-wp-theme' ); ?></span> <?php esc_html_e( 'Hybrid Cloud Program', 'ccg-wp-theme' ); ?></h3>
						<p class="lpl-hero-copy__subtitle"><?php esc_html_e( 'Secure, scalable hosting for CMS applications across AWS, Azure, Google Cloud, and Oracle—with shared services, guardrails, and operational support.', 'ccg-wp-theme' ); ?></p>
						<div class="lpl-hero-copy__actions">
							<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="#get-started">
								<?php esc_html_e( 'Get started', 'ccg-wp-theme' ); ?>
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</a>
							<a class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark" href="<?php echo $explore_url; ?>"><?php esc_html_e( 'View platforms', 'ccg-wp-theme' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->
