<?php
/**
 * Homepage Quick Access.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_items = array(
	array( 'Launchpad', 'Start your journey', ccg_home_url( '/#pathways' ), 'launchpad' ),
	array( 'Governance', 'Oversight and trust', ccg_home_url( '/#multi-cloud-services' ), 'governance' ),
	array( 'Pathways', 'Find the right path', ccg_home_url( '/#pathways' ), 'pathways' ),
	array( 'Solutions', 'Explore cloud options', ccg_home_url( '/#fusion-ecosystem' ), 'solutions' ),
	array( 'Support', 'Get CST help', ccg_home_url( '/#site-footer' ), 'support' ),
	array( 'Learn', 'Upskill and adapt', ccg_home_url( '/#fusion-academy' ), 'learn' ),
);
?>
<section id="fusion-quick-access" class="fusion-quick-access fusion-band-gradient-primary-mist" aria-labelledby="fusion-quick-access-heading">
	<div class="fusion-quick-access__inner">
		<header class="fusion-quick-access__header fusion-home-section__header">
			<h2 id="fusion-quick-access-heading" class="fusion-quick-access__heading"><?php esc_html_e( 'Quick Access', 'ccg-wp-theme' ); ?></h2>
			<p class="fusion-quick-access__support"><?php esc_html_e( 'Jump to common destinations across the FUSION ecosystem.', 'ccg-wp-theme' ); ?></p>
		</header>
		<nav class="fusion-quick-access__panel" aria-labelledby="fusion-quick-access-heading">
			<ul class="fusion-quick-access__grid">
				<?php foreach ( $ccg_items as $item ) : ?>
					<li>
						<a href="<?php echo esc_url( $item[2] ); ?>" class="fusion-quick-access__link">
							<span class="fusion-quick-access__icon-ring" aria-hidden="true">
								<?php if ( 'launchpad' === $item[3] ) : ?>
									<svg viewBox="0 0 24 24" fill="none" focusable="false">
										<path d="M13 2 3 14h8l-1 8 10-12h-8l1-8Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/>
									</svg>
								<?php elseif ( 'governance' === $item[3] ) : ?>
									<svg viewBox="0 0 24 24" fill="none" focusable="false">
										<path d="m12 3 7 4v5c0 5-3.5 9-7 10-3.5-1-7-5-7-10V7l7-4Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/>
										<path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								<?php elseif ( 'pathways' === $item[3] ) : ?>
									<svg viewBox="0 0 24 24" fill="none" focusable="false">
										<path d="M3 17V7l4-4h10l4 4v10l-4 4H7l-4-4Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/>
										<path d="M9 9h6M9 13h4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/>
									</svg>
								<?php elseif ( 'solutions' === $item[3] ) : ?>
									<svg viewBox="0 0 24 24" fill="none" focusable="false">
										<path d="M7 14a5 5 0 0 1 10 0M6 14h12M9 10h6" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								<?php elseif ( 'support' === $item[3] ) : ?>
									<svg viewBox="0 0 24 24" fill="none" focusable="false">
										<circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.75"/>
										<path d="M9.5 9.5a2.5 2.5 0 1 1 3.2 2.4c-.6.3-1.2.8-1.2 1.6V14" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/>
										<path d="M12 17h.01" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
									</svg>
								<?php else : ?>
									<svg viewBox="0 0 24 24" fill="none" focusable="false">
										<path d="m4 10 8-5 8 5-8 5-8-5Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/>
										<path d="M8 12v4.5l4 2.5 4-2.5V12" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/>
									</svg>
								<?php endif; ?>
							</span>
							<span class="fusion-quick-access__title"><?php echo esc_html( $item[0] ); ?></span>
							<span class="fusion-quick-access__subtitle"><?php echo esc_html( $item[1] ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</section>
