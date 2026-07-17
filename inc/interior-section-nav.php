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
 * Items may include an optional `href` for cross-page links. Without `href`,
 * links default to `#{$id}` for in-page scroll-spy.
 *
 * @param array<int, array{id:string,label:string,href?:string,icon_html?:string}> $items Nav items.
 * @param array<string, mixed>                                   $args  {
 *     Optional. Arguments.
 *     @type string $aria_label Nav aria-label.
 *     @type string $active_id  Id of the active item (defaults to first item).
 *     @type string $cta_href   Optional CTA href.
 *     @type string $cta_label  Optional CTA label.
 *     @type string $cta_class  Optional CTA button classes.
 *     @type string $cta_html   Optional raw CTA HTML (overrides href/label).
 *     @type string $variant    Optional visual variant (`icon`).
 *     @type bool   $manual_active Whether another script manages active links.
 * }
 */
function ccg_render_interior_section_nav( $items, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'aria_label' => __( 'Page sections', 'ccg-wp-theme' ),
			'active_id'  => '',
			'cta_href'   => '',
			'cta_label'  => '',
			'cta_class'  => 'ds-c-button ds-c-button--solid ccg-btn-accent',
			'cta_html'   => '',
			'variant'    => '',
			'manual_active' => false,
		)
	);

	if ( empty( $items ) || ! is_array( $items ) ) {
		return;
	}

	$active_id = is_string( $args['active_id'] ) ? $args['active_id'] : '';
	$is_icon   = 'icon' === $args['variant'];
	if ( '' === $active_id && ! empty( $items[0]['id'] ) ) {
		$active_id = (string) $items[0]['id'];
	}
	?>
<div class="interior-section-nav-root<?php echo $is_icon ? ' interior-section-nav-root--icon' : ''; ?>"<?php echo $args['manual_active'] ? ' data-manual-active="true"' : ''; ?>>
	<div class="interior-section-nav__sentinel" aria-hidden="true"></div>
	<div class="interior-section-nav">
		<div class="interior-section-nav__wrap">
			<div class="interior-section-nav__shell<?php echo $is_icon ? ' interior-section-nav__shell--icon' : ''; ?>">
				<nav class="interior-section-nav__nav<?php echo $is_icon ? ' interior-section-nav__nav--icon' : ''; ?>" aria-label="<?php echo esc_attr( $args['aria_label'] ); ?>">
					<div class="interior-section-nav__track">
						<ul class="interior-section-nav__list<?php echo $is_icon ? ' interior-section-nav__list--icon' : ''; ?>">
							<?php foreach ( $items as $item ) : ?>
								<?php
								$id    = isset( $item['id'] ) ? (string) $item['id'] : '';
								$label = isset( $item['label'] ) ? (string) $item['label'] : '';
								$href  = ! empty( $item['href'] ) ? (string) $item['href'] : '#' . $id;
								$active = ( $id === $active_id );
								$icon_html = ! empty( $item['icon_html'] ) ? (string) $item['icon_html'] : '';
								?>
							<li class="interior-section-nav__item<?php echo $is_icon ? ' interior-section-nav__item--icon' : ''; ?>">
								<a
									href="<?php echo esc_url( $href ); ?>"
									class="interior-section-nav__link<?php echo $is_icon ? ' interior-section-nav__link--icon' : ''; ?><?php echo $active ? ' interior-section-nav__link--active' : ''; ?>"
									<?php echo $active ? ' aria-current="true"' : ''; ?>
									<?php echo $id ? ' data-section-id="' . esc_attr( $id ) . '"' : ''; ?>
								><?php if ( $is_icon && $icon_html ) : ?><span class="interior-section-nav__icon" aria-hidden="true"><?php echo $icon_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted theme SVG. ?></span><?php endif; ?><span class="<?php echo $is_icon ? 'interior-section-nav__label' : 'interior-section-nav__label--text'; ?>"><?php echo esc_html( $label ); ?></span></a>
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
}
