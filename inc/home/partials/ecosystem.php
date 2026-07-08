<?php
/**
 * Homepage FUSION ecosystem.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_base = ccg_home_asset( 'assets/images/sections/ecosphere/' );
$ccg_orbit = array(
	'toolkit'       => 'fusion-toolkit-icon2.png',
	'security'      => 'security-networking-icon2.png',
	'multi-cloud'   => 'multi-cloud-icon2.png',
	'cost'          => 'cost-optimization-icon2.png',
	'product-teams' => 'cloud-product-teams-icon2.png',
);
$ccg_tiles = array(
	array( 'toolkit', __( 'Fusion Toolkit', 'ccg-wp-theme' ), __( 'Customer focused decision intelligence, governance, operational coordination, financial visibility, and product transparency across multi cloud environment', 'ccg-wp-theme' ) ),
	array( 'security', __( 'Security & Networking', 'ccg-wp-theme' ), __( 'Zero Trust security and continuous compliance monitoring with simplified networking across every cloud platform', 'ccg-wp-theme' ) ),
	array( 'multi-cloud', __( 'Multi Cloud Env', 'ccg-wp-theme' ), __( 'Best-of breed public cloud, physical data center, and platform services delivered by AWS, Microsoft, Google, and Oracle CSPs', 'ccg-wp-theme' ) ),
	array( 'cost', __( 'Cost Optimization', 'ccg-wp-theme' ), __( 'Continuous process of reducing cloud expenses by maximizing resource efficiency and rightsizing without sacrificing performance', 'ccg-wp-theme' ) ),
	array( 'product-teams', __( 'Cloud Product Teams', 'ccg-wp-theme' ), __( 'Cloud engineering, security, finance and governance teams operating under a shared framework tailored specifically to meet CMS requirements', 'ccg-wp-theme' ) ),
);
?>
<section id="fusion-ecosystem" class="fusion-ecosphere" aria-labelledby="fusion-ecosphere-heading">
	<div class="fusion-ecosphere__inner">
		<header class="fusion-ecosphere__header fusion-home-section__header">
			<h2 id="fusion-ecosphere-heading" class="fusion-ecosphere__heading">
				<span class="fusion-ecosphere__heading-muted"><?php esc_html_e( 'Explore the', 'ccg-wp-theme' ); ?> </span>
				<span class="fusion-hero__headline-accent fusion-ecosphere__heading-accent"><?php esc_html_e( 'FUSION', 'ccg-wp-theme' ); ?></span>
				<span class="fusion-ecosphere__heading-muted"> <?php esc_html_e( 'ecosystem', 'ccg-wp-theme' ); ?></span>
			</h2>
			<p class="fusion-ecosphere__lede"><?php esc_html_e( 'A constellation of connected tools working in harmony', 'ccg-wp-theme' ); ?></p>
		</header>
		<div class="fusion-ecosphere__cluster">
			<div class="fusion-ecosphere__orbit-host" aria-hidden="true">
				<div class="fusion-ecosphere__orbit-board">
					<div class="fusion-ecosphere__ring fusion-ecosphere__ring--outer"></div>
					<div class="fusion-ecosphere__ring fusion-ecosphere__ring--mid"></div>
					<div class="fusion-ecosphere__core-wrap">
						<img class="fusion-ecosphere__core-img" src="<?php echo esc_url( $ccg_base . 'logo-fusion.png' ); ?>" alt="" width="160" height="160" decoding="async" />
					</div>
					<?php foreach ( $ccg_orbit as $id => $file ) : ?>
						<div class="fusion-ecosphere__orbit-node fusion-ecosphere__orbit-node--<?php echo esc_attr( $id ); ?>">
							<img src="<?php echo esc_url( $ccg_base . $file ); ?>" alt="" width="120" height="120" decoding="async" />
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php foreach ( $ccg_tiles as $tile ) : ?>
				<article class="fusion-ecosphere__tile fusion-ecosphere__tile--<?php echo esc_attr( $tile[0] ); ?>" aria-labelledby="fusion-ecosphere-tile-<?php echo esc_attr( $tile[0] ); ?>">
					<div class="fusion-ecosphere__card">
						<h3 id="fusion-ecosphere-tile-<?php echo esc_attr( $tile[0] ); ?>" class="fusion-ecosphere__card-title"><?php echo esc_html( $tile[1] ); ?></h3>
						<p class="fusion-ecosphere__card-body"><?php echo esc_html( $tile[2] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
