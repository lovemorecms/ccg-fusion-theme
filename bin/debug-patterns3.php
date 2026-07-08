<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

$registry = WP_Block_Patterns_Registry::get_instance();
$slug = 'ccg-wp-theme/about-hero-band';
echo 'is_registered=' . ( $registry->is_registered( $slug ) ? 'yes' : 'no' ) . PHP_EOL;
$pattern = $registry->get_registered( $slug );
echo 'title=' . ( $pattern['title'] ?? 'none' ) . PHP_EOL;
echo 'categories=' . implode( ',', $pattern['categories'] ?? array() ) . PHP_EOL;
$content = $registry->get_content( $slug );
echo 'content_len=' . strlen( $content ) . PHP_EOL;
echo 'content_has_po_hero=' . ( str_contains( $content, 'po-hero' ) ? 'yes' : 'no' ) . PHP_EOL;

$page = get_page_by_path( 'about/program-overview' );
$blocks = parse_blocks( $page->post_content );
echo 'top_level_blocks=' . count( $blocks ) . PHP_EOL;
foreach ( $blocks as $i => $block ) {
	echo "block[$i]=" . ( $block['blockName'] ?? 'null' ) . ' inner=' . count( $block['innerBlocks'] ?? array() ) . ' html_len=' . strlen( $block['innerHTML'] ?? '' ) . PHP_EOL;
}
