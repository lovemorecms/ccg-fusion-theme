<?php
/**
 * About Hybrid Cloud — Benefits + placeholder child-page helpers.
 *
 * Parent must wire (do not skip):
 *   require_once get_template_directory() . '/inc/about/about-hybrid-cloud.php';
 *   wp_enqueue_style( 'ccg-wp-theme-about-hybrid-cloud', …/assets/css/about-hybrid-cloud.css,
 *     array( 'ccg-wp-theme', 'ccg-wp-theme-program-overview', 'ccg-wp-theme-interior-section-nav' ), … );
 *   add_editor_style( 'assets/css/about-hybrid-cloud.css' );
 *   theme.json customTemplates:
 *     page-about-benefits, page-about-section
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * About Hybrid Cloud cross-page nav items (Program Overview, Benefits, …).
 *
 * @return array<int, array{id:string,label:string,href:string}>
 */
function ccg_about_hybrid_cloud_nav_items() {
	return array(
		array(
			'id'    => 'program-overview',
			'label' => __( 'Program Overview', 'ccg-wp-theme' ),
			'href'  => home_url( user_trailingslashit( '/about/program-overview' ) ),
		),
		array(
			'id'    => 'benefits',
			'label' => __( 'Benefits', 'ccg-wp-theme' ),
			'href'  => home_url( user_trailingslashit( '/about/benefits' ) ),
		),
		array(
			'id'    => 'success-stories',
			'label' => __( 'Success Stories', 'ccg-wp-theme' ),
			'href'  => home_url( user_trailingslashit( '/about/success-stories' ) ),
		),
		array(
			'id'    => 'contact-us',
			'label' => __( 'Contact Us', 'ccg-wp-theme' ),
			'href'  => home_url( user_trailingslashit( '/about/contact-us' ) ),
		),
	);
}

/**
 * Shared About Hybrid Cloud hero copy (from aboutHybridCloudHero).
 *
 * @return array{title:string,description:string}
 */
function ccg_about_hybrid_cloud_hero_defaults() {
	return array(
		'title'       => __( 'Why Hybrid Cloud Hosting', 'ccg-wp-theme' ),
		'description' => __(
			"CMS's Hybrid Cloud service provides all the benefits of cloud hosting – secure, scalable, and cost effective – along with the added benefits of regulatory and organizational control of a traditional data center.",
			'ccg-wp-theme'
		),
	);
}

/**
 * Theme image URL under assets/images/sections/benefits/.
 *
 * @param string $filename Filename.
 * @return string Empty string if missing.
 */
function ccg_about_benefits_image_url( $filename ) {
	$relative = 'assets/images/sections/benefits/' . ltrim( $filename, '/' );
	$path     = get_template_directory() . '/' . $relative;
	if ( ! file_exists( $path ) ) {
		return '';
	}
	return ccg_wp_theme_asset_url( $relative );
}

/**
 * Placeholder section copy keyed by slug (mirrors App.tsx routes).
 *
 * @param string $slug Section slug.
 * @return array{title:string,description:string}|null
 */
function ccg_about_hybrid_cloud_placeholder_meta( $slug ) {
	$map = array(
		'success-stories' => array(
			'title'       => __( 'Success Stories', 'ccg-wp-theme' ),
			'description' => __(
				'Explore how teams use CMS Hybrid Cloud services to modernize applications, strengthen operations, and support mission-critical work.',
				'ccg-wp-theme'
			),
		),
		'contact-us'      => array(
			'title'       => __( 'Contact Us', 'ccg-wp-theme' ),
			'description' => __(
				'Connect with the CMS Hybrid Cloud team for guidance on hosting, migration, shared services, and getting started.',
				'ccg-wp-theme'
			),
		),
	);

	return isset( $map[ $slug ] ) ? $map[ $slug ] : null;
}

/**
 * Breadcrumb chevron SVG.
 */
