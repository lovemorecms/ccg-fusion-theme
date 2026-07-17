<?php
/**
 * Shared Services data and page-content helpers.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load and cache the Shared Services export.
 *
 * @return array<string, mixed>
 */
function ccg_shared_services_data() {
	static $data = null;

	if ( null !== $data ) {
		return $data;
	}

	$data = array();
	$path = __DIR__ . '/shared-services.json';

	if ( ! is_readable( $path ) ) {
		return $data;
	}

	$json = file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( false === $json ) {
		return $data;
	}

	$decoded = json_decode( $json, true );
	if ( JSON_ERROR_NONE === json_last_error() && is_array( $decoded ) ) {
		$data = $decoded;
	}

	return $data;
}

/**
 * Return the catalog categories.
 *
 * @return array<int, array<string, mixed>>
 */
function ccg_shared_services_categories() {
	$data = ccg_shared_services_data();
	return isset( $data['categories'] ) && is_array( $data['categories'] ) ? $data['categories'] : array();
}

/**
 * Find a Shared Service article by slug.
 *
 * @param string $slug Article slug.
 * @return array<string, mixed>|null
 */
function ccg_shared_service_article_by_slug( $slug ) {
	$slug     = sanitize_title( (string) $slug );
	$data     = ccg_shared_services_data();
	$articles = isset( $data['articles'] ) && is_array( $data['articles'] ) ? $data['articles'] : array();

	foreach ( $articles as $article ) {
		if ( is_array( $article ) && ! empty( $article['slug'] ) && $slug === sanitize_title( (string) $article['slug'] ) ) {
			return $article;
		}
	}

	return null;
}

/**
 * Render a breadcrumb separator.
 */
function ccg_shared_services_breadcrumb_separator() {
	echo '<li aria-hidden="true" class="kc-breadcrumb-sep"><svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></li>';
}

/**
 * Map a Shared Services image path to the theme assets directory.
 *
 * @param string $path Exported image path.
 * @return string
 */
function ccg_shared_services_image_url( $path ) {
	$relative = ltrim( (string) $path, '/' );
	if ( '' === $relative ) {
		return '';
	}
	if ( 0 !== strpos( $relative, 'assets/' ) ) {
		$relative = 'assets/' . $relative;
	}
	return ccg_wp_theme_asset_url( $relative );
}

/**
 * Resolve a Shared Services link destination.
 *
 * @param string $href Link destination.
 * @return string
 */
function ccg_shared_services_link_url( $href ) {
	$href = trim( (string) $href );
	if ( '' === $href || 0 !== strpos( $href, '/' ) ) {
		return '#';
	}
	return home_url( $href );
}

/**
 * Build Gutenberg block markup for the Shared Services catalog.
 *
 * @return string
 */
