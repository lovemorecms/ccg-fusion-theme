<?php
/**
 * Title: Interior hero with breadcrumbs
 * Slug: ccg-wp-theme/hero-interior-breadcrumbs
 * Categories: ccg-hero, ccg-breadcrumbs
 * Inserter: yes
 * Description: Dark gradient hero with breadcrumb bar, heading, lede, and two CMS buttons.
 */
$ccg_po_home_url    = esc_url( home_url( '/' ) );
$ccg_po_about_url   = esc_url( ccg_nav_url( '/about/program-overview' ) );
$ccg_po_get_started = esc_url( home_url( '/#pathways' ) );
?>
<!-- wp:group {"tagName":"header","align":"full","className":"tpl-2col-hero-band ccg-about-hero-band ccg-about-sections","layout":{"type":"default"}} -->
<header class="wp-block-group alignfull tpl-2col-hero-band ccg-about-hero-band ccg-about-sections">
	<!-- wp:html -->
	<div class="tpl-2col-breadcrumb-bar">
		<nav aria-label="Breadcrumb" class="kc-breadcrumb-inner">
			<div class="kc-breadcrumb-list">
				<a href="<?php echo $ccg_po_home_url; ?>" class="kc-breadcrumb-link">Home</a>
				<span class="kc-breadcrumb-sep" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</span>
				<a href="<?php echo $ccg_po_about_url; ?>" class="kc-breadcrumb-link" id="about">About</a>
				<span class="kc-breadcrumb-sep" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</span>
				<span class="kc-breadcrumb-current">Program Overview</span>
			</div>
		</nav>
	</div>
	<!-- /wp:html -->

	<!-- wp:group {"tagName":"section","className":"po-hero","layout":{"type":"default"}} -->
	<section class="wp-block-group po-hero">
		<!-- wp:html -->
		<div class="po-hero__glow" aria-hidden="true"></div>
		<!-- /wp:html -->

		<!-- wp:group {"className":"init-hero__inner po-hero__inner","layout":{"type":"default"}} -->
		<div class="wp-block-group init-hero__inner po-hero__inner">
			<!-- wp:group {"className":"init-hero__text po-hero__text","layout":{"type":"default"}} -->
			<div class="wp-block-group init-hero__text po-hero__text">
				<!-- wp:heading {"level":1,"className":"init-hero__heading po-hero__heading"} -->
				<h1 class="wp-block-heading init-hero__heading po-hero__heading">Why Hybrid Cloud Hosting</h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"init-hero__description po-hero__description"} -->
				<p class="init-hero__description po-hero__description">CMS's Hybrid Cloud service provides all the benefits of cloud hosting – secure, scalable, and cost effective – along with the added benefits of regulatory and organizational control of a traditional data center.</p>
				<!-- /wp:paragraph -->

				<!-- wp:html -->
				<div class="init-hero__actions">
					<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="<?php echo $ccg_po_get_started; ?>">
						Get Started
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</a>
					<a class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark" href="#critical-work">Learn More</a>
				</div>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</section>
	<!-- /wp:group -->
</header>
<!-- /wp:group -->
