<?php
/**
 * CCG Fusion block theme — CMS.gov Design System + prototype layout.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CCG_WP_THEME_VERSION', '0.9.10' );
define( 'CCG_CMSDS_VERSION', '12.4.5' );

/**
 * Theme setup.
 */
function ccg_wp_theme_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'ccg_wp_theme_setup' );

/**
 * Editor iframe styles — CMS DS first, then theme section CSS (matches front-end stack).
 */
function ccg_wp_theme_register_editor_styles() {
	add_editor_style(
		array(
			ccg_wp_theme_cmsds_style_url( 'cmsgov-theme.css' ),
			ccg_wp_theme_cmsds_style_url( 'index.css' ),
			'assets/css/theme.css',
			'assets/css/mega-nav.css',
			'assets/css/home.css',
			'assets/css/explore.css',
			'assets/css/program-overview.css',
			'assets/css/fusion-toolkit.css',
			'assets/css/interior-section-nav.css',
			'assets/css/page-layouts.css',
			'assets/css/landing-page-layout.css',
			'assets/css/buttons.css',
			'assets/css/editor.css',
		)
	);
}
add_action( 'after_setup_theme', 'ccg_wp_theme_register_editor_styles', 20 );
add_filter( 'should_load_remote_block_patterns', '__return_false' );

/**
 * URL for vendored CMS DS CSS, else jsDelivr (same package as the React prototype).
 *
 * @param string $file CSS filename under dist/css/.
 */
function ccg_wp_theme_cmsds_style_url( $file ) {
	$local = get_template_directory() . '/assets/vendor/cmsds/' . $file;
	if ( file_exists( $local ) ) {
		return get_template_directory_uri() . '/assets/vendor/cmsds/' . $file;
	}
	return 'https://cdn.jsdelivr.net/npm/@cmsgov/ds-cms-gov@' . CCG_CMSDS_VERSION . '/dist/css/' . $file;
}

/**
 * Enqueue CMS.gov Design System + Fusion theme CSS.
 */
