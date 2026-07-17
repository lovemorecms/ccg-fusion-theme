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
 * Render the small diagonal-arrow indicator used by overview links.
 */
function ccg_mega_nav_render_link_indicator() {
	?>
	<svg class="fusion-nav-v2__link-indicator" width="15" height="15" viewBox="0 0 16 16" fill="none" aria-hidden="true" focusable="false">
		<path d="M5 11 11 5M6 5h5v5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
	<?php
}

/**
 * Return all links represented by a category panel.
 *
 * @param array $panel Category panel.
 * @return array<int, array{label:string,href:string}>
 */
function ccg_mega_nav_panel_links( $panel ) {
	if ( in_array( $panel['type'] ?? '', array( 'list', 'cards' ), true ) ) {
		return $panel['links'] ?? array();
	}

	if ( 'columns' === ( $panel['type'] ?? '' ) ) {
		$links = array();
		foreach ( $panel['columns'] ?? array() as $column ) {
			$links = array_merge( $links, $column['links'] ?? array() );
		}
		return $links;
	}

	return array();
}

/**
 * Overview menu copy keyed by primary navigation section.
 *
 * @return array<string, array<string, string>>
 */
function ccg_mega_nav_overview_copy() {
	return array(
		'explore'     => array(
			'description'        => __( 'Discover our cloud platforms, solutions, and shared services.', 'ccg-wp-theme' ),
			'footer_title'       => __( 'Need guidance?', 'ccg-wp-theme' ),
			'footer_description' => __( 'Explore documentation, tutorials, and resources to help you succeed in the cloud.', 'ccg-wp-theme' ),
			'footer_label'       => __( 'Visit Documentation', 'ccg-wp-theme' ),
			'footer_href'        => ccg_nav_url( '/learn/knowledge-center' ),
		),
		'about'       => array(
			'description'        => __( 'Learn about CMS Hybrid Cloud, its benefits, and the team supporting your cloud journey.', 'ccg-wp-theme' ),
			'footer_title'       => __( 'Have questions?', 'ccg-wp-theme' ),
			'footer_description' => __( 'Connect with our team to learn how CMS Hybrid Cloud can support your organization.', 'ccg-wp-theme' ),
			'footer_label'       => __( 'Contact Us', 'ccg-wp-theme' ),
			'footer_href'        => ccg_nav_url( '/about/contact-us' ),
		),
		'learn'       => array(
			'description'        => __( 'Build your expertise. Access documentation, training, and resources to succeed in the cloud.', 'ccg-wp-theme' ),
			'footer_title'       => __( 'Need help finding something?', 'ccg-wp-theme' ),
			'footer_description' => __( 'Visit our documentation center for articles, tutorials, and support.', 'ccg-wp-theme' ),
			'footer_label'       => __( 'Go to Documentation', 'ccg-wp-theme' ),
			'footer_href'        => ccg_nav_url( '/learn/knowledge-center' ),
		),
		'get-started' => array(
			'description'        => __( 'Find the onboarding and migration resources you need to begin your cloud journey.', 'ccg-wp-theme' ),
			'footer_title'       => __( 'Need help getting started?', 'ccg-wp-theme' ),
			'footer_description' => __( 'Our support team can help you identify the right path and next steps.', 'ccg-wp-theme' ),
			'footer_label'       => __( 'Get Help', 'ccg-wp-theme' ),
			'footer_href'        => home_url( '/#get-help' ),
		),
	);
}

/**
 * Render a contextual overview footer.
 *
 * @param array<string, string> $copy Footer copy.
 */
function ccg_mega_nav_render_overview_footer( $copy ) {
	?>
	<footer class="fusion-nav-v2__overview-footer">
		<div>
			<strong><?php echo esc_html( $copy['footer_title'] ); ?></strong>
			<span><?php echo esc_html( $copy['footer_description'] ); ?></span>
		</div>
		<a href="<?php echo esc_url( $copy['footer_href'] ); ?>" class="fusion-nav-v2__overview-footer-link">
			<?php echo esc_html( $copy['footer_label'] ); ?>
			<?php ccg_mega_nav_render_link_indicator(); ?>
		</a>
	</footer>
	<?php
}

