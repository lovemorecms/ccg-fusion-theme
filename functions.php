<?php
/**
 * CCG Fusion block theme — CMS.gov Design System + prototype layout.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CCG_WP_THEME_VERSION', '0.7.4' );
define( 'CCG_CMSDS_VERSION', '12.4.5' );

/**
 * Theme setup.
 */
function ccg_wp_theme_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style(
		array(
			'assets/css/theme.css',
			'assets/css/mega-nav.css',
			'assets/css/home.css',
			'assets/css/explore.css',
			'assets/css/program-overview.css',
		)
	);
}
add_action( 'after_setup_theme', 'ccg_wp_theme_setup' );

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
}
add_action( 'wp_enqueue_scripts', 'ccg_wp_theme_enqueue_assets' );
/* Editor sidebar + block canvas iframe (styled patterns while editing). */
add_action( 'enqueue_block_editor_assets', 'ccg_wp_theme_enqueue_assets' );
add_action( 'enqueue_block_assets', 'ccg_wp_theme_enqueue_assets' );

/**
 * Pattern category (CCG Fusion sections for editors).
 */
function ccg_wp_theme_register_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'ccg-fusion',
			array(
				'label' => __( 'CCG Fusion', 'ccg-wp-theme' ),
			)
		);
		register_block_pattern_category(
			'ccg-fusion-explore',
			array(
				'label' => __( 'CCG Fusion — Explore', 'ccg-wp-theme' ),
			)
		);
		register_block_pattern_category(
			'ccg-fusion-home',
			array(
				'label' => __( 'CCG Fusion — Home', 'ccg-wp-theme' ),
			)
		);
		register_block_pattern_category(
			'ccg-fusion-about',
			array(
				'label' => __( 'CCG Fusion — About', 'ccg-wp-theme' ),
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
require_once get_template_directory() . '/inc/mega-nav.php';
require_once get_template_directory() . '/inc/usa-banner.php';
require_once get_template_directory() . '/inc/site-search.php';
require_once get_template_directory() . '/inc/footer.php';
