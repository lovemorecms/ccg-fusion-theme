<?php
/**
 * Title: Landing timeline
 * Slug: ccg-wp-theme/landing-timeline
 * Categories: ccg-content
 */
$quarters = array(
	array(
		'quarter'     => 'Q1',
		'year'        => '2026',
		'months'      => 'Jan — Mar',
		'status'      => 'completed',
		'title'       => 'Template foundations',
		'description' => 'Establish hero, sticky nav, and core section blocks for landing pages.',
		'tags'        => array( 'Completed', 'Layout library' ),
	),
	array(
		'quarter'     => 'Q2',
		'year'        => '2026',
		'months'      => 'Apr — Jun',
		'status'      => 'current',
		'title'       => 'Authoring guidance',
		'description' => 'Publish content guidelines and examples for each section variant.',
		'tags'        => array( 'In progress', 'Documentation' ),
	),
	array(
		'quarter'     => 'Q3',
		'year'        => '2026',
		'months'      => 'Jul — Sep',
		'status'      => 'upcoming',
		'title'       => 'Pattern expansion',
		'description' => 'Add optional blocks such as video, quote carousel, and logo strips.',
		'tags'        => array( 'Planned', 'Components' ),
	),
);
?>
<!-- wp:html -->
<section id="timeline" class="lpl-section lpl-section--timeline" aria-labelledby="timeline-heading" tabindex="-1">
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="timeline-heading" class="lpl-section__title"><?php esc_html_e( 'Release timeline', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Optional roadmap band for phased rollouts, milestones, or quarterly themes.', 'ccg-wp-theme' ); ?></p>
		</header>
		<div class="init-timeline lpl-timeline" role="region" aria-label="<?php esc_attr_e( 'Release timeline', 'ccg-wp-theme' ); ?>">
			<ol class="init-timeline__list">
				<?php foreach ( $quarters as $q ) : ?>
				<li class="init-timeline__row init-timeline__row--<?php echo esc_attr( $q['status'] ); ?>"<?php echo 'current' === $q['status'] ? ' aria-current="step"' : ''; ?>>
					<div class="init-timeline__track"><span class="init-timeline__marker init-timeline__marker--<?php echo esc_attr( $q['status'] ); ?>" aria-hidden="true"></span></div>
					<div class="init-timeline__label-cell init-timeline__label-cell--<?php echo esc_attr( $q['status'] ); ?>">
						<span class="init-timeline__q"><?php echo esc_html( $q['quarter'] ); ?> <span class="init-timeline__yr"><?php echo esc_html( $q['year'] ); ?></span></span>
						<span class="init-timeline__months"><?php echo esc_html( $q['months'] ); ?></span>
						<?php if ( 'current' === $q['status'] ) : ?>
						<span class="init-timeline__now-badge"><?php esc_html_e( 'Now', 'ccg-wp-theme' ); ?></span>
						<?php endif; ?>
					</div>
					<article class="init-timeline__hq-card init-timeline__hq-card--<?php echo esc_attr( $q['status'] ); ?>">
						<h3 class="init-timeline__hq-title"><?php echo esc_html( $q['title'] ); ?></h3>
						<p class="init-timeline__hq-desc"><?php echo esc_html( $q['description'] ); ?></p>
						<ul class="init-timeline__tags" aria-label="<?php esc_attr_e( 'Themes', 'ccg-wp-theme' ); ?>">
							<?php foreach ( $q['tags'] as $tag ) : ?>
							<li class="init-timeline__tag init-timeline__tag--default"><?php echo esc_html( $tag ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</section>
<!-- /wp:html -->
