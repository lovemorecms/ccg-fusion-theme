<?php
/**
 * Program Overview — hero band (breadcrumbs + po-hero).
 *
 * @package ccg-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$home_url    = esc_url( home_url( '/' ) );
$about_url   = esc_url( ccg_nav_url( '/about/program-overview' ) );
$get_started = esc_url( home_url( '/#pathways' ) );
?>
<header class="tpl-2col-hero-band ccg-about-hero-band">
	<div class="tpl-2col-breadcrumb-bar">
		<nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'ccg-wp-theme' ); ?>" class="kc-breadcrumb-inner">
			<div class="kc-breadcrumb-list">
				<a href="<?php echo $home_url; ?>" class="kc-breadcrumb-link"><?php esc_html_e( 'Home', 'ccg-wp-theme' ); ?></a>
				<span class="kc-breadcrumb-sep" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</span>
				<a href="<?php echo $about_url; ?>" class="kc-breadcrumb-link" id="about"><?php esc_html_e( 'About', 'ccg-wp-theme' ); ?></a>
				<span class="kc-breadcrumb-sep" aria-hidden="true">
					<svg width="14" height="14" viewBox="0 0 16 16" fill="none" focusable="false" aria-hidden="true"><path d="M6 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</span>
				<span class="kc-breadcrumb-current"><?php esc_html_e( 'Program Overview', 'ccg-wp-theme' ); ?></span>
			</div>
		</nav>
	</div>

	<section class="po-hero" aria-labelledby="po-hero-heading">
		<div class="po-hero__glow" aria-hidden="true"></div>
		<div class="init-hero__inner po-hero__inner">
			<div class="init-hero__text po-hero__text">
				<h1 id="po-hero-heading" class="init-hero__heading po-hero__heading">
					<?php esc_html_e( 'Why Hybrid Cloud Hosting', 'ccg-wp-theme' ); ?>
				</h1>
				<p class="init-hero__description po-hero__description">
					<?php esc_html_e( "CMS's Hybrid Cloud service provides all the benefits of cloud hosting – secure, scalable, and cost effective – along with the added benefits of regulatory and organizational control of a traditional data center.", 'ccg-wp-theme' ); ?>
				</p>
				<div class="init-hero__actions">
					<a class="ds-c-button ds-c-button--solid ccg-btn-accent" href="<?php echo $get_started; ?>">
						<?php esc_html_e( 'Get Started', 'ccg-wp-theme' ); ?>
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</a>
					<a class="ds-c-button ds-c-button--ghost ccg-btn-ghost-on-dark" href="#critical-work">
						<?php esc_html_e( 'Learn More', 'ccg-wp-theme' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
</header>
