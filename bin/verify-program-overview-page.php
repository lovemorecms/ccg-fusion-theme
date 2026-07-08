<?php
/**
 * Verify Program Overview page content and theme registration.
 *
 * @package ccg-wp-theme
 */

define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

$page = get_page_by_path( 'about/program-overview' );
if ( ! $page ) {
	fwrite( STDERR, "Page not found at about/program-overview\n" );
	exit( 1 );
}

$checks = array(
	'po-hero'        => false,
	'critical-work'  => false,
	'po-feature-card' => false,
	'po-stats'       => false,
	'po-security'    => false,
	'tpl-2col-hero-band' => false,
	'secure-platforms.jpg' => false,
);

$html = apply_filters( 'the_content', $page->post_content );
foreach ( array_keys( $checks ) as $needle ) {
	$checks[ $needle ] = false !== strpos( $html, $needle );
}

$template = get_page_template_slug( $page->ID );
$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
$about_patterns = array();
foreach ( $patterns as $slug => $pattern ) {
	if ( false !== strpos( $slug, 'ccg-wp-theme/about-' ) ) {
		$about_patterns[] = $slug;
	}
}

echo 'page_id=' . $page->ID . PHP_EOL;
echo 'status=' . $page->post_status . PHP_EOL;
echo 'template=' . $template . PHP_EOL;
echo 'permalink=' . get_permalink( $page->ID ) . PHP_EOL;

foreach ( $checks as $key => $ok ) {
	echo ( $ok ? 'OK' : 'MISSING' ) . ':' . $key . PHP_EOL;
}

echo 'about_pattern_count=' . count( $about_patterns ) . PHP_EOL;
sort( $about_patterns );
foreach ( $about_patterns as $slug ) {
	echo 'pattern:' . $slug . PHP_EOL;
}

$css_path = get_template_directory() . '/assets/css/program-overview.css';
echo 'css_file=' . ( file_exists( $css_path ) ? 'exists' : 'missing' ) . PHP_EOL;

$images = array( 'secure-platforms.jpg', 'scalable-platforms.jpg', 'stress-tested-platforms.jpg' );
foreach ( $images as $image ) {
	$path = get_template_directory() . '/assets/images/sections/program-overview/' . $image;
	echo ( file_exists( $path ) ? 'OK:image:' : 'MISSING:image:' ) . $image . PHP_EOL;
}

$failed = array_filter(
	$checks,
	static function ( $ok ) {
		return ! $ok;
	}
);

exit( $failed || 'page-program-overview' !== $template ? 1 : 0 );