/**
 * Render About, Explore, and Get Started desktop overview menus.
 *
 * @param array $menu_item Primary menu item.
 * @param array $copy      Menu copy.
 */
function ccg_mega_nav_render_overview( $menu_item, $copy ) {
	?>
	<div class="fusion-nav-v2__overview fusion-nav-v2__overview--<?php echo esc_attr( $menu_item['id'] ); ?>">
		<div class="fusion-nav-v2__overview-main">
			<header class="fusion-nav-v2__overview-header">
				<h2 class="fusion-nav-v2__overview-title">
					<a href="<?php echo esc_url( $menu_item['href'] ); ?>">
						<?php echo esc_html( $menu_item['label'] ); ?>
						<?php ccg_mega_nav_render_link_indicator(); ?>
					</a>
				</h2>
				<p><?php echo esc_html( $copy['description'] ); ?></p>
			</header>

			<div class="fusion-nav-v2__overview-grid fusion-nav-v2__overview-grid--<?php echo esc_attr( $menu_item['id'] ); ?>" aria-label="<?php echo esc_attr( $menu_item['label'] . ' categories' ); ?>">
				<?php foreach ( $menu_item['categories'] as $category ) : ?>
					<?php
					$category_href = ! empty( $category['href'] ) ? $category['href'] : $menu_item['href'];
					$links         = ccg_mega_nav_panel_links( $category['panel'] );
					?>
				<section class="fusion-nav-v2__overview-category fusion-nav-v2__overview-category--<?php echo esc_attr( $category['id'] ); ?>">
					<h3>
						<a href="<?php echo esc_url( $category_href ); ?>">
							<?php echo esc_html( $category['label'] ); ?>
							<?php ccg_mega_nav_render_link_indicator(); ?>
						</a>
					</h3>
					<ul>
						<?php foreach ( $links as $link ) : ?>
						<li><a class="fusion-mega-link" href="<?php echo esc_url( $link['href'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</section>
				<?php endforeach; ?>
			</div>
		</div>
		<?php ccg_mega_nav_render_overview_footer( $copy ); ?>
	</div>
	<?php
}

/**
 * Render the compact four-column Learn overview.
 *
 * @param array $menu_item Learn menu item.
 * @param array $copy      Learn overview copy.
 */
