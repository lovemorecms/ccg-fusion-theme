<?php
/**
 * Program Overview — services stats list.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$stats = array(
	array( '99.99%', __( 'Uptime SLA', 'ccg-wp-theme' ) ),
	array( '24/7', __( 'Support', 'ccg-wp-theme' ) ),
	array( '100%', __( 'Compliant', 'ccg-wp-theme' ) ),
	array( __( 'Secure', 'ccg-wp-theme' ), __( 'Infrastructure', 'ccg-wp-theme' ) ),
);
?>
<ul class="po-stats">
	<?php foreach ( $stats as $stat ) : ?>
		<li class="po-stat">
			<span class="po-stat__value"><?php echo esc_html( $stat[0] ); ?></span>
			<span class="po-stat__label"><?php echo esc_html( $stat[1] ); ?></span>
		</li>
	<?php endforeach; ?>
</ul>
