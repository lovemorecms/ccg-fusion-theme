<?php
/**
 * Title: About — critical work
 * Slug: ccg-wp-theme/about-critical-work
 * Categories: ccg-fusion, ccg-fusion-about
 * Inserter: yes
 * Description: Platform image cards — "We know your work is critical."
 */
$ccg_po_secure_img = esc_url( ccg_about_program_image_url( 'secure-platforms.jpg' ) );
$ccg_po_scale_img  = esc_url( ccg_about_program_image_url( 'scalable-platforms.jpg' ) );
$ccg_po_stress_img = esc_url( ccg_about_program_image_url( 'stress-tested-platforms.jpg' ) );
?>
<!-- wp:group {"className":"kc-content ccg-about-sections","layout":{"type":"default"}} -->
<div class="wp-block-group kc-content ccg-about-sections">
	<!-- wp:group {"tagName":"section","className":"kc-section","anchor":"critical-work","layout":{"type":"default"}} -->
	<section id="critical-work" class="wp-block-group kc-section">
		<!-- wp:heading {"level":2,"className":"kc-section-heading po-section-heading"} -->
		<h2 class="wp-block-heading kc-section-heading po-section-heading">We know your work is critical.</h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"kc-section-subtitle po-section-lede"} -->
		<p class="kc-section-subtitle po-section-lede">CMS delivers secure and effective technology services and solutions to support the critical missions of CMS and our federal and state partners in administering Medicare, Medicaid, the Children's Health Insurance Program, and the Health Insurance Marketplace.</p>
		<!-- /wp:paragraph -->

		<!-- wp:group {"className":"po-platform-grid","layout":{"type":"default"}} -->
		<div class="wp-block-group po-platform-grid">
			<!-- wp:group {"tagName":"article","className":"po-platform-card","layout":{"type":"default"}} -->
			<article class="wp-block-group po-platform-card">
				<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"po-platform-card__media"} -->
				<figure class="wp-block-image size-large po-platform-card__media"><img src="<?php echo $ccg_po_secure_img; ?>" alt="" loading="lazy" decoding="async"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"className":"po-platform-card__body","layout":{"type":"default"}} -->
				<div class="wp-block-group po-platform-card__body">
					<!-- wp:heading {"level":3,"className":"po-platform-card__title"} -->
					<h3 class="wp-block-heading po-platform-card__title">Secure platforms</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"className":"po-platform-card__desc"} -->
					<p class="po-platform-card__desc">Our infrastructure is built with security at its core, meeting the highest standards for government and healthcare.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</article>
			<!-- /wp:group -->

			<!-- wp:group {"tagName":"article","className":"po-platform-card","layout":{"type":"default"}} -->
			<article class="wp-block-group po-platform-card">
				<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"po-platform-card__media"} -->
				<figure class="wp-block-image size-large po-platform-card__media"><img src="<?php echo $ccg_po_scale_img; ?>" alt="" loading="lazy" decoding="async"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"className":"po-platform-card__body","layout":{"type":"default"}} -->
				<div class="wp-block-group po-platform-card__body">
					<!-- wp:heading {"level":3,"className":"po-platform-card__title"} -->
					<h3 class="wp-block-heading po-platform-card__title">Scalable platforms</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"className":"po-platform-card__desc"} -->
					<p class="po-platform-card__desc">Grow with confidence knowing our systems can handle peak demands and expand as your needs evolve.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</article>
			<!-- /wp:group -->

			<!-- wp:group {"tagName":"article","className":"po-platform-card","layout":{"type":"default"}} -->
			<article class="wp-block-group po-platform-card">
				<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"po-platform-card__media"} -->
				<figure class="wp-block-image size-large po-platform-card__media"><img src="<?php echo $ccg_po_stress_img; ?>" alt="" loading="lazy" decoding="async"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"className":"po-platform-card__body","layout":{"type":"default"}} -->
				<div class="wp-block-group po-platform-card__body">
					<!-- wp:heading {"level":3,"className":"po-platform-card__title"} -->
					<h3 class="wp-block-heading po-platform-card__title">Stress-tested platforms</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"className":"po-platform-card__desc"} -->
					<p class="po-platform-card__desc">Rigorously tested and proven to deliver reliable performance under the most demanding conditions.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</article>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</section>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
