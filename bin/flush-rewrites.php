<?php
define( 'WP_USE_THEMES', false );
require dirname( __DIR__, 4 ) . '/wp-load.php';
flush_rewrite_rules( false );
echo "flushed_rewrite_rules\n";
