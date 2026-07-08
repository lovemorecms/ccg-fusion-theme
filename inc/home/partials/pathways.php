<?php
/**
 * Homepage pathways.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __DIR__ ) . '/bootstrap.php';

$ccg_row1 = array(
	array( __( 'I Need to Host an Application', 'ccg-wp-theme' ), ccg_home_url( '/#multi-cloud-services' ), '' ),
	array( __( 'I Need to Migrate an Application', 'ccg-wp-theme' ), ccg_home_url( '/learn/initiatives' ), '' ),
);
$ccg_row2 = array(
	array( __( 'I Need Guidance', 'ccg-wp-theme' ), ccg_home_url( '/learn/knowledge-center' ), '' ),
	array( __( 'I Need Support', 'ccg-wp-theme' ), ccg_home_url( '/#site-footer' ), ' fusion-pathways-help__pill-icon-wrap--support' ),
	array( __( 'Explore Options', 'ccg-wp-theme' ), ccg_home_url( '/#fusion-ecosystem' ), '' ),
);
?>
<section id="pathways" class="fusion-pathways-help fusion-band-gradient-primary-mist" aria-labelledby="fusion-pathways-heading">
	<div class="fusion-pathways-help__inner">
		<header class="fusion-pathways-help__header fusion-home-section__header">
			<h2 id="fusion-pathways-heading" class="fusion-pathways-help__heading"><?php esc_html_e( 'How can we help you today?', 'ccg-wp-theme' ); ?></h2>
			<p class="fusion-pathways-help__lede"><?php esc_html_e( 'Select a pathway to access services, resources, and support across the cloud ecosystem.', 'ccg-wp-theme' ); ?></p>
		</header>
		<nav class="fusion-pathways-help__layout" aria-labelledby="fusion-pathways-heading">
			<ul class="fusion-pathways-help__row fusion-pathways-help__row--two">
				<?php foreach ( $ccg_row1 as $pill ) : ?>
					<li>
						<a class="fusion-pathways-help__pill" href="<?php echo esc_url( $pill[1] ); ?>">
							<span class="fusion-pathways-help__pill-icon-wrap<?php echo esc_attr( $pill[2] ); ?>" aria-hidden="true"></span>
							<span class="fusion-pathways-help__pill-label"><?php echo esc_html( $pill[0] ); ?></span>
							<span class="fusion-pathways-help__pill-chevron" aria-hidden="true">›</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<ul class="fusion-pathways-help__row fusion-pathways-help__row--three">
				<?php foreach ( $ccg_row2 as $pill ) : ?>
					<li>
						<a class="fusion-pathways-help__pill fusion-pathways-help__pill--compact" href="<?php echo esc_url( $pill[1] ); ?>">
							<span class="fusion-pathways-help__pill-icon-wrap<?php echo esc_attr( $pill[2] ); ?>" aria-hidden="true"></span>
							<span class="fusion-pathways-help__pill-label"><?php echo esc_html( $pill[0] ); ?></span>
							<span class="fusion-pathways-help__pill-chevron" aria-hidden="true">›</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</section>