function ccg_mega_nav_render_learn_overview( $menu_item, $copy ) {
	$group_labels = array(
		'ARCHITECTURE & INFRASTRUCTURE'                         => __( 'Architecture & Infrastructure', 'ccg-wp-theme' ),
		'COMPUTING & DEVOPS'                                    => __( 'Computing & DevOps', 'ccg-wp-theme' ),
		'MONITORING'                                            => __( 'Monitoring', 'ccg-wp-theme' ),
		'NETWORKING & SECURITY'                                 => __( 'Networking & Security', 'ccg-wp-theme' ),
		'CLOUD PLATFORM'                                        => __( 'Cloud Platforms', 'ccg-wp-theme' ),
		'AGILE TOOLS'                                           => __( 'Agile Tools', 'ccg-wp-theme' ),
		'HYBRID CLOUD HOSTING SERVICES SELF-PACED LEARNING'     => __( 'Self-paced Learning', 'ccg-wp-theme' ),
		'HYBRID CLOUD PROGRAM SESSIONS'                         => __( 'Program Sessions', 'ccg-wp-theme' ),
		'FINANCIAL OPERATIONS'                                  => __( 'Financial Operations', 'ccg-wp-theme' ),
		'COST TOOLS'                                            => __( 'Cost Tools', 'ccg-wp-theme' ),
		'CLOUD CONSUMPTION'                                     => __( 'Cloud Consumption', 'ccg-wp-theme' ),
	);
	$view_labels = array(
		'knowledge-center'    => __( 'View all documentation', 'ccg-wp-theme' ),
		'training-enablement' => __( 'View all training', 'ccg-wp-theme' ),
		'resource-center'     => __( 'View all resources', 'ccg-wp-theme' ),
		'customer-roadmap'    => __( 'View roadmap', 'ccg-wp-theme' ),
	);
	?>
	<div class="fusion-nav-v2__overview fusion-nav-v2__overview--learn">
		<div class="fusion-nav-v2__overview-main fusion-nav-v2__learn-main">
			<header class="fusion-nav-v2__overview-header">
				<h2 class="fusion-nav-v2__overview-title">
					<a href="<?php echo esc_url( $menu_item['href'] ); ?>">
						<?php echo esc_html( $menu_item['label'] ); ?>
						<?php ccg_mega_nav_render_link_indicator(); ?>
					</a>
				</h2>
				<p><?php echo esc_html( $copy['description'] ); ?></p>
			</header>

			<div class="fusion-nav-v2__learn-grid" aria-label="<?php esc_attr_e( 'Learn categories', 'ccg-wp-theme' ); ?>">
				<?php foreach ( $menu_item['categories'] as $category ) : ?>
					<?php
					$category_href = ! empty( $category['href'] ) ? $category['href'] : $menu_item['href'];
					$groups        = 'columns' === ( $category['panel']['type'] ?? '' ) ? $category['panel']['columns'] : array();
					?>
				<section class="fusion-nav-v2__learn-category fusion-nav-v2__learn-category--<?php echo esc_attr( $category['id'] ); ?>">
					<div class="fusion-nav-v2__learn-category-heading">
						<h3>
							<a href="<?php echo esc_url( $category_href ); ?>">
								<?php echo esc_html( $category['label'] ); ?>
								<?php ccg_mega_nav_render_link_indicator(); ?>
							</a>
						</h3>
					</div>
					<span class="fusion-nav-v2__learn-accent" aria-hidden="true"></span>
					<?php if ( $groups ) : ?>
					<ul class="fusion-nav-v2__learn-group-list">
						<?php foreach ( $groups as $group ) : ?>
						<li>
							<a href="<?php echo esc_url( $category_href . '#' . sanitize_title( $group['title'] ) ); ?>">
								<?php echo esc_html( $group_labels[ $group['title'] ] ?? $group['title'] ); ?>
								<span aria-hidden="true">›</span>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					<a class="fusion-nav-v2__learn-view-all" href="<?php echo esc_url( $category_href ); ?>">
						<?php echo esc_html( $view_labels[ $category['id'] ] ?? __( 'View all', 'ccg-wp-theme' ) ); ?>
						<span aria-hidden="true">→</span>
					</a>
				</section>
				<?php endforeach; ?>
			</div>
		</div>
		<?php ccg_mega_nav_render_overview_footer( $copy ); ?>
	</div>
	<?php
}

/**
 * Output full site header (skip link + mega nav).
 */
function ccg_render_mega_nav_header() {
	$items         = ccg_get_nav_menu_items();
	$overview_copy = ccg_mega_nav_overview_copy();
	$logo_url      = ccg_wp_theme_asset_url( 'assets/images/cloud-fusion-logo.png' );
	$home          = home_url( '/' );
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
						alt="<?php esc_attr_e( 'Cloud Fusion', 'ccg-wp-theme' ); ?>"
						width="282"
						height="40"
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
						<div class="fusion-nav-v2__mega-inner fusion-nav-v2__mega-inner--overview">
							<?php
							if ( 'learn' === $item['id'] ) {
								ccg_mega_nav_render_learn_overview( $item, $overview_copy['learn'] );
							} else {
								ccg_mega_nav_render_overview( $item, $overview_copy[ $item['id'] ] );
							}
							?>
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
