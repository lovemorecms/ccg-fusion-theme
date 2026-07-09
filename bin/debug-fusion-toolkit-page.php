<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

$page = get_page_by_path( 'explore/fusion-toolkit' );
if ( ! $page ) {
	echo "page not found\n";
	exit( 1 );
}

echo 'content_len=' . strlen( $page->post_content ) . PHP_EOL;
echo 'has_wp_pattern=' . ( str_contains( $page->post_content, 'wp:pattern' ) ? 'yes' : 'no' ) . PHP_EOL;
echo 'has_ft_hero=' . ( str_contains( $page->post_content, 'ft-hero' ) ? 'yes' : 'no' ) . PHP_EOL;
echo 'has_ccg_fusion_toolkit_sections=' . ( str_contains( $page->post_content, 'ccg-fusion-toolkit-sections' ) ? 'yes' : 'no' ) . PHP_EOL;

$blocks = parse_blocks( $page->post_content );
function ccg_count_blocks_ft( $blocks, &$counts ) {
	foreach ( $blocks as $block ) {
		$name              = $block['blockName'] ?? 'null';
		$counts[ $name ]   = ( $counts[ $name ] ?? 0 ) + 1;
		if ( ! empty( $block['innerBlocks'] ) ) {
			ccg_count_blocks_ft( $block['innerBlocks'], $counts );
		}
	}
}
$counts = array();
ccg_count_blocks_ft( $blocks, $counts );
foreach ( $counts as $name => $n ) {
	echo "$name=$n\n";
}
