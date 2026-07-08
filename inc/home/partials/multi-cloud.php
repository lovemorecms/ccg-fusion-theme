<?php
/**
 * Homepage Multi-Cloud Services band.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_bg = esc_url( ccg_home_asset( 'assets/images/sections/new-bg-cloud.png' ) );
?>
<section
	id="multi-cloud-services"
	class="fusion-multi-cloud"
	aria-labelledby="fusion-multi-cloud-heading"
	style="background-image:url(<?php echo $ccg_bg; ?>)"
>
	<div class="fusion-multi-cloud__inner">
		<div class="fusion-multi-cloud__copy">
			<h2 id="fusion-multi-cloud-heading" class="fusion-multi-cloud__heading"><?php esc_html_e( 'Multi-Cloud Services', 'ccg-wp-theme' ); ?></h2>
			<div class="fusion-multi-cloud__prose">
				<p><?php esc_html_e( 'Fusion provides a true multi-cloud service that leverages the best features of each Cloud Service Provider to deliver value to CMS cloud customers across public cloud, on-prem data centers, and platform services.', 'ccg-wp-theme' ); ?></p>
				<p><?php esc_html_e( 'Besides best-of-breed cloud platforms and services, we offer a unified governance system that enforces rules, ensures standards are met, and keeps costs under control across a multi-cloud setup, secured by a Zero-Trust, TIC 3.0-approved security system that covers all cloud platforms.', 'ccg-wp-theme' ); ?></p>
				<p><?php esc_html_e( 'Fusion also offers right-sized workload placement, competitive pricing, and unified financial visibility, which drive measurable savings.', 'ccg-wp-theme' ); ?></p>
			</div>
			<a class="ds-c-button ds-c-button--solid ccg-btn-accent fusion-multi-cloud__cta" href="<?php echo esc_url( ccg_home_url( '/about/program-overview' ) ); ?>">
				<?php esc_html_e( 'Learn more', 'ccg-wp-theme' ); ?>
			</a>
		</div>
	</div>
</section>
