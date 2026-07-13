<?php
/**
 * Shared interior section nav helper (Explore, Fusion Toolkit, landing templates).
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render interior section nav markup (block-friendly HTML).
 *
 * @param array<int, array{id:string,label:string}> $items Nav items.
 * @param array<string, mixed>                      $args  {
 *     Optional. Arguments.
 *     @type string $aria_label Nav aria-label.
 *     @type string $cta_href   Optional CTA href.
 *     @type string $cta_label  Optional CTA label.
 *     @type string $cta_class  Optional CTA button classes.
 *     @type string $cta_html   Optional raw CTA HTML (overrides href/label).
 * }
 */
function ccg_render_interior_section_nav( $items, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'aria_label' => __( 'Page sections', 'ccg-wp-theme' ),
			'cta_href'   => '',
			'cta_label'  => '',
			'cta_class'  => 'ds-c-button ds-c-button--solid ccg-btn-accent',
			'cta_html'   => '',
		)
	);

	if ( empty( $items ) || ! is_array( $items ) ) {
		return;
	}

	$first_id = esc_attr( $items[0]['id'] );
	?>
<div class="interior-section-nav-root">
	<div class="interior-section-nav__sentinel" aria-hidden="true"></div>
	<div class="interior-section-nav">
		<div class="interior-section-nav__wrap">
			<div class="interior-section-nav__shell">
				<nav class="interior-section-nav__nav" aria-label="<?php echo esc_attr( $args['aria_label'] ); ?>">
					<div class="interior-section-nav__track">
						<ul class="interior-section-nav__list">
							<?php foreach ( $items as $index => $item ) : ?>
								<?php
								$id    = esc_attr( $item['id'] );
								$label = esc_html( $item['label'] );
								$active = 0 === (int) $index;
								?>
							<li class="interior-section-nav__item">
								<a
									href="#<?php echo $id; ?>"
									class="interior-section-nav__link<?php echo $active ? ' interior-section-nav__link--active' : ''; ?>"
									<?php echo $active ? ' aria-current="true"' : ''; ?>
								><?php echo $label; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
						<span class="interior-section-nav__indicator" aria-hidden="true" style="opacity:0;width:0;transform:translateX(0)"></span>
					</div>
				</nav>
				<?php if ( $args['cta_html'] ) : ?>
				<div class="interior-section-nav__cta">
					<?php echo $args['cta_html']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- caller-provided escaped HTML. ?>
				</div>
				<?php elseif ( $args['cta_href'] && $args['cta_label'] ) : ?>
				<div class="interior-section-nav__cta">
					<a class="<?php echo esc_attr( $args['cta_class'] ); ?>" href="<?php echo esc_url( $args['cta_href'] ); ?>"><?php echo esc_html( $args['cta_label'] ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
	<?php
	unset( $first_id );
}
