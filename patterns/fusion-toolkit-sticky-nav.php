<?php
/**
 * Title: Fusion Toolkit sticky nav
 * Slug: ccg-wp-theme/fusion-toolkit-sticky-nav
 * Categories: ccg-utilities
 * Description: In-page section nav (appears after scrolling past hero).
 */
$kc_url = esc_url( ccg_nav_url( '/learn/knowledge-center' ) );
?>
<!-- wp:group {"className":"ft-sticky-nav-wrap","layout":{"type":"default"}} -->
<div class="wp-block-group ft-sticky-nav-wrap">
	<!-- wp:html -->
	<div class="ft-sticky-nav" aria-hidden="true">
		<div class="ft-sticky-nav__wrap">
			<div class="ft-sticky-nav__shell">
				<nav class="ft-sticky-nav__nav" aria-label="<?php esc_attr_e( 'Fusion Toolkit sections', 'ccg-wp-theme' ); ?>">
					<ul class="ft-sticky-nav__list">
						<li class="ft-sticky-nav__item"><a href="#overview" class="ft-sticky-nav__link ft-sticky-nav__link--active" aria-current="true"><?php esc_html_e( 'Overview', 'ccg-wp-theme' ); ?></a></li>
						<li class="ft-sticky-nav__item"><a href="#basecamp" class="ft-sticky-nav__link">BaseCamp</a></li>
						<li class="ft-sticky-nav__item"><a href="#helix" class="ft-sticky-nav__link">Helix</a></li>
						<li class="ft-sticky-nav__item"><a href="#lens" class="ft-sticky-nav__link">Lens</a></li>
						<li class="ft-sticky-nav__item"><a href="#match" class="ft-sticky-nav__link">Match</a></li>
					</ul>
				</nav>
				<a class="ds-c-button ds-c-button--solid ccg-btn-accent ft-sticky-nav__cta" href="<?php echo $kc_url; ?>"><?php esc_html_e( 'Get started with Fusion Toolkit', 'ccg-wp-theme' ); ?></a>
			</div>
		</div>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->
