<?php
/**
 * Title: About — services & stats
 * Slug: ccg-wp-theme/about-services-stats
 * Categories: ccg-fusion, ccg-fusion-about
 * Inserter: yes
 * Description: Services heading with uptime, support, compliance, and infrastructure stats.
 */
?>
<!-- wp:group {"className":"kc-content","layout":{"type":"default"}} -->
<div class="kc-content">
	<!-- wp:group {"tagName":"section","className":"kc-section","anchor":"services","layout":{"type":"default"}} -->
	<section id="services" class="wp-block-group kc-section">
		<!-- wp:heading {"level":2,"className":"kc-section-heading po-section-heading"} -->
		<h2 class="wp-block-heading kc-section-heading po-section-heading">Services to suit your needs</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"kc-section-subtitle po-section-lede"} -->
		<p class="kc-section-subtitle po-section-lede">From legacy modernization to cloud migration, CMS offers comprehensive technology services designed to meet the unique demands of healthcare and human services programs.</p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<?php require get_template_directory() . '/inc/about/partials/stats-list.php'; ?>
		<!-- /wp:html -->
	</section>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