function ccg_shared_services_landing_page_content() {
	$data       = ccg_shared_services_data();
	$hero       = isset( $data['hero'] ) && is_array( $data['hero'] ) ? $data['hero'] : array();
	$categories = ccg_shared_services_categories();
	$total      = isset( $data['totalCount'] ) ? absint( $data['totalCount'] ) : 0;
	$nav_items  = array();

	if ( 0 === $total ) {
		foreach ( $categories as $category ) {
			if ( is_array( $category ) && ! empty( $category['services'] ) && is_array( $category['services'] ) ) {
				$total += count( $category['services'] );
			}
		}
	}

	foreach ( $categories as $category ) {
		if ( is_array( $category ) && ! empty( $category['id'] ) && ! empty( $category['label'] ) ) {
			$category_id = sanitize_title( (string) $category['id'] );
			ob_start();
			ccg_shared_services_category_icon( $category_id );
			$nav_items[] = array(
				'id'        => $category_id,
				'label'     => 'finops' === $category_id ? __( 'Financial Operations', 'ccg-wp-theme' ) : (string) $category['label'],
				'icon_html' => ob_get_clean(),
			);
		}
	}

	ob_start();
	?>
<!-- wp:group {"align":"full","className":"ss-page","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull ss-page">
<!-- wp:html -->
<div class="ss-hero-band">
	<div class="kc-breadcrumb-bar ss-breadcrumb-bar">
		<nav aria-label="<?php echo esc_attr__( 'Breadcrumb', 'ccg-wp-theme' ); ?>" class="kc-breadcrumb-inner">
			<ol class="kc-breadcrumb-list">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a></li>
				<?php ccg_shared_services_breadcrumb_separator(); ?>
				<li><a href="<?php echo esc_url( home_url( '/explore/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Explore', 'ccg-wp-theme' ); ?></a></li>
				<?php ccg_shared_services_breadcrumb_separator(); ?>
				<li><span class="kc-breadcrumb-current"><?php esc_html_e( 'Shared Services', 'ccg-wp-theme' ); ?></span></li>
			</ol>
		</nav>
	</div>
	<section id="overview" class="ss-hero kc-hero ss-hero--with-section-nav" aria-labelledby="ss-hero-title" tabindex="-1">
	<div class="kc-hero__inner">
		<h1 id="ss-hero-title" class="kc-hero__title"><?php echo esc_html( isset( $hero['title'] ) ? (string) $hero['title'] : __( 'Shared Services', 'ccg-wp-theme' ) ); ?></h1>
		<p class="kc-hero__description"><?php echo esc_html( isset( $hero['description'] ) ? (string) $hero['description'] : '' ); ?></p>
		<form class="kc-hero__search ss-hero__search" role="search" data-ss-search>
			<label class="sr-only" for="ss-search-input"><?php esc_html_e( 'Search shared services', 'ccg-wp-theme' ); ?></label>
			<div class="kc-hero__search-field">
				<svg class="kc-hero__search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M19 19l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
				<input id="ss-search-input" class="kc-hero__search-input" type="search" name="ss-q" placeholder="<?php echo esc_attr( isset( $hero['searchPlaceholder'] ) ? (string) $hero['searchPlaceholder'] : __( 'Search shared services', 'ccg-wp-theme' ) ); ?>" autocomplete="off" data-ss-search-input />
				<button class="kc-hero__search-clear" type="button" data-ss-search-clear hidden><?php esc_html_e( 'Clear', 'ccg-wp-theme' ); ?></button>
			</div>
		</form>
		<div class="kc-hero__stats" aria-label="<?php esc_attr_e( 'Shared Services catalog totals', 'ccg-wp-theme' ); ?>">
			<div class="kc-hero__stat"><span class="kc-hero__stat-number"><?php echo esc_html( $total ); ?></span><span class="kc-hero__stat-label"><?php esc_html_e( 'Services', 'ccg-wp-theme' ); ?></span></div>
			<div class="kc-hero__stat"><span class="kc-hero__stat-number"><?php echo esc_html( count( $categories ) ); ?></span><span class="kc-hero__stat-label"><?php esc_html_e( 'Categories', 'ccg-wp-theme' ); ?></span></div>
		</div>
	</div>
</section>
</div>
<!-- /wp:html -->

<!-- wp:html -->
<?php
	ccg_render_interior_section_nav(
		$nav_items,
		array(
			'aria_label' => __( 'Shared Services categories', 'ccg-wp-theme' ),
			'variant'    => 'icon',
			'manual_active' => true,
		)
	);
?>
<!-- /wp:html -->

<!-- wp:html -->
<section class="ss-content" aria-labelledby="ss-catalog-heading">
	<div class="ss-content__glow ss-content__glow--one" aria-hidden="true"></div>
	<div class="ss-content__glow ss-content__glow--two" aria-hidden="true"></div>
	<div class="ss-container">
		<header class="ss-section__header">
			<h2 id="ss-catalog-heading" class="ss-section__title"><?php esc_html_e( 'Explore by category', 'ccg-wp-theme' ); ?></h2>
			<p class="ss-section__meta" data-ss-results-status aria-live="polite"><?php esc_html_e( 'Expand a category to browse available services across CMS Cloud Fusion.', 'ccg-wp-theme' ); ?></p>
		</header>
		<div class="ss-acc-list">
			<?php foreach ( $categories as $category_index => $category ) : ?>
				<?php
				if ( ! is_array( $category ) || empty( $category['id'] ) ) {
					continue;
				}

				$category_id    = sanitize_title( (string) $category['id'] );
				$category_label = isset( $category['label'] ) ? (string) $category['label'] : '';
				$services       = isset( $category['services'] ) && is_array( $category['services'] ) ? $category['services'] : array();
				$service_count  = count( $services );
				$is_open        = false;
				$panel_id       = 'ss-panel-' . $category_id;
				$button_id      = 'ss-button-' . $category_id;
				?>
			<section
				id="<?php echo esc_attr( $category_id ); ?>"
				class="ss-acc<?php echo $is_open ? ' ss-acc--open' : ''; ?>"
				data-ss-category
				data-category-title="<?php echo esc_attr( $category_label ); ?>"
				data-category-description="<?php echo esc_attr( isset( $category['description'] ) ? (string) $category['description'] : '' ); ?>"
				aria-labelledby="<?php echo esc_attr( $button_id ); ?>"
				tabindex="-1"
			>
				<h2 class="ss-acc__heading">
					<button
						class="ss-acc__trigger"
						type="button"
						id="<?php echo esc_attr( $button_id ); ?>"
						aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
						aria-controls="<?php echo esc_attr( $panel_id ); ?>"
						data-ss-accordion-trigger
					>
						<span class="ss-acc__icon" aria-hidden="true"><?php ccg_shared_services_category_icon( $category_id ); ?></span>
						<span class="ss-acc__copy">
							<span class="ss-acc__title-row">
								<span class="ss-acc__title"><?php echo esc_html( $category_label ); ?></span>
								<span class="ss-acc__count"><?php echo esc_html( sprintf( _n( '%d service', '%d services', $service_count, 'ccg-wp-theme' ), $service_count ) ); ?></span>
							</span>
							<span class="ss-acc__description"><?php echo esc_html( isset( $category['description'] ) ? (string) $category['description'] : '' ); ?></span>
						</span>
						<span class="ss-acc__chevron-wrap<?php echo $is_open ? ' ss-acc__chevron-wrap--open' : ''; ?>" aria-hidden="true">
							<svg class="ss-acc__chevron<?php echo $is_open ? ' ss-acc__chevron--open' : ''; ?>" width="18" height="18" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M4 6l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</span>
					</button>
				</h2>
				<div
					id="<?php echo esc_attr( $panel_id ); ?>"
					class="ss-acc__panel"
					role="region"
					aria-labelledby="<?php echo esc_attr( $button_id ); ?>"
					<?php echo $is_open ? '' : ' hidden'; ?>
				>
					<div class="ss-service-grid">
						<?php foreach ( $services as $service ) : ?>
							<?php
							if ( ! is_array( $service ) ) {
								continue;
							}

							$service_id  = isset( $service['id'] ) ? sanitize_title( (string) $service['id'] ) : '';
							$title       = isset( $service['title'] ) ? (string) $service['title'] : '';
							$description = isset( $service['description'] ) ? (string) $service['description'] : '';
							$tag         = isset( $service['tag'] ) ? (string) $service['tag'] : '';
							$href        = ! empty( $service['href'] ) ? ccg_shared_services_link_url( (string) $service['href'] ) : '#';
							$title_id    = $service_id ? 'ss-service-' . $service_id : '';
							?>
						<article
							class="ss-service-card"
							<?php echo $title_id ? 'aria-labelledby="' . esc_attr( $title_id ) . '"' : ''; ?>
							data-ss-service
							data-title="<?php echo esc_attr( $title ); ?>"
							data-description="<?php echo esc_attr( $description ); ?>"
							data-tag="<?php echo esc_attr( $tag ); ?>"
							data-category="<?php echo esc_attr( $category_id ); ?>"
						>
							<div class="ss-service-card__top">
								<span class="ss-service-card__icon" aria-hidden="true"><?php ccg_shared_services_category_icon( $category_id ); ?></span>
							</div>
							<h4 <?php echo $title_id ? 'id="' . esc_attr( $title_id ) . '"' : ''; ?> class="ss-service-card__title"><?php echo esc_html( $title ); ?></h4>
							<p class="ss-service-card__body"><?php echo esc_html( $description ); ?></p>
							<a class="ds-c-button ds-c-button--ghost ss-service-card__cta" href="<?php echo esc_url( $href ); ?>">
								<?php esc_html_e( 'Learn more', 'ccg-wp-theme' ); ?>
								<svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</a>
						</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
	<?php

	return trim( ob_get_clean() );
}

/**
 * Build Gutenberg block markup for a Shared Service article.
 *
 * @param string $slug Article slug.
 * @return string
 */
function ccg_shared_service_article_page_content( $slug ) {
	$article = ccg_shared_service_article_by_slug( $slug );
	if ( null === $article ) {
		return '';
	}

	$data           = ccg_shared_services_data();
	$section_hero   = isset( $data['sectionHero'] ) && is_array( $data['sectionHero'] ) ? $data['sectionHero'] : array();
	$title          = isset( $article['title'] ) ? (string) $article['title'] : '';
	$category_id    = isset( $article['categoryId'] ) ? sanitize_title( (string) $article['categoryId'] ) : '';
	$category_label = isset( $article['categoryLabel'] ) ? (string) $article['categoryLabel'] : '';
	$status         = isset( $article['status'] ) ? (string) $article['status'] : '';
	$metadata       = isset( $article['metadata'] ) && is_array( $article['metadata'] ) ? $article['metadata'] : array();
	$sections       = isset( $article['sections'] ) && is_array( $article['sections'] ) ? $article['sections'] : array();
	$cloud_name     = ! empty( $metadata['cloud'] ) ? (string) $metadata['cloud'] : ( $title ? $title : __( 'this shared service', 'ccg-wp-theme' ) );
	$intro          = ! empty( $article['introParagraphs'] ) && is_array( $article['introParagraphs'] )
		? $article['introParagraphs']
		: array( isset( $article['heroSummary'] ) ? (string) $article['heroSummary'] : '' );
	$hero_image     = ! empty( $article['heroImageSrc'] )
		? (string) $article['heroImageSrc']
		: ( isset( $section_hero['imageSrc'] ) ? (string) $section_hero['imageSrc'] : '' );
	$hero_alt       = ! empty( $article['heroImageAlt'] )
		? (string) $article['heroImageAlt']
		: ( isset( $section_hero['imageAlt'] ) ? (string) $section_hero['imageAlt'] : '' );
	$hero_image_url = ccg_shared_services_image_url( $hero_image );
	$has_visual     = '' !== $hero_image_url;
	$nav_items      = array();

	foreach ( $sections as $section ) {
		if ( is_array( $section ) && ! empty( $section['id'] ) && ! empty( $section['navLabel'] ) ) {
			$nav_items[] = array(
				'id'    => sanitize_title( (string) $section['id'] ),
				'label' => (string) $section['navLabel'],
			);
		}
	}

	ob_start();
	?>
<!-- wp:group {"align":"full","className":"pa-page shared-service-article-page","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pa-page shared-service-article-page">
<!-- wp:html -->
<div class="pa-hero-band">
	<div class="kc-breadcrumb-bar kc-breadcrumb-bar--initiatives ss-breadcrumb-bar">
		<nav aria-label="<?php echo esc_attr__( 'Breadcrumb', 'ccg-wp-theme' ); ?>" class="kc-breadcrumb-inner">
			<ol class="kc-breadcrumb-list">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a></li>
				<?php ccg_shared_services_breadcrumb_separator(); ?>
				<li><a href="<?php echo esc_url( home_url( '/explore/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Explore', 'ccg-wp-theme' ); ?></a></li>
				<?php ccg_shared_services_breadcrumb_separator(); ?>
				<li><a href="<?php echo esc_url( home_url( '/explore/shared-services/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Shared Services', 'ccg-wp-theme' ); ?></a></li>
				<?php if ( $category_label ) : ?>
				<?php ccg_shared_services_breadcrumb_separator(); ?>
				<li><a href="<?php echo esc_url( home_url( '/explore/shared-services/#' . $category_id ) ); ?>" class="kc-breadcrumb-link"><?php echo esc_html( $category_label ); ?></a></li>
				<?php endif; ?>
				<?php ccg_shared_services_breadcrumb_separator(); ?>
				<li><span class="kc-breadcrumb-current"><?php echo esc_html( $title ); ?></span></li>
			</ol>
		</nav>
	</div>
	<section id="overview" class="init-hero init-hero--with-section-nav pa-hero<?php echo $has_visual ? ' pa-hero--visual' : ''; ?>" aria-labelledby="pa-hero-title" tabindex="-1">
		<div class="init-hero__inner pa-hero__inner">
			<div class="init-hero__text pa-hero__text">
				<div class="pa-hero__title-row">
					<p id="pa-hero-title" class="init-hero__heading pa-hero__title"><?php echo esc_html( isset( $section_hero['title'] ) ? (string) $section_hero['title'] : __( 'Shared Services', 'ccg-wp-theme' ) ); ?></p>
				</div>
				<p class="init-hero__description pa-hero__summary"><?php echo esc_html( isset( $section_hero['summary'] ) ? (string) $section_hero['summary'] : '' ); ?></p>
			</div>
			<?php if ( $has_visual ) : ?>
			<div class="pa-hero__visual">
				<img src="<?php echo esc_url( $hero_image_url ); ?>" alt="<?php echo esc_attr( $hero_alt ); ?>" class="pa-hero__visual-img" decoding="async" fetchpriority="high" />
			</div>
			<?php endif; ?>
		</div>
	</section>
</div>
<!-- /wp:html -->

<!-- wp:html -->
<?php
	ccg_render_interior_section_nav(
		$nav_items,
		array(
			'aria_label' => sprintf(
				/* translators: %s: article title. */
				__( '%s page sections', 'ccg-wp-theme' ),
				$title
			),
		)
	);
?>
<!-- /wp:html -->

<!-- wp:html -->
<article class="pa-article" aria-labelledby="pa-article-title">
	<div class="pa-article__inner">
		<header class="pa-article__header">
			<div class="pa-article__title-row">
				<h1 id="pa-article-title" class="pa-article__h1"><?php echo esc_html( $title ); ?></h1>
				<?php if ( '' !== $status ) : ?>
				<span class="pa-article__badge"><?php echo esc_html( $status ); ?></span>
				<?php endif; ?>
			</div>
			<div class="pa-article__intro">
				<?php foreach ( $intro as $paragraph ) : ?>
					<?php if ( '' !== trim( (string) $paragraph ) ) : ?>
				<p><?php echo esc_html( (string) $paragraph ); ?></p>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<dl class="pa-article__meta">
				<div class="pa-article__meta-item">
					<dt><?php esc_html_e( 'Updated', 'ccg-wp-theme' ); ?></dt>
					<dd><?php echo esc_html( isset( $metadata['updated'] ) ? (string) $metadata['updated'] : '' ); ?></dd>
				</div>
				<div class="pa-article__meta-item">
					<dt><?php esc_html_e( 'Reading time', 'ccg-wp-theme' ); ?></dt>
					<dd><?php echo esc_html( isset( $metadata['readingTime'] ) ? (string) $metadata['readingTime'] : '' ); ?></dd>
				</div>
			</dl>
		</header>

		<?php foreach ( $sections as $section ) : ?>
			<?php if ( is_array( $section ) ) : ?>
				<?php ccg_platform_article_render_section( $section ); ?>
			<?php endif; ?>
		<?php endforeach; ?>

		<p class="pa-article__updated"><?php esc_html_e( 'Last updated:', 'ccg-wp-theme' ); ?> <?php echo esc_html( isset( $article['lastUpdated'] ) ? (string) $article['lastUpdated'] : '' ); ?></p>
	</div>
</article>
<!-- /wp:html -->

<!-- wp:html -->
<section class="pa-cta-band" aria-labelledby="ss-cta-band-heading">
	<div class="pa-cta-band__inner">
		<h2 id="ss-cta-band-heading" class="sr-only"><?php esc_html_e( 'Next steps', 'ccg-wp-theme' ); ?></h2>
		<div class="pa-cta-band__grid">
			<article class="pa-cta-card">
				<span class="pa-cta-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M7 18h9.5a3.5 3.5 0 0 0 .2-7A4.8 4.8 0 0 0 7.4 8.5 3.5 3.5 0 0 0 7 18Z" stroke="currentColor" stroke-width="1.5"/></svg></span>
				<h3 class="pa-cta-card__title"><?php esc_html_e( 'Request shared services support', 'ccg-wp-theme' ); ?></h3>
				<p class="pa-cta-card__body"><?php echo esc_html( sprintf( __( 'Get help onboarding to %s and coordinating the right support path.', 'ccg-wp-theme' ), $cloud_name ) ); ?></p>
				<a href="<?php echo esc_url( home_url( '/explore/#getting-started' ) ); ?>" class="ds-c-button ds-c-button--solid ccg-btn-accent pa-cta-card__btn"><?php esc_html_e( 'Request support', 'ccg-wp-theme' ); ?></a>
			</article>

			<article class="pa-cta-card">
				<span class="pa-cta-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><rect x="4" y="5" width="16" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M8 9h8M8 12h8M8 15h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
				<h3 class="pa-cta-card__title"><?php esc_html_e( 'Want updates?', 'ccg-wp-theme' ); ?></h3>
				<p class="pa-cta-card__body"><?php esc_html_e( 'Follow shared service announcements, availability changes, and guidance.', 'ccg-wp-theme' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/explore/#whats-happening' ) ); ?>" class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark pa-cta-card__btn pa-cta-card__btn--link"><?php esc_html_e( 'Go to News', 'ccg-wp-theme' ); ?></a>
			</article>

			<article class="pa-cta-card">
				<span class="pa-cta-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M5 10v4a2 2 0 0 0 2 2h1v3l3.5-3H17a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg></span>
				<h3 class="pa-cta-card__title"><?php esc_html_e( 'Have questions?', 'ccg-wp-theme' ); ?></h3>
				<p class="pa-cta-card__body"><?php esc_html_e( 'Connect with the Customer Support Team for shared services guidance.', 'ccg-wp-theme' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/explore/#learn-connect' ) ); ?>" class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark pa-cta-card__btn pa-cta-card__btn--link"><?php esc_html_e( 'Contact us', 'ccg-wp-theme' ); ?></a>
			</article>
		</div>
	</div>
</section>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
	<?php

	return trim( ob_get_clean() );
}
