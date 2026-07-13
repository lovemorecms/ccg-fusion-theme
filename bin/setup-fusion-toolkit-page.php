<?php

/**

 * One-off CLI helper: create /explore/fusion-toolkit page with composite pattern content.

 *

 * Usage (from site root):

 *   php path/to/php.exe wp-content/themes/CCG-WP-THEME/bin/setup-fusion-toolkit-page.php

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



$explore_parent = get_page_by_path( 'explore' );

if ( ! $explore_parent ) {

	$explore_parent_id = wp_insert_post(

		array(

			'post_title'   => 'Explore',

			'post_name'    => 'explore',

			'post_status'  => 'publish',

			'post_type'    => 'page',

			'post_content' => '',

		),

		true

	);

	if ( is_wp_error( $explore_parent_id ) ) {

		fwrite( STDERR, 'Failed to create Explore parent: ' . $explore_parent_id->get_error_message() . PHP_EOL );

		exit( 1 );

	}

	echo 'created_explore_parent=' . $explore_parent_id . PHP_EOL;

} else {

	$explore_parent_id = (int) $explore_parent->ID;

	echo 'explore_parent=' . $explore_parent_id . PHP_EOL;

}



$page = get_page_by_path( 'explore/fusion-toolkit' );

if ( ! $page ) {

	$page = get_page_by_path( 'fusion-toolkit', OBJECT, 'page' );

	if ( $page && (int) $page->post_parent !== $explore_parent_id ) {

		$page = null;

	}

}



$content = ccg_fusion_toolkit_page_content();

$blocks  = parse_blocks( $content );

echo 'top_level_blocks=' . count( $blocks ) . PHP_EOL;



kses_remove_filters();

if ( $page ) {

	$page_id = (int) $page->ID;

	wp_update_post(

		array(

			'ID'           => $page_id,

			'post_content' => $content,

			'post_parent'  => $explore_parent_id,

			'post_status'  => 'publish',

		)

	);

	echo 'updated_page=' . $page_id . PHP_EOL;

} else {

	$page_id = wp_insert_post(

		array(

			'post_title'   => 'Fusion Toolkit',

			'post_name'    => 'fusion-toolkit',

			'post_parent'  => $explore_parent_id,

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



update_post_meta( $page_id, '_wp_page_template', 'page-fusion-toolkit' );



$url = get_permalink( $page_id );

echo 'permalink=' . $url . PHP_EOL;

echo 'template=' . get_page_template_slug( $page_id ) . PHP_EOL;


