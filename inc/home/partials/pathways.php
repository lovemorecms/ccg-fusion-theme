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
	array( __( 'I Need to Host an Application', 'ccg-wp-theme' ), ccg_home_url( '/#multi-cloud-services' ), 'host' ),
	array( __( 'I Need to Migrate an Application', 'ccg-wp-theme' ), ccg_home_url( '/learn/initiatives' ), 'migrate' ),
);
$ccg_row2 = array(
	array( __( 'I Need Guidance', 'ccg-wp-theme' ), ccg_home_url( '/learn/knowledge-center' ), 'guidance' ),
	array( __( 'I Need Support', 'ccg-wp-theme' ), ccg_home_url( '/#site-footer' ), 'support' ),
	array( __( 'Explore Options', 'ccg-wp-theme' ), ccg_home_url( '/#fusion-ecosystem' ), 'explore' ),
);

$ccg_pathway_icon = static function ( $icon ) {
	$icons = array(
		'host'     => '<svg class="fusion-pathways-help__pill-icon" viewBox="0 0 24 24" fill="none" focusable="false"><path d="M8 9h8M8 13h5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/><path d="M8 5h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-4l-4 3v-3H8a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/></svg>',
		'migrate'  => '<svg class="fusion-pathways-help__pill-icon" viewBox="0 0 24 24" fill="none" focusable="false"><path d="M5 9a7 7 0 0 1 13-2l1 2M19 15a7 7 0 0 1-13 2l-1-2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 9V5h4M19 15v4h-4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		'guidance' => '<svg class="fusion-pathways-help__pill-icon" viewBox="0 0 24 24" fill="none" focusable="false"><circle cx="12" cy="14" r="7" stroke="currentColor" stroke-width="1.75"/><path d="M12 10V7M9 3h6M12 14l3-2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>',
		'support'  => '<svg class="fusion-pathways-help__pill-icon" viewBox="0 0 24 24" fill="none" focusable="false"><path d="M9.5 9a2.5 2.5 0 1 1 4.8 1.2c-.6.8-1.3 1.1-1.8 1.8-.4.6-.5 1-.5 1.5V14" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/><path d="M12 17h.01" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>',
		'explore'  => '<svg class="fusion-pathways-help__pill-icon" viewBox="0 0 24 24" fill="none" focusable="false"><path d="M5 5h6v6H5zM13 5h6v6h-6zM5 13h6v6H5zM13 13h6v6h-6z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/></svg>',
	);

	return $icons[ $icon ] ?? '';
};
?>
<section id="pathways" class="fusion-pathways-help fusion-band-gradient-primary-mist" aria-labelledby="fusion-pathways-heading">
	<div class="fusion-pathways-help__inner">
		<header class="fusion-pathways-help__header fusion-home-section__header">
			<h2 id="fusion-pathways-heading" class="fusion-pathways-help__heading"><?php esc_html_e( 'How can we help you today?', 'ccg-wp-theme' ); ?></h2>
			<p class="fusion-pathways-help__lede"><?php esc_html_e( 'Select a pathway to access services, resources, and support across the cloud ecosystem', 'ccg-wp-theme' ); ?></p>
		</header>
		<nav class="fusion-pathways-help__layout" aria-labelledby="fusion-pathways-heading">
			<ul class="fusion-pathways-help__row fusion-pathways-help__row--two">
				<?php foreach ( $ccg_row1 as $pill ) : ?>
					<li>
						<a class="fusion-pathways-help__pill" href="<?php echo esc_url( $pill[1] ); ?>">
							<span class="fusion-pathways-help__pill-icon-wrap" aria-hidden="true"><?php echo $ccg_pathway_icon( $pill[2] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
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
							<span class="fusion-pathways-help__pill-icon-wrap<?php echo 'support' === $pill[2] ? ' fusion-pathways-help__pill-icon-wrap--support' : ''; ?>" aria-hidden="true"><?php echo $ccg_pathway_icon( $pill[2] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<span class="fusion-pathways-help__pill-label"><?php echo esc_html( $pill[0] ); ?></span>
							<span class="fusion-pathways-help__pill-chevron" aria-hidden="true">›</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</section>
