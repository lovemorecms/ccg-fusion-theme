<?php
/**
 * CLI helper: create/update About child pages (Benefits, Success Stories, Contact Us).
 * Does NOT overwrite /about/program-overview content.
 *
 * Usage (from site root):
 *   php wp-content/themes/CCG-WP-THEME/bin/setup-about-pages.php
 *
 * Parent wiring required before run (if not already present):
 *   require_once …/inc/about/about-hybrid-cloud.php
 *   enqueue assets/css/about-hybrid-cloud.css
 *   theme.json customTemplates: page-about-benefits, page-about-section
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

if ( ! function_exists( 'ccg_about_benefits_page_content' ) ) {
	$helper = get_template_directory() . '/inc/about/about-hybrid-cloud.php';
	if ( file_exists( $helper ) ) {
		require_once $helper;
	}
}

if ( ! function_exists( 'ccg_about_benefits_page_content' ) ) {
	fwrite(
		STDERR,
		"Missing ccg_about_benefits_page_content(). Add to functions.php:\n" .
		"  require_once get_template_directory() . '/inc/about/about-hybrid-cloud.php';\n"
	);
	exit( 1 );
}

echo 'siteurl=' . get_option( 'siteurl' ) . PHP_EOL;

/**
 * Ensure a published page exists.
 *
 * @param string $title  Title.
 * @param string $slug   Slug.
 * @param int    $parent Parent ID.
 * @return int
 */
function ccg_setup_about_ensure_page( $title, $slug, $parent = 0 ) {
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

/**
 * Update page content + template.
 *
 * @param int    $page_id  Page ID.
 * @param string $title    Title.
 * @param string $content  Block markup.
 * @param string $template Template slug.
 * @param int    $parent   Parent ID.
 */
function ccg_setup_about_apply_page( $page_id, $title, $content, $template, $parent ) {
	wp_update_post(
		array(
			'ID'           => $page_id,
			'post_title'   => $title,
			'post_content' => $content,
			'post_parent'  => (int) $parent,
			'post_status'  => 'publish',
		)
	);
	update_post_meta( $page_id, '_wp_page_template', $template );
	echo 'updated_' . sanitize_title( $title ) . '=' . $page_id . PHP_EOL;
	echo 'permalink_' . sanitize_title( $title ) . '=' . get_permalink( $page_id ) . PHP_EOL;
	echo 'template_' . sanitize_title( $title ) . '=' . get_page_template_slug( $page_id ) . PHP_EOL;
}

$about_id = ccg_setup_about_ensure_page( 'About', 'about' );

// Leave program-overview content alone; only ensure parent hierarchy exists.
$po = get_page_by_path( 'about/program-overview' );
if ( $po ) {
	echo 'program-overview_untouched=' . (int) $po->ID . PHP_EOL;
} else {
	echo "program-overview_missing=yes (run setup-program-overview-page.php separately)\n";
}

$pages = array(
	array(
		'slug'     => 'benefits',
		'title'    => 'Benefits',
		'template' => 'page-about-benefits',
		'content'  => ccg_about_benefits_page_content(),
	),
	array(
		'slug'     => 'success-stories',
		'title'    => 'Success Stories',
		'template' => 'page-about-section',
		'content'  => ccg_about_placeholder_page_content( 'success-stories', 'Success Stories' ),
	),
	array(
		'slug'     => 'contact-us',
		'title'    => 'Contact Us',
		'template' => 'page-about-section',
		'content'  => ccg_about_placeholder_page_content( 'contact-us', 'Contact Us' ),
	),
);

kses_remove_filters();

foreach ( $pages as $page_def ) {
	if ( '' === $page_def['content'] ) {
		fwrite( STDERR, 'Empty content for ' . $page_def['slug'] . PHP_EOL );
		continue;
	}
	$page_id = ccg_setup_about_ensure_page( $page_def['title'], $page_def['slug'], $about_id );
	ccg_setup_about_apply_page(
		$page_id,
		$page_def['title'],
		$page_def['content'],
		$page_def['template'],
		$about_id
	);
}

kses_init_filters();

echo "done_about_pages=3\n";
echo "NOTE: Ensure functions.php requires about-hybrid-cloud.php and enqueues about-hybrid-cloud.css;\n";
echo "      add theme.json customTemplates page-about-benefits and page-about-section.\n";
