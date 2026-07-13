<?php
/**
 * Fusion Toolkit page helpers.
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render markup from a theme pattern file (block comments preserved).
 *
 * @param string $pattern_file Basename under patterns/.
 */
function ccg_fusion_toolkit_render_pattern_file( $pattern_file ) {
	$path = get_template_directory() . '/patterns/' . ltrim( $pattern_file, '/' );
	if ( ! file_exists( $path ) ) {
		return '';
	}
	ob_start();
	include $path;
	return trim( ob_get_clean() );
}

/**
 * Block markup for the full Fusion Toolkit page body.
 */
function ccg_fusion_toolkit_page_content() {
	$sections = array(
		'fusion-toolkit-breadcrumbs.php',
		'fusion-toolkit-hero.php',
		'fusion-toolkit-sticky-nav.php',
		'fusion-toolkit-product-grid.php',
		'fusion-toolkit-product-basecamp.php',
		'fusion-toolkit-product-helix.php',
		'fusion-toolkit-product-lens.php',
		'fusion-toolkit-product-match.php',
		'fusion-toolkit-footer-band.php',
	);
	$parts    = array();
	foreach ( $sections as $file ) {
		$markup = ccg_fusion_toolkit_render_pattern_file( $file );
		if ( $markup ) {
			$parts[] = $markup;
		}
	}
	$inner = implode( "\n\n", $parts );
	return $inner;
}

/**
 * Inline SVG icon for a toolkit product.
 *
 * @param string $id    basecamp|helix|lens|match.
 * @param string $class Optional class attribute value.
 */
