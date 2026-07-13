<?php
/**
 * Title: Landing spotlight splits
 * Slug: ccg-wp-theme/landing-spotlight
 * Categories: ccg-content
 */
?>
<!-- wp:html -->
<section id="spotlight" class="lpl-section lpl-section--split" aria-labelledby="spotlight-heading" tabindex="-1">
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="spotlight-heading" class="lpl-section__title"><?php esc_html_e( 'Split media layouts', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Fifty-fifty sections with copy on one side and a visual placeholder on the other. Include a standard and reversed variant.', 'ccg-wp-theme' ); ?></p>
		</header>
		<div class="lpl-split-stack">
			<div class="lpl-split">
				<div class="lpl-split__copy">
					<h3 class="lpl-split__title"><?php esc_html_e( 'Text left, media right', 'ccg-wp-theme' ); ?></h3>
					<p class="lpl-split__body"><?php esc_html_e( 'Lead with narrative copy, bullets, or CTAs on the left. Place product screenshots, diagrams, or photography in the media frame on the right.', 'ccg-wp-theme' ); ?></p>
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
			<div class="lpl-split lpl-split--reverse">
				<div class="lpl-split__copy">
					<h3 class="lpl-split__title"><?php esc_html_e( 'Text right, media left', 'ccg-wp-theme' ); ?></h3>
					<p class="lpl-split__body"><?php esc_html_e( 'Mirror the layout to create rhythm down the page. Useful when alternating storytelling and visual proof points.', 'ccg-wp-theme' ); ?></p>
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
