<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';
$page = get_page_by_path( 'about/program-overview' );
$blocks = parse_blocks( $page->post_content );
echo 'content_len=' . strlen( $page->post_content ) . PHP_EOL;
function ccg_count_blocks( $blocks, &$counts ) {
	foreach ( $blocks as $block ) {
		$name = $block['blockName'] ?? 'null';
		$counts[ $name ] = ( $counts[ $name ] ?? 0 ) + 1;
		if ( ! empty( $block['innerBlocks'] ) ) {
			ccg_count_blocks( $block['innerBlocks'], $counts );
		}
	}
}
$counts = array();
ccg_count_blocks( $blocks, $counts );
foreach ( $counts as $name => $n ) {
	echo "$name=$n\n";
}
