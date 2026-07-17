<?php
/**
 * Title: Landing FAQ accordion
 * Slug: ccg-wp-theme/landing-faq
 * Categories: ccg-content
 */
$items = array(
	array(
		'heading' => 'Who should use this landing layout?',
		'content' => 'Program offices, platform teams, and initiative leads who need a long-form marketing-style page with in-page navigation and multiple content blocks.',
	),
	array(
		'heading' => 'Can sections be reordered or removed?',
		'content' => 'Yes. Each block is composable. Keep the hero and sticky nav pattern, then include only the sections your page needs.',
	),
	array(
		'heading' => 'Does the sticky nav work on mobile?',
		'content' => 'The pill navigation scrolls horizontally on small screens and pins beneath the site header when the user scrolls past the hero.',
	),
	array(
		'heading' => 'Which design system components are used?',
		'content' => 'Fusion buttons, CMS.gov tabs, and accordion components are used where interactive patterns are demonstrated.',
	),
);
?>
<!-- wp:html -->
<section id="faq" class="lpl-section lpl-section--faq fusion-section-reveal" aria-labelledby="faq-heading" tabindex="-1">
	<div class="lpl-container">
		<header class="lpl-section__intro">
			<h2 id="faq-heading" class="lpl-section__title"><?php esc_html_e( 'FAQ with accordion', 'ccg-wp-theme' ); ?></h2>
			<p class="lpl-section__lede"><?php esc_html_e( 'Pair introductory copy with an accordion for detailed questions. CMS Design System accordion components keep interactions accessible.', 'ccg-wp-theme' ); ?></p>
		</header>
		<div class="lpl-faq">
			<div class="lpl-faq__intro">
				<p class="lpl-faq__body"><?php esc_html_e( 'Place a short paragraph or bullet list on the left to frame the topic. Stack accordion items on the right for expandable answers.', 'ccg-wp-theme' ); ?></p>
				<ul class="lpl-faq__list">
					<li><?php esc_html_e( 'Keep answers focused and link out when needed', 'ccg-wp-theme' ); ?></li>
					<li><?php esc_html_e( 'Default the first item open on desktop if helpful', 'ccg-wp-theme' ); ?></li>
					<li><?php esc_html_e( 'Limit to 5–7 questions per section', 'ccg-wp-theme' ); ?></li>
				</ul>
			</div>
			<div class="lpl-faq__accordion" data-lpl-accordion role="list">
				<?php foreach ( $items as $i => $item ) : ?>
				<div class="lpl-acc__item<?php echo 0 === $i ? ' lpl-acc__item--open' : ''; ?>">
					<h3 class="lpl-acc__heading">
						<button type="button" class="lpl-acc__button" aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>">
							<span><?php echo esc_html( $item['heading'] ); ?></span>
							<svg class="lpl-acc__chevron<?php echo 0 === $i ? ' lpl-acc__chevron--open' : ''; ?>" width="18" height="18" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M4 6l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
					</h3>
					<div class="lpl-acc__panel" <?php echo 0 === $i ? '' : 'hidden'; ?>>
						<p class="lpl-acc__content"><?php echo esc_html( $item['content'] ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->