function ccg_about_hybrid_cloud_breadcrumb_chevron() {
	echo '<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/**
 * Arrow icon SVG (inline).
 */
function ccg_about_hybrid_cloud_arrow_icon() {
	echo '<svg viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M4 10h12M12 6l4 4-4 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/**
 * Role icon SVG by type (people | headset | chart).
 *
 * @param string $type Icon type.
 */
function ccg_about_hybrid_cloud_role_icon( $type ) {
	if ( 'headset' === $type ) {
		echo '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 14v-2a8 8 0 0116 0v2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M4 14h3v6H5a1 1 0 01-1-1v-5zM20 14h-3v6h2a1 1 0 001-1v-5z" stroke="currentColor" stroke-width="1.6"/></svg>';
		return;
	}
	if ( 'chart' === $type ) {
		echo '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 20V10M12 20V4M19 20v-7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M3 20h18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>';
		return;
	}
	echo '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="9" cy="8" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 19v-1a5.5 5.5 0 0111 0v1M16 5.5a3 3 0 010 5.8M16.5 14a5 5 0 014 4.5V19" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>';
}

/**
 * Support roles data (Benefits page).
 *
 * @return array<int, array{id:string,shortLabel:string,title:string,focus:string,icon:string,responsibilities:array<int,string>}>
 */
function ccg_about_benefits_support_roles() {
	return array(
		array(
			'id'              => 'hosting-coordinator',
			'shortLabel'      => 'HC',
			'title'           => __( 'Hosting Coordinator', 'ccg-wp-theme' ),
			'focus'           => __( 'Relationship with the CMS Business Owner', 'ccg-wp-theme' ),
			'icon'            => 'people',
			'responsibilities' => array(
				__( 'Maintains ownership of the customer relationship', 'ccg-wp-theme' ),
				__( 'Possesses a high-level understanding of Hybrid Cloud', 'ccg-wp-theme' ),
				__( 'Understands CMS culture, risk, regulation, and customer-team context, including roadmaps and business cycles', 'ccg-wp-theme' ),
				__( 'Manages the relationship with customers throughout their end-to-end journey', 'ccg-wp-theme' ),
			),
		),
		array(
			'id'              => 'technical-advisor',
			'shortLabel'      => 'TA',
			'title'           => __( 'Technical Advisor', 'ccg-wp-theme' ),
			'focus'           => __( 'Guides customers to the appropriate product and service offerings so they can achieve their goals', 'ccg-wp-theme' ),
			'icon'            => 'headset',
			'responsibilities' => array(
				__( 'Serves as the technical point of contact for customers', 'ccg-wp-theme' ),
				__( 'Coordinates between application teams and back-end support teams', 'ccg-wp-theme' ),
				__( 'Provides broad technical knowledge of Hybrid Cloud', 'ccg-wp-theme' ),
				__( 'Provides deep technical knowledge of hosting offerings', 'ccg-wp-theme' ),
				__( 'Operates as a technical thought partner to customers', 'ccg-wp-theme' ),
				__( 'Advises customers on technical optimization', 'ccg-wp-theme' ),
			),
		),
		array(
			'id'              => 'financial-analyst',
			'shortLabel'      => 'FA',
			'title'           => __( 'Financial Analyst', 'ccg-wp-theme' ),
			'focus'           => __( 'Budget, funding, and optimization activities', 'ccg-wp-theme' ),
			'icon'            => 'chart',
			'responsibilities' => array(
				__( 'Provides understanding of and leads financial planning and funding activities', 'ccg-wp-theme' ),
				__( 'Leads cost estimation, ongoing FinOps, and budgeting activities', 'ccg-wp-theme' ),
				__( 'Aids CORs and customers through funding collection and approval', 'ccg-wp-theme' ),
				__( 'Advises customers on cost-optimization opportunities', 'ccg-wp-theme' ),
			),
		),
	);
}

/**
 * Echo About Hybrid Cloud sticky cross-page nav (interior-section-nav classes).
 *
 * @param string $current_slug Active section id (e.g. benefits).
 */
function ccg_about_hybrid_cloud_sticky_nav( $current_slug ) {
	$items = array();
	foreach ( ccg_about_hybrid_cloud_nav_items() as $item ) {
		$items[] = array(
			'id'    => $item['id'],
			'label' => $item['label'],
			'href'  => $item['href'],
		);
	}

	ccg_render_interior_section_nav(
		$items,
		array(
			'aria_label' => __( 'About Hybrid Cloud pages', 'ccg-wp-theme' ),
			'active_id'  => sanitize_title( (string) $current_slug ),
		)
	);
}

/**
 * Echo About Hybrid Cloud chrome: breadcrumb bar + hero + sticky nav.
 *
 * @param array<string, mixed> $args {
 *     @type string $current_slug    Nav active slug.
 *     @type string $current_label   Breadcrumb current label.
 *     @type string $title           Hero title.
 *     @type string $description     Hero description.
 *     @type string $background_image Optional background image URL.
 *     @type bool   $show_actions    Show Get Started / Learn More (default false).
 * }
 */
function ccg_about_hybrid_cloud_chrome( $args = array() ) {
	$defaults = ccg_about_hybrid_cloud_hero_defaults();
	$args     = wp_parse_args(
		$args,
		array(
			'current_slug'     => 'program-overview',
			'current_label'    => '',
			'title'            => $defaults['title'],
			'description'      => $defaults['description'],
			'background_image' => '',
			'show_actions'     => false,
		)
	);

	$current_label = $args['current_label'] ? (string) $args['current_label'] : (string) $args['title'];
	$bg            = is_string( $args['background_image'] ) ? $args['background_image'] : '';
	$has_image     = '' !== $bg;
	$band_class    = 'tpl-2col-hero-band' . ( $has_image ? ' about-hybrid-cloud-hero-band--image' : '' );
	$hero_class    = 'po-hero about-hybrid-cloud-hero' . ( $has_image ? ' about-hybrid-cloud-hero--image' : '' );
	$about_url     = home_url( user_trailingslashit( '/about/program-overview' ) );
	$contact_url   = home_url( user_trailingslashit( '/about/contact-us' ) );
	$overview_url  = $about_url;
	?>
<header class="<?php echo esc_attr( $band_class ); ?>">
	<?php if ( $has_image ) : ?>
	<img
		src="<?php echo esc_url( $bg ); ?>"
		alt=""
		class="about-hybrid-cloud-hero__background"
		decoding="async"
		fetchpriority="high"
	/>
	<?php endif; ?>
	<div class="tpl-2col-breadcrumb-bar">
		<nav aria-label="<?php echo esc_attr__( 'Breadcrumb', 'ccg-wp-theme' ); ?>" class="kc-breadcrumb-inner">
			<ol class="kc-breadcrumb-list">
				<li>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a>
				</li>
				<li aria-hidden="true" class="kc-breadcrumb-sep"><?php ccg_about_hybrid_cloud_breadcrumb_chevron(); ?></li>
				<li>
					<a href="<?php echo esc_url( $about_url ); ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'About Hybrid Cloud', 'ccg-wp-theme' ); ?></a>
				</li>
				<li aria-hidden="true" class="kc-breadcrumb-sep"><?php ccg_about_hybrid_cloud_breadcrumb_chevron(); ?></li>
				<li>
					<span class="kc-breadcrumb-current"><?php echo esc_html( $current_label ); ?></span>
				</li>
			</ol>
		</nav>
	</div>

	<section class="<?php echo esc_attr( $hero_class ); ?>" aria-labelledby="about-hybrid-cloud-heading">
		<div class="po-hero__glow" aria-hidden="true"></div>
		<div class="init-hero__inner po-hero__inner">
			<div class="init-hero__text po-hero__text">
				<h1 id="about-hybrid-cloud-heading" class="init-hero__heading po-hero__heading">
					<?php echo esc_html( (string) $args['title'] ); ?>
				</h1>
				<p class="init-hero__description po-hero__description">
					<?php echo esc_html( (string) $args['description'] ); ?>
				</p>
				<?php if ( ! empty( $args['show_actions'] ) ) : ?>
				<div class="init-hero__actions">
					<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="<?php echo esc_url( $contact_url ); ?>">
						<?php esc_html_e( 'Get Started', 'ccg-wp-theme' ); ?>
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</a>
					<a class="ds-c-button ds-c-button--ghost ds-c-button--on-dark" href="<?php echo esc_url( $overview_url ); ?>">
						<?php esc_html_e( 'Learn More', 'ccg-wp-theme' ); ?>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</header>
	<?php
	ccg_about_hybrid_cloud_sticky_nav( (string) $args['current_slug'] );
}

/**
 * Return HTML string for About Hybrid Cloud chrome (for embedding in wp:html).
 *
 * @param array<string, mixed> $args Same as ccg_about_hybrid_cloud_chrome().
 * @return string
 */
function ccg_about_hybrid_cloud_chrome_html( $args = array() ) {
	ob_start();
	ccg_about_hybrid_cloud_chrome( $args );
	return trim( ob_get_clean() );
}

/**
 * Gutenberg block markup for the Benefits page body.
 *
 * @return string
 */
function ccg_about_benefits_page_content() {
	$hero_image = ccg_about_benefits_image_url( 'customer-support-hero.png' );
	$team_image = ccg_about_benefits_image_url( 'customer-support-team.png' );
	$roles      = ccg_about_benefits_support_roles();
	$contact    = home_url( user_trailingslashit( '/about/contact-us' ) );

	ob_start();
	?>
<!-- wp:group {"align":"full","className":"ccg-about-sections program-overview about-hybrid-cloud-page cst-page","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull ccg-about-sections program-overview about-hybrid-cloud-page cst-page">
<!-- wp:html -->
<?php
	ccg_about_hybrid_cloud_chrome(
		array(
			'current_slug'     => 'benefits',
			'current_label'    => __( 'Benefits', 'ccg-wp-theme' ),
			'title'            => __( 'Hybrid Cloud Customer Support Team Overview', 'ccg-wp-theme' ),
			'description'      => __(
				'The CMS Hybrid Cloud support team aims to provide a streamlined customer journey across all hosting offerings. We are committed to taking a customer-centric approach, streamlining all touchpoints where possible, and being a core resource for Hybrid Cloud customers throughout their customer journey.',
				'ccg-wp-theme'
			),
			'background_image' => $hero_image,
			'show_actions'     => false,
		)
	);
?>
<!-- /wp:html -->

<!-- wp:html -->
<section class="cst-team" aria-labelledby="cst-team-heading">
	<div class="cst-container">
		<h2 id="cst-team-heading" class="cst-section-title"><?php esc_html_e( 'Customer Support Team', 'ccg-wp-theme' ); ?></h2>

		<div class="cst-team-map">
			<?php if ( $team_image ) : ?>
			<img
				src="<?php echo esc_url( $team_image ); ?>"
				alt="<?php echo esc_attr__( 'Team members stacking their hands together', 'ccg-wp-theme' ); ?>"
				class="cst-team-map__image"
				loading="lazy"
				decoding="async"
			/>
			<?php endif; ?>
			<?php foreach ( $roles as $role ) : ?>
			<article class="cst-role-card cst-role-card--<?php echo esc_attr( $role['id'] ); ?>">
				<span class="cst-role-card__icon"><?php ccg_about_hybrid_cloud_role_icon( $role['icon'] ); ?></span>
				<h3><?php echo esc_html( sprintf( '%1$s (%2$s)', $role['title'], $role['shortLabel'] ) ); ?></h3>
				<p><strong><?php esc_html_e( 'Focus:', 'ccg-wp-theme' ); ?></strong> <?php echo esc_html( $role['focus'] ); ?></p>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="cst-responsibilities" aria-labelledby="cst-responsibilities-heading">
	<div class="cst-container cst-container--narrow">
		<h2 id="cst-responsibilities-heading" class="cst-section-title"><?php esc_html_e( 'Our Support Roles & Responsibilities', 'ccg-wp-theme' ); ?></h2>

		<div class="cst-accordion-list">
			<?php foreach ( $roles as $role ) : ?>
			<details class="cst-accordion" open>
				<summary>
					<span class="cst-accordion__icon"><?php ccg_about_hybrid_cloud_role_icon( $role['icon'] ); ?></span>
					<span><?php echo esc_html( $role['title'] ); ?></span>
					<svg class="cst-accordion__chevron" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 12l5-5 5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</summary>
				<div class="cst-accordion__content">
					<div class="cst-accordion__role">
						<span><?php esc_html_e( 'Support Team', 'ccg-wp-theme' ); ?></span>
						<strong><?php echo esc_html( $role['title'] ); ?></strong>
					</div>
					<div class="cst-accordion__responsibilities">
						<span><?php esc_html_e( 'Responsibilities', 'ccg-wp-theme' ); ?></span>
						<ul>
							<?php foreach ( $role['responsibilities'] as $item ) : ?>
							<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</details>
			<?php endforeach; ?>
		</div>

		<p class="cst-updated">
			<span aria-hidden="true">▣</span> <?php esc_html_e( 'Last updated: October 24, 2024', 'ccg-wp-theme' ); ?>
		</p>

		<a class="cst-feedback" href="<?php echo esc_url( $contact ); ?>">
			<span class="cst-feedback__icon" aria-hidden="true">●</span>
			<span><?php esc_html_e( 'We want to continuously enhance your customer experience. Please use the CMS Hybrid Cloud Customer Experience portal to share any feedback.', 'ccg-wp-theme' ); ?></span>
			<?php ccg_about_hybrid_cloud_arrow_icon(); ?>
		</a>
	</div>
</section>
<!-- /wp:html -->

<!-- wp:html -->
<section class="cst-get-started" aria-labelledby="cst-get-started-heading">
	<div class="cst-container">
		<h2 id="cst-get-started-heading"><?php esc_html_e( 'Getting started with CMS Hybrid Cloud', 'ccg-wp-theme' ); ?></h2>
		<div class="cst-get-started__grid">
			<div>
				<h3><?php esc_html_e( 'Ready to get started?', 'ccg-wp-theme' ); ?></h3>
				<a class="ds-c-button ds-c-button--solid ccg-btn-accent cst-get-started__button" href="<?php echo esc_url( $contact ); ?>">
					<?php esc_html_e( 'Request to use CMS Hybrid Cloud', 'ccg-wp-theme' ); ?>
					<?php ccg_about_hybrid_cloud_arrow_icon(); ?>
				</a>
			</div>
			<div>
				<h3><?php esc_html_e( 'Want updates?', 'ccg-wp-theme' ); ?></h3>
				<p><?php esc_html_e( 'Visit our news and learning resources for the latest information about CMS Hybrid Cloud.', 'ccg-wp-theme' ); ?></p>
			</div>
			<div>
				<h3><?php esc_html_e( 'Have more questions?', 'ccg-wp-theme' ); ?></h3>
				<p><?php esc_html_e( 'A Hosting Coordinator can help answer questions and guide you through the migration process.', 'ccg-wp-theme' ); ?></p>
				<a href="<?php echo esc_url( $contact ); ?>"><?php esc_html_e( 'Contact the CMS Hybrid Cloud team', 'ccg-wp-theme' ); ?></a>
			</div>
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
 * Gutenberg block markup for About Hybrid Cloud placeholder child pages.
 *
 * @param string $slug  Section slug (success-stories | contact-us).
 * @param string $title Optional title override.
 * @return string
 */
function ccg_about_placeholder_page_content( $slug, $title = '' ) {
	$slug = sanitize_title( (string) $slug );
	$meta = ccg_about_hybrid_cloud_placeholder_meta( $slug );

	if ( null === $meta ) {
		$meta = array(
			'title'       => $title ? (string) $title : ucwords( str_replace( '-', ' ', $slug ) ),
			'description' => '',
		);
	}

	if ( $title ) {
		$meta['title'] = (string) $title;
	}

	$hero_image = ccg_about_benefits_image_url( 'customer-support-hero.png' );
	$heading_id = $slug . '-heading';

	ob_start();
	?>
<!-- wp:group {"align":"full","className":"ccg-about-sections program-overview about-hybrid-cloud-page cst-page","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull ccg-about-sections program-overview about-hybrid-cloud-page cst-page">
<!-- wp:html -->
<?php
	ccg_about_hybrid_cloud_chrome(
		array(
			'current_slug'     => $slug,
			'current_label'    => $meta['title'],
			'title'            => $meta['title'],
			'description'      => $meta['description'],
			'background_image' => $hero_image,
			'show_actions'     => false,
		)
	);
?>
<!-- /wp:html -->

<!-- wp:html -->
<div class="kc-content">
	<section class="kc-section about-hybrid-cloud-section" aria-labelledby="<?php echo esc_attr( $heading_id ); ?>">
		<h2 id="<?php echo esc_attr( $heading_id ); ?>" class="kc-section-heading po-section-heading"><?php echo esc_html( $meta['title'] ); ?></h2>
		<?php if ( '' !== $meta['description'] ) : ?>
		<p class="kc-section-subtitle po-section-lede"><?php echo esc_html( $meta['description'] ); ?></p>
		<?php endif; ?>
	</section>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:group -->
	<?php

	return trim( ob_get_clean() );
}