function ccg_wp_theme_enqueue_assets() {
	wp_enqueue_style(
		'ccg-cmsds-theme',
		ccg_wp_theme_cmsds_style_url( 'cmsgov-theme.css' ),
		array(),
		CCG_CMSDS_VERSION
	);
	wp_enqueue_style(
		'ccg-cmsds-index',
		ccg_wp_theme_cmsds_style_url( 'index.css' ),
		array( 'ccg-cmsds-theme' ),
		CCG_CMSDS_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme',
		get_template_directory_uri() . '/assets/css/theme.css',
		array( 'ccg-cmsds-index' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-home',
		get_template_directory_uri() . '/assets/css/home.css',
		array( 'ccg-wp-theme' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-explore',
		get_template_directory_uri() . '/assets/css/explore.css',
		array( 'ccg-wp-theme' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-program-overview',
		get_template_directory_uri() . '/assets/css/program-overview.css',
		array( 'ccg-wp-theme' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-fusion-toolkit',
		get_template_directory_uri() . '/assets/css/fusion-toolkit.css',
		array( 'ccg-wp-theme' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-interior-section-nav',
		get_template_directory_uri() . '/assets/css/interior-section-nav.css',
		array( 'ccg-wp-theme' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-page-layouts',
		get_template_directory_uri() . '/assets/css/page-layouts.css',
		array( 'ccg-wp-theme', 'ccg-wp-theme-explore' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-landing-page-layout',
		get_template_directory_uri() . '/assets/css/landing-page-layout.css',
		array( 'ccg-wp-theme', 'ccg-wp-theme-fusion-toolkit', 'ccg-wp-theme-interior-section-nav' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_style(
		'ccg-wp-theme-buttons',
		get_template_directory_uri() . '/assets/css/buttons.css',
		array( 'ccg-wp-theme-landing-page-layout' ),
		CCG_WP_THEME_VERSION
	);

	wp_enqueue_script(
		'ccg-home-hero',
		get_template_directory_uri() . '/assets/js/home-hero.js',
		array(),
		CCG_WP_THEME_VERSION,
		true
	);
	wp_enqueue_script(
		'ccg-home-announcements',
		get_template_directory_uri() . '/assets/js/home-announcements.js',
		array(),
		CCG_WP_THEME_VERSION,
		true
	);
	wp_enqueue_script(
		'ccg-interior-section-nav',
		get_template_directory_uri() . '/assets/js/interior-section-nav.js',
		array(),
		CCG_WP_THEME_VERSION,
		true
	);
	wp_enqueue_script(
		'ccg-landing-page-layout',
		get_template_directory_uri() . '/assets/js/landing-page-layout.js',
		array(),
		CCG_WP_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ccg_wp_theme_enqueue_assets' );
/* Editor sidebar + block canvas iframe (styled patterns while editing). */
add_action( 'enqueue_block_editor_assets', 'ccg_wp_theme_enqueue_assets' );
add_action( 'enqueue_block_assets', 'ccg_wp_theme_enqueue_assets' );

/**
 * Purpose-based pattern categories for the block inserter.
 */
function ccg_wp_theme_register_pattern_category() {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	$categories = array(
		'ccg-hero'          => __( 'Hero', 'ccg-wp-theme' ),
		'ccg-cta'           => __( 'CTA', 'ccg-wp-theme' ),
		'ccg-cards'         => __( 'Cards', 'ccg-wp-theme' ),
		'ccg-feature-grid'  => __( 'Feature grid', 'ccg-wp-theme' ),
		'ccg-stats'         => __( 'Stats & metrics', 'ccg-wp-theme' ),
		'ccg-content'       => __( 'Content sections', 'ccg-wp-theme' ),
		'ccg-checklist'     => __( 'Checklist & lists', 'ccg-wp-theme' ),
		'ccg-breadcrumbs'   => __( 'Breadcrumbs', 'ccg-wp-theme' ),
		'ccg-page-layouts'  => __( 'Page layouts', 'ccg-wp-theme' ),
		'ccg-utilities'     => __( 'Utilities', 'ccg-wp-theme' ),
	);

	foreach ( $categories as $slug => $label ) {
		register_block_pattern_category(
			$slug,
			array(
				'label' => $label,
			)
		);
	}
}
add_action( 'init', 'ccg_wp_theme_register_pattern_category' );

/**
 * Bust theme pattern metadata cache when the theme version changes.
 */
function ccg_wp_theme_sync_pattern_cache() {
	$stored = get_option( 'ccg_wp_theme_pattern_cache_version', '' );
	if ( $stored === CCG_WP_THEME_VERSION ) {
		return;
	}
	wp_get_theme()->delete_pattern_cache();
	update_option( 'ccg_wp_theme_pattern_cache_version', CCG_WP_THEME_VERSION );
}
add_action( 'init', 'ccg_wp_theme_sync_pattern_cache', 9 );

/**
 * Theme image URL helper (footer logos, etc.).
 *
 * @param string $relative Path under theme root, e.g. assets/images/footer/cms-lockup.svg.
 */
function ccg_wp_theme_asset_url( $relative ) {
	return trailingslashit( get_template_directory_uri() ) . ltrim( $relative, '/' );
}

require_once get_template_directory() . '/inc/about/helpers.php';
require_once get_template_directory() . '/inc/interior-section-nav.php';
require_once get_template_directory() . '/inc/explore/helpers.php';
require_once get_template_directory() . '/inc/fusion-toolkit/helpers.php';
require_once get_template_directory() . '/inc/page-layouts/helpers.php';
require_once get_template_directory() . '/inc/mega-nav.php';
require_once get_template_directory() . '/inc/usa-banner.php';
require_once get_template_directory() . '/inc/site-search.php';
require_once get_template_directory() . '/inc/footer.php';
