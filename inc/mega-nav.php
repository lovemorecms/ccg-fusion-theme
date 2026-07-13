<?php
/**
 * Mega menu rendering and header template-part replacement.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/nav-menu-data.php';

/**
 * Enqueue mega menu assets.
 */
function ccg_mega_nav_enqueue_assets() {
	wp_enqueue_style(
		'ccg-mega-nav',
		get_template_directory_uri() . '/assets/css/mega-nav.css',
		array( 'ccg-wp-theme' ),
		CCG_WP_THEME_VERSION
	);
	wp_enqueue_script(
		'ccg-mega-nav',
		get_template_directory_uri() . '/assets/js/mega-nav.js',
		array(),
		CCG_WP_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ccg_mega_nav_enqueue_assets' );
add_action( 'enqueue_block_editor_assets', 'ccg_mega_nav_enqueue_assets' );
add_action( 'enqueue_block_assets', 'ccg_mega_nav_enqueue_assets' );

/**
 * Replace block theme header template part with PHP mega nav.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Block data.
 */
function ccg_mega_nav_replace_header( $block_content, $block ) {
	if ( ( $block['blockName'] ?? '' ) !== 'core/template-part' ) {
		return $block_content;
	}
	if ( ( $block['attrs']['slug'] ?? '' ) !== 'header' ) {
		return $block_content;
	}

	ob_start();
	ccg_render_mega_nav_header();
	return ob_get_clean();
}
add_filter( 'render_block', 'ccg_mega_nav_replace_header', 10, 2 );

/**
 * @param array $panel
 */
function ccg_mega_nav_render_panel( $panel, $category, $menu_item ) {
	$cat_href = ! empty( $category['href'] ) ? $category['href'] : ( $menu_item['href'] ?? '#' );
	$title    = sprintf(
		'<h3 class="fusion-nav-v2__panel-title"><a class="fusion-nav-v2__panel-title-link" href="%1$s">%2$s</a></h3>',
		esc_url( $cat_href ),
		esc_html( $category['label'] )
	);

	if ( ( $panel['type'] ?? '' ) === 'empty' ) {
		echo '<div class="fusion-nav-v2__panel-content">';
		echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';
		return;
	}

	if ( in_array( $panel['type'], array( 'list', 'cards' ), true ) ) {
		echo '<div class="fusion-nav-v2__panel-content fusion-nav-v2__panel-content--list">';
		echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<ul class="fusion-nav-v2__link-list">';
		foreach ( $panel['links'] as $link ) {
			printf(
				'<li><a class="fusion-mega-link" href="%1$s">%2$s</a></li>',
				esc_url( $link['href'] ),
				esc_html( $link['label'] )
			);
		}
		echo '</ul></div>';
		return;
	}

	if ( 'columns' === ( $panel['type'] ?? '' ) ) {
		$count = count( $panel['columns'] );
		$cols  = 4 === $count ? '4' : ( 3 === $count ? '3' : '2' );
		echo '<div class="fusion-nav-v2__panel-content fusion-nav-v2__panel-content--columns">';
		echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		printf(
			'<div class="fusion-nav-v2__columns fusion-nav-v2__columns--%s">',
			esc_attr( $cols )
		);
		foreach ( $panel['columns'] as $col ) {
			echo '<div class="fusion-nav-v2__column">';
			printf( '<h4 class="fusion-nav-v2__column-title">%s</h4>', esc_html( $col['title'] ) );
			echo '<ul class="fusion-nav-v2__link-list">';
			foreach ( $col['links'] as $link ) {
				printf(
					'<li><a class="fusion-mega-link" href="%1$s">%2$s</a></li>',
					esc_url( $link['href'] ),
					esc_html( $link['label'] )
				);
			}
			echo '</ul></div>';
		}
		echo '</div></div>';
	}
}

/**
 * @param array $panel
 */
function ccg_mega_nav_render_mobile_panel( $panel, $category ) {
	$cat_href = ! empty( $category['href'] ) ? $category['href'] : '#';
	printf(
		'<p class="fusion-site-nav__mobile-featured-title"><a href="%1$s">%2$s</a></p>',
		esc_url( $cat_href ),
		esc_html( $category['label'] )
	);

	if ( ( $panel['type'] ?? '' ) === 'empty' ) {
		return;
	}

	if ( in_array( $panel['type'], array( 'list', 'cards' ), true ) ) {
		echo '<ul class="fusion-site-nav__mobile-link-list">';
		foreach ( $panel['links'] as $link ) {
			printf(
				'<li><a class="fusion-site-nav__mobile-link" href="%1$s">%2$s</a></li>',
				esc_url( $link['href'] ),
				esc_html( $link['label'] )
			);
		}
		echo '</ul>';
		return;
	}

	if ( 'columns' === ( $panel['type'] ?? '' ) ) {
		foreach ( $panel['columns'] as $col ) {
			echo '<div class="fusion-site-nav__mobile-col">';
			printf( '<h4 class="fusion-site-nav__mobile-col-title">%s</h4>', esc_html( $col['title'] ) );
			echo '<ul class="fusion-site-nav__mobile-link-list">';
			foreach ( $col['links'] as $link ) {
				printf(
					'<li><a class="fusion-site-nav__mobile-link" href="%1$s">%2$s</a></li>',
					esc_url( $link['href'] ),
					esc_html( $link['label'] )
				);
			}
			echo '</ul></div>';
		}
	}
}

/**
 * Output full site header (skip link + mega nav).
 */
function ccg_render_mega_nav_header() {
	$items    = ccg_get_nav_menu_items();
	$logo_url = ccg_wp_theme_asset_url( 'assets/images/fusion-orbit-logo.png' );
	$home     = home_url( '/' );
	?>
	<a class="ccg-skip-link" href="#main-content"><?php esc_html_e( 'Skip to main content', 'ccg-wp-theme' ); ?></a>
	<div class="fusion-site-header">
		<div
			id="ccg-mega-nav"
			class="fusion-nav-v2 fusion-site-nav"
			data-active-menu=""
			data-active-category=""
		>
			<div class="fusion-nav-v2__bar">
				<a href="<?php echo esc_url( $home ); ?>" class="fusion-site-nav__logo">
					<img
						src="<?php echo esc_url( $logo_url ); ?>"
						alt="<?php esc_attr_e( 'FUSION Sphere', 'ccg-wp-theme' ); ?>"
						width="213"
						height="49"
					/>
				</a>

				<nav aria-label="<?php esc_attr_e( 'Primary', 'ccg-wp-theme' ); ?>" class="ccg-mega-nav__desktop">
					<?php foreach ( $items as $item ) : ?>
						<button
							type="button"
							class="fusion-mega-trigger fusion-mega-trigger--<?php echo esc_attr( $item['id'] ); ?>"
							data-menu-trigger="<?php echo esc_attr( $item['id'] ); ?>"
							aria-expanded="false"
							aria-controls="fusion-nav-v2-mega-<?php echo esc_attr( $item['id'] ); ?>"
						>
							<span><?php echo esc_html( $item['label'] ); ?></span>
							<svg class="ccg-mega-chevron" width="12" height="12" viewBox="0 0 10 6" fill="none" aria-hidden="true">
								<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
							<span class="fusion-mega-trigger__underline" aria-hidden="true"></span>
						</button>
					<?php endforeach; ?>
				</nav>

				<div class="ccg-mega-nav__actions">
					<button
						type="button"
						class="fusion-site-nav__menu-btn"
						data-mobile-toggle
						aria-expanded="false"
						aria-controls="fusion-nav-v2-mobile-drawer"
						aria-label="<?php esc_attr_e( 'Open menu', 'ccg-wp-theme' ); ?>"
					>
						<svg class="ccg-icon-menu" width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
							<path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						</svg>
						<svg class="ccg-icon-close" width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true" hidden>
							<path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						</svg>
					</button>

					<button
						type="button"
						class="fusion-site-nav__search-btn"
						data-site-search-toggle
						aria-expanded="false"
						aria-controls="site-search-region"
						aria-label="<?php esc_attr_e( 'Open search', 'ccg-wp-theme' ); ?>"
					>
						<?php ccg_render_search_icon(); ?>
					</button>

					<a class="fusion-site-nav__get-help" href="<?php echo esc_url( home_url( '/#get-help' ) ); ?>">
						<?php esc_html_e( 'Get Help', 'ccg-wp-theme' ); ?>
					</a>
				</div>
			</div>

			<button type="button" class="fusion-nav-v2__overlay" data-mega-overlay hidden aria-label="<?php esc_attr_e( 'Close menu', 'ccg-wp-theme' ); ?>"></button>

			<?php foreach ( $items as $item ) : ?>
				<?php
				$first_cat = $item['categories'][0] ?? null;
				?>
				<div
					id="fusion-nav-v2-mega-<?php echo esc_attr( $item['id'] ); ?>"
					class="fusion-nav-v2__mega fusion-nav-v2__mega--<?php echo esc_attr( $item['id'] ); ?> ccg-mega-nav__mega--desktop"
					role="region"
					aria-label="<?php echo esc_attr( $item['label'] . ' menu' ); ?>"
					hidden
				>
					<div class="fusion-nav-v2__mega-bridge" aria-hidden="true"></div>
					<div class="fusion-nav-v2__mega-atmosphere" aria-hidden="true"></div>
					<div class="fusion-nav-v2__mega-veil" aria-hidden="true"></div>
					<div class="fusion-nav-v2__mega-swap">
					<div class="fusion-nav-v2__mega-container">
						<div class="fusion-nav-v2__mega-inner">
							<div class="fusion-nav-v2__left">
								<h2 class="fusion-nav-v2__menu-title" id="fusion-nav-v2-menu-<?php echo esc_attr( $item['id'] ); ?>">
									<a class="fusion-nav-v2__menu-title-link" href="<?php echo esc_url( $item['href'] ); ?>">
										<?php echo esc_html( $item['label'] ); ?>
									</a>
								</h2>
								<div
									class="fusion-nav-v2__categories"
									role="tablist"
									aria-labelledby="fusion-nav-v2-menu-<?php echo esc_attr( $item['id'] ); ?>"
								>
									<?php foreach ( $item['categories'] as $cat_index => $cat ) : ?>
										<button
											type="button"
											role="tab"
											class="fusion-nav-v2__category<?php echo 0 === $cat_index ? ' fusion-nav-v2__category--active' : ''; ?>"
											id="fusion-nav-v2-tab-<?php echo esc_attr( $item['id'] . '-' . $cat['id'] ); ?>"
											data-menu="<?php echo esc_attr( $item['id'] ); ?>"
											data-category="<?php echo esc_attr( $cat['id'] ); ?>"
											aria-selected="<?php echo 0 === $cat_index ? 'true' : 'false'; ?>"
											aria-controls="fusion-nav-v2-panel-<?php echo esc_attr( $item['id'] ); ?>"
											tabindex="<?php echo 0 === $cat_index ? '0' : '-1'; ?>"
										>
											<?php echo esc_html( $cat['label'] ); ?>
										</button>
									<?php endforeach; ?>
								</div>
							</div>
							<div
								id="fusion-nav-v2-panel-<?php echo esc_attr( $item['id'] ); ?>"
								class="fusion-nav-v2__right"
								role="tabpanel"
							>
								<?php foreach ( $item['categories'] as $cat_index => $cat ) : ?>
									<div
										class="ccg-mega-nav__panel-pane"
										data-menu="<?php echo esc_attr( $item['id'] ); ?>"
										data-category="<?php echo esc_attr( $cat['id'] ); ?>"
										<?php echo $cat_index > 0 ? ' hidden' : ''; ?>
									>
										<?php ccg_mega_nav_render_panel( $cat['panel'], $cat, $item ); ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					</div>
				</div>
			<?php endforeach; ?>

			<div id="fusion-nav-v2-mobile-drawer" class="fusion-site-nav__mobile-drawer" hidden>
				<nav aria-label="<?php esc_attr_e( 'Primary sections', 'ccg-wp-theme' ); ?>" class="fusion-site-nav__mobile-nav">
					<?php foreach ( $items as $item ) : ?>
						<?php $first_cat = $item['categories'][0] ?? null; ?>
						<details class="fusion-site-nav__mobile-details" data-mobile-section="<?php echo esc_attr( $item['id'] ); ?>">
							<summary class="fusion-site-nav__mobile-summary"><?php echo esc_html( $item['label'] ); ?></summary>
							<div class="fusion-site-nav__mobile-panel fusion-nav-v2__mobile-panel fusion-nav-v2__mobile-panel--<?php echo esc_attr( $item['id'] ); ?>">
								<div class="fusion-nav-v2__mobile-categories">
									<?php foreach ( $item['categories'] as $cat_index => $cat ) : ?>
										<button
											type="button"
											class="fusion-nav-v2__mobile-category<?php echo 0 === $cat_index ? ' fusion-nav-v2__mobile-category--active' : ''; ?>"
											data-mobile-menu="<?php echo esc_attr( $item['id'] ); ?>"
											data-mobile-category="<?php echo esc_attr( $cat['id'] ); ?>"
										>
											<?php echo esc_html( $cat['label'] ); ?>
										</button>
									<?php endforeach; ?>
								</div>
								<?php foreach ( $item['categories'] as $cat_index => $cat ) : ?>
									<div
										class="fusion-nav-v2__mobile-links ccg-mega-nav__mobile-pane"
										data-mobile-menu="<?php echo esc_attr( $item['id'] ); ?>"
										data-mobile-category="<?php echo esc_attr( $cat['id'] ); ?>"
										<?php echo $cat_index > 0 ? ' hidden' : ''; ?>
									>
										<?php ccg_mega_nav_render_mobile_panel( $cat['panel'], $cat ); ?>
									</div>
								<?php endforeach; ?>
							</div>
						</details>
					<?php endforeach; ?>
				</nav>
			</div>
		</div>
		<?php ccg_render_site_search_panel(); ?>
	</div>
	<?php
}
