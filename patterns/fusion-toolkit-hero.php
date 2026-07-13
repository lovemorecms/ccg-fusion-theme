<?php
/**
 * Title: Fusion Toolkit hero
 * Slug: ccg-wp-theme/fusion-toolkit-hero
 * Categories: ccg-hero
 * Description: Glossy CMS primary hero with gradient title and CTAs (section-nav overlap ready).
 */
$kc_url = esc_url( ccg_nav_url( '/learn/knowledge-center' ) );
?>
<!-- wp:group {"tagName":"section","align":"full","className":"ft-hero ft-hero--with-section-nav ccg-fusion-toolkit-sections","anchor":"overview","layout":{"type":"default"}} -->
<section id="overview" class="wp-block-group alignfull ft-hero ft-hero--with-section-nav ccg-fusion-toolkit-sections" aria-labelledby="ft-hero-heading" tabindex="-1">
	<!-- wp:html -->
	<div class="ft-hero__glow ft-hero__glow--one" aria-hidden="true"></div>
	<div class="ft-hero__glow ft-hero__glow--two" aria-hidden="true"></div>
	<div class="ft-hero__streak" aria-hidden="true"></div>
	<!-- /wp:html -->

	<!-- wp:group {"className":"ft-container ft-hero__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group ft-container ft-hero__inner">
		<!-- wp:heading {"level":1,"className":"ft-hero__title"} -->
		<h1 id="ft-hero-heading" class="wp-block-heading ft-hero__title">Fusion <span class="ft-hero__title-accent">Toolkit</span></h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"className":"ft-hero__lede"} -->
		<p class="ft-hero__lede">Four powerful products, one unified ecosystem. Build, orchestrate, observe, and optimize with elegance.</p>
		<!-- /wp:paragraph -->

		<!-- wp:html -->
		<div class="ft-hero__actions">
			<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="#toolkit-grid">
				<?php esc_html_e( 'Explore the Toolkit', 'ccg-wp-theme' ); ?>
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false" style="margin-left:0.35rem;vertical-align:middle"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</a>
			<a class="ds-c-button ds-c-button--ghost ft-btn-secondary" href="<?php echo $kc_url; ?>"><?php esc_html_e( 'View Documentation', 'ccg-wp-theme' ); ?></a>
		</div>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
