<?php
/**
 * Title: Interior hero with breadcrumbs
 * Slug: ccg-wp-theme/hero-interior-breadcrumbs
 * Categories: ccg-hero, ccg-breadcrumbs
 * Inserter: yes
 * Description: About Hybrid Cloud image hero with breadcrumbs, actions, and sticky cross-page navigation.
 */
$ccg_po_hero_image = ccg_about_benefits_image_url( 'customer-support-hero.png' );
?>
<!-- wp:html -->
<?php
ccg_about_hybrid_cloud_chrome(
	array(
		'current_slug'     => 'program-overview',
		'current_label'    => __( 'Program Overview', 'ccg-wp-theme' ),
		'background_image' => $ccg_po_hero_image,
		'show_actions'     => true,
	)
);
?>
<!-- /wp:html -->
