<?php
/**
 * Program Overview — feature capabilities band.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$features = array(
	array(
		'icon'  => 'cloud',
		'title' => __( 'Secure platforms', 'ccg-wp-theme' ),
		'desc'  => __( 'Our infrastructure meets the highest security and compliance standards.', 'ccg-wp-theme' ),
	),
	array(
		'icon'  => 'shield',
		'title' => __( 'Scalable platforms', 'ccg-wp-theme' ),
		'desc'  => __( "Systems designed to grow with your organization's needs.", 'ccg-wp-theme' ),
	),
	array(
		'icon'  => 'bolt',
		'title' => __( 'Stress-tested platforms', 'ccg-wp-theme' ),
		'desc'  => __( 'Proven reliability under the most demanding conditions.', 'ccg-wp-theme' ),
	),
	array(
		'icon'  => 'users',
		'title' => __( 'Modern services', 'ccg-wp-theme' ),
		'desc'  => __( 'Cutting-edge technology to support your mission-critical applications.', 'ccg-wp-theme' ),
	),
);
?>
<section class="po-band ccg-about-features" aria-labelledby="po-features-heading">
	<div class="po-band__inner">
		<h2 id="po-features-heading" class="sr-only"><?php esc_html_e( 'Platform capabilities', 'ccg-wp-theme' ); ?></h2>
		<div class="po-feature-grid">
			<?php foreach ( $features as $feature ) : ?>
				<article class="po-feature-card">
					<div class="po-feature-icon" aria-hidden="true">
						<?php if ( 'cloud' === $feature['icon'] ) : ?>
							<svg class="po-feature-icon__svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M18 10h-1.26A8 8 0 109 20h9a5 5 0 000-10z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
						<?php elseif ( 'shield' === $feature['icon'] ) : ?>
							<svg class="po-feature-icon__svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
						<?php elseif ( 'bolt' === $feature['icon'] ) : ?>
							<svg class="po-feature-icon__svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
						<?php else : ?>
							<svg class="po-feature-icon__svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
						<?php endif; ?>
					</div>
					<div class="po-feature-card__text">
						<h3 class="po-feature-card__title"><?php echo esc_html( $feature['title'] ); ?></h3>
						<p class="po-feature-card__desc"><?php echo esc_html( $feature['desc'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
