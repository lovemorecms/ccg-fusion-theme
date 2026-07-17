<?php
/**
 * Platform article data and page-content helpers.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the platform article data.
 *
 * @return array<string, mixed>
 */
function ccg_platform_articles_data() {
	static $data = null;

	if ( null !== $data ) {
		return $data;
	}

	$data = array();
	$path = __DIR__ . '/platform-articles.json';

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
 * Find a platform article by slug.
 *
 * @param string $slug Article slug.
 * @return array<string, mixed>|null
 */
function ccg_platform_article_by_slug( $slug ) {
	$slug     = sanitize_title( (string) $slug );
	$data     = ccg_platform_articles_data();
	$articles = isset( $data['articles'] ) && is_array( $data['articles'] ) ? $data['articles'] : array();

	foreach ( $articles as $article ) {
		if ( is_array( $article ) && isset( $article['slug'] ) && $slug === sanitize_title( (string) $article['slug'] ) ) {
			return $article;
		}
	}

	return null;
}

/**
 * Get all configured platform article slugs.
 *
 * @return array<int, string>
 */
function ccg_platform_article_slugs() {
	$data     = ccg_platform_articles_data();
	$articles = isset( $data['articles'] ) && is_array( $data['articles'] ) ? $data['articles'] : array();
	$slugs    = array();

	foreach ( $articles as $article ) {
		if ( is_array( $article ) && ! empty( $article['slug'] ) ) {
			$slugs[] = sanitize_title( (string) $article['slug'] );
		}
	}

	return $slugs;
}

/**
 * Get a slug-to-title map for platform article setup tasks.
 *
 * @return array<string, string>
 */
function ccg_platform_articles_titles() {
	$data     = ccg_platform_articles_data();
	$articles = isset( $data['articles'] ) && is_array( $data['articles'] ) ? $data['articles'] : array();
	$titles   = array();

	foreach ( $articles as $article ) {
		if ( ! is_array( $article ) || empty( $article['slug'] ) || empty( $article['title'] ) ) {
			continue;
		}

		$titles[ sanitize_title( (string) $article['slug'] ) ] = (string) $article['title'];
	}

	return $titles;
}

/**
 * Get the shared platform section hero, with its image mapped to theme assets.
 *
 * @return array<string, mixed>
 */
function ccg_platform_section_hero() {
	$data = ccg_platform_articles_data();
	$hero = isset( $data['sectionHero'] ) && is_array( $data['sectionHero'] ) ? $data['sectionHero'] : array();

	if ( ! empty( $hero['imageSrc'] ) ) {
		$relative = ltrim( (string) $hero['imageSrc'], '/' );
		if ( 0 !== strpos( $relative, 'assets/' ) ) {
			$relative = 'assets/' . $relative;
		}
		$hero['imageSrc'] = ccg_wp_theme_asset_url( $relative );
	}

	return $hero;
}

/**
 * Resolve links from exported React content.
 *
 * @param string $href Link destination.
 * @return string
 */
function ccg_platform_article_link_url( $href ) {
	$href = trim( (string) $href );
	return 0 === strpos( $href, '/' ) ? home_url( $href ) : $href;
}

/**
 * Render one platform article content section.
 *
 * @param array<string, mixed> $section Section data.
 */
function ccg_platform_article_render_section( $section ) {
	if ( empty( $section['id'] ) || empty( $section['heading'] ) || empty( $section['type'] ) ) {
		return;
	}

	$id         = sanitize_title( (string) $section['id'] );
	$heading_id = $id . '-heading';
	$type       = (string) $section['type'];
	?>
<section id="<?php echo esc_attr( $id ); ?>" class="pa-article__section" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>" tabindex="-1">
	<h2 id="<?php echo esc_attr( $heading_id ); ?>" class="pa-article__h2"><?php echo esc_html( (string) $section['heading'] ); ?></h2>
	<?php if ( 'leads' === $type ) : ?>
	<div class="pa-article__leads">
		<?php foreach ( isset( $section['items'] ) && is_array( $section['items'] ) ? $section['items'] : array() as $item ) : ?>
			<?php if ( is_array( $item ) && isset( $item['label'], $item['body'] ) ) : ?>
		<p class="pa-article__lead"><strong class="pa-article__lead-label"><?php echo esc_html( (string) $item['label'] ); ?>:</strong> <?php echo esc_html( (string) $item['body'] ); ?></p>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<?php elseif ( 'table' === $type && ! empty( $section['table'] ) && is_array( $section['table'] ) ) : ?>
		<?php
		$table   = $section['table'];
		$headers = isset( $table['headers'] ) && is_array( $table['headers'] ) ? $table['headers'] : array();
		$rows    = isset( $table['rows'] ) && is_array( $table['rows'] ) ? $table['rows'] : array();
		if ( array_key_exists( 'rowHeaderColumn', $table ) ) {
			$row_header_column = (bool) $table['rowHeaderColumn'];
		} else {
			$first_header      = isset( $headers[0] ) ? trim( (string) $headers[0] ) : '';
			$second_header     = isset( $headers[1] ) ? trim( (string) $headers[1] ) : '';
			$row_header_column = 0 === strcasecmp( $first_header, 'Category' )
				|| ( 2 === count( $headers ) && 0 === strcasecmp( $first_header, 'Category' ) && 0 === stripos( $second_header, 'Approved' ) );
		}
		?>
	<div class="pa-table-wrap">
		<?php if ( ! empty( $table['intro'] ) ) : ?>
		<p class="pa-article__p pa-table-wrap__intro"><?php echo esc_html( (string) $table['intro'] ); ?></p>
		<?php endif; ?>
		<div class="pa-table-scroll">
			<table class="pa-table">
				<?php if ( ! empty( $table['caption'] ) ) : ?>
				<caption class="pa-table__caption"><?php echo esc_html( (string) $table['caption'] ); ?></caption>
				<?php endif; ?>
				<thead>
					<tr>
						<?php foreach ( $headers as $header ) : ?>
						<th scope="col"><?php echo esc_html( (string) $header ); ?></th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $rows as $row ) : ?>
						<?php if ( is_array( $row ) ) : ?>
					<tr>
							<?php foreach ( $row as $cell_index => $cell ) : ?>
								<?php if ( $row_header_column && 0 === (int) $cell_index ) : ?>
						<th scope="row"><?php echo esc_html( (string) $cell ); ?></th>
								<?php else : ?>
						<td><?php echo esc_html( (string) $cell ); ?></td>
								<?php endif; ?>
							<?php endforeach; ?>
					</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php elseif ( 'prose' === $type ) : ?>
	<div class="pa-article__prose">
		<?php foreach ( isset( $section['paragraphs'] ) && is_array( $section['paragraphs'] ) ? $section['paragraphs'] : array() as $paragraph ) : ?>
		<p class="pa-article__p"><?php echo esc_html( (string) $paragraph ); ?></p>
		<?php endforeach; ?>
		<?php if ( ! empty( $section['bullets'] ) && is_array( $section['bullets'] ) ) : ?>
		<ul class="pa-article__list">
			<?php foreach ( $section['bullets'] as $bullet ) : ?>
			<li class="pa-article__list-item"><?php echo esc_html( (string) $bullet ); ?></li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
		<?php if ( ! empty( $section['links'] ) && is_array( $section['links'] ) ) : ?>
		<p class="pa-article__p">
			<?php foreach ( $section['links'] as $link_index => $link ) : ?>
				<?php if ( is_array( $link ) && isset( $link['label'], $link['href'] ) ) : ?>
					<?php echo $link_index > 0 ? ' &middot; ' : ''; ?>
					<a href="<?php echo esc_url( ccg_platform_article_link_url( $link['href'] ) ); ?>" class="pa-article__link"><?php echo esc_html( (string) $link['label'] ); ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</p>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</section>
	<?php
}

