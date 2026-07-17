<?php
/**
 * Title: Landing partner strip
 * Slug: ccg-wp-theme/landing-partners
 * Categories: ccg-content
 */
$logos = array( 'CMS Hybrid Cloud', 'AWS', 'Azure', 'Google Cloud', 'Oracle', 'Fusion Toolkit' );
?>
<!-- wp:html -->
<section id="partners" class="lpl-section lpl-section--partners fusion-section-reveal fusion-section-reveal--stagger" aria-labelledby="partners-heading" tabindex="-1">
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="partners-heading" class="lpl-section__title"><?php esc_html_e( 'Partner strip', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Logo row for ecosystems, integrations, or stakeholder groups. Keep logos monochrome for visual consistency.', 'ccg-wp-theme' ); ?></p>
		</header>
		<ul class="lpl-logos">
			<?php foreach ( $logos as $logo ) : ?>
			<li class="lpl-logos__item"><span class="lpl-logos__mark"><?php echo esc_html( $logo ); ?></span></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
<!-- /wp:html -->
