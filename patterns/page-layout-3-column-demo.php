<?php
/**
 * Title: 3-Column layout demo
 * Slug: ccg-wp-theme/page-layout-3-column-demo
 * Categories: ccg-page-layouts
 * Description: Simple three-column interior demo linked from Page layouts library.
 */
$home    = esc_url( home_url( '/' ) );
$layouts = esc_url( home_url( '/resources/page-layouts/' ) );
?>
<!-- wp:html -->
<div class="ccg-layout-demo ccg-layout-demo--3col">
	<div class="kc-breadcrumb-bar kc-breadcrumb-bar--initiatives">
		<nav aria-label="Breadcrumb" class="kc-breadcrumb-inner">
			<div class="kc-breadcrumb-list">
				<a href="<?php echo $home; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a>
				<span class="kc-breadcrumb-sep" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
				<a href="<?php echo $layouts; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Page layouts', 'ccg-wp-theme' ); ?></a>
				<span class="kc-breadcrumb-sep" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
				<span class="kc-breadcrumb-current"><?php esc_html_e( '3 Column Layout', 'ccg-wp-theme' ); ?></span>
			</div>
		</nav>
	</div>
	<div class="kc-content">
		<section class="kc-section" aria-labelledby="three-col-heading">
			<h1 id="three-col-heading" class="kc-section-heading"><?php esc_html_e( '3 Column Layout', 'ccg-wp-theme' ); ?></h1>
			<p class="kc-section-subtitle"><?php esc_html_e( 'Three-column grid for dense documentation and resource hubs.', 'ccg-wp-theme' ); ?></p>
			<div class="ccg-layout-demo__grid ccg-layout-demo__grid--3">
				<aside class="ccg-layout-demo__side" aria-label="<?php esc_attr_e( 'Left navigation', 'ccg-wp-theme' ); ?>">
					<h2><?php esc_html_e( 'Nav', 'ccg-wp-theme' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Section A', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Section B', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Section C', 'ccg-wp-theme' ); ?></li>
					</ul>
				</aside>
				<article class="ccg-layout-demo__main">
					<h2><?php esc_html_e( 'Main content', 'ccg-wp-theme' ); ?></h2>
					<p><?php esc_html_e( 'Center column for primary documentation. Ideal for knowledge-base style pages.', 'ccg-wp-theme' ); ?></p>
				</article>
				<aside class="ccg-layout-demo__side" aria-label="<?php esc_attr_e( 'Right rail', 'ccg-wp-theme' ); ?>">
					<h2><?php esc_html_e( 'Related', 'ccg-wp-theme' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Quick links', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Tags', 'ccg-wp-theme' ); ?></li>
					</ul>
				</aside>
			</div>
			<p><a class="ds-c-button ds-c-button--ghost" href="<?php echo $layouts; ?>"><?php esc_html_e( 'Back to layout library', 'ccg-wp-theme' ); ?></a></p>
		</section>
	</div>
</div>
<!-- /wp:html -->
