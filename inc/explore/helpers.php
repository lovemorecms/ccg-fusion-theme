<?php
/**
 * Explore page helpers.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render markup from a theme pattern file (block comments preserved).
 *
 * @param string $pattern_file Basename under patterns/.
 */
function ccg_explore_render_pattern_file( $pattern_file ) {
	$path = get_template_directory() . '/patterns/' . ltrim( $pattern_file, '/' );
	if ( ! file_exists( $path ) ) {
		return '';
	}
	ob_start();
	include $path;
	return trim( ob_get_clean() );
}

/**
 * Block markup for the full Explore page body.
 */
function ccg_explore_page_content() {
	$sections = array(
		'explore-breadcrumbs.php',
		'explore-hero.php',
		'explore-section-nav.php',
		'explore-platforms.php',
		'explore-roadmap.php',
		'explore-whats-happening.php',
		'explore-learn-get-started.php',
		'explore-getting-started-band.php',
	);
	$parts    = array();
	foreach ( $sections as $file ) {
		$markup = ccg_explore_render_pattern_file( $file );
		if ( $markup ) {
			$parts[] = $markup;
		}
	}
	return implode( "\n\n", $parts );
}
