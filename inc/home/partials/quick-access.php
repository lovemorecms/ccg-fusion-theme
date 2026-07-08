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
							<span class="fusion-quick-access__icon-ring" aria-hidden="true"></span>
							<span class="fusion-quick-access__title"><?php echo esc_html( $item[0] ); ?></span>
							<span class="fusion-quick-access__subtitle"><?php echo esc_html( $item[1] ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</section>
