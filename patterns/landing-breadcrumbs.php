<?php
/**
 * Title: Landing template breadcrumbs
 * Slug: ccg-wp-theme/landing-breadcrumbs
 * Categories: ccg-breadcrumbs
 * Description: Home → Page layouts → Landing page Layout.
 */
$home    = esc_url( home_url( '/' ) );
$layouts = esc_url( home_url( '/resources/page-layouts/' ) );
?>
<!-- wp:html -->
<div class="kc-breadcrumb-bar ft-breadcrumb-bar">
	<nav aria-label="Breadcrumb" class="kc-breadcrumb-inner">
		<div class="kc-breadcrumb-list">
			<a href="<?php echo $home; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a>
			<span class="kc-breadcrumb-sep" aria-hidden="true">
				<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</span>
			<a href="<?php echo $layouts; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Page layouts', 'ccg-wp-theme' ); ?></a>
			<span class="kc-breadcrumb-sep" aria-hidden="true">
				<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</span>
			<span class="kc-breadcrumb-current"><?php esc_html_e( 'Landing page Layout', 'ccg-wp-theme' ); ?></span>
		</div>
	</nav>
</div>
<!-- /wp:html -->
