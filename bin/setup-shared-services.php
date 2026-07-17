<?php
/**
 * CLI helper: create Shared Services landing + article pages from exported React content.
 *
 * Usage (from site root):
 *   php wp-content/themes/CCG-WP-THEME/bin/setup-shared-services.php
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
function ccg_setup_ss_ensure_page( $title, $slug, $parent = 0 ) {
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

$explore_id         = ccg_setup_ss_ensure_page( 'Explore', 'explore' );
$shared_services_id = ccg_setup_ss_ensure_page( 'Shared Services', 'shared-services', $explore_id );

kses_remove_filters();

$landing_content = ccg_shared_services_landing_page_content();
if ( '' === $landing_content ) {
	fwrite( STDERR, "Empty Shared Services landing content.\n" );
	exit( 1 );
}

wp_update_post(
	array(
		'ID'           => $shared_services_id,
		'post_title'   => 'Shared Services',
		'post_content' => $landing_content,
		'post_status'  => 'publish',
	)
);
update_post_meta( $shared_services_id, '_wp_page_template', 'page-shared-services' );
echo 'updated_shared-services=' . $shared_services_id . PHP_EOL;
echo 'permalink_shared-services=' . get_permalink( $shared_services_id ) . PHP_EOL;
echo 'template_shared-services=' . get_page_template_slug( $shared_services_id ) . PHP_EOL;

$data     = ccg_shared_services_data();
$articles = isset( $data['articles'] ) && is_array( $data['articles'] ) ? $data['articles'] : array();
$created  = 0;

foreach ( $articles as $article ) {
	if ( ! is_array( $article ) || empty( $article['slug'] ) || empty( $article['title'] ) ) {
		continue;
	}

	$slug           = sanitize_title( (string) $article['slug'] );
	$title          = (string) $article['title'];
	$category_id    = ! empty( $article['categoryId'] ) ? sanitize_title( (string) $article['categoryId'] ) : 'general';
	$category_label = ! empty( $article['categoryLabel'] ) ? (string) $article['categoryLabel'] : ucwords( str_replace( '-', ' ', $category_id ) );
	$category_page  = ccg_setup_ss_ensure_page( $category_label, $category_id, $shared_services_id );
	$content        = ccg_shared_service_article_page_content( $slug );

	if ( '' === $content ) {
		fwrite( STDERR, "Empty content for {$slug}\n" );
		continue;
	}

	$path = 'explore/shared-services/' . $category_id . '/' . $slug;
	$page = get_page_by_path( $path );

	if ( $page ) {
		$page_id = (int) $page->ID;
		wp_update_post(
			array(
				'ID'           => $page_id,
				'post_title'   => $title,
				'post_content' => $content,
				'post_parent'  => $category_page,
				'post_status'  => 'publish',
			)
		);
		echo 'updated_' . $slug . '=' . $page_id . PHP_EOL;
	} else {
		$page_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_parent'  => $category_page,
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

	update_post_meta( $page_id, '_wp_page_template', 'page-shared-service-article' );
	echo 'permalink_' . $slug . '=' . get_permalink( $page_id ) . PHP_EOL;
	echo 'template_' . $slug . '=' . get_page_template_slug( $page_id ) . PHP_EOL;
	$created++;
}

kses_init_filters();

echo 'done_shared_services_articles=' . $created . PHP_EOL;
