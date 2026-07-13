<?php
/**
 * Title: 2-Column layout demo
 * Slug: ccg-wp-theme/page-layout-2-column-demo
 * Categories: ccg-page-layouts
 * Description: Simple two-column interior demo linked from Page layouts library.
 */
$home    = esc_url( home_url( '/' ) );
$layouts = esc_url( home_url( '/resources/page-layouts/' ) );
?>
<!-- wp:html -->
<div class="ccg-layout-demo ccg-layout-demo--2col">
	<div class="kc-breadcrumb-bar kc-breadcrumb-bar--initiatives">
		<nav aria-label="Breadcrumb" class="kc-breadcrumb-inner">
			<div class="kc-breadcrumb-list">
				<a href="<?php echo $home; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a>
				<span class="kc-breadcrumb-sep" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
				<a href="<?php echo $layouts; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Page layouts', 'ccg-wp-theme' ); ?></a>
				<span class="kc-breadcrumb-sep" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
				<span class="kc-breadcrumb-current"><?php esc_html_e( '2-Column Template', 'ccg-wp-theme' ); ?></span>
			</div>
		</nav>
	</div>
	<div class="kc-content">
		<section class="kc-section" aria-labelledby="two-col-heading">
			<h1 id="two-col-heading" class="kc-section-heading"><?php esc_html_e( '2-Column Template', 'ccg-wp-theme' ); ?></h1>
			<p class="kc-section-subtitle"><?php esc_html_e( 'Two-column interior layout for content and sidebar patterns.', 'ccg-wp-theme' ); ?></p>
			<div class="ccg-layout-demo__grid ccg-layout-demo__grid--2">
				<article class="ccg-layout-demo__main">
					<h2><?php esc_html_e( 'Main content', 'ccg-wp-theme' ); ?></h2>
					<p><?php esc_html_e( 'Primary column for long-form copy, lists, and media. Replace this demo text with your page content.', 'ccg-wp-theme' ); ?></p>
					<p><?php esc_html_e( 'Use this pattern for articles, guides, and interior pages that need a supporting sidebar.', 'ccg-wp-theme' ); ?></p>
				</article>
				<aside class="ccg-layout-demo__side" aria-label="<?php esc_attr_e( 'Sidebar', 'ccg-wp-theme' ); ?>">
					<h2><?php esc_html_e( 'Sidebar', 'ccg-wp-theme' ); ?></h2>
					<ul>
						<li><?php esc_html_e( 'Related links', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Contact card', 'ccg-wp-theme' ); ?></li>
						<li><?php esc_html_e( 'Downloads', 'ccg-wp-theme' ); ?></li>
					</ul>
				</aside>
			</div>
			<p><a class="ds-c-button ds-c-button--ghost" href="<?php echo $layouts; ?>"><?php esc_html_e( 'Back to layout library', 'ccg-wp-theme' ); ?></a></p>
		</section>
	</div>
</div>
<!-- /wp:html -->
