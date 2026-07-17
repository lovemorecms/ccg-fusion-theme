<?php
/**
 * CLI helper: create /explore/platforms/{slug} pages from exported React content.
 *
 * Usage (from site root):
 *   php wp-content/themes/CCG-WP-THEME/bin/setup-platform-articles.php
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

/**
 * Ensure a published page exists at a path segment under an optional parent.
 *
 * @param string $title  Page title.
 * @param string $slug   Page slug.
 * @param int    $parent Parent page ID.
 * @return int
 */
function ccg_setup_ensure_page( $title, $slug, $parent = 0 ) {
	$path = $parent ? get_page_uri( $parent ) . '/' . $slug : $slug;
	$page = get_page_by_path( $path );
	if ( $page ) {
		echo 'exists_' . $slug . '=' . (int) $page->ID . PHP_EOL;
		return (int) $page->ID;
	}

	$page_id = wp_insert_post(
		array(
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_parent'  => (int) $parent,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		),
		true
	);

	if ( is_wp_error( $page_id ) ) {
		fwrite( STDERR, 'Failed to create ' . $path . ': ' . $page_id->get_error_message() . PHP_EOL );
		exit( 1 );
	}

	echo 'created_' . $slug . '=' . $page_id . PHP_EOL;
	return (int) $page_id;
}

$explore_id   = ccg_setup_ensure_page( 'Explore', 'explore' );
$platforms_id = ccg_setup_ensure_page( 'Platforms', 'platforms', $explore_id );

$titles = ccg_platform_articles_titles();
if ( empty( $titles ) ) {
	fwrite( STDERR, "No platform articles found in JSON.\n" );
	exit( 1 );
}

kses_remove_filters();

foreach ( $titles as $slug => $title ) {
	$content = ccg_platform_article_page_content( $slug );
	if ( '' === $content ) {
		fwrite( STDERR, "Empty content for {$slug}\n" );
		continue;
	}

	$path = 'explore/platforms/' . $slug;
	$page = get_page_by_path( $path );

	if ( $page ) {
		$page_id = (int) $page->ID;
		wp_update_post(
			array(
				'ID'           => $page_id,
				'post_title'   => $title,
				'post_content' => $content,
				'post_parent'  => $platforms_id,
				'post_status'  => 'publish',
			)
		);
		echo 'updated_' . $slug . '=' . $page_id . PHP_EOL;
	} else {
		$page_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_parent'  => $platforms_id,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => $content,
			),
			true
		);
		if ( is_wp_error( $page_id ) ) {
			fwrite( STDERR, 'Failed to create ' . $path . ': ' . $page_id->get_error_message() . PHP_EOL );
			continue;
		}
		echo 'created_' . $slug . '=' . $page_id . PHP_EOL;
	}

	update_post_meta( $page_id, '_wp_page_template', 'page-platform-article' );
	echo 'permalink_' . $slug . '=' . get_permalink( $page_id ) . PHP_EOL;
	echo 'template_' . $slug . '=' . get_page_template_slug( $page_id ) . PHP_EOL;
}

kses_init_filters();

echo 'done_platform_articles=' . count( $titles ) . PHP_EOL;
