<?php
/**
 * Create /resources/page-layouts library + child layout demos.
 *
 * @package ccg-wp-theme
 */

define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

if ( ! function_exists( 'switch_theme' ) ) {
	fwrite( STDERR, "WordPress failed to load.\n" );
	exit( 1 );
}

echo 'siteurl=' . get_option( 'siteurl' ) . PHP_EOL;

/**
 * Ensure a page exists at path and set content/template.
 *
 * @param array $args Page args.
 */
function ccg_setup_layout_page( $args ) {
	$path     = $args['path'];
	$title    = $args['title'];
	$slug     = $args['slug'];
	$parent   = isset( $args['parent'] ) ? (int) $args['parent'] : 0;
	$content  = $args['content'];
	$template = $args['template'];

	$page = get_page_by_path( $path );
	kses_remove_filters();
	if ( $page ) {
		$page_id = (int) $page->ID;
		wp_update_post(
			array(
				'ID'           => $page_id,
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_parent'  => $parent,
				'post_content' => $content,
				'post_status'  => 'publish',
			)
		);
		echo "updated_{$slug}={$page_id}\n";
	} else {
		$page_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_parent'  => $parent,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			),
			true
		);
		if ( is_wp_error( $page_id ) ) {
			fwrite( STDERR, $page_id->get_error_message() . PHP_EOL );
			exit( 1 );
		}
		echo "created_{$slug}={$page_id}\n";
	}
	kses_init_filters();
	update_post_meta( $page_id, '_wp_page_template', $template );
	echo 'permalink_' . $slug . '=' . get_permalink( $page_id ) . PHP_EOL;
	return $page_id;
}

// Parent: /resources
$resources = get_page_by_path( 'resources' );
if ( ! $resources ) {
	$resources_id = wp_insert_post(
		array(
			'post_title'  => 'Resources',
			'post_name'   => 'resources',
			'post_status' => 'publish',
			'post_type'   => 'page',
			'post_content'=> '',
		),
		true
	);
	if ( is_wp_error( $resources_id ) ) {
		fwrite( STDERR, $resources_id->get_error_message() . PHP_EOL );
		exit( 1 );
	}
	echo "created_resources={$resources_id}\n";
} else {
	$resources_id = (int) $resources->ID;
	echo "resources_parent={$resources_id}\n";
}

$layouts_id = ccg_setup_layout_page(
	array(
		'path'     => 'resources/page-layouts',
		'title'    => 'Page layouts',
		'slug'     => 'page-layouts',
		'parent'   => $resources_id,
		'content'  => ccg_page_layouts_index_content(),
		'template' => 'page-page-layouts',
	)
);

ccg_setup_layout_page(
	array(
		'path'     => 'resources/page-layouts/landing',
		'title'    => 'Landing page Layout',
		'slug'     => 'landing',
		'parent'   => $layouts_id,
		'content'  => ccg_landing_template_page_content(),
		'template' => 'page-landing-layout',
	)
);

ccg_setup_layout_page(
	array(
		'path'     => 'resources/page-layouts/2-column',
		'title'    => '2-Column Template',
		'slug'     => '2-column',
		'parent'   => $layouts_id,
		'content'  => ccg_two_column_template_page_content(),
		'template' => 'page-page-layouts',
	)
);

ccg_setup_layout_page(
	array(
		'path'     => 'resources/page-layouts/3-column',
		'title'    => '3 Column Layout',
		'slug'     => '3-column',
		'parent'   => $layouts_id,
		'content'  => ccg_three_column_template_page_content(),
		'template' => 'page-page-layouts',
	)
);

echo "done\n";
