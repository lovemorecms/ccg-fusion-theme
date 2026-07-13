<?php
/**
 * Title: Page layouts library
 * Slug: ccg-wp-theme/page-layouts-index
 * Categories: ccg-page-layouts
 * Description: Index of interior page layout templates (2-col, 3-col, landing).
 */
$two     = esc_url( home_url( '/resources/page-layouts/2-column/' ) );
$three   = esc_url( home_url( '/resources/page-layouts/3-column/' ) );
$landing = esc_url( home_url( '/resources/page-layouts/landing/' ) );
$home    = esc_url( home_url( '/' ) );
?>
<!-- wp:html -->
<div class="ccg-page-layouts-index">
	<div class="kc-breadcrumb-bar kc-breadcrumb-bar--initiatives">
		<nav aria-label="Breadcrumb" class="kc-breadcrumb-inner">
			<div class="kc-breadcrumb-list">
				<a href="<?php echo $home; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a>
				<span class="kc-breadcrumb-sep" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</span>
				<span class="kc-breadcrumb-current"><?php esc_html_e( 'Page layouts', 'ccg-wp-theme' ); ?></span>
			</div>
		</nav>
	</div>

	<div class="kc-content">
		<section class="kc-section kc-section--categories" aria-labelledby="page-layouts-heading">
			<h1 id="page-layouts-heading" class="kc-section-heading"><?php esc_html_e( 'Page layouts', 'ccg-wp-theme' ); ?></h1>
			<p class="kc-section-subtitle"><?php esc_html_e( 'Interior page templates for FUSION Sphere. Select a layout to preview the structure and use it as a starting point for new pages.', 'ccg-wp-theme' ); ?></p>
			<div class="kc-category-inline-stack">
				<div class="kc-categories-grid kc-categories-grid--3">
					<a href="<?php echo $two; ?>" class="kc-category-link" title="<?php esc_attr_e( 'Two-column interior layout for content and sidebar patterns.', 'ccg-wp-theme' ); ?>">
						<span class="kc-category-link__main">
							<span class="kc-category-link__text"><?php esc_html_e( '2-Column Template', 'ccg-wp-theme' ); ?></span>
							<span class="kc-category-link__count">2-col</span>
						</span>
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</a>
					<a href="<?php echo $three; ?>" class="kc-category-link" title="<?php esc_attr_e( 'Three-column grid for dense documentation and resource hubs.', 'ccg-wp-theme' ); ?>">
						<span class="kc-category-link__main">
							<span class="kc-category-link__text"><?php esc_html_e( '3 Column Layout', 'ccg-wp-theme' ); ?></span>
							<span class="kc-category-link__count">3-col</span>
						</span>
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</a>
					<a href="<?php echo $landing; ?>" class="kc-category-link" title="<?php esc_attr_e( 'Hero-led landing layout for program and campaign pages.', 'ccg-wp-theme' ); ?>">
						<span class="kc-category-link__main">
							<span class="kc-category-link__text"><?php esc_html_e( 'Landing page Layout', 'ccg-wp-theme' ); ?></span>
							<span class="kc-category-link__count"><?php esc_html_e( 'Landing', 'ccg-wp-theme' ); ?></span>
						</span>
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</a>
				</div>
			</div>
		</section>
	</div>
</div>
<!-- /wp:html -->
