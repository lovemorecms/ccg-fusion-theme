<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

foreach ( array( 'explore', 'explore/fusion-toolkit' ) as $path ) {
	$page = get_page_by_path( $path );
	if ( ! $page ) {
		echo "$path=missing\n";
		continue;
	}
	$c = $page->post_content;
	echo "path=$path\n";
	echo '  interior_nav=' . ( str_contains( $c, 'interior-section-nav-root' ) ? 'yes' : 'no' ) . "\n";
	echo '  ft_sticky_old=' . ( str_contains( $c, 'ft-sticky-nav' ) ? 'yes' : 'no' ) . "\n";
	echo '  with_section_nav=' . ( str_contains( $c, 'with-section-nav' ) ? 'yes' : 'no' ) . "\n";
	echo '  has_overview=' . ( str_contains( $c, 'id="overview"' ) ? 'yes' : 'no' ) . "\n";
	$pos_nav  = strpos( $c, 'interior-section-nav-root' );
	$pos_hero = strpos( $c, 'ft-hero' );
	if ( false === $pos_hero ) {
		$pos_hero = strpos( $c, 'init-hero' );
	}
	echo '  nav_after_hero=' . ( false !== $pos_nav && false !== $pos_hero && $pos_nav > $pos_hero ? 'yes' : 'no' ) . "\n";
	foreach ( array( 'platforms', 'roadmap', 'whats-happening', 'learn-connect', 'getting-started', 'basecamp', 'helix' ) as $id ) {
		if ( str_contains( $c, 'id="' . $id . '"' ) ) {
			echo "  id_$id=yes\n";
		}
	}
}
