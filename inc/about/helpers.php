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
 * @param string $pattern_file Basename under patterns/, e.g. hero-interior-breadcrumbs.php.
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
		'hero-interior-breadcrumbs.php',
		'cards-image-three-up.php',
		'feature-grid-icons-four.php',
		'stats-metrics-four-up.php',
		'checklist-icon-two-column.php',
		'cta-gradient-band.php',
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
 * Valid core/image block for a bundled theme image (external URL, no attachment id).
 *
 * @param string $filename   File under assets/images/sections/program-overview/.
 * @param string $class_name Optional figure class.
 */
function ccg_about_program_image_block( $filename, $class_name = 'po-platform-card__media' ) {
	$url  = ccg_about_program_image_url( $filename );
	$attr = wp_json_encode(
		array(
			'url'             => $url,
			'sizeSlug'        => 'large',
			'linkDestination' => 'none',
			'className'       => $class_name,
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	);

	return sprintf(
		'<!-- wp:image %1$s -->' . "\n" .
		'<figure class="wp-block-image size-large %2$s"><img alt="" src="%3$s" loading="lazy" decoding="async"/></figure>' . "\n" .
		'<!-- /wp:image -->',
		$attr,
		esc_attr( $class_name ),
		esc_url( $url )
	);
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
