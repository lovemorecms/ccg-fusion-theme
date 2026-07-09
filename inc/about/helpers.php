<?php
/**
 * About section helpers.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render markup from a theme pattern file (block comments preserved).
 *
 * @param string $pattern_file Basename under patterns/, e.g. about-hero-band.php.
 */
function ccg_about_render_pattern_file( $pattern_file ) {
	$path = get_template_directory() . '/patterns/' . ltrim( $pattern_file, '/' );
	if ( ! file_exists( $path ) ) {
		return '';
	}
	ob_start();
	include $path;
	return trim( ob_get_clean() );
}

/**
 * Block markup for the full Program Overview page body.
 */
function ccg_about_program_overview_page_content() {
	$sections = array(
		'about-hero-band.php',
		'about-critical-work.php',
		'about-features.php',
		'about-services-stats.php',
		'about-security.php',
		'about-cta.php',
	);
	$parts    = array();
	foreach ( $sections as $file ) {
		$markup = ccg_about_render_pattern_file( $file );
		if ( $markup ) {
			$parts[] = $markup;
		}
	}
	$inner = implode( "\n\n", $parts );
	return '<!-- wp:group {"align":"full","className":"ccg-about-sections program-overview","layout":{"type":"default"}} -->' . "\n"
		. '<div class="wp-block-group alignfull ccg-about-sections program-overview">' . "\n"
		. $inner . "\n"
		. '</div>' . "\n"
		. '<!-- /wp:group -->';
}

/**
 * Program Overview section image URL.
 *
 * @param string $filename File under assets/images/sections/program-overview/.
 */
function ccg_about_program_image_url( $filename ) {
	return ccg_wp_theme_asset_url( 'assets/images/sections/program-overview/' . ltrim( $filename, '/' ) );
}

/**
 * Home URL with optional hash (in-page or cross-page).
 *
 * @param string $path Path or hash fragment target.
 */
function ccg_about_page_url( $path = '/' ) {
	if ( 0 === strpos( $path, '#' ) ) {
		return $path;
	}
	return ccg_nav_url( $path );
}