function ccg_fusion_toolkit_icon( $id, $class = '' ) {
	$attr  = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	$icons = array(
		'basecamp' => '<svg' . $attr . ' width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true" focusable="false"><path d="M4 22V10l10-6 10 6v12H4Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/><path d="M14 4v18M4 10h20" stroke="currentColor" stroke-width="1.75"/></svg>',
		'helix'    => '<svg' . $attr . ' width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true" focusable="false"><path d="M8 20c6-8 6-12 12-12M8 8c6 8 6 12 12 12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/><circle cx="8" cy="8" r="2.25" fill="currentColor"/><circle cx="20" cy="20" r="2.25" fill="currentColor"/></svg>',
		'lens'     => '<svg' . $attr . ' width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true" focusable="false"><circle cx="14" cy="14" r="8" stroke="currentColor" stroke-width="1.75"/><circle cx="14" cy="14" r="3" fill="currentColor"/><path d="M20 8l4-4M8 20l-4 4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>',
		'match'    => '<svg' . $attr . ' width="28" height="28" viewBox="0 0 28 28" fill="none" aria-hidden="true" focusable="false"><circle cx="7" cy="14" r="3" stroke="currentColor" stroke-width="1.75"/><circle cx="21" cy="7" r="3" stroke="currentColor" stroke-width="1.75"/><circle cx="21" cy="21" r="3" stroke="currentColor" stroke-width="1.75"/><path d="M9.8 12.6 18.2 8.4M9.8 15.4l8.4 4.2" stroke="currentColor" stroke-width="1.75"/></svg>',
	);
	echo isset( $icons[ $id ] ) ? $icons[ $id ] : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Product content (mirrors fusionToolkitContent.ts).
 *
 * @return array<int, array<string, mixed>>
 */
function ccg_fusion_toolkit_products() {
	return array(
		array(
			'id'                 => 'basecamp',
			'name'               => 'BaseCamp',
			'tagline'            => 'Your foundation for innovation',
			'card_description'   => 'A comprehensive platform for managing cloud infrastructure, deployment pipelines, and development environments. BaseCamp provides the solid foundation your teams need to build with confidence.',
			'detail_description' => 'A comprehensive platform for managing cloud infrastructure, deployment pipelines, and development environments. BaseCamp provides the solid foundation your teams need to build with confidence.',
			'features'           => array(
				'Unified infrastructure management',
				'Automated deployment pipelines',
				'Real-time monitoring and alerts',
				'Collaborative workspace',
			),
			'section_variant'    => 'light',
			'image_reverse'      => false,
		),
		array(
			'id'                 => 'helix',
			'name'               => 'Helix',
			'tagline'            => 'Orchestrate complexity with elegance',
			'card_description'   => 'Advanced workflow automation and integration platform that connects your tools, teams, and processes. Helix transforms complex operations into elegant, automated flows.',
			'detail_description' => 'Advanced workflow automation and integration platform that connects your tools, teams, and processes. Helix transforms complex operations into elegant, automated flows.',
			'features'           => array(
				'Visual workflow designer',
				'Pre-built integrations',
				'Event-driven automation',
				'Advanced analytics',
			),
			'section_variant'    => 'blue',
			'image_reverse'      => true,
		),
		array(
			'id'                 => 'lens',
			'name'               => 'Lens',
			'tagline'            => 'See everything, understand instantly',
			'card_description'   => 'Powerful observability and analytics platform that provides deep insights into your systems. Lens gives you crystal-clear visibility across your entire infrastructure.',
			'detail_description' => 'Powerful observability and analytics platform that provides deep insights into your systems. Lens gives you crystal-clear visibility across your entire infrastructure.',
			'features'           => array(
				'Unified dashboards',
				'AI-powered anomaly detection',
				'Custom metrics and logs',
				'Performance optimization',
			),
			'section_variant'    => 'gloss',
			'image_reverse'      => false,
		),
		array(
			'id'                 => 'match',
			'name'               => 'Match',
			'tagline'            => 'Connect the right resources, right now',
			'card_description'   => 'Intelligent resource allocation and optimization platform. Match uses advanced algorithms to pair workloads with optimal infrastructure, maximizing efficiency and reducing costs.',
			'detail_description' => 'Intelligent resource allocation and optimization platform. Match uses advanced algorithms to pair workloads with optimal infrastructure, maximizing efficiency and reducing costs.',
			'features'           => array(
				'Intelligent workload matching',
				'Cost and capacity optimization',
				'Policy-driven placement',
				'FinOps-aligned recommendations',
			),
			'section_variant'    => 'blue',
			'image_reverse'      => true,
		),
	);
}

/**
 * Gutenberg block markup for one toolkit grid card.
 *
 * @param array<string, mixed> $product Product row from ccg_fusion_toolkit_products().
 */
function ccg_fusion_toolkit_render_card_block( $product ) {
	$pid = esc_attr( $product['id'] );
	?>
<!-- wp:group {"tagName":"article","className":"ft-card","layout":{"type":"default"}} -->
<article id="ft-card-<?php echo $pid; ?>" class="wp-block-group ft-card" aria-labelledby="ft-card-title-<?php echo $pid; ?>">
	<!-- wp:html -->
	<div class="ft-card__icon-wrap">
		<?php ccg_fusion_toolkit_icon( $product['id'] ); ?>
	</div>
	<!-- /wp:html -->

	<!-- wp:heading {"level":3,"className":"ft-card__title"} -->
	<h3 id="ft-card-title-<?php echo $pid; ?>" class="wp-block-heading ft-card__title"><?php echo esc_html( $product['name'] ); ?></h3>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"ft-card__tagline"} -->
	<p class="ft-card__tagline"><?php echo esc_html( $product['tagline'] ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"className":"ft-card__body"} -->
	<p class="ft-card__body"><?php echo esc_html( $product['card_description'] ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"className":"ft-card__link-wrap"} -->
	<p class="ft-card__link-wrap"><a href="#<?php echo $pid; ?>" class="ft-card__link"><?php esc_html_e( 'Learn more', 'ccg-wp-theme' ); ?> →</a></p>
	<!-- /wp:paragraph -->
</article>
<!-- /wp:group -->
	<?php
}

/**
 * wp:list block markup for product feature bullets.
 *
 * @param array<int, string> $features Feature labels.
 */
