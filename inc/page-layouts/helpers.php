<?php
/**
 * Page layouts library + landing template helpers.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render a patterns/*.php file and return markup.
 *
 * @param string $pattern_file Basename under patterns/.
 */
function ccg_page_layouts_render_pattern_file( $pattern_file ) {
	$path = get_template_directory() . '/patterns/' . ltrim( $pattern_file, '/' );
	if ( ! file_exists( $path ) ) {
		return '';
	}
	ob_start();
	include $path;
	return trim( ob_get_clean() );
}

/**
 * Page layouts library index content.
 */
function ccg_page_layouts_index_content() {
	return ccg_page_layouts_render_pattern_file( 'page-layouts-index.php' );
}

/**
 * Full landing template page content.
 */
function ccg_landing_template_page_content() {
	$sections = array(
		'landing-breadcrumbs.php',
		'landing-hero.php',
		'landing-section-nav.php',
		'landing-heroes.php',
		'landing-cards.php',
		'landing-spotlight.php',
		'landing-metrics.php',
		'landing-compare.php',
		'landing-faq.php',
		'landing-timeline.php',
		'landing-partners.php',
		'landing-cta-band.php',
	);
	$parts = array();
	foreach ( $sections as $file ) {
		$markup = ccg_page_layouts_render_pattern_file( $file );
		if ( $markup ) {
			$parts[] = $markup;
		}
	}
	return implode( "\n\n", $parts );
}

/**
 * Simple 2-column demo page content.
 */
function ccg_two_column_template_page_content() {
	return ccg_page_layouts_render_pattern_file( 'page-layout-2-column-demo.php' );
}

/**
 * Simple 3-column demo page content.
 */
function ccg_three_column_template_page_content() {
	return ccg_page_layouts_render_pattern_file( 'page-layout-3-column-demo.php' );
}
