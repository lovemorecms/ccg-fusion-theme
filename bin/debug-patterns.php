<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

$theme = wp_get_theme();
echo 'stylesheet=' . $theme->get_stylesheet() . PHP_EOL;
echo 'template=' . $theme->get_template() . PHP_EOL;

$dir = get_template_directory() . '/patterns';
$about_files = glob( $dir . '/about-*.php' );
echo 'about_files_on_disk=' . count( $about_files ) . PHP_EOL;

$registry = WP_Block_Patterns_Registry::get_instance();
$all = $registry->get_all_registered();
$explore = array();
$about = array();
$home = array();
foreach ( $all as $slug => $pattern ) {
	if ( str_contains( $slug, 'explore-' ) || str_contains( $slug, '/explore' ) ) {
		$explore[] = $slug;
	}
	if ( str_contains( $slug, 'about-' ) || str_contains( $slug, '/about' ) ) {
		$about[] = $slug;
	}
	if ( str_contains( $slug, 'home-' ) || str_contains( $slug, '/home' ) ) {
		$home[] = $slug;
	}
}
echo 'registered_explore=' . count( $explore ) . PHP_EOL;
echo 'registered_about=' . count( $about ) . PHP_EOL;
echo 'registered_home=' . count( $home ) . PHP_EOL;

foreach ( $about as $slug ) {
	echo 'about:' . $slug . PHP_EOL;
}

$page = get_page_by_path( 'about/program-overview' );
if ( $page ) {
	$content = $page->post_content;
	echo 'page_content_len=' . strlen( $content ) . PHP_EOL;
	echo 'page_content_start=' . substr( $content, 0, 300 ) . PHP_EOL;
	echo 'has_wp_html=' . ( str_contains( $content, 'wp:html' ) ? 'yes' : 'no' ) . PHP_EOL;
	echo 'has_po_hero=' . ( str_contains( $content, 'po-hero' ) ? 'yes' : 'no' ) . PHP_EOL;
}

// Try loading one pattern file manually.
$test_file = $dir . '/about-hero-band.php';
ob_start();
include $test_file;
$raw = ob_get_clean();
echo 'hero_pattern_output_len=' . strlen( $raw ) . PHP_EOL;
echo 'hero_pattern_start=' . substr( $raw, 0, 200 ) . PHP_EOL;