/**
 * Build Gutenberg block markup for one platform article page body.
 *
 * @param string $slug Article slug.
 * @return string
 */
function ccg_platform_article_page_content( $slug ) {
	$article = ccg_platform_article_by_slug( $slug );
	if ( null === $article ) {
		return '';
	}

	$hero       = ccg_platform_section_hero();
	$title      = isset( $article['title'] ) ? (string) $article['title'] : '';
	$metadata   = isset( $article['metadata'] ) && is_array( $article['metadata'] ) ? $article['metadata'] : array();
	$sections   = isset( $article['sections'] ) && is_array( $article['sections'] ) ? $article['sections'] : array();
	$cloud      = ! empty( $metadata['cloud'] ) ? (string) $metadata['cloud'] : $title;
	$nav_items  = array();
	$intro      = ! empty( $article['introParagraphs'] ) && is_array( $article['introParagraphs'] )
		? $article['introParagraphs']
		: array( isset( $article['heroSummary'] ) ? (string) $article['heroSummary'] : '' );

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
<!-- wp:group {"align":"full","className":"pa-page","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull pa-page">
<!-- wp:html -->
<div class="pa-hero-band">
	<div class="kc-breadcrumb-bar kc-breadcrumb-bar--initiatives">
		<nav aria-label="<?php echo esc_attr__( 'Breadcrumb', 'ccg-wp-theme' ); ?>" class="kc-breadcrumb-inner">
			<ol class="kc-breadcrumb-list">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a></li>
				<li aria-hidden="true" class="kc-breadcrumb-sep"><svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
				<li><a href="<?php echo esc_url( home_url( '/explore/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Explore', 'ccg-wp-theme' ); ?></a></li>
				<li aria-hidden="true" class="kc-breadcrumb-sep"><svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></li>
				<li><span class="kc-breadcrumb-current"><?php echo esc_html( $title ); ?></span></li>
			</ol>
		</nav>
	</div>
	<section id="overview" class="init-hero init-hero--with-section-nav pa-hero pa-hero--background" aria-labelledby="pa-hero-title" tabindex="-1">
		<img src="<?php echo esc_url( isset( $hero['imageSrc'] ) ? $hero['imageSrc'] : '' ); ?>" alt="" class="pa-hero__background" decoding="async" fetchpriority="high" />
		<div class="init-hero__scrim pa-hero__scrim" aria-hidden="true"></div>
		<div class="init-hero__inner pa-hero__inner">
			<div class="init-hero__text pa-hero__text">
				<div class="pa-hero__title-row">
					<p id="pa-hero-title" class="init-hero__heading pa-hero__title"><?php echo esc_html( isset( $hero['title'] ) ? (string) $hero['title'] : '' ); ?></p>
				</div>
				<p class="init-hero__description pa-hero__summary"><?php echo esc_html( isset( $hero['summary'] ) ? (string) $hero['summary'] : '' ); ?></p>
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
			<h1 id="pa-article-title" class="pa-article__h1"><?php echo esc_html( $title ); ?></h1>
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
<section class="pa-cta-band" aria-labelledby="pa-cta-band-heading">
	<div class="pa-cta-band__inner">
		<h2 id="pa-cta-band-heading" class="sr-only"><?php esc_html_e( 'Next steps', 'ccg-wp-theme' ); ?></h2>
		<div class="pa-cta-band__grid">
			<article class="pa-cta-card">
				<span class="pa-cta-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M7 18h9.5a3.5 3.5 0 0 0 .2-7A4.8 4.8 0 0 0 7.4 8.5 3.5 3.5 0 0 0 7 18Z" stroke="currentColor" stroke-width="1.5"/></svg></span>
				<h3 class="pa-cta-card__title"><?php esc_html_e( 'Ready to get started?', 'ccg-wp-theme' ); ?></h3>
				<p class="pa-cta-card__body"><?php echo esc_html( sprintf( __( 'Request access to %s and align your team with CST onboarding milestones.', 'ccg-wp-theme' ), $cloud ) ); ?></p>
				<a href="<?php echo esc_url( home_url( '/explore/#getting-started' ) ); ?>" class="ds-c-button ds-c-button--solid ccg-btn-accent pa-cta-card__btn"><?php echo esc_html( sprintf( __( 'Request to use %s', 'ccg-wp-theme' ), $cloud ) ); ?></a>
			</article>

			<article class="pa-cta-card">
				<span class="pa-cta-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><rect x="4" y="5" width="16" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M8 9h8M8 12h8M8 15h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span>
				<h3 class="pa-cta-card__title"><?php esc_html_e( 'Want updates?', 'ccg-wp-theme' ); ?></h3>
				<p class="pa-cta-card__body"><?php esc_html_e( 'Follow program announcements, roadmap changes, and enablement releases.', 'ccg-wp-theme' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/explore/#whats-happening' ) ); ?>" class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark pa-cta-card__btn pa-cta-card__btn--link"><?php esc_html_e( 'Go to News', 'ccg-wp-theme' ); ?></a>
			</article>

			<article class="pa-cta-card">
				<span class="pa-cta-card__icon" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M5 10v4a2 2 0 0 0 2 2h1v3l3.5-3H17a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg></span>
				<h3 class="pa-cta-card__title"><?php esc_html_e( 'Have questions?', 'ccg-wp-theme' ); ?></h3>
				<p class="pa-cta-card__body"><?php esc_html_e( 'Connect with the Customer Service Team for platform guidance and support paths.', 'ccg-wp-theme' ); ?></p>
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
