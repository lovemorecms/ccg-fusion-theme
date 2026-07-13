<?php
/**
 * Title: Explore section nav
 * Slug: ccg-wp-theme/explore-section-nav
 * Categories: ccg-utilities
 * Description: Shared interior section nav for Explore (pins under site header).
 */
$items = array(
	array(
		'id'    => 'overview',
		'label' => __( 'Overview', 'ccg-wp-theme' ),
	),
	array(
		'id'    => 'platforms',
		'label' => __( 'Platforms', 'ccg-wp-theme' ),
	),
	array(
		'id'    => 'roadmap',
		'label' => __( 'Roadmap', 'ccg-wp-theme' ),
	),
	array(
		'id'    => 'whats-happening',
		'label' => __( "What's Happening", 'ccg-wp-theme' ),
	),
	array(
		'id'    => 'learn-connect',
		'label' => __( 'Learn & Connect', 'ccg-wp-theme' ),
	),
	array(
		'id'    => 'getting-started',
		'label' => __( 'Get Started', 'ccg-wp-theme' ),
	),
);
?>
<!-- wp:html -->
<?php
ccg_render_interior_section_nav(
	$items,
	array(
		'aria_label' => __( 'Explore page sections', 'ccg-wp-theme' ),
		'cta_href'   => '#learn-connect',
		'cta_label'  => __( 'Contact Team', 'ccg-wp-theme' ),
	)
);
?>
<!-- /wp:html -->
