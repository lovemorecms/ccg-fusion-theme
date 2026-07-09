<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

echo 'active_theme=' . get_stylesheet() . PHP_EOL;
echo 'theme_version=' . wp_get_theme()->get( 'Version' ) . PHP_EOL;
echo 'defined_version=' . CCG_WP_THEME_VERSION . PHP_EOL;

$page = get_page_by_path( 'about/program-overview' );
if ( $page ) {
	echo 'page_has_ccg_about_sections=' . ( str_contains( $page->post_content, 'ccg-about-sections' ) ? 'yes' : 'no' ) . PHP_EOL;
	echo 'page_content_len=' . strlen( $page->post_content ) . PHP_EOL;
}
