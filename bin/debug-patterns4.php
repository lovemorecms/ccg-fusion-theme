<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';

$registry = WP_Block_Patterns_Registry::get_instance();
foreach ( $registry->get_all_registered() as $pattern ) {
	$name = $pattern['name'] ?? '';
	if ( str_contains( $name, 'about' ) ) {
		echo $name . PHP_EOL;
	}
}
