<?php
/**
 * One-off CLI helper: create /explore page with composite pattern content.
 *
 * Usage (from site root):
 *   php path/to/php.exe wp-content/themes/CCG-WP-THEME/bin/setup-explore-page.php
 *
 * @package ccg-wp-theme
 */

define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

if ( ! function_exists( 'switch_theme' ) ) {
	fwrite( STDERR, "WordPress failed to load.\n" );
	exit( 1 );
}

$theme = get_stylesheet();
if ( 'CCG-WP-THEME' !== $theme && 'ccg-wp-theme' !== strtolower( $theme ) ) {
	fwrite( STDERR, "Active theme is {$theme}; expected CCG-WP-THEME.\n" );
}

echo 'siteurl=' . get_option( 'siteurl' ) . PHP_EOL;

$content = ccg_explore_page_content();
$blocks  = parse_blocks( $content );
echo 'top_level_blocks=' . count( $blocks ) . PHP_EOL;

$page = get_page_by_path( 'explore' );

kses_remove_filters();
if ( $page ) {
	$page_id = (int) $page->ID;
	wp_update_post(
		array(
			'ID'           => $page_id,
			'post_content' => $content,
			'post_status'  => 'publish',
		)
	);
	echo 'updated_page=' . $page_id . PHP_EOL;
} else {
	$page_id = wp_insert_post(
		array(
			'post_title'   => 'Explore',
			'post_name'    => 'explore',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => $content,
		),
		true
	);
	if ( is_wp_error( $page_id ) ) {
		fwrite( STDERR, 'Failed to create page: ' . $page_id->get_error_message() . PHP_EOL );
		exit( 1 );
	}
	echo 'created_page=' . $page_id . PHP_EOL;
}
kses_init_filters();

update_post_meta( $page_id, '_wp_page_template', 'page-explore' );

$url = get_permalink( $page_id );
echo 'permalink=' . $url . PHP_EOL;
echo 'template=' . get_page_template_slug( $page_id ) . PHP_EOL;
echo 'has_interior_nav=' . ( str_contains( $content, 'interior-section-nav-root' ) ? 'yes' : 'no' ) . PHP_EOL;