function ccg_fusion_toolkit_features_list_block( $features ) {
	echo '<!-- wp:list {"className":"ft-features"} -->' . "\n";
	echo '<ul class="wp-block-list ft-features">' . "\n";
	foreach ( $features as $feature ) {
		echo '<!-- wp:list-item -->' . "\n";
		echo '<li>' . esc_html( $feature ) . '</li>' . "\n";
		echo '<!-- /wp:list-item -->' . "\n";
	}
	echo '</ul>' . "\n";
	echo '<!-- /wp:list -->' . "\n";
}

/**
 * Render one product detail section (Gutenberg block markup).
 *
 * @param string $product_id basecamp|helix|lens|match.
 */
function ccg_fusion_toolkit_render_product_section( $product_id ) {
	$product = null;
	foreach ( ccg_fusion_toolkit_products() as $item ) {
		if ( $item['id'] === $product_id ) {
			$product = $item;
			break;
		}
	}
	if ( ! $product ) {
		return;
	}

	$variant = esc_attr( $product['section_variant'] );
	$reverse = ! empty( $product['image_reverse'] ) ? ' ft-section--reverse' : '';
	$kc_url  = esc_url( ccg_nav_url( '/learn/knowledge-center' ) );
	$pid     = esc_attr( $product['id'] );
	$name    = esc_html( $product['name'] );
	?>
<!-- wp:group {"tagName":"section","align":"full","className":"ft-section ft-section--product ft-section--<?php echo $variant; ?><?php echo esc_attr( $reverse ); ?> ccg-fusion-toolkit-sections","anchor":"<?php echo $pid; ?>"} -->
<section id="<?php echo $pid; ?>" class="wp-block-group alignfull ft-section ft-section--product ft-section--<?php echo $variant; ?><?php echo esc_attr( $reverse ); ?> ccg-fusion-toolkit-sections" aria-labelledby="ft-product-<?php echo $pid; ?>" tabindex="-1">
	<!-- wp:group {"className":"ft-container ft-product","layout":{"type":"default"}} -->
	<div class="wp-block-group ft-container ft-product">
		<!-- wp:group {"className":"ft-product__copy","layout":{"type":"default"}} -->
		<div class="wp-block-group ft-product__copy">
			<!-- wp:html -->
			<div class="ft-card__icon-wrap ft-card__icon-wrap--lg">
				<?php ccg_fusion_toolkit_icon( $product['id'] ); ?>
			</div>
			<!-- /wp:html -->

			<!-- wp:heading {"level":2,"className":"ft-product__title"} -->
			<h2 id="ft-product-<?php echo $pid; ?>" class="wp-block-heading ft-product__title"><?php echo $name; ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"ft-product__tagline"} -->
			<p class="ft-product__tagline"><?php echo esc_html( $product['tagline'] ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"ft-product__body"} -->
			<p class="ft-product__body"><?php echo esc_html( $product['detail_description'] ); ?></p>
			<!-- /wp:paragraph -->

			<?php ccg_fusion_toolkit_features_list_block( $product['features'] ); ?>

			<!-- wp:html -->
			<div class="ft-product__actions">
				<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="<?php echo $kc_url; ?>"><?php echo esc_html( 'Get Started with ' . $product['name'] ); ?></a>
				<a class="ds-c-button ds-c-button--ghost ft-btn-secondary" href="<?php echo $kc_url; ?>"><?php esc_html_e( 'Documentation', 'ccg-wp-theme' ); ?></a>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"ft-product-viz","layout":{"type":"default"}} -->
		<div class="wp-block-group ft-product-viz">
			<!-- wp:group {"className":"ft-product-viz__frame","layout":{"type":"default"}} -->
			<div class="wp-block-group ft-product-viz__frame">
				<!-- wp:html -->
				<?php ccg_fusion_toolkit_icon( $product['id'], 'ft-product-viz__icon' ); ?>
				<!-- /wp:html -->

				<!-- wp:paragraph {"className":"ft-product-viz__label"} -->
				<p class="ft-product-viz__label"><?php esc_html_e( 'Product visualization', 'ccg-wp-theme' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
	<?php
}
