<?php
/**
 * Title: Landing CTA band
 * Slug: ccg-wp-theme/landing-cta-band
 * Categories: ccg-cta
 */
$layouts = esc_url( home_url( '/resources/page-layouts/' ) );
$explore = esc_url( home_url( '/explore/' ) );
?>
<!-- wp:html -->
<section id="get-started" class="lpl-section lpl-section--cta-band fusion-section-reveal" aria-labelledby="get-started-heading" tabindex="-1">
	<div class="lpl-container lpl-cta-band">
		<h2 id="get-started-heading" class="lpl-cta-band__title"><?php esc_html_e( 'Ready to build your landing page?', 'ccg-wp-theme' ); ?></h2>
		<p class="lpl-cta-band__body"><?php esc_html_e( 'Combine these blocks to create program, platform, or initiative pages that match Explore and Fusion Toolkit patterns.', 'ccg-wp-theme' ); ?></p>
		<div class="lpl-cta-band__actions">
			<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="<?php echo $layouts; ?>"><?php esc_html_e( 'Back to layout library', 'ccg-wp-theme' ); ?></a>
			<a class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark" href="<?php echo $explore; ?>"><?php esc_html_e( 'View Explore page', 'ccg-wp-theme' ); ?></a>
		</div>
	</div>
</section>
<!-- /wp:html -->
