<?php
/**
 * Title: Landing template section nav
 * Slug: ccg-wp-theme/landing-section-nav
 * Categories: ccg-utilities
 * Description: Shared interior section nav for the landing template.
 */
$items = array(
	array( 'id' => 'overview', 'label' => __( 'Overview', 'ccg-wp-theme' ) ),
	array( 'id' => 'heroes', 'label' => __( 'Heroes', 'ccg-wp-theme' ) ),
	array( 'id' => 'cards', 'label' => __( 'Cards', 'ccg-wp-theme' ) ),
	array( 'id' => 'spotlight', 'label' => __( 'Spotlight', 'ccg-wp-theme' ) ),
	array( 'id' => 'metrics', 'label' => __( 'Metrics', 'ccg-wp-theme' ) ),
	array( 'id' => 'compare', 'label' => __( 'Compare', 'ccg-wp-theme' ) ),
	array( 'id' => 'faq', 'label' => __( 'FAQ', 'ccg-wp-theme' ) ),
	array( 'id' => 'timeline', 'label' => __( 'Timeline', 'ccg-wp-theme' ) ),
	array( 'id' => 'partners', 'label' => __( 'Partners', 'ccg-wp-theme' ) ),
	array( 'id' => 'get-started', 'label' => __( 'Get Started', 'ccg-wp-theme' ) ),
);
?>
<!-- wp:html -->
<?php
ccg_render_interior_section_nav(
	$items,
	array(
		'aria_label' => __( 'Landing page sections', 'ccg-wp-theme' ),
		'cta_href'   => '#get-started',
		'cta_label'  => __( 'Get started', 'ccg-wp-theme' ),
	)
);
?>
<!-- /wp:html -->
