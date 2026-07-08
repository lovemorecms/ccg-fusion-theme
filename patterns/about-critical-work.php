<?php
/**
 * Title: About — critical work
 * Slug: ccg-wp-theme/about-critical-work
 * Categories: ccg-fusion, ccg-fusion-about
 * Inserter: yes
 * Description: Platform image cards — "We know your work is critical."
 */
?>
<!-- wp:group {"className":"kc-content","layout":{"type":"default"}} -->
<div class="kc-content">
	<!-- wp:group {"tagName":"section","className":"kc-section","anchor":"critical-work","layout":{"type":"default"}} -->
	<section id="critical-work" class="wp-block-group kc-section">
		<!-- wp:heading {"level":2,"className":"kc-section-heading po-section-heading"} -->
		<h2 class="wp-block-heading kc-section-heading po-section-heading">We know your work is critical.</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"kc-section-subtitle po-section-lede"} -->
		<p class="kc-section-subtitle po-section-lede">CMS delivers secure and effective technology services and solutions to support the critical missions of CMS and our federal and state partners in administering Medicare, Medicaid, the Children's Health Insurance Program, and the Health Insurance Marketplace.</p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<?php require get_template_directory() . '/inc/about/partials/platform-cards.php'; ?>
		<!-- /wp:html -->
	</section>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
