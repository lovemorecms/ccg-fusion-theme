<?php
/**
 * Title: Fusion Toolkit footer band
 * Slug: ccg-wp-theme/fusion-toolkit-footer-band
 * Categories: ccg-cta
 * Description: Dark primary gradient CTA band.
 */
$explore = esc_url( ccg_nav_url( '/explore' ) );
$home    = esc_url( ccg_nav_url( '/' ) );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ft-section ft-section--footer-band ccg-fusion-toolkit-sections","layout":{"type":"default"}} -->
<section class="wp-block-group alignfull ft-section ft-section--footer-band ccg-fusion-toolkit-sections" aria-label="<?php esc_attr_e( 'Fusion Toolkit', 'ccg-wp-theme' ); ?>">
	<!-- wp:group {"className":"ft-container ft-footer-band","layout":{"type":"default"}} -->
	<div class="wp-block-group ft-container ft-footer-band">
		<!-- wp:paragraph {"className":"ft-footer-band__text"} -->
		<p class="ft-footer-band__text"><?php esc_html_e( 'Ready to explore the full Fusion Toolkit ecosystem on CMS Hybrid Cloud?', 'ccg-wp-theme' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<div class="ft-footer-band__actions">
			<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="<?php echo $explore; ?>"><?php esc_html_e( 'Back to Explore', 'ccg-wp-theme' ); ?></a>
			<a class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark" href="<?php echo $home; ?>"><?php esc_html_e( 'Return Home', 'ccg-wp-theme' ); ?></a>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
