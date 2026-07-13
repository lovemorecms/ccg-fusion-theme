<?php
/**
 * Title: Fusion Toolkit sticky nav
 * Slug: ccg-wp-theme/fusion-toolkit-sticky-nav
 * Categories: ccg-utilities
 * Description: Shared interior section nav for Fusion Toolkit (pins under site header).
 */
$kc_url = esc_url( ccg_nav_url( '/learn/knowledge-center' ) );
$items  = array(
	array(
		'id'    => 'overview',
		'label' => __( 'Overview', 'ccg-wp-theme' ),
	),
	array(
		'id'    => 'basecamp',
		'label' => 'BaseCamp',
	),
	array(
		'id'    => 'helix',
		'label' => 'Helix',
	),
	array(
		'id'    => 'lens',
		'label' => 'Lens',
	),
	array(
		'id'    => 'match',
		'label' => 'Match',
	),
);
?>
<!-- wp:html -->
<?php
ccg_render_interior_section_nav(
	$items,
	array(
		'aria_label' => __( 'Fusion Toolkit sections', 'ccg-wp-theme' ),
		'cta_href'   => $kc_url,
		'cta_label'  => __( 'Get started with Fusion Toolkit', 'ccg-wp-theme' ),
	)
);
?>
<!-- /wp:html -->
