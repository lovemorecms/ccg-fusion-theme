<?php
/**
 * Program Overview — security checklist band.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = array(
	__( 'Advanced threat detection and response capabilities', 'ccg-wp-theme' ),
	__( 'Continuous monitoring and security assessments', 'ccg-wp-theme' ),
	__( 'Industry-leading encryption and data protection', 'ccg-wp-theme' ),
	__( 'Regular security audits and compliance verification', 'ccg-wp-theme' ),
);
?>
<section class="po-band ccg-about-security" aria-labelledby="po-security-heading">
	<div class="po-band__inner po-security">
		<h2 id="po-security-heading" class="kc-section-heading po-section-heading">
			<?php esc_html_e( 'Keeping security top-of-mind', 'ccg-wp-theme' ); ?>
		</h2>
		<p class="kc-section-subtitle po-section-lede">
			<?php esc_html_e( 'CMS is committed to following industry leading security standards and privacy practices. We work to continuously strengthen our security posture and better protect our stakeholders and their information through innovative and proven security solutions.', 'ccg-wp-theme' ); ?>
		</p>
		<ul class="po-security__grid">
			<?php foreach ( $items as $item ) : ?>
				<li class="po-security__item">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true" class="po-security__check">
						<circle cx="12" cy="12" r="10" fill="color-mix(in srgb, var(--color-primary) 12%, white)" />
						<path d="M8 12l3 3 5-6" stroke="var(--color-primary)" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<span><?php echo esc_html( $item ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
