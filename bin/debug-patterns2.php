<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

$theme = wp_get_theme();
$patterns = $theme->get_block_patterns();
echo 'theme_get_block_patterns=' . count( $patterns ) . PHP_EOL;
$about = array_filter(
	array_keys( $patterns ),
	static function ( $file ) {
		return str_starts_with( $file, 'about-' );
	}
);
echo 'about_in_theme_metadata=' . count( $about ) . PHP_EOL;
foreach ( $about as $file ) {
	echo 'file:' . $file . ' slug:' . $patterns[ $file ]['slug'] . PHP_EOL;
}

$registry = WP_Block_Patterns_Registry::get_instance();
$all = $registry->get_all_registered();
echo 'registry_total=' . count( $all ) . PHP_EOL;
$ccg = array();
foreach ( $all as $slug => $p ) {
	if ( str_contains( $slug, 'ccg' ) ) {
		$ccg[] = $slug;
	}
}
echo 'registry_ccg=' . count( $ccg ) . PHP_EOL;
foreach ( array_slice( $ccg, 0, 15 ) as $slug ) {
	echo 'reg:' . $slug . PHP_EOL;
}

// Force cache bust.
$theme->delete_pattern_cache();
echo "deleted_pattern_cache\n";
_register_theme_block_patterns();
$all2 = $registry->get_all_registered();
echo 'registry_total_after_bust=' . count( $all2 ) . PHP_EOL;
$ccg2 = array_filter( array_keys( $all2 ), static fn( $s ) => str_contains( $s, 'ccg' ) );
echo 'registry_ccg_after_bust=' . count( $ccg2 ) . PHP_EOL;
foreach ( $ccg2 as $slug ) {
	if ( str_contains( $slug, 'about' ) ) {
		echo 'about_reg:' . $slug . PHP_EOL;
	}
}
