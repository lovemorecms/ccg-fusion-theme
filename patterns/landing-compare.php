<?php
/**
 * Title: Landing compare tabs
 * Slug: ccg-wp-theme/landing-compare
 * Categories: ccg-content
 */
$tabs = array(
	array(
		'id'      => 'plans',
		'label'   => 'Plans',
		'title'   => 'Choose the right starting point',
		'body'    => 'Use tabs for plan tiers, service levels, or deployment models. Keep panel copy concise and scannable.',
		'bullets' => array( 'Sandbox for discovery', 'Standard for production workloads', 'Enterprise for mission-critical systems' ),
	),
	array(
		'id'      => 'capabilities',
		'label'   => 'Capabilities',
		'title'   => 'What each option includes',
		'body'    => 'List capabilities that change between tabs—automation, monitoring, backup, identity integration, and more.',
		'bullets' => array( 'Infrastructure as code templates', 'Centralized logging and metrics', 'Security baseline controls' ),
	),
	array(
		'id'      => 'support',
		'label'   => 'Support',
		'title'   => 'How teams get help',
		'body'    => 'Describe support channels, office hours, and escalation paths associated with each tab selection.',
		'bullets' => array( 'Customer Service Team engagement', 'Knowledge base and runbooks', 'Incident management integration' ),
	),
);
?>
<!-- wp:html -->
<section id="compare" class="lpl-section lpl-section--tabs" aria-labelledby="compare-heading" tabindex="-1">
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="compare-heading" class="lpl-section__title"><?php esc_html_e( 'Tabbed comparison', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Organize related content into tabs when users need to compare options without leaving the page.', 'ccg-wp-theme' ); ?></p>
		</header>
		<div class="lpl-ms-tabs" data-lpl-tabs>
			<div class="lpl-ms-tabs__bar" role="tablist" aria-label="<?php esc_attr_e( 'Tabbed comparison', 'ccg-wp-theme' ); ?>">
				<?php foreach ( $tabs as $i => $tab ) : ?>
				<button
					type="button"
					role="tab"
					id="lpl-tab-<?php echo esc_attr( $tab['id'] ); ?>"
					class="lpl-ms-tabs__tab<?php echo 0 === $i ? ' lpl-ms-tabs__tab--active' : ''; ?>"
					aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
					aria-controls="lpl-panel-<?php echo esc_attr( $tab['id'] ); ?>"
					data-tab="<?php echo esc_attr( $tab['id'] ); ?>"
				><?php echo esc_html( $tab['label'] ); ?></button>
				<?php endforeach; ?>
			</div>
			<?php foreach ( $tabs as $i => $tab ) : ?>
			<div
				role="tabpanel"
				id="lpl-panel-<?php echo esc_attr( $tab['id'] ); ?>"
				aria-labelledby="lpl-tab-<?php echo esc_attr( $tab['id'] ); ?>"
				class="lpl-ms-tabs__panel"
				data-panel="<?php echo esc_attr( $tab['id'] ); ?>"
				<?php echo 0 === $i ? '' : ' hidden'; ?>
			>
				<h3 class="lpl-ms-tabs__title"><?php echo esc_html( $tab['title'] ); ?></h3>
				<p class="lpl-ms-tabs__body"><?php echo esc_html( $tab['body'] ); ?></p>
				<ul class="lpl-ms-tabs__list">
					<?php foreach ( $tab['bullets'] as $bullet ) : ?>
					<li><?php echo esc_html( $bullet ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:html -->
