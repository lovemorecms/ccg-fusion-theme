<?php
/**
 * Title: Dark hero with image
 * Slug: ccg-wp-theme/explore-hero
 * Categories: ccg-hero
 * Description: Dark CMS primary hero with background image, accent CTAs, and section-nav overlap room.
 */
$ccg_hero_img = esc_url( get_template_directory_uri() . '/assets/images/sections/initiatives-hero-cms-gov.png' );
?>
<!-- wp:html -->
<div class="ccg-explore-hero-wrap">
<section id="overview" class="init-hero init-hero--with-section-nav" aria-labelledby="explore-hero-heading" tabindex="-1">
	<img src="<?php echo $ccg_hero_img; ?>" alt="" class="init-hero__bg-img" decoding="async" />
	<div class="init-hero__scrim" aria-hidden="true"></div>
	<div class="init-hero__inner">
		<div class="init-hero__text">
			<h1 id="explore-hero-heading" class="init-hero__heading">
				<span class="init-hero__heading-accent">Explore</span> Platforms &amp; Services
			</h1>
			<p class="init-hero__description">
				Discover cloud platforms, FUSION toolkit products, and shared services available on CMS Hybrid Cloud—built for secure, scalable, and compliant hosting.
			</p>
			<div class="init-hero__actions">
				<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="#platforms">View All Platforms</a>
				<a class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark" href="#learn-connect">Contact Team</a>
			</div>
		</div>
	</div>
</section>
</div>
<!-- /wp:html -->
